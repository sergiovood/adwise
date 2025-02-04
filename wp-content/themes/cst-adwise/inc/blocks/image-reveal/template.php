<?php
$mask_image = get_field('mask_image');
$video_type = get_field('video_type');
$video_file = get_field('video_file');
$youtube_url = get_field('youtube_url');
$video_overlay = get_field('video_overlay');
$button_text = get_field('button_text') ?: 'Zobacz film';

function get_youtube_id($url) {
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
    return isset($match[1]) ? $match[1] : '';
}

$youtube_id = '';
if ($video_type === 'youtube' && $youtube_url) {
    $youtube_id = get_youtube_id($youtube_url);
}

$thumbnail = $video_overlay;
if (!$thumbnail && $video_type === 'youtube' && $youtube_id) {
    $thumbnail = "https://img.youtube.com/vi/{$youtube_id}/maxresdefault.jpg";
}
?>

<section class="image-reveal">
    <div class="image-reveal__sticky-container">
        <div class="image-reveal__sticky-content">
            <!-- Maska -->
            <div class="bg-section">
                <div>
                    <img src="<?php echo esc_url($mask_image); ?>" alt="Mask" class="mask-image">
                </div>
            </div>

            <!-- Video Overlay -->
            <div class="bg-image-under">
                <div class="video-wrapper">
                    <div class="video-overlay" 
                         data-video-type="<?php echo esc_attr($video_type); ?>"
                         data-video-url="<?php echo esc_url($video_type === 'file' ? $video_file : ''); ?>"
                         data-youtube-id="<?php echo esc_attr($youtube_id); ?>">
                        <?php if ($thumbnail): ?>
                            <img src="<?php echo esc_url($thumbnail); ?>" alt="Video overlay" class="overlay-image">
                        <?php endif; ?>
                        <?php if ($button_text): ?>
                            <div class="video-play-button-wrapper">
                                <button class="video-play-button">
                                    <?php echo esc_html($button_text); ?>
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="video-overlay-border"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Popup -->
    <div class="video-popup">
        <div class="video-popup__content">
            <button class="video-popup__close">&times;</button>
            <div class="video-popup__player"></div>
        </div>
    </div>
</section>