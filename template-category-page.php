<?php
/**
 * Template Name: Kompan Category Page
 */

get_header(); ?>

<main id="primary" class="site-main category-page">
    <?php while ( have_posts() ) : the_post(); 
        // Retrieve ACF fields
        $hero_img  = get_field('hero_image');
        $hero_ttl  = get_field('hero_title');
        $desc_text = get_field('main_description');
        $side_img  = get_field('secondary_content_image');
    ?>

    <!-- Hero Section -->
    <section class="category-hero" style="background-image: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.3)), url('<?php echo esc_url($hero_img['url']); ?>');">
        <div class="container">
            <div class="hero-content">
                <h2 class="category-hero-h2">Kinek szól az oldalunk?</h2>
                <h1><?php echo esc_html($hero_ttl); ?></h1>
                <div class="hero-buttons">
                    <a href="#contact" class="btn btn-red">Lépj velünk kapcsolatban</a>
                    <a href="#" class="btn btn-outline">Termékkatalógus letöltése</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="category-intro py-5">
        <div class="container">
            <div class="category-image-and-text-wrapper">
                <!-- Left side: Text -->
                <div class="col-md-7">
                    <div class="intro-body">
                        <p class="col-md-7-title">Kinek segítünk?</p>
                        <p class="col-md-7-intro">Minedenkinek tervezve, általad inspirálva</p>
                        <div class="acf-description-text">
                            <?php echo $desc_text; ?>

                        </div>
                    </div>
                </div>
                
                <!-- Right side: Image -->
                <div class="col-md-5">
                    <?php if( $side_img ): ?>
                        <div class="side-image-wrapper">
                            <img src="<?php echo esc_url($side_img['url']); ?>" alt="<?php echo esc_attr($side_img['alt']); ?>" class="img-fluid rounded">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php endwhile; ?>
</main>

<?php 
// Your footer.php already contains the contact/info section
get_footer(); ?>