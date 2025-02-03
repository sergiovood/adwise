document.addEventListener('DOMContentLoaded', function() {
    gsap.registerPlugin(ScrollTrigger);

    // Funkcja do określenia punktów startowych w zależności od szerokości ekranu
    function getStartPosition() {
        const windowWidth = window.innerWidth;
        if (windowWidth > 1640) {
            return '500px center'; // Później dla większych ekranów
        }
        return '300px center'; // Standardowy start dla mniejszych ekranów
    }

    // Animacja maski i tła razem
    const tl = gsap.timeline({
        scrollTrigger: {
            trigger: '.image-reveal',
            start: getStartPosition(),
            end: 'bottom bottom',
            scrub: 1.5, // Wolniejsza animacja
            onUpdate: function(self) {
                if (self.progress > 0.85) {
                    gsap.set('.bg-section', {
                        opacity: 1 - (self.progress - 0.85) * 20
                    });
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

    // Ustawienie początkowego stanu
    gsap.set(['.bg-section', '.bg-image-under'], {
        transformOrigin: 'center center',
        scale: 1
    });

    // Animacje
    tl.to('.bg-section', {
        scale: 20, // Zmniejszony scale dla lepszego efektu
        duration: 1
    })
    .to('.bg-image-under', {
        scale: 0.9,
        duration: 1
    }, 0);

    // Obsługa resize
    window.addEventListener('resize', () => {
        ScrollTrigger.refresh();
    });


    // Obsługa popupu wideo
    const videoOverlay = document.querySelector('.video-overlay');
    const videoPopup = document.querySelector('.video-popup');
    const videoPopupPlayer = document.querySelector('.video-popup__player');
    const closeButton = document.querySelector('.video-popup__close');

    if (videoOverlay && videoPopup && closeButton) {
        // Otwieranie popupu
        videoOverlay.addEventListener('click', function() {
            const videoType = this.dataset.videoType;
            const videoUrl = this.dataset.videoUrl;
            const youtubeId = this.dataset.youtubeId;

            // Przygotuj zawartość wideo
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
                    <video controls autoplay>
                        <source src="${videoUrl}" type="video/webm">
                        Your browser does not support the video tag.
                    </video>`;
            }

            // Wstaw wideo i pokaż popup
            videoPopupPlayer.innerHTML = videoContent;
            videoPopup.classList.add('active');
            document.body.style.overflow = 'hidden'; // Zablokuj scrollowanie strony
        });

        // Zamykanie popupu
        function closePopup() {
            videoPopup.classList.remove('active');
            videoPopupPlayer.innerHTML = ''; // Wyczyść player
            document.body.style.overflow = ''; // Przywróć scrollowanie
        }

        closeButton.addEventListener('click', closePopup);
        
        // Zamykanie po kliknięciu poza wideo
        videoPopup.addEventListener('click', function(e) {
            if (e.target === videoPopup) {
                closePopup();
            }
        });

        // Zamykanie przez ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && videoPopup.classList.contains('active')) {
                closePopup();
            }
        });
    }
});