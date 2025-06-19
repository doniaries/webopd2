<x-layouts.app>
    <x-slot name="title">Beranda - WebOPD</x-slot>
    <x-slot name="metaDescription">Portal resmi Organisasi Perangkat Daerah yang menyediakan informasi dan layanan publik.</x-slot>
    
    <!-- Hero Section -->
    <section class="bg-blue-600 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-4xl font-bold mb-4">Selamat Datang di Portal WebOPD</h1>
                    <p class="text-xl mb-6">Portal resmi Organisasi Perangkat Daerah yang menyediakan informasi dan layanan publik untuk masyarakat.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-md font-medium inline-block text-center">Layanan Online</a>
                        <a href="#" class="bg-transparent border border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-md font-medium inline-block text-center">Pelajari Lebih Lanjut</a>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <img src="https://placehold.co/600x400/EEE/31316A" alt="WebOPD Hero Image" class="rounded-lg shadow-lg w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Layanan Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Kami menyediakan berbagai layanan untuk memudahkan masyarakat dalam mengakses informasi dan pelayanan publik.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Perizinan Online</h3>
                    <p class="text-gray-600 mb-4">Ajukan perizinan secara online tanpa perlu datang ke kantor. Proses cepat dan transparan.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                        Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="bg-green-100 text-green-600 p-3 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pengaduan Masyarakat</h3>
                    <p class="text-gray-600 mb-4">Sampaikan keluhan, saran, atau pengaduan Anda terkait pelayanan publik di daerah kami.</p>
                    <a href="#" class="text-green-600 hover:text-green-800 font-medium inline-flex items-center">
                        Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="bg-purple-100 text-purple-600 p-3 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Informasi Publik</h3>
                    <p class="text-gray-600 mb-4">Akses informasi publik seperti anggaran, program kerja, dan laporan kinerja pemerintah daerah.</p>
                    <a href="#" class="text-purple-600 hover:text-purple-800 font-medium inline-flex items-center">
                        Selengkapnya
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Berita Terbaru Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Berita Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Informasi terkini seputar kegiatan dan program pemerintah daerah.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Berita 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                    <img src="https://placehold.co/600x400/EEE/31316A" alt="Berita 1" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ date('d M Y') }}</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Pembukaan Pelayanan Terpadu Satu Pintu</h3>
                        <p class="text-gray-600 mb-4">Pemerintah daerah meresmikan Pelayanan Terpadu Satu Pintu untuk memudahkan masyarakat dalam mengurus berbagai perizinan.</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Berita 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                    <img src="https://placehold.co/600x400/EEE/31316A" alt="Berita 2" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ date('d M Y', strtotime('-1 day')) }}</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Program Pemberdayaan UMKM Lokal</h3>
                        <p class="text-gray-600 mb-4">Pemerintah daerah meluncurkan program pemberdayaan UMKM lokal untuk meningkatkan perekonomian masyarakat.</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Berita 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
                    <img src="https://placehold.co/600x400/EEE/31316A" alt="Berita 3" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>{{ date('d M Y', strtotime('-2 days')) }}</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Peningkatan Infrastruktur Jalan Daerah</h3>
                        <p class="text-gray-600 mb-4">Pemerintah daerah melakukan peningkatan infrastruktur jalan di beberapa wilayah untuk memperlancar akses transportasi.</p>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium inline-flex items-center">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-10">
                <a href="#" class="bg-blue-600 text-white hover:bg-blue-700 px-6 py-3 rounded-md font-medium inline-block">Lihat Semua Berita</a>
            </div>
        </div>
    </section>

    <!-- Statistik Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Statistik Layanan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Pencapaian kami dalam memberikan pelayanan kepada masyarakat.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-4xl font-bold text-blue-600 mb-2">1,234</div>
                    <div class="text-gray-600">Perizinan Terbit</div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-4xl font-bold text-green-600 mb-2">567</div>
                    <div class="text-gray-600">Pengaduan Ditangani</div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-4xl font-bold text-purple-600 mb-2">89</div>
                    <div class="text-gray-600">Program Berjalan</div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-4xl font-bold text-orange-600 mb-2">12,345</div>
                    <div class="text-gray-600">Pengunjung Website</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Butuh Bantuan?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Tim kami siap membantu Anda dengan berbagai pertanyaan dan kebutuhan terkait layanan publik.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#" class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-md font-medium inline-block">Hubungi Kami</a>
                <a href="#" class="bg-transparent border border-white text-white hover:bg-white hover:text-blue-600 px-6 py-3 rounded-md font-medium inline-block">FAQ</a>
            </div>
        </div>
    </section>
</x-layouts.app>