<?php
/* Template Name: Strona Główna */
get_header();
?>

<section class="hero">
    <h1><?php the_field('hero_title'); ?></h1>
    <p><?php the_field('hero_text'); ?></p>
    <a href="<?php the_field('hero_button_link'); ?>" class="btn"><?php the_field('hero_button_text'); ?></a>
</section>


<section class="opinions">
    <h2>Opinie uczestników</h2>
    <?php if (have_rows('opinions')): ?>
        <div class="opinions-wrapper">
            <?php while (have_rows('opinions')): the_row(); ?>
                <div class="opinion">
                    <img src="<?php the_sub_field('photo'); ?>" alt="<?php the_sub_field('name'); ?>">
                    <p><?php the_sub_field('text'); ?></p>
                    <h4><?php the_sub_field('name'); ?></h4>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>