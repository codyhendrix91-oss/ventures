<!-- Newsletter Section - Above Footer -->
<?php if (!is_singular('domains') && function_exists('svm_newsletter_form')): ?>
<section class="svm-newsletter-section">
    <?php echo svm_newsletter_form(false); ?>
</section>
<?php endif; ?>

<footer class="svm-footer">
  <div class="svm-footer__inner">
    
    <?php if (!is_singular('domains')): ?>
    <!-- Footer Menu Grid - Hidden on single domain pages -->
    <div class="svm-footer__grid">
      
      <!-- Column 1: Company -->
      <div class="svm-footer__column">
        <h3 class="svm-footer__title">Company</h3>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer_company',
          'container' => false,
          'menu_class' => 'svm-footer__menu',
          'fallback_cb' => function() {
            echo '<ul class="svm-footer__menu">';
            echo '<li><a href="' . home_url('/about') . '">About Us</a></li>';
            echo '<li><a href="' . home_url('/contact') . '">Contact</a></li>';
            echo '<li><a href="' . get_post_type_archive_link('domains') . '">Browse Domains</a></li>';
            echo '</ul>';
          }
        ));
        ?>
      </div>
      
      <!-- Column 2: Resources -->
      <div class="svm-footer__column">
        <h3 class="svm-footer__title">Resources</h3>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer_resources',
          'container' => false,
          'menu_class' => 'svm-footer__menu',
          'fallback_cb' => function() {
            echo '<ul class="svm-footer__menu">';
            echo '<li><a href="' . get_permalink(get_option('page_for_posts')) . '">Blog</a></li>';
            echo '<li><a href="' . home_url('/resources') . '">Resources</a></li>';
            echo '</ul>';
          }
        ));
        ?>
      </div>
      
      <!-- Column 3: Legal -->
      <div class="svm-footer__column">
        <h3 class="svm-footer__title">Legal</h3>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer_legal',
          'container' => false,
          'menu_class' => 'svm-footer__menu',
          'fallback_cb' => function() {
            echo '<ul class="svm-footer__menu">';
            echo '<li><a href="' . home_url('/privacy-policy') . '">Privacy Policy</a></li>';
            echo '<li><a href="' . home_url('/terms-of-service') . '">Terms of Service</a></li>';
            echo '</ul>';
          }
        ));
        ?>
      </div>
      
    </div>
    <?php endif; ?>
    
    <!-- Contact Section -->
    <div class="svm-footer__contact">
      <p class="svm-footer__contact-label">Get in touch with us</p>
      <div class="svm-footer__contact-icons">
        <a href="mailto:info@s.ventures?subject=General Inquiry" class="svm-footer__contact-btn" title="Email us" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="24" height="24">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
        </a>
        <a href="https://wa.me/12817261751?text=Hi,%20I'd%20like%20to%20learn%20more%20about%20your%20domains" class="svm-footer__contact-btn" title="WhatsApp us" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="24" height="24" style="color:#25D366;">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
        </a>
        <a href="https://t.me/s_ventures?text=Hi,%20I'd%20like%20to%20learn%20more%20about%20your%20domains" class="svm-footer__contact-btn" title="Telegram us" target="_blank" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="24" height="24" style="color:#0088cc;">
            <path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-1.99 1.93c-.23.23-.42.42-.83.42z"/>
          </svg>
        </a>
        <a href="sms:+12815295954&body=Hi,%20I'd%20like%20to%20learn%20more%20about%20your%20domains" class="svm-footer__contact-btn" title="Text us" rel="noopener">
          <svg viewBox="0 0 24 24" fill="currentColor" width="24" height="24" style="color:#5AC8FA;">
            <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM9 11H7V9h2v2zm4 0h-2V9h2v2zm4 0h-2V9h2v2z"/>
          </svg>
        </a>
      </div>
    </div>
    
    <!-- Copyright -->
    <div class="svm-footer__bottom">
      <p>&copy; <?php echo date('Y'); ?> S.Ventures. All rights reserved.</p>
    </div>
    
  </div>
</footer>

<style>
/* Global Footer Styling - Digital Shelf Institute Inspired */
.svm-newsletter-section,
.svm-footer,
.svm-footer__contact,
.svm-footer__bottom {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-rendering: optimizeLegibility;
}

/* Newsletter Section - White Background */
.svm-newsletter-section {
  background: #ffffff;
  padding: 50px 20px;
  margin: 0;
  box-shadow: 0 3px 5px 0 rgba(0, 0, 0, 0.1);
  position: relative;
  z-index: 2;
}

/* Override newsletter form styles for white background */
.svm-newsletter-section .svm-newsletter {
  background: transparent;
  border: none;
  padding: 0;
}

.svm-newsletter-section .svm-newsletter__text {
  color: #1a1d35;
  font-family: "proxima-nova", -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  font-size: 18px;
  line-height: 1.6180339888;
}

.svm-newsletter-section .svm-newsletter__text strong {
  background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  font-weight: 700;
}

.svm-newsletter-section .svm-newsletter__input {
  background: #ffffff;
  border: 2px solid #e5e7eb;
  color: #1a1d35;
  font-family: "proxima-nova", -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
}

.svm-newsletter-section .svm-newsletter__input:focus {
  background: #ffffff;
  border-color: #a855f7;
  box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
}

.svm-newsletter-section .svm-newsletter__input::placeholder {
  color: rgba(26, 29, 53, 0.5);
}

.svm-newsletter-section .svm-newsletter__button {
  background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
  border: none;
  color: rgba(255, 255, 255, 1.0);
  font-weight: 700;
  box-shadow: 0 4px 16px rgba(124, 58, 237, 0.3);
}

.svm-newsletter-section .svm-newsletter__button:hover {
  background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);
  box-shadow: 0 6px 24px rgba(124, 58, 237, 0.4);
  transform: translateY(-2px);
}

/* Footer Styles - Purple Gradient */
.svm-footer {
  background: linear-gradient(to right, rgb(15, 23, 61), rgb(138, 38, 250));
  border-top: none;
  padding: 80px 20px 0;
  position: relative;
  overflow: hidden;
  box-shadow: 0 3px 5px 0 rgba(0, 0, 0, 0.1);
  z-index: 2;
}

/* Subtle overlay pattern */
.svm-footer::before {
  content: '';
  position: absolute;
  inset: 0;
  background:
    radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
    radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
  pointer-events: none;
}

/* On single domain pages, reduce top padding since there's no menu grid */
body.single-domains .svm-footer {
  padding: 50px 20px 0;
}

.svm-footer__inner {
  max-width: 1400px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

/* Footer Grid - 3 Columns */
.svm-footer__grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 80px;
  margin-bottom: 60px;
  padding-bottom: 60px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.15);
}

.svm-footer__column {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.svm-footer__title {
  font-size: 20px;
  font-weight: 700;
  color: rgba(255, 255, 255, 1.0);
  margin: 0 0 28px;
  font-family: "proxima-nova", 'Colour Brown', sans-serif;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}

.svm-footer__menu {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 16px;
  align-items: center;
}

.svm-footer__menu li {
  margin: 0;
  padding: 0;
}

.svm-footer__menu a {
  color: rgba(255, 255, 255, 0.9);
  font-size: 16px;
  font-weight: 400;
  text-decoration: none;
  transition: all 0.3s ease;
  display: block;
  font-family: "proxima-nova", -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
  line-height: 1.6180339888;
}

.svm-footer__menu a:hover {
  color: rgba(255, 255, 255, 1.0);
  transform: translateY(-2px);
  text-shadow: 0 2px 12px rgba(255, 255, 255, 0.3);
}

/* Footer Contact Section - Purple Gradient Background */
.svm-footer__contact {
  text-align: center;
  margin: 0;
  padding: 50px 20px;
  background: transparent;
  border-top: 1px solid rgba(255, 255, 255, 0.15);
}

.svm-footer__contact-label {
  color: rgba(255, 255, 255, 1.0);
  font-size: 20px;
  font-weight: 600;
  margin: 0 0 28px;
  font-family: "proxima-nova", 'Colour Brown', sans-serif;
}

.svm-footer__contact-icons {
  display: flex;
  justify-content: center;
  gap: 18px;
  align-items: center;
  flex-wrap: wrap;
}

.svm-footer__contact-btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  text-decoration: none;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  background: #ffffff;
}

.svm-footer__contact-btn:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
}

/* Footer Bottom */
.svm-footer__bottom {
  text-align: center;
  background: transparent;
  padding: 30px 20px;
  margin: 0;
  border-top: 1px solid rgba(255, 255, 255, 0.15);
}

.svm-footer__bottom p {
  margin: 0;
  font-size: 14px;
  color: rgba(255, 255, 255, 0.8);
  font-family: "proxima-nova", -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* Responsive */
@media (max-width: 1024px) {
  .svm-footer__grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 50px;
  }
}

@media (max-width: 768px) {
  .svm-footer {
    padding: 60px 20px 0;
  }

  body.single-domains .svm-footer {
    padding: 40px 20px 0;
  }

  .svm-footer__grid {
    grid-template-columns: 1fr;
    gap: 40px;
    margin-bottom: 50px;
    padding-bottom: 50px;
  }

  .svm-footer__contact {
    padding: 40px 20px;
  }

  .svm-footer__contact-icons {
    gap: 14px;
  }

  .svm-footer__contact-btn {
    width: 54px;
    height: 54px;
  }

  .svm-footer__bottom {
    padding: 25px 20px;
  }
}
</style>

<?php wp_footer(); ?>
</body>
</html>