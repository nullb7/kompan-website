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
        <?php echo do_shortcode('[contact-form-7 id="b341141" title="Kapcsolat Form"]'); ?>
      </div>

      <!-- Right: Contact Info + Map -->
      <div class="kapcsolat-info-wrap">
        <div class="kapcsolat-form-wrap">
          <h2 class="kapcsolat-block__title">Elérhetőségeink!</h2>
          
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
              </div>

        <div class="kapcsolat-map">
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2698.100879949703!2d19.0448995901883!3d47.44897295199992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741dd780577ea05%3A0x609dff71d515f5d9!2sBudapest%2C%20Hunyadi%20J%C3%A1nos%20%C3%BAt%203%2C%201117!5e0!3m2!1shu!2shu!4v1647951002710!5m2!1shu!2shu"
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