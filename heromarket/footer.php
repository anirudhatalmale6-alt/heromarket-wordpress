</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-columns">
            <div class="footer-column">
                <h4>Follow Us</h4>
                <div class="social-links">
                    <?php
                    $socials = heromarket_get_social_links();
                    if ($socials) :
                        foreach ($socials as $social) : ?>
                            <a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($social['name']); ?>">
                                <i class="<?php echo esc_attr($social['icon']); ?>"></i>
                            </a>
                        <?php endforeach;
                    else : ?>
                        <a href="https://www.facebook.com/myheromarket" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/myheromarket" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.tiktok.com/@myheromarket" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="https://www.youtube.com/@myheromarket" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="footer-column">
                <h4>Special Deals</h4>
                <ul>
                    <?php
                    $monthly = get_page_by_path('monthly-specials');
                    $weekend = get_page_by_path('weekend-deals');
                    ?>
                    <li><a href="<?php echo $monthly ? esc_url(get_permalink($monthly)) : '#'; ?>">Monthly Specials</a></li>
                    <li><a href="<?php echo $weekend ? esc_url(get_permalink($weekend)) : '#'; ?>">Weekend Deals</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>About</h4>
                <ul>
                    <?php
                    $about = get_page_by_path('about-us');
                    $hilo = get_page_by_path('hilo-products');
                    ?>
                    <li><a href="<?php echo $about ? esc_url(get_permalink($about)) : '#'; ?>">About Us</a></li>
                    <li><a href="<?php echo $hilo ? esc_url(get_permalink($hilo)) : '#'; ?>">Hilo Products</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Find Us</h4>
                <ul>
                    <?php
                    $locator = get_page_by_path('store-locator');
                    $contact = get_page_by_path('contact-us');
                    ?>
                    <li><a href="<?php echo $locator ? esc_url(get_permalink($locator)) : esc_url(get_post_type_archive_link('store')); ?>">Locate Us</a></li>
                    <li><a href="<?php echo $contact ? esc_url(get_permalink($contact)) : '#'; ?>">Contact Us</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4>Support</h4>
                <ul>
                    <?php
                    $career = get_page_by_path('careers');
                    $privacy = get_page_by_path('privacy-policy');
                    $terms = get_page_by_path('terms-and-conditions');
                    ?>
                    <li><a href="<?php echo $career ? esc_url(get_permalink($career)) : '#'; ?>">Join Our Team</a></li>
                    <li><a href="<?php echo $privacy ? esc_url(get_permalink($privacy)) : '#'; ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo $terms ? esc_url(get_permalink($terms)) : '#'; ?>">Terms &amp; Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <?php echo wp_kses_post(get_theme_mod('heromarket_copyright', 'Copyright &copy; 2024 My Hero Hypermarket Sdn Bhd 200401038165 (676676-T)')); ?>
        </div>
    </div>
</footer>

<a href="https://www.facebook.com/myheromarket" class="float-btn" target="_blank" rel="noopener noreferrer" aria-label="Chat with us">
    <i class="fa-brands fa-facebook-messenger"></i>
</a>

<?php wp_footer(); ?>
</body>
</html>
