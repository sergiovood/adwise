document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);

    // Sprawdzenie czy urządzenie jest mobilne
    const isMobile = window.innerWidth <= 768;

    // Konfiguracja animacji w zależności od rozmiaru ekranu
    const config = {
        scrubValue: isMobile ? 2.5 : 1.5,
        scaleValue: isMobile ? 12 : 15,
        start: isMobile ? 'top 80%' : '300px center', // Start na mobile
        end: isMobile ? 'center 30%' : 'center center', 
        smoothness: 0.3
    };

    // Główna animacja
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: '.image-reveal',
            start: config.start,
            end: config.end,
            scrub: config.scrubValue,
            markers: false,
            onUpdate: function(self) {
                if (self.progress > 0.85) {
                    const opacity = 1 - (self.progress - 0.85) * 20;
                    gsap.set('.bg-section', { opacity });
                    
                    if (self.progress > 0.95) {
                        gsap.set('.bg-image-under', { zIndex: 99 });
                    }
                } else {
                    gsap.set('.bg-section', { opacity: 1 });
                    gsap.set('.bg-image-under', { zIndex: 1 });
                }
            }
        }
    });

    // Początkowy stan
    gsap.set(['.bg-section', '.bg-image-under'], {
        transformOrigin: 'center center',
        scale: 1
    });

    // Animacja skalowania wraz z przewijaniem strony
    tl.to('.bg-section', {
        scale: config.scaleValue,
        duration: 1,
        ease: "power1.inOut" 
    })
    .to('.bg-image-under', {
        scale: 0.9,
        duration: 1,
        ease: "power1.inOut" 
    }, 0);

    // Obsługa popupu wideo
    const videoOverlay = document.querySelector('.video-overlay');
    const videoPopup = document.querySelector('.video-popup');
    const videoPopupPlayer = document.querySelector('.video-popup__player');
    const closeButton = document.querySelector('.video-popup__close');

    // Funkcja inicjalizacji popupu
    function initVideoPopup() {
        if (!videoOverlay || !videoPopup || !closeButton) return;

        const preventAndClose = (e) => {
            e.preventDefault();
            e.stopPropagation();
            closePopup();
        };

        const openPopup = function(e) {
            e.preventDefault();
            const videoType = this.getAttribute('data-video-type');
            const videoUrl = this.getAttribute('data-video-url');
            const youtubeId = this.getAttribute('data-youtube-id');
            
            let videoContent = '';
            if (videoType === 'youtube' && youtubeId) {
                videoContent = `
                    <iframe
                        src="https://www.youtube.com/embed/${youtubeId}?autoplay=1"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>`;
            } else if (videoType === 'file' && videoUrl) {
                videoContent = `
                    <video controls autoplay playsinline>
                        <source src="${videoUrl}" type="video/webm">
                        Your browser does not support the video tag.
                    </video>`;
            }

            if (videoContent) {
                videoPopupPlayer.innerHTML = videoContent;
                videoPopup.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        };

        const closePopup = () => {
            videoPopup.classList.remove('active');
            videoPopupPlayer.innerHTML = '';
            document.body.style.overflow = '';
        };

        // Event listeners dla desktop i mobile
        videoOverlay.addEventListener('click', openPopup);
        videoOverlay.addEventListener('touchstart', openPopup);
        
        // Obsługa zamykania popup
        closeButton.addEventListener('click', preventAndClose);
        closeButton.addEventListener('touchstart', preventAndClose);
        closeButton.addEventListener('touchend', preventAndClose);
        
        // Zamykanie popupu po kliknięciu/dotknięciu tła
        const handleBackgroundClick = (e) => {
            if (e.target === videoPopup) {
                e.preventDefault();
                e.stopPropagation();
                closePopup();
            }
        };
        
        videoPopup.addEventListener('click', handleBackgroundClick);
        videoPopup.addEventListener('touchstart', handleBackgroundClick);
        videoPopup.addEventListener('touchend', handleBackgroundClick);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && videoPopup.classList.contains('active')) {
                closePopup();
            }
        });
    }

    // Inicjalizacja popupu
    initVideoPopup();
});