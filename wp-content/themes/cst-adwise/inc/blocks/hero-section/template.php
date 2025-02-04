<?php
/**
* Hero Section Block Template.
*/

$heading = get_field('heading');
$subheading = get_field('subheading');
$cta_text = get_field('cta_text');
$cta_text_mobile = get_field('cta_text_mobile');
$cta_link = get_field('cta_link');
$bg_color = get_field('background_color');
$scroll_text = get_field('scroll_text');

$formatted_link = cst_adwise_format_link($cta_link);
?>

<section class="hero-section" style="background-color: <?php echo esc_attr($bg_color); ?>">
   <div class="container">
       <div class="hero-content">
           <div class="hero-main">
               <h1 class="hero-heading"><?php echo esc_html($heading); ?></h1>
               <div class="hero-bottom">
                   <p class="hero-subheading"><?php echo esc_html($subheading); ?></p>
                   <?php if ($cta_text) : ?>
                       <a href="<?php echo esc_attr($formatted_link); ?>" class="hero-cta">
                           <span class="desktop-text"><?php echo esc_html($cta_text); ?></span>
                           <?php if ($cta_text_mobile): ?>
                               <span class="mobile-text"><?php echo esc_html($cta_text_mobile); ?></span>
                           <?php endif; ?>
                       </a>
                   <?php endif; ?>
               </div>
           </div>
           <?php if ($scroll_text) : ?>
               <div class="scroll-text">
                   <?php echo esc_html($scroll_text); ?>
               </div>
           <?php endif; ?>
       </div>
   </div>
</section>

