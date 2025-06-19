// Fungsi untuk menangani toggle menu mobile
function setupMobileMenu() {
    console.log('Setting up mobile menu - DEBUG');
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    console.log('Mobile menu button:', mobileMenuButton);
    console.log('Mobile menu:', mobileMenu);
    
    // Jika salah satu elemen tidak ditemukan, tampilkan pesan error
    if (!mobileMenuButton) {
        console.error('Mobile menu button not found!');
    }
    
    if (!mobileMenu) {
        console.error('Mobile menu not found!');
    }
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function(event) {
            // Mencegah event bubbling
            event.stopPropagation();
            // Toggle the mobile menu
            mobileMenu.classList.toggle('hidden');
            console.log('Mobile menu toggled, hidden:', mobileMenu.classList.contains('hidden'));
        });
        
        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
        
        // Add shadow to header on scroll
        const header = document.querySelector('header');
        if (header) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 10) {
                    header.classList.add('shadow-md');
                } else {
                    header.classList.remove('shadow-md');
                }
            });
        }
    }
}

// Jalankan setup saat DOM sudah dimuat
document.addEventListener('DOMContentLoaded', setupMobileMenu);

// Jalankan setup juga setelah window load untuk memastikan semua elemen sudah dimuat
window.addEventListener('load', setupMobileMenu);

// Jalankan setup langsung jika dokumen sudah dalam keadaan 'interactive' atau 'complete'
if (document.readyState === 'interactive' || document.readyState === 'complete') {
    setupMobileMenu();
}