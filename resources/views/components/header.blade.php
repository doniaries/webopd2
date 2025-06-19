@php
    $pengaturan = \App\Models\Pengaturan::getFirst();
@endphp

<header class="bg-white shadow-lg sticky top-0 z-50 transition-all duration-300">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                @if($pengaturan && $pengaturan->logo_instansi)
                    <img src="{{ asset('storage/' . $pengaturan->logo_instansi) }}" alt="{{ $pengaturan->nama_website ?? 'WebOPD' }}" class="h-10 w-auto">
                @else
                    <div class="bg-blue-600 text-white p-2 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                @endif
                <span class="text-xl font-bold text-gray-800">{{ $pengaturan->nama_website ?? 'WebOPD' }}</span>
            </a>
        </div>
        
        <nav class="hidden md:flex space-x-6">
            <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-blue-600">Beranda</a>
            <a href="#" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-blue-600">Tentang</a>
            <a href="#" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-blue-600">Layanan</a>
            <div class="relative group">
                <button class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-blue-600 flex items-center">
                    Berita
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 hidden group-hover:block">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Semua Berita</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Infografis</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Artikel</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Pengumuman</a>
                </div>
            </div>
            <a href="#" class="text-gray-600 hover:text-blue-600 font-medium transition-colors duration-200 py-2 border-b-2 border-transparent hover:border-blue-600">Kontak</a>
        </nav>
        
        <div class="md:hidden">
            <button type="button" class="text-gray-600 hover:text-blue-600 focus:outline-none transition-colors duration-200" id="mobile-menu-button" aria-label="Menu">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Mobile menu, show/hide based on menu state -->
    <div class="md:hidden hidden bg-white border-t border-gray-100 shadow-inner" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ url('/') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-200">Beranda</a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-200">Tentang</a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-200">Layanan</a>
            
            <!-- Mobile Berita Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex justify-between w-full px-3 py-2 text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-200">
                    <span>Berita</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" class="pl-4 pr-2 py-1 space-y-1">
                    <a href="#" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-200">Semua Berita</a>
                    <a href="#" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-200">Infografis</a>
                    <a href="#" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-200">Artikel</a>
                    <a href="#" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-200">Pengumuman</a>
                </div>
            </div>
            
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-200">Kontak</a>
        </div>
    </div>
</header>