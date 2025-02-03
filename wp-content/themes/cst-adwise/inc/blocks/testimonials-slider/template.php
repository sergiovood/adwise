<?php
$title = get_field('title');
$main_image = get_field('main_image');
$background_text = get_field('background_text');
$testimonials = get_field('testimonials');
?>

<section class="testimonials-slider">
    <div class="testimonials-slider__container">
        <h2 class="testimonials-slider__title"><?php echo esc_html($title); ?></h2>
        
        <div class="testimonials-slider__content">
            <!-- Lewa kolumna - 30% -->
            <div class="testimonials-slider__image-col">
                <?php if ($main_image): ?>
                    <div class="image-wrapper">
                        <img src="<?php echo esc_url($main_image); ?>" alt="" class="main-image">
                        <?php if ($background_text): ?>
                            <div class="image-overlay-text">
                                <?php echo esc_html($background_text); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Prawa kolumna - 70% -->
            <div class="testimonials-slider__quotes-col">
                <div class="swiper testimonials-swiper">
                    <div class="swiper-wrapper">
                        <?php if ($testimonials): ?>
                            <?php foreach ($testimonials as $testimonial): ?>
                                <div class="swiper-slide">
                                    <div class="quote-icon">
                                    <svg width="57" height="57" viewBox="0 0 57 57" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.2753 0.537598H22.4559V11.3922H17.522C14.315 11.3922 12.5881 12.1323 12.5881 16.5728V22.4936H22.2093V56.5376H0.5V16.8195C0.5 5.96491 6.6674 0.537598 17.2753 0.537598ZM51.3194 0.537598H56.5V11.3922H51.5661C48.1123 11.3922 46.6322 12.1323 46.6322 16.5728V22.4936H56.2533V56.5376H34.5441V16.8195C34.5441 5.96491 40.7115 0.537598 51.3194 0.537598Z" fill="white"/>
                                    </svg>
                                    </div>
                                    <div class="testimonial-content">
                                        <?php echo wpautop($testimonial['quote']); ?>
                                    </div>
                                    <div class="testimonial-author">
                                        <?php if ($testimonial['author_image']): ?>
                                            <img src="<?php echo esc_url($testimonial['author_image']); ?>" 
                                                 alt="<?php echo esc_attr($testimonial['author_name']); ?>" 
                                                 class="author-image">
                                        <?php endif; ?>
                                        <span class="author-name"><?php echo esc_html($testimonial['author_name']); ?></span>
                                    </div>
                                    <div class="testimonial-border"></div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Nawigacja -->
                <div class="testimonials-nav">
                    <button class="testimonials-button-prev">
                        <svg width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                             <path d="M0.146446 4.89115C-0.0488157 4.69589 -0.0488157 4.37931 0.146446 4.18404L3.32843 1.00206C3.52369 0.806802 3.84027 0.806802 4.03553 1.00206C4.2308 1.19733 4.2308 1.51391 4.03553 1.70917L1.20711 4.5376L4.03553 7.36602C4.2308 7.56129 4.2308 7.87787 4.03553 8.07313C3.84027 8.26839 3.52369 8.26839 3.32843 8.07313L0.146446 4.89115ZM12.5 5.0376H0.5V4.0376H12.5V5.0376Z" fill="#0F1219"/>
                        </svg>
                        </button>
                    <button class="testimonials-button-next">
                        <svg width="13" height="9" viewBox="0 0 13 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.8536 4.89115C13.0488 4.69589 13.0488 4.37931 12.8536 4.18404L9.67157 1.00206C9.47631 0.806802 9.15973 0.806802 8.96447 1.00206C8.7692 1.19733 8.7692 1.51391 8.96447 1.70917L11.7929 4.5376L8.96447 7.36602C8.7692 7.56129 8.7692 7.87787 8.96447 8.07313C9.15973 8.26839 9.47631 8.26839 9.67157 8.07313L12.8536 4.89115ZM0.5 5.0376H12.5V4.0376H0.5V5.0376Z" fill="#0F1219"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>