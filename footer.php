<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PlaygroundTheme
 */

?>

<footer class="site-footer">
    <div class="footer-inner">

        <!-- Column 1: Logo + Social -->
        <div class="footer-brand">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                <?php if (has_custom_logo()) : the_custom_logo();
                else : ?><span class="footer-logo-text">KOMPAN*</span><?php endif; ?>
            </a>
            <!--
            <div class="footer-socials">
                <a href="#" aria-label="LinkedIn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.32 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93zM6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37z"/></svg>
                </a>
                <a href="#" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M10 15l5.19-3L10 9zm11.56-7.83c.13.47.22 1.1.28 1.9c.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 4.83c-.25.9-.83 1.48-1.73 1.73c-.47.13-1.33.22-2.65.28c-1.3.07-2.49.1-3.59.1L12 19c-4.19 0-6.8-.16-7.83-.44c-.9-.25-1.48-.83-1.73-1.73c-.13-.47-.22-1.1-.28-1.9c-.07-.8-.1-1.49-.1-2.09L2 12c0-2.19.16-3.8.44-4.83c.25-.9.83-1.48 1.73-1.73c.47-.13 1.33-.22 2.65-.28c1.3-.07 2.49-.1 3.59-.1L12 5c4.19 0 6.8.16 7.83.44c.9.25 1.48.83 1.73 1.73"/></svg>
                </a>
                <a href="#" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3"/></svg>
                </a>
                <a href="#" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95"/></svg>
                </a>
            </div>
            -->
        </div>

        <!-- Column 2: Kapcsolat -->
        <div class="footer-col">
            <h4 class="footer-col-title">Kapcsolat</h4>
            <ul>
                <li><a href="tel:+3614810620">+36 1 481 06 20</a></li>
                <li><a href="mailto:kompan@kompankepviselet.hu">kompan@kompankepviselet.hu</a></li>
                <li>1117 Budapest<br>Hunyadi János út 3.</li>
            </ul>
        </div>

        <!-- Column 3-5: More -->
        <div class="footer-col">
            <h4 class="footer-col-title">Tudj meg többet</h4>
            <ul>
                <li><a href="/termekek">Termékek</a></li>
                <li><a href="/rolunk">Rólunk</a></li>
                <li><a href="/referenciak">Referenciák</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4 class="footer-col-title">Kinek szól?</h4>
            <ul>
                <li><a href="/bolcsode-ovi">Bölcsődék-Óvodák</a></li>
                <li><a href="/iskolak">Iskolák</a></li>
								<li><a href="/lakozossegek">Lakóközösségek</a></li>
								<li><a href="/vallalatok">Vállalatok</a></li>
								<li><a href="/tervezok">Tervezők</a></li>
								<li><a href="/onkormanyzatok">Önkormányzatok</a></li>
							</ul>
        </div>


    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> KOMPAN. Minden jog fenntartva.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
