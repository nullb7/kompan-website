<?php 
/**
 * Template Name: Termekek
 */
get_header(); ?>

<div class="termekek-container">
    <h1 class="termekek-title">Termékek</h1>

    <!-- Filter Pills -->
    <div class="termekek-filters">
        <button class="filter-pill active" data-category="all">Minden termék</button>
        <?php
        $categories = get_terms([
            'taxonomy' => 'termek_kat',
            'hide_empty' => true,
            'parent' => 0
        ]);
        if (!is_wp_error($categories) && !empty($categories)) :
        foreach ($categories as $cat) : ?>
            <button class="filter-pill" data-category="<?php echo esc_attr($cat->slug); ?>">
                <?php echo esc_html($cat->name); ?>
            </button>
        <?php endforeach; endif?>
    </div>

    <!-- Counter + Clear -->
    <div class="termekek-meta">
        <span class="termekek-counter"></span>
        <button class="termekek-clear" style="display:none;">
            &times; Összes törlése
        </button>
    </div>

    <!-- Product Grid -->
    <div class="termekek-grid" id="termekek-grid">
        <!-- Products loaded via JS -->
    </div>

    <!-- Pagination -->
    <div class="termekek-pagination" id="termekek-pagination"></div>
</div>

<script>
    const ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>

<?php get_footer(); ?>