<?php 
/**
 * The template for displaying the front page
 */

get_header(); 

// Grab the ACF data
$hero_bg       = get_field('hero_bg');
$hero_title    = get_field('hero_title');
$hero_subtitle = get_field('hero_subtitle');
?>


<main id="primary" class="site-main">

<!-- HERO SECTION -->
 <section class="hp-hero" style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3)), url('<?php echo esc_url($hero_bg['url'])  ?>');">
  <div class="container">
    <div class="hp-hero__inner">
      <p class="hp-hero__intro"><?php echo esc_html($hero_subtitle); ?></p>
      <p class="hp-hero__title"><?php echo esc_html($hero_title); ?></p>
      <div class="hp-hero__actions">
        <a href="#contact" class="btn btn--red">Lépj velünk kapcsolatba!</a>
        <a href="catalog" class="btn btn--red">Termékkatalógus letöltése</a>
         
      </div>
    </div>
    
  </div>    

 </section>

 <!-- INTRO SECTION -->
  <section class="hp-intro">
    <div class="container container--narrow">
       <h2 class="hp-intro__text">
                <?php // You can make this an ACF field later if you want! ?>
                Legyen szó játszótérről vagy szabadtéri edzésről, segítünk olyan kültéri tereket létrehozni, ahová szívesen mennek az emberek. Találkozzunk kint!
            </h2>
    </div>
  </section> 
  
  
  <!-- CATEGORIES -->
  <section class="hp-categories">
    <div class="container">
        
        <div class="hp-categories__header">
            <h2 class="section-title">Kiknek segítünk</h2>
            <p class="section-subtitle">Fedezze fel iparágára szabott játszótéri és szabadtéri fitneszmegoldásainkat.</p>
        </div>

        <div class="hp-categories__grid">
            <?php 
            // We'll hardcode these for now to see the design, 
            // then we can make them dynamic with ACF!
            $categories = [
                ['img' => 'http://kompanwebsite.local/wp-content/uploads/2026/03/image-3.jpg', 'title' => 'Bölcsődék-Óvodák'],
                ['img' => 'http://kompanwebsite.local/wp-content/uploads/2026/03/image-4.jpg', 'title' => 'Iskolák'],
                ['img' => 'http://kompanwebsite.local/wp-content/uploads/2026/03/image-5.jpg', 'title' => 'Lakóközösségek'],
                ['img' => 'http://kompanwebsite.local/wp-content/uploads/2026/03/image-6.jpg', 'title' => 'Vállalatok'],
                ['img' => 'http://kompanwebsite.local/wp-content/uploads/2026/03/image-7.jpg', 'title' => 'Tervezők'],
                ['img' => 'http://kompanwebsite.local/wp-content/uploads/2026/03/image-8.jpg', 'title' => 'Önkormányzatok'],
            ];

            foreach ($categories as $cat) : ?>
                <div class="category-card">
                    <div class="category-card__image">
                        <!-- Replace with your actual image URLs later -->
                        <img src="<?php echo esc_url($cat['img']); ?>" alt="<?php echo esc_html($cat['title']); ?>">                    
                    </div>                    
                    <h3 class="category-card__title"><?php echo $cat['title']; ?></h3>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
  </section>


  <!-- ABOUT -->
  <section class="hp-about">
    <div class="container">
      <div class="hp-about__grid">
        
        <!-- Left Column -->
        <div class="hp-about__intro">
          <h2 class="hp-about__main-title">Megbízható partner játszóterekhez és szabadtéri fitneszhez</h2>
          <p class="hp-about__main-text">Több mint 50 év tapasztalatát ötvözzük előremutató tervezéssel, hogy olyan dinamikus kültéri tereket hozzunk létre, amelyek mozgásra inspirálnak.</p>
        </div>

        <!-- Right Column -->
        <div class="hp-about__content">
          <div class="hp-about__feature">
            <h3 class="hp-about__feature-title">Mindenkinek tervezve, általad inspirálva</h3>
            <p class="hp-about__feature-text">Hiszünk abban, hogy a játék és a mozgás mindenkié. Ezért tereinket úgy tervezzük, hogy minden képességű ember számára befogadók legyenek – kutatásokra és az egyetemes tervezés elveire építve. És ha azt szeretnéd, hogy a játszótér egy helyi történetet is elmeséljen, a Design Studio csapatunk készen áll arra, hogy a közösséged hangulatából valami igazán különlegeset alkosson.</p>
          </div>

          <div class="hp-about__feature">
            <h3 class="hp-about__feature-title">Tartósra építve, az életre tervezve</h3>
            <p class="hp-about__feature-text">A jó játszóterek és szabadtéri edzőterek nagy igénybevételt kapnak – a mi megoldásaink pedig erre készülnek. Minőségi anyagokat és precíz mérnöki munkát használunk, hogy minden megoldásunk kiállja az idő próbáját, és hosszú távon értéket adjon a következő generációknak is.</p>
          </div>

          <a href="#" class="hp-about__link">Tudj meg többet <span class="arrow">›</span></a>
        </div>

      </div>
    </div>
  </section>


  <!-- SERVICES -->
  <section class="hp-services">
    <div class="container">
      
      <div class="hp-services__header">
        <h2 class="section-title">Mit keresel?</h2>
        <p class="section-subtitle">Merülj el a játék világában, vagy fedezd fel a fitnesz univerzumát.</p>
      </div>

      <div class="hp-services__grid">
        
        <!-- Card 1: Playgrounds -->
        <a href="#" class="service-card">
          <div class="service-card__image">
            <img src="http://kompanwebsite.local/wp-content/uploads/2026/03/services1.jpg" alt="Játszótéri eszközök">
          </div>
          <div class="service-card__content">
            <h3 class="service-card__title">Játszótéri eszközök</h3>
            <span class="service-card__link">Játsszunk <span class="arrow">›</span></span>
          </div>
        </a>

        <!-- Card 2: Fitness -->
        <a href="#" class="service-card">
          <div class="service-card__image">
            <img src="http://kompanwebsite.local/wp-content/uploads/2026/03/services2.jpg" alt="Szabadtéri fitneszeszközök">
          </div>
          <div class="service-card__content">
            <h3 class="service-card__title">Szabadtéri fitneszeszközök</h3>
            <span class="service-card__link">Mozogjunk <span class="arrow">›</span></span>
          </div>
        </a>

      </div>
    </div>
  </section>

  
  <!-- CALL-TO-ACTION -->
  <section class="hp-cta-banner">
    <div class="container">
      <div class="hp-cta-banner__inner" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('http://kompanwebsite.local/wp-content/uploads/2026/03/CTA.png');">
        <div class="hp-cta-banner__content">
          <p class="hp-cta-banner__subtitle">Kíváncsi vagy a megvalósult projektekre?</p>
          <h2 class="hp-cta-banner__title">Keress referenciát a saját területedhez</h2>
          <div class="hp-cta-banner__actions">
            <a href="#" class="btn btn--red">Mutasd a projekteket</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>