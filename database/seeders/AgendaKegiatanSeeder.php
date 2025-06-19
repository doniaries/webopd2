<?php

namespace Database\Seeders;

use App\Models\AgendaKegiatan;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AgendaKegiatanSeeder extends Seeder
{
    public function run()
    {
        // Get all teams
        $teams = Team::all();
        
        if ($teams->isEmpty()) {
            $this->command->warn('No teams found. Please run TeamSeeder first!');
            return;
        }

        // Base data for agenda kegiatan
        $now = Carbon::now();
        
        // Agenda yang sudah selesai (bulan lalu)
        $agendaSelesai = [
            [
                'nama_agenda' => 'Rapat Evaluasi Triwulan I',
                'uraian_agenda' => 'Evaluasi capaian kinerja triwulan I tahun ' . $now->year . ' dan penyusunan rencana triwulan II.',
                'tempat' => 'Ruang Rapat Lantai 3',
                'dari_tanggal' => $now->copy()->subMonth()->startOfMonth()->addDays(5)->setHour(9)->setMinute(0)->format('Y-m-d'),
                'sampai_tanggal' => $now->copy()->subMonth()->startOfMonth()->addDays(5)->setHour(12)->setMinute(0)->format('Y-m-d')
            ],
            [
                'nama_agenda' => 'Workshop Penyusunan RKPD',
                'uraian_agenda' => 'Workshop penyusunan Rencana Kerja Pemerintah Daerah tahun ' . ($now->year + 1) . '.',
                'tempat' => 'Aula Kantor Bupati',
                'dari_tanggal' => $now->copy()->subMonth()->startOfMonth()->addDays(10)->setHour(8)->setMinute(0)->format('Y-m-d'),
                'sampai_tanggal' => $now->copy()->subMonth()->startOfMonth()->addDays(12)->setHour(16)->setMinute(0)->format('Y-m-d')
            ]
        ];

        // Agenda yang sedang berlangsung (hari ini)
        $agendaBerjalan = [
            [
                'nama_agenda' => 'Rapat Koordinasi Bulanan',
                'uraian_agenda' => 'Rapat koordinasi bulanan untuk sinkronisasi program dan kegiatan antar OPD.',
                'tempat' => 'Ruang Rapat Lantai 2',
                'dari_tanggal' => $now->copy()->setHour(10)->setMinute(0)->format('Y-m-d'),
                'sampai_tanggal' => $now->copy()->setHour(12)->setMinute(0)->format('Y-m-d')
            ]
        ];

        // Agenda yang akan datang (bulan ini dan depan)
        $agendaAkanDatang = [
            [
                'nama_agenda' => 'Pelatihan Manajemen Keuangan Daerah',
                'uraian_agenda' => 'Pelatihan ini bertujuan untuk meningkatkan kompetensi SDM di bidang pengelolaan keuangan daerah.',
                'tempat' => 'Aula Kantor Bupati',
                'dari_tanggal' => $now->copy()->addDays(3)->setHour(8)->setMinute(0)->format('Y-m-d'),
                'sampai_tanggal' => $now->copy()->addDays(5)->setHour(17)->setMinute(0)->format('Y-m-d')
            ],
            [
                'nama_agenda' => 'Rakor Pimpinan',
                'uraian_agenda' => 'Rapat koordinasi pimpinan untuk mengevaluasi capaian kinerja dan menyusun rencana kerja ke depan.',
                'tempat' => 'Ruang Rapat Lantai 3',
                'dari_tanggal' => $now->copy()->addWeek()->setHour(9)->setMinute(0)->format('Y-m-d'),
                'sampai_tanggal' => $now->copy()->addWeek()->setHour(12)->setMinute(0)->format('Y-m-d')
            ],
            [
                'nama_agenda' => 'Kunjungan Kerja ke Kecamatan Terpencil',
                'uraian_agenda' => 'Kunjungan kerja ke kecamatan terpencil untuk mengevaluasi pelaksanaan program pembangunan.',
                'tempat' => 'Kecamatan Terpencil',
                'dari_tanggal' => $now->copy()->addWeeks(2)->setHour(8)->setMinute(0)->format('Y-m-d'),
                'sampai_tanggal' => $now->copy()->addWeeks(2)->addDays(2)->setHour(15)->setMinute(0)->format('Y-m-d')
            ],
            [
                'nama_agenda' => 'Seminar Nasional Pembangunan Daerah',
                'uraian_agenda' => 'Seminar nasional dengan tema "Inovasi dan Kolaborasi dalam Mewujudkan Pembangunan Berkelanjutan".',
                'tempat' => 'Hotel Grand Ballroom',
                'dari_tanggal' => $now->copy()->addMonth()->startOfMonth()->addDays(5)->setHour(8)->setMinute(0)->format('Y-m-d'),
                'sampai_tanggal' => $now->copy()->addMonth()->startOfMonth()->addDays(6)->setHour(17)->setMinute(0)->format('Y-m-d')
            ]
        ];

        // Gabungkan semua agenda
        $agendaKegiatanData = array_merge($agendaSelesai, $agendaBerjalan, $agendaAkanDatang);

        // Hapus data agenda yang mungkin sudah ada
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        AgendaKegiatan::truncate();
        \Illuminate\Support\Facades\DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Create agenda kegiatan for each team
        foreach ($teams as $team) {
            foreach ($agendaKegiatanData as $data) {
                // Add team-specific data
                $agendaKegiatan = array_merge($data, [
                    'team_id' => $team->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Create the agenda kegiatan
                AgendaKegiatan::create($agendaKegiatan);
            }
        }
        
        $this->command->info('Berhasil menambahkan ' . count($agendaKegiatanData) * count($teams) . ' data agenda kegiatan.');

    }
}
