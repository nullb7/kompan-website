<?php
/* Template Name: Kapcsolat */
get_header();
?>

<section class="kapcsolat-hero">
  <div class="container">
    <h1 class="kapcsolat-hero__title">Kapcsolat</h1>
  </div>
</section>

<section class="kapcsolat-main">
  <div class="container">
    <div class="kapcsolat-grid">

      <!-- Left: Contact Form -->
      <div class="kapcsolat-form-wrap">
        <h2 class="kapcsolat-block__title">Lépj kapcsolatba velünk!</h2>
        <?php
          $form_id = get_field('kapcsolat_form_id'); // ACF field for CF7 form ID
          if ($form_id) {
            echo do_shortcode('[contact-form-7 id="' . esc_attr($form_id) . '"]');
          }
        ?>
      </div>

      <!-- Right: Contact Info + Map -->
      <div class="kapcsolat-info-wrap">
        <h2 class="kapcsolat-block__title">Lépj kapcsolatba velünk!</h2>

        <ul class="kapcsolat-info-list">

          <?php $telefon = get_field('kapcsolat_telefon'); if ($telefon) : ?>
            <li class="kapcsolat-info-item">
              <span class="kapcsolat-info-icon"></span>
              <div>
                <strong>Telefon</strong>
                <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $telefon)); ?>">
                  <?php echo esc_html($telefon); ?>
                </a>
              </div>
            </li>
          <?php endif; ?>

          <?php $email = get_field('kapcsolat_email'); if ($email) : ?>
            <li class="kapcsolat-info-item">
              <span class="kapcsolat-info-icon"></span>
              <div>
                <strong>Email</strong>
                <a href="mailto:<?php echo esc_attr($email); ?>">
                  <?php echo esc_html($email); ?>
                </a>
              </div>
            </li>
          <?php endif; ?>

          <?php $cim = get_field('kapcsolat_cim'); if ($cim) : ?>
            <li class="kapcsolat-info-item">
              <span class="kapcsolat-info-icon"></span>
              <div>
                <strong>Cím</strong>
                <span><?php echo esc_html($cim); ?></span>
              </div>
            </li>
          <?php endif; ?>

        </ul>

        <div class="kapcsolat-map">
          <iframe
            src="https://www.google.com/maps/d/embed?mid=YOUR_MAP_ID"
            width="100%"
            height="280"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
          </iframe>
        </div>

      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>