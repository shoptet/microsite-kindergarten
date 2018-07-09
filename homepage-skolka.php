<?php /* Template Name: Shoptet Skolka Homepage template */ ?>
<?php get_header(); ?>
<?php get_template_part( 'src/template-parts/page/content', 'claim' ); ?>

<section class="section section-tertiary">
    <div class="section-inner container text-center">
        <?php wp_nav_menu( array( 'theme_location' => 'kindergarten-menu', 'container_class' => 'shp-kindergarten-menu responsive-nav', 'menu_class' => 'visible-links' ) ); ?>
    </div>
</section>

<?php
while ( have_posts() ) : the_post(); ?>

<?php  ?>
    <section class="section section-tertiary">
        <div class="section-inner container">
            <div class="content-container">
                <?php the_content(); ?>
                <?php get_template_part( 'template-parts/post/content', 'widget' ); ?>
            </div>
        </div>
    </section>

    <section class="section section-primary">
        <div class="section-inner container">
            <?php get_template_part( 'template-parts/utils/content', 'navigation' ); ?>
        </div>
    </section>

<?php
endwhile;
get_template_part( 'template-parts/page/content', 'widget' );
?>

<?php get_footer(); ?>
