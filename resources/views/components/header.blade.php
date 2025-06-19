<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                WebOPD
            </a>
        </div>
        <nav class="hidden md:flex space-x-6">
            <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-900 font-medium">Beranda</a>
            <a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Tentang</a>
            <a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Layanan</a>
            <a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Berita</a>
            <a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Kontak</a>
        </nav>
        <div class="md:hidden">
            <button type="button" class="text-gray-600 hover:text-gray-900 focus:outline-none" id="mobile-menu-button">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
    <!-- Mobile menu, show/hide based on menu state -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ url('/') }}" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md">Beranda</a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md">Tentang</a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md">Layanan</a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md">Berita</a>
            <a href="#" class="block px-3 py-2 text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 rounded-md">Kontak</a>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        
        button.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });
    });
</script>