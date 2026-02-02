document.addEventListener('DOMContentLoaded', () => {

    // --- SCRIPT UNTUK HERO SLIDER (SWIPER.JS) ---
    const swiper = new Swiper('.hero-slider', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        coverflowEffect: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    // --- SCRIPT UNTUK ANIMASI SAAT SCROLL (INTERSECTION OBSERVER) ---
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            } else {
                // Hapus kelas jika Anda ingin animasi berulang setiap kali elemen masuk layar
                // entry.target.classList.remove('visible');
            }
        });
    }, { threshold: 0.1 });

    // Memilih semua elemen yang akan dianimasikan
    const elementsToAnimate = document.querySelectorAll('.def-text h2, .def-text p, .def-btn, .def-image, .section-title, .section-subtitle, .partner-item, .cta-inner');
    
    elementsToAnimate.forEach((el, index) => {
        if (el.classList.contains('partner-item')) {
            el.style.transitionDelay = `${(index % 6) * 0.05}s`;
        }
        observer.observe(el);
    });

    // --- SCRIPT UNTUK ANIMASI BENTO GRID ---
    const bentoCards = document.querySelectorAll('.bento-card');
    
    bentoCards.forEach((card, index) => {
        // Menambahkan delay animasi agar kartu muncul satu per satu
        card.style.animationDelay = `${index * 100}ms`;
        observer.observe(card); // Menggunakan observer yang sama untuk memicu animasi
    });

    // --- SCRIPT UNTUK INTERAKSI KARTU BENTO (PARTIKEL & CAHAYA) ---
    const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    const prefersReducedMotion = motionQuery.matches;

    bentoCards.forEach(card => {
        // Logika untuk Efek Cahaya (Glow) yang mengikuti kursor
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            card.style.setProperty('--glow-x', `${x}px`);
            card.style.setProperty('--glow-y', `${y}px`);
        });

        // Logika untuk Animasi Partikel (hanya jika pengguna tidak meminta pengurangan gerakan)
        if (!prefersReducedMotion) {
            let particles = [];

            card.addEventListener('mouseenter', () => {
                for (let i = 0; i < 15; i++) {
                    const p = document.createElement('div');
                    p.classList.add('particle');
                    card.appendChild(p);
                    
                    const rect = card.getBoundingClientRect();
                    const startX = Math.random() * rect.width;
                    const startY = Math.random() * rect.height;

                    gsap.set(p, { x: startX, y: startY, scale: 0, opacity: 0 });

                    gsap.to(p, {
                        duration: 0.5,
                        scale: 1,
                        opacity: 1,
                        ease: 'power2.out'
                    });

                    gsap.to(p, {
                        duration: 3 + Math.random() * 2,
                        x: `+=${(Math.random() - 0.5) * 100}`,
                        y: `+=${(Math.random() - 0.5) * 100}`,
                        repeat: -1,
                        yoyo: true,
                        ease: 'sine.inOut'
                    });
                    particles.push(p);
                }
            });

            card.addEventListener('mouseleave', () => {
                gsap.to(particles, {
                    duration: 0.3,
                    scale: 0,
                    opacity: 0,
                    ease: 'power2.in',
                    stagger: 0.01,
                    onComplete: () => {
                        particles.forEach(p => p.remove());
                        particles = [];
                    }
                });
            });
        }
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // SCRIPT UNTUK 3D TILTED CARD EFFECT PADA MITRA KAMI
    // -----------------------------------------------------------
    const tiltedCards = document.querySelectorAll('.tilted-card');

    if (tiltedCards.length > 0) {
        tiltedCards.forEach(card => {
            const inner = card.querySelector('.tilted-card-inner');
            
            // Konfigurasi bisa diubah di sini
            const rotateAmplitude = 25;   // Seberapa kuat efek rotasinya
            const scaleOnHover = 1.2;     // Seberapa besar kartu saat disentuh mouse
            const perspectiveValue = 1500; // Jarak perspektif untuk efek 3D

            card.style.perspective = `${perspectiveValue}px`;

            // Event saat mouse masuk ke area kartu
            card.addEventListener('mouseenter', () => {
                gsap.to(inner, { 
                    duration: 0.5, 
                    scale: scaleOnHover, 
                    ease: 'back.out(1.7)' 
                });
            });

            // Event saat mouse bergerak di atas kartu
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                
                // Menghitung posisi mouse relatif terhadap kartu
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                // Set custom properties CSS untuk efek highlight
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);

                // Menghitung offset dari tengah kartu
                const offsetX = x - rect.width / 2;
                const offsetY = y - rect.height / 2;

                // Menghitung rotasi berdasarkan posisi mouse
                const rotateX = (offsetY / (rect.height / 2)) * -rotateAmplitude;
                const rotateY = (offsetX / (rect.width / 2)) * rotateAmplitude;
                
                // Menerapkan animasi rotasi dengan GSAP
                gsap.to(inner, {
                    duration: 0.7,
                    rotateX: rotateX,
                    rotateY: rotateY,
                    ease: 'power3.out'
                });
            });

            // Event saat mouse meninggalkan area kartu
            card.addEventListener('mouseleave', () => {
                // Mengembalikan kartu ke posisi dan skala semula
                gsap.to(inner, {
                    duration: 0.8,
                    rotateX: 0,
                    rotateY: 0,
                    scale: 1,
                    ease: 'elastic.out(1, 0.4)'
                });
            });
        });
    }
});