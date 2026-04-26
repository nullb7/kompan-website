<?php get_header(); ?>

<main class="search-page">
    <div class="search-page-header">
        <h1 class="search-page-title">
            Keresési eredmények:
        </h1>
        <p class="search-page-count">
            <?php echo $wp_query->found_posts; ?> találat
        </p>
    </div>

    <div class="search-results-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="termek-card">
                    <div class="termek-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>" alt="<?php the_title(); ?>" />
                        <?php endif; ?>
                    </div>
                    <p class="termek-title"><?php the_title(); ?></p>
                </a>
            <?php endwhile; ?>
        <?php else : ?>
            <p class="no-results">Nincs találat a keresésre.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
