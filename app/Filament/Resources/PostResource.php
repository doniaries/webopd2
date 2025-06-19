<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles as SpatieHasRoles;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Postingan';
    protected static ?string $modelLabel = 'Postingan';
    protected static ?string $navigationGroup = 'Konten';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->schema([
                        // Left Column - Main Content
                        Forms\Components\Group::make()
                            ->schema([
                                // Main Content Section
                                Forms\Components\Section::make('Informasi Dasar')
                                    ->description('Judul dan konten artikel')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Judul')
                                            ->required()
                                            ->maxLength(255)
                                            ->live(onBlur: true)
                                            ->placeholder('Masukkan judul artikel di sini')
                                            ->afterStateUpdated(function ($state, Forms\Set $set) {
                                                $set('slug', \Illuminate\Support\Str::slug($state));
                                            }),

                                        Forms\Components\Hidden::make('slug')
                                            ->required(),

                                        Forms\Components\RichEditor::make('content')
                                            ->label('Isi Artikel')
                                            ->required()
                                            ->toolbarButtons([
                                                'blockquote',
                                                'bold',
                                                'bulletList',
                                                'codeBlock',
                                                'h2',
                                                'h3',
                                                'italic',
                                                'link',
                                                'orderedList',
                                                'redo',
                                                'strike',
                                                'underline',
                                                'undo',
                                            ])
                                            ->columnSpanFull(),
                                    ])
                                    ->columnSpan(2),

                                // Images Section
                                Forms\Components\Section::make('Media')
                                    ->schema([
                                        // Featured Image
                                        Forms\Components\FileUpload::make('featured_image')
                                            ->label('Gambar Utama')
                                            ->helperText('Foto ini akan ditampilkan sebagai thumbnail artikel')
                                            ->directory('featured-images')
                                            ->image()
                                            ->imageEditor()
                                            ->imageResizeMode('cover')
                                            ->imageCropAspectRatio('16:9')
                                            ->imageResizeTargetWidth('1200')
                                            ->optimize('webp')
                                            ->maxSize(2048),

                                        // Gallery Images
                                        Forms\Components\FileUpload::make('gallery_images')
                                            ->label('Galeri Gambar')
                                            ->helperText('Gambar tambahan untuk konten artikel')
                                            ->multiple()
                                            ->directory('gallery-images')
                                            ->image()
                                            ->imageResizeMode('cover')
                                            ->optimize('webp')
                                            ->maxSize(2048)
                                            ->openable()
                                            ->previewable()
                                            ->afterStateUpdated(function ($state) {
                                                if (!is_array($state)) {
                                                    return [$state];
                                                }
                                                return $state;
                                            })
                                            ->dehydrated(fn($state) => filled($state)),
                                    ])
                                    ->columnSpan(1),
                            ])
                            ->columnSpan(3),

                        // Right Column - Sidebar
                        Forms\Components\Group::make()
                            ->schema([
                                // Team ID (hidden)
                                Forms\Components\Hidden::make('team_id')
                                    ->default(fn() => Auth::user()->teams->first()?->id)
                                    ->dehydrated(),

                                // Publication Status Section
                                Forms\Components\Section::make('Status Publikasi')
                                    ->description('Pengaturan status publikasi artikel')
                                    ->schema([
                                        Forms\Components\Select::make('status')
                                            ->options([
                                                'draft' => 'Draft',
                                                'published' => 'Dipublikasikan',
                                                'archived' => 'Diarsipkan',
                                            ])
                                            ->default('draft')
                                            ->required(),

                                        Forms\Components\DateTimePicker::make('published_at')
                                            ->label('Tanggal Publikasi')
                                            ->default(now())
                                            ->displayFormat('d M Y H:i')
                                            ->native(false)
                                            ->visible(fn(Forms\Get $get) => $get('status') === 'published'),

                                        Forms\Components\Toggle::make('is_featured')
                                            ->label('Tampilkan Sebagai Unggulan')
                                            ->inline(false),
                                    ]),

                                // Category Section
                                Forms\Components\Section::make('Kategori')
                                    ->description('Pilih kategori artikel')
                                    ->schema([
                                        Forms\Components\Select::make('category_id')
                                            ->relationship('category', 'name', function ($query) {
                                                // Filter kategori berdasarkan team yang sama dengan user yang login
                                                return $query->where('team_id', auth()->user()->teams->first()?->id);
                                            })
                                            ->label('Kategori')
                                            ->preload()
                                            ->searchable()
                                            ->required()
                                            ->createOptionForm([
                                                Forms\Components\TextInput::make('name')
                                                    ->label('Nama Kategori')
                                                    ->required()
                                                    ->maxLength(255)
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                                                        $set('slug', \Illuminate\Support\Str::slug($state));
                                                    }),

                                                Forms\Components\Hidden::make('slug')
                                                    ->required()
                                                    ->unique(ignoreRecord: true),

                                                Forms\Components\Hidden::make('team_id')
                                                    ->default(fn() => auth()->user()->teams->first()?->id),

                                                Forms\Components\Toggle::make('is_active')
                                                    ->label('Aktif')
                                                    ->default(true),
                                            ])
                                            ->createOptionAction(function (Forms\Components\Actions\Action $action) {
                                                return $action
                                                    ->label('Tambah Kategori Baru')
                                                    ->icon('heroicon-o-plus-circle');
                                            }),
                                    ]),

                                // Additional Info Section
                                Forms\Components\Section::make('Informasi Tambahan')
                                    ->description('Informasi tambahan artikel')
                                    ->schema([
                                        // User ID
                                        Forms\Components\Select::make('user_id') // Ini akan menyimpan ID user di database
                                            ->label('Nama User') // Label yang akan terlihat di form
                                            ->relationship('user', 'name') // Mengambil 'name' dari relasi 'user' untuk ditampilkan di dropdown
                                            ->default(function (?Model $record) {
                                                // Otomatis mengisi dengan ID user yang sedang login saat membuat record baru
                                                if (!$record) { // Jika $record null, berarti sedang dalam mode "create"
                                                    return auth()->user()->id;
                                                }
                                                // Jika sedang mengedit, gunakan ID user yang sudah ada dari record
                                                return $record->user_id;
                                            })
                                            ->searchable() // Memungkinkan pencarian dalam daftar dropdown
                                            ->preload() // Memuat semua opsi saat pertama kali dibuka (hati-hati jika user terlalu banyak)
                                            ->required() // Opsional: Jadikan field ini wajib diisi
                                            ->disabled(function () {
                                                // Field ini akan dinonaktifkan (disabled) jika user BUKAN 'super_admin'
                                                // Ingat: Gunakan nama peran yang benar sesuai database Anda ('super_admin' dengan underscore).
                                                return !auth()->user()->hasRole('super_admin');
                                            })
                                            ->dehydrated(function ($state, Forms\Get $get, ?Model $record) {
                                                // Logika ini memastikan nilai disimpan dengan benar berdasarkan peran dan mode form.

                                                // Jika user adalah 'super_admin', mereka bisa mengubah, dan nilai $state akan disimpan.
                                                if (auth()->user()->hasRole('super_admin')) {
                                                    return $state;
                                                }

                                                // Jika user BUKAN 'super_admin':
                                                if (!$record) {
                                                    // Untuk mode "create" oleh non-super_admin, simpan ID user yang sedang login.
                                                    return auth()->user()->id;
                                                }

                                                // Untuk mode "edit" oleh non-super_admin, field ini disabled.
                                                // Data dari field disabled tidak otomatis dikirimkan saat submit.
                                                // Jadi, kita harus mengembalikan nilai lama ($get('user_id')) agar tidak di-null-kan atau diubah.
                                                return $get('user_id');
                                            })
                                            ->hidden(false), // Pastikan field ini selalu terlihat oleh semua

                                        // Views Counter - Dapat dilihat oleh semua tetapi hanya dapat diedit oleh superadmin
                                        Forms\Components\TextInput::make('views')
                                            ->label('Jumlah View')
                                            ->numeric()
                                            ->default(0)
                                            ->readonly(function () {
                                                // PERBAIKI: Gunakan 'super_admin' sesuai dengan nama di database Anda
                                                return !auth()->user()->hasRole('super_admin');
                                            })
                                            ->dehydrated(function ($state, Forms\Get $get, ?Model $record) {
                                                // PERBAIKI: Gunakan 'super_admin' sesuai dengan nama di database Anda
                                                return auth()->user()->hasRole('super_admin') ? $state : null;
                                            })
                                            ->visible(true),
                                    ])
                            ])
                            ->columnSpan(1),
                    ])
                    ->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('team.name')
                    ->hidden()
                    ->searchable(),
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                // Kolom Views - Terlihat oleh semua pengguna
                Tables\Columns\TextColumn::make('views')
                    ->label('Views')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('featured_image_url')
                    ->label('Featured Image')
                    ->circular(false)
                    ->square()
                    ->width(100)
                    ->height(60)
                    ->url(fn(Post $record): ?string => $record->featured_image_url)
                    ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('slug')
                    ->hidden(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'danger' => 'draft',
                        'success' => 'published',
                        'warning' => 'archived',
                    ])
                    ->icons([
                        'heroicon-o-pencil' => 'draft',
                        'heroicon-o-check-circle' => 'published',
                        'heroicon-o-archive-box' => 'archived',
                    ]),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                // Kolom views sudah didefinisikan sebelumnya
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Dihapus')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Dipublikasikan',
                        'archived' => 'Diarsipkan',
                    ]),
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->relationship('category', 'name', function ($query) {
                        return $query->where('team_id', Auth::user()->teams->first()?->id);
                    }),
                Tables\Filters\Filter::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->form([
                        Forms\Components\DatePicker::make('published_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('published_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('published_at', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('published_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->when(!auth()->user()->hasRole('super_admin'), function ($query) {
                $query->where('team_id', auth()->user()->teams->first()?->id);
            });
    }
}
