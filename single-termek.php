<?php get_header();

while (have_posts()) : the_post();

    // ACF Fields
    $cikkszam   = get_field('termek_cikkszam');
    $korosztaly = get_field('termek_korosztaly');
    $rogzites   = get_field('termek_rogzites');
    $esesi      = get_field('termek_esesi');
    $info_url   = get_field('termek_info_url');
    $rajz_1     = get_field('termek_rajz_1');
    $rajz_2     = get_field('termek_rajz_2');
    $hossz      = get_field('termek_hossz');
    $szelesseg  = get_field('termek_szelesseg');
    $magassag   = get_field('termek_magassag');

    // Category
    $categories = get_the_terms(get_the_ID(), 'termek_kat');
    $cat_names  = !is_wp_error($categories) && $categories ? array_map(fn($c) => $c->name, $categories) : [];

    // Main image
    $main_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
?>

<div class="termek-page">

    <!-- TOP SECTION -->
    <div class="termek-top">

        <!-- LEFT: Images -->
        <div class="termek-gallery">
            <div class="termek-main-image">
                <?php if ($main_image) : ?>
                    <img src="<?php echo esc_url($main_image); ?>" alt="<?php the_title(); ?>" id="termek-main-img" />
                <?php endif; ?>
            </div>
        </div>

        <!-- RIGHT: Details -->
        <div class="termek-details">
            <h1 class="termek-page-title"><?php the_title(); ?></h1>

            <div class="termek-meta">
                <?php if ($cikkszam) : ?>
                    <p><span class="meta-label">Cikkszám:</span> <?php echo esc_html($cikkszam); ?></p>
                <?php endif; ?>
                <?php if (!empty($cat_names)) : ?>
                    <p><span class="meta-label">Kategória:</span> <?php echo esc_html(implode(', ', $cat_names)); ?></p>
                <?php endif; ?>
                <?php if ($korosztaly) : ?>
                    <p><span class="meta-label">Korosztály:</span> <?php echo esc_html($korosztaly); ?></p>
                <?php endif; ?>
                <?php if ($rogzites) : ?>
                    <p><span class="meta-label">Rögzítés:</span> <?php echo esc_html($rogzites); ?></p>
                <?php endif; ?>
                <?php if ($esesi) : ?>
                    <p><span class="meta-label">Esési magasság:</span> <?php echo esc_html($esesi); ?></p>
                <?php endif; ?>
            </div>

            <div class="termek-buttons">
                <a href="/kapcsolat" class="btn-primary">Lépj velünk kapcsolatba!</a>
                <?php if ($info_url) : ?>
                    <a href="<?php echo esc_url($info_url); ?>" class="btn-secondary" target="_blank">Részletes információk</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- BOTTOM SECTION: Technical Drawing -->
    <?php if ($rajz_1 || $rajz_2) : ?>
    <div class="termek-rajz-section">
        <div class="termek-rajz-images">
            <?php if ($rajz_1) : ?>
                <img src="<?php echo esc_url($rajz_1['url']); ?>" alt="Műszaki rajz 1" />
            <?php endif; ?>
            <?php if ($rajz_2) : ?>
                <img src="<?php echo esc_url($rajz_2['url']); ?>" alt="Műszaki rajz 2" />
            <?php endif; ?>
        </div>

        <?php if ($hossz || $szelesseg || $magassag) : ?>
        <div class="termek-dimensions">
            <?php if ($hossz) : ?>
                <div class="dimension-box">
                    <span class="dimension-label">Hossz</span>
                    <span class="dimension-value"><?php echo esc_html($hossz); ?> cm</span>
                </div>
            <?php endif; ?>
            <?php if ($szelesseg) : ?>
                <div class="dimension-box">
                    <span class="dimension-label">Szélesség</span>
                    <span class="dimension-value"><?php echo esc_html($szelesseg); ?> cm</span>
                </div>
            <?php endif; ?>
            <?php if ($magassag) : ?>
                <div class="dimension-box">
                    <span class="dimension-label">Magasság</span>
                    <span class="dimension-value"><?php echo esc_html($magassag); ?> cm</span>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

</div>

<script>
document.querySelectorAll('.termek-thumb').forEach(thumb => {
    thumb.addEventListener('click', () => {
        document.getElementById('termek-main-img').src = thumb.dataset.full;
        document.querySelectorAll('.termek-thumb').forEach(t => t.classList.remove('active'));
        thumb.classList.add('active');
    });
});
</script>

<?php endwhile; ?>

<?php get_footer(); ?>