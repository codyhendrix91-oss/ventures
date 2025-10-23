<?php
/**
 * Template Name: Single Domain Landing - FIXED
 * Template Post Type: domains
 * FIXED: Description section now properly styled with H2 header
 */
if (!defined('ABSPATH')) exit;

get_header();

while (have_posts()): the_post();
  if (!session_id()) session_start();

  $post_id = get_the_ID();
  $domain_name = get_the_title();
  $price = get_post_meta($post_id,'svm_price',true);
  $status = get_post_meta($post_id,'svm_status',true);
  $stripe_price_id = get_post_meta($post_id,'svm_stripe_price_id',true);
  $auto_escrow = get_post_meta($post_id,'svm_auto_escrow',true);
  
  $logo_id = get_post_meta($post_id,'svm_logo_id',true);
  $logo_url = '';
  if (is_numeric($logo_id)) {
    $logo_url = wp_get_attachment_image_url((int)$logo_id,'large');
  }

  $verified = false;
  if (isset($_GET['verified']) && (int)$_GET['verified'] === (int)$post_id) $verified = true;
  if (isset($_SESSION['svm_verified'][$post_id])) $verified = true;
  if (isset($_COOKIE['svm_v_'.$post_id]) && $_COOKIE['svm_v_'.$post_id] === '1') $verified = true;

  $verification_msg = '';
  $verification_type = '';
  if (isset($_GET['verification']) && $_GET['verification'] === 'expired') {
    $verification_msg = 'Your verification link has expired. Please submit the form again.';
    $verification_type = 'error';
  }
  
  $assets_url = get_stylesheet_directory_uri() . '/assets/';
  // FIXED: Construct logo path from assets folder
  // Preserve first letter capitalization (e.g., Snipy_ai_logo.webp)
  $domain_parts = str_replace('.', '_', $domain_name);
  $domain_clean = ucfirst(strtolower($domain_parts));
  $theme_url = get_stylesheet_directory_uri();
  $logo_url = $theme_url . '/assets/' . $domain_clean . '_logo.webp';
  
  // Check for custom logo URL from Google Sheets
  $custom_logo = get_post_meta($post_id, 'svm_logo_url', true);
  if (!empty($custom_logo)) {
    $logo_url = $custom_logo;
  }
  
?>

<main class="svm-domain-page">
  <!-- HERO - ABOVE THE FOLD -->
  <section class="svm-domain-hero-v6" id="svm-hero">
    <div class="svm-hero-container">
      
      <!-- LEFT SIDE -->
      <div class="svm-hero-left-v6">
        <div class="svm-hero-content-v6">
          <!-- Logo -->
          <?php if ($logo_url): ?>
            <div class="svm-domain-logo-v6">
              <img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr($domain_name); ?>">
            </div>
          <?php endif; ?>
          
          <!-- Domain Title -->
          <h1 class="svm-domain-title-v6"><?php echo esc_html($domain_name); ?></h1>
          
          <!-- Subtitle -->
          <p class="svm-domain-subtitle-v6">Premium domain available for acquisition</p>
          
          <!-- Badge -->
          <?php if ($status === 'sold'): ?>
            <div class="svm-status-badge svm-status-sold">
              <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
              Sold
            </div>
          <?php else: ?>
            <div class="svm-status-badge svm-status-available">
              <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
              Available Now
            </div>
          <?php endif; ?>
        </div>
        
        <!-- Trust Partner Logos -->
        <div class="svm-trust-partners-v6">
          <img src="<?php echo $assets_url; ?>trust-pilot-stacked-black.svg" alt="Trustpilot" class="svm-partner-logo-v6">
          <img src="<?php echo $assets_url; ?>partner-escrow.svg" alt="Escrow.com" class="svm-partner-logo-v6">
          <img src="<?php echo $assets_url; ?>partner-godaddy.svg" alt="GoDaddy" class="svm-partner-logo-v6">
          <img src="<?php echo $assets_url; ?>partner-atom.svg" alt="Atom" class="svm-partner-logo-v6">
        </div>
      </div>

      <!-- RIGHT SIDE -->
      <div class="svm-hero-right-v6">
        <div class="svm-hero-right-inner">
          <?php if ($verification_msg): ?>
            <div class="svm-alert-v6 svm-alert-<?php echo esc_attr($verification_type); ?>">
              <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
              <span><?php echo esc_html($verification_msg); ?></span>
            </div>
          <?php endif; ?>

          <?php if ($status !== 'sold'): ?>
            <?php if (!$verified): ?>
              <!-- LEAD FORM -->
              <div class="svm-form-box-v6">
                <div class="svm-form-header-v6">
                  <h3>Get Instant Pricing</h3>
                  <p>Fill out the form to unlock pricing details</p>
                </div>
                
                <form method="post" class="svm-form-v6" id="lead-form">
                  <input type="hidden" name="action" value="svm_submit_lead">
                  <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>">
                  <input type="hidden" name="_ajax_nonce" value="<?php echo wp_create_nonce('svm_nonce'); ?>">
                  
                  <input name="full_name" type="text" placeholder="Full Name*" required>
                  <input name="email" type="email" placeholder="Email Address*" required>
                  
                  <div class="svm-form-row-2-v6">
                    <input name="company" type="text" placeholder="Company">
                    <input name="phone" type="tel" placeholder="Phone">
                  </div>
                  
                  <div class="svm-budget-input-v6">
                    <input name="budget" type="number" min="1" placeholder="Budget">
                    <span class="svm-currency-label">USD</span>
                  </div>
                  
                  <textarea name="message" placeholder="Message*" required rows="2"></textarea>
                  
                  <!-- Payment Icons -->
                  <div class="svm-payment-icons-v6">
                    <img src="<?php echo $assets_url; ?>visa-grayscale.svg" alt="Visa">
                    <img src="<?php echo $assets_url; ?>mastercard-grayscale.svg" alt="Mastercard">
                    <img src="<?php echo $assets_url; ?>american-express-grayscale.svg" alt="American Express">
                    <img src="<?php echo $assets_url; ?>discover-grayscale.svg" alt="Discover">
                    <img src="<?php echo $assets_url; ?>paypal-grayscale.svg" alt="PayPal">
                    <img src="<?php echo $assets_url; ?>applepay-grayscale.svg" alt="Apple Pay">
                    <img src="<?php echo $assets_url; ?>googlepay-grayscale.svg" alt="Google Pay">
                    <img src="<?php echo $assets_url; ?>bitcoin-grayscale.svg" alt="Bitcoin">
                    <img src="<?php echo $assets_url; ?>alipay-grayscale.svg" alt="Alipay">
                    <img src="<?php echo $assets_url; ?>wire-transfer-grayscale.svg" alt="Wire Transfer">
                  </div>
                  
                  <button type="submit" class="svm-cta-btn-v6">
                    <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                    View Price
                  </button>
                </form>
                
                <div id="verify-sent" class="svm-alert-v6 svm-alert-success" style="display:none">
                  <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                  <div>
                    <strong>Check your email!</strong>
                    <p>We sent a verification link to <strong id="sent-email"></strong></p>
                    <a href="#" id="resend">Resend</a>
                  </div>
                </div>
              </div>
            <?php else: ?>
              <!-- PRICING BOX -->
              <?php if ($price): ?>
                <div class="svm-pricing-box-v6">
                  <div class="svm-pricing-header-v6">
                    <h3>Purchase Options</h3>
                    <div class="svm-price-display-v6">
                      <span class="svm-price-num-v6"><?php echo number_format((int)$price); ?></span>
                      <span class="svm-price-curr-v6">USD</span>
                    </div>
                  </div>
                  
                  <div class="svm-pricing-btns-v6">
                    <?php if ($stripe_price_id): ?>
                      <form method="post" class="svm-checkout-form-v6">
                        <input type="hidden" name="action" value="svm_create_checkout">
                        <input type="hidden" name="post_id" value="<?php echo esc_attr($post_id); ?>">
                        <input type="hidden" name="_ajax_nonce" value="<?php echo wp_create_nonce('svm_nonce'); ?>">
                        <button type="submit" class="svm-cta-btn-v6">
                          <svg viewBox="0 0 20 20" fill="currentColor"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg>
                          Buy with Stripe
                        </button>
                      </form>
                    <?php endif; ?>
                    
                    <?php if ($auto_escrow): ?>
                      <a class="svm-btn-secondary-v6" href="mailto:info@s.ventures?subject=Buy <?php echo urlencode($domain_name); ?> via Escrow.com" target="_blank">
                        <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                        Buy with Escrow.com
                      </a>
                    <?php endif; ?>
                  </div>
                  
                  <!-- Payment Icons -->
                  <div class="svm-payment-icons-v6">
                    <img src="<?php echo $assets_url; ?>visa-grayscale.svg" alt="Visa">
                    <img src="<?php echo $assets_url; ?>mastercard-grayscale.svg" alt="Mastercard">
                    <img src="<?php echo $assets_url; ?>american-express-grayscale.svg" alt="American Express">
                    <img src="<?php echo $assets_url; ?>discover-grayscale.svg" alt="Discover">
                    <img src="<?php echo $assets_url; ?>paypal-grayscale.svg" alt="PayPal">
                    <img src="<?php echo $assets_url; ?>applepay-grayscale.svg" alt="Apple Pay">
                    <img src="<?php echo $assets_url; ?>googlepay-grayscale.svg" alt="Google Pay">
                    <img src="<?php echo $assets_url; ?>bitcoin-grayscale.svg" alt="Bitcoin">
                    <img src="<?php echo $assets_url; ?>alipay-grayscale.svg" alt="Alipay">
                    <img src="<?php echo $assets_url; ?>wire-transfer-grayscale.svg" alt="Wire Transfer">
                  </div>
                  
                  <div class="svm-trust-line-v6">
                    <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>Secure payment • Transfer included • Buyer protection</span>
                  </div>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    
    <!-- BELOW THE FOLD - Feature Icons LEFT, Contact RIGHT -->
    <div class="svm-below-fold-row-v6">
      <!-- Feature Icons LEFT -->
      <div class="svm-features-container-v6">
        <div class="svm-feature-item-v6">
          <img src="<?php echo $assets_url; ?>shield.svg" alt="Shield" class="svm-feature-icon-v6">
          <span>Buyer protected transaction</span>
        </div>
        <div class="svm-feature-item-v6">
          <img src="<?php echo $assets_url; ?>clock.svg" alt="Clock" class="svm-feature-icon-v6">
          <span>Fast and easy transfer</span>
        </div>
        <div class="svm-feature-item-v6">
          <img src="<?php echo $assets_url; ?>check.svg" alt="Check" class="svm-feature-icon-v6">
          <span>Flexible payment options</span>
        </div>
      </div>
      
      <!-- Contact Icons RIGHT -->
      <div class="svm-contact-box-v6">
        <p class="svm-contact-label-v6">Prefer to discuss directly?</p>
        <div class="svm-contact-grid-v6">
          <a href="mailto:info@s.ventures?subject=<?php echo urlencode($domain_name); ?>" class="svm-contact-link-v6">
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/><path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/></svg>
            <span>Email</span>
          </a>
          <a href="https://wa.me/12817261751?text=<?php echo urlencode($domain_name); ?>" class="svm-contact-link-v6" target="_blank">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            <span>WhatsApp</span>
          </a>
          <a href="https://t.me/s_ventures?text=<?php echo urlencode($domain_name); ?>" class="svm-contact-link-v6" target="_blank">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-1.99 1.93c-.23.23-.42.42-.83.42z"/></svg>
            <span>Telegram</span>
          </a>
          <a href="sms:+12815295954&body=<?php echo urlencode($domain_name); ?>" class="svm-contact-link-v6">
            <svg viewBox="0 0 20 20" fill="currentColor"><path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"/><path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"/></svg>
            <span>SMS</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTENT SECTION - FIXED: Now with styled description -->
  <section class="svm-content-section-v6">
    <div class="svm-content-inner-v6">
      <?php 
      // Get custom description from meta field (synced from Google Sheets)
      $custom_description = get_post_meta($post_id, 'svm_description', true);
      
      if (!empty($custom_description)): ?>
        <div class="svm-description-section">
          <h2 class="svm-description-title">About <?php echo esc_html($domain_name); ?></h2>
          <div class="svm-description-content">
            <?php echo wpautop(wp_kses_post($custom_description)); ?>
          </div>
        </div>
      <?php endif;
      
      // Then show Elementor content if it exists
      if (class_exists('\Elementor\Plugin')) {
        $elementor_content = \Elementor\Plugin::instance()->frontend->get_builder_content($post_id);
        if (!empty($elementor_content)) {
          echo '<div class="svm-elementor-content">' . $elementor_content . '</div>';
        }
      }
      
      // Finally show standard post content if no Elementor and no custom description
      if (!class_exists('\Elementor\Plugin') || !\Elementor\Plugin::instance()->frontend->get_builder_content($post_id)) {
        if (empty($custom_description) && get_the_content()) {
          echo '<div class="svm-standard-content">';
          the_content();
          echo '</div>';
        }
      }
      ?>
    </div>
  </section>

  <!-- FAQ SECTION -->
  <section class="svm-faq-v6">
    <div class="svm-faq-inner-v6">
      <div class="svm-faq-header-v6">
        <h2>Frequently Asked Questions</h2>
        <p>Everything you need to know about acquiring this domain</p>
      </div>
      
      <div class="svm-faq-list-v6">
        <?php
        $faqs = [
          ['q' => 'How does the domain transfer process work?', 'a' => 'Once payment is complete, we initiate the domain transfer. You\'ll receive an authorization code and step-by-step instructions. The process typically takes 5-7 days. We provide full support throughout.'],
          ['q' => 'What payment methods do you accept?', 'a' => 'We accept all major credit cards through Stripe for instant checkout. We also facilitate secure transactions through Escrow.com. For custom arrangements or installment plans, contact us directly.'],
          ['q' => 'Is the price negotiable?', 'a' => 'While our prices reflect fair market value, we\'re open to reasonable offers. We offer flexible lease-to-own arrangements and can structure creative deals including equity partnerships. Contact us to discuss.'],
          ['q' => 'Why invest in a premium domain?', 'a' => 'A premium domain establishes instant credibility, improves SEO, and creates memorable brand identity. Short, brandable domains are rare digital assets that appreciate in value while serving as the foundation of your online presence.'],
          ['q' => 'How quickly can I get the domain?', 'a' => 'For Stripe purchases, transfer begins immediately. Escrow.com transactions start once funds are verified (1-3 days). The actual domain transfer takes 5-7 days due to ICANN regulations, though you can often begin using it sooner.'],
          ['q' => 'What support do you provide?', 'a' => 'We provide comprehensive support throughout and after the transfer process. Reach us via email, WhatsApp, Telegram, or SMS. We\'ll guide you through every step, from transfer initiation to DNS setup.']
        ];
        foreach ($faqs as $faq):
        ?>
          <div class="svm-faq-item-v6">
            <button class="svm-faq-question-v6">
              <span><?php echo esc_html($faq['q']); ?></span>
              <svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
            </button>
            <div class="svm-faq-answer-v6">
              <p><?php echo esc_html($faq['a']); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- CTA SECTION -->
  <section class="svm-cta-v6">
    <div class="svm-cta-inner-v6">
      <h2>Ready to Secure <?php echo esc_html($domain_name); ?>?</h2>
      <p>This premium domain represents a unique investment opportunity</p>
      <a href="#svm-hero" class="svm-cta-button-v6">Get Started Now</a>
    </div>
  </section>

  <!-- PURPLE ABOUT -->
  <section class="svm-purple-about">
    <div class="svm-purple-about-inner">
      <p>At S Ventures, we've spent the past two decades quietly acquiring premium digital real estate — the kind of domain names that define industries and ignite ideas. Our portfolio was born from our own ventures, spanning cutting-edge software and AI platforms to e-commerce brands, home services, finance, and beyond.</p>
      <p>Rather than let these powerful names collect dust, we're opening them up to the world. S Ventures offers our curated domain portfolio for sale or lease — even for equity or revenue-sharing partnerships with the right startups.</p>
    </div>
  </section>
</main>

<script>
(function(){
  var AJAX_URL = <?php echo json_encode(admin_url('admin-ajax.php')); ?>;

  function post(form, onSuccess, onError){
    var data = new FormData(form);
    var btn = form.querySelector('button[type="submit"]');
    var txt = btn ? btn.innerHTML : '';
    
    if (btn) {
      btn.disabled = true;
      btn.innerHTML = '<svg class="spin-v6" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="3" opacity="0.25"/><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Processing...';
    }

    fetch(AJAX_URL, {method: 'POST', body: data, credentials: 'same-origin'})
    .then(r => r.text())
    .then(t => {
      try {
        var d = JSON.parse(t);
        if (d && d.success) {
          onSuccess(d);
        } else {
          if (btn) {
            btn.disabled = false;
            btn.innerHTML = txt;
          }
          onError((d && d.data && d.data.message) || 'Error occurred');
        }
      } catch(e) {
        if (btn) {
          btn.disabled = false;
          btn.innerHTML = txt;
        }
        onError('Invalid response');
      }
    })
    .catch(err => {
      if (btn) {
        btn.disabled = false;
        btn.innerHTML = txt;
      }
      onError('Request failed');
    });
  }

  document.addEventListener('DOMContentLoaded', function() {
    var leadForm = document.getElementById('lead-form');
    var verifySent = document.getElementById('verify-sent');
    var sentEmail = document.getElementById('sent-email');
    var resend = document.getElementById('resend');

    if (leadForm) {
      leadForm.addEventListener('submit', function(e) {
        e.preventDefault();
        var email = leadForm.querySelector('input[name="email"]').value;
        
        post(leadForm, function(d) {
          if (leadForm) leadForm.style.display = 'none';
          if (verifySent) {
            verifySent.style.display = 'flex';
            if (sentEmail) sentEmail.textContent = email;
          }
        }, alert);
      });
    }

    if (resend) {
      resend.addEventListener('click', function(e) {
        e.preventDefault();
        if (leadForm) leadForm.style.display = 'block';
        if (verifySent) verifySent.style.display = 'none';
        if (leadForm) leadForm.reset();
      });
    }

    var checkoutForm = document.querySelector('.svm-checkout-form-v6');
    if (checkoutForm) {
      checkoutForm.addEventListener('submit', function(e) {
        e.preventDefault();
        post(checkoutForm, function(d) {
          if (d.data && d.data.redirect) window.location.href = d.data.redirect;
          else alert('Checkout URL not received');
        }, alert);
      });
    }

    var faqItems = document.querySelectorAll('.svm-faq-question-v6');
    faqItems.forEach(function(btn) {
      btn.addEventListener('click', function() {
        var item = this.closest('.svm-faq-item-v6');
        var content = item.querySelector('.svm-faq-answer-v6');
        var open = item.classList.contains('open');
        
        document.querySelectorAll('.svm-faq-item-v6').forEach(function(i) {
          if (i !== item) {
            i.classList.remove('open');
            i.querySelector('.svm-faq-answer-v6').style.maxHeight = null;
          }
        });
        
        if (open) {
          item.classList.remove('open');
          content.style.maxHeight = null;
        } else {
          item.classList.add('open');
          content.style.maxHeight = content.scrollHeight + 'px';
        }
      });
    });

    document.querySelector('.svm-cta-button-v6')?.addEventListener('click', function(e) {
      e.preventDefault();
      document.getElementById('svm-hero')?.scrollIntoView({behavior:'smooth'});
    });
  });
})();
</script>

<style>
/* DESKTOP - PERFECT LAYOUT */

.svm-domain-hero-v6 {
  background:#fff;
  padding:calc(70px + 20px) 20px 20px;
}

.svm-hero-container {
  max-width:1280px;
  margin:0 auto;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:40px;
  align-items:start;
}

/* LEFT SIDE */
.svm-hero-left-v6 {
  display:flex;
  flex-direction:column;
  justify-content:space-between;
  min-height:calc(100vh - 160px);
}

.svm-hero-content-v6 {
  text-align:center;
  display:flex;
  flex-direction:column;
  gap:12px;
  align-items:center;
  padding-bottom:40px;
}

/* Logo - MUCH LARGER & CENTERED (like Rlz.ai example) */
.svm-domain-logo-v6 {
  width:100%;
  max-width:420px;
  padding:30px;
  background:#ffffff;
  border-radius:20px;
  box-shadow:0 6px 24px rgba(0,0,0,0.08);
  border:1px solid #f3f4f6;
  margin:0 auto;
}

.svm-domain-logo-v6 img {
  width:100%;
  height:auto;
  max-height:220px;
  object-fit:contain;
  display:block;
  background:#ffffff;
}

/* Domain Title */
.svm-domain-title-v6 {
  font-size:clamp(30px,4vw,40px);
  font-weight:700;
  color:#1a1d35;
  margin:10px 0;
  font-family:'Colour Brown',sans-serif;
  line-height:1.1;
  letter-spacing:-0.02em;
}

/* Subtitle */
.svm-domain-subtitle-v6 {
  font-size:15px;
  color:#6b7280;
  margin:0;
  line-height:1.4;
}

/* Badge */
.svm-status-badge {
  display:inline-flex;
  align-items:center;
  gap:6px;
  padding:8px 16px;
  border-radius:20px;
  font-weight:600;
  font-size:13px;
  margin:0;
}

.svm-status-badge svg {
  width:16px;
  height:16px;
}

.svm-status-available {
  background:rgba(46,252,134,0.12);
  color:#1ec770;
  border:2px solid rgba(46,252,134,0.3);
}

.svm-status-sold {
  background:rgba(239,68,68,0.1);
  color:#dc2626;
  border:2px solid rgba(239,68,68,0.2);
}

/* Trust Partner Logos */
.svm-trust-partners-v6 {
  display:flex;
  justify-content:space-between;
  align-items:flex-end;
  gap:20px;
  width:100%;
  max-width:460px;
  margin:0 auto;
  padding-bottom:0;
}

.svm-partner-logo-v6 {
  height:60px;
  width:auto;
  flex:1;
  max-width:115px;
  opacity:0.75;
  transition:all .2s ease;
  filter:grayscale(100%);
  object-fit:contain;
}

.svm-partner-logo-v6:hover {
  opacity:1;
  filter:grayscale(0%);
  transform:scale(1.05);
}

/* RIGHT SIDE */
.svm-hero-right-v6 {
  display:flex;
  align-items:flex-start;
  justify-content:center;
}

.svm-hero-right-inner {
  width:100%;
  max-width:460px;
  display:flex;
  flex-direction:column;
  gap:14px;
}

/* Form Box */
.svm-form-box-v6,
.svm-pricing-box-v6 {
  background:#fff;
  border-radius:18px;
  padding:20px;
  box-shadow:0 6px 28px rgba(0,0,0,0.08);
  border:1px solid #f3f4f6;
}

.svm-form-header-v6,
.svm-pricing-header-v6 {
  margin-bottom:12px;
  text-align:center;
}

.svm-form-header-v6 h3,
.svm-pricing-header-v6 h3 {
  font-size:22px;
  font-weight:700;
  color:#1a1d35;
  margin:0 0 6px;
  font-family:'Colour Brown',sans-serif;
}

.svm-form-header-v6 p {
  font-size:14px;
  color:#6b7280;
  margin:0;
  line-height:1.4;
}

.svm-form-v6 {
  display:flex;
  flex-direction:column;
  gap:11px;
}

.svm-form-v6 input,
.svm-form-v6 textarea {
  width:100%;
  padding:11px 15px;
  border:2px solid #e5e7eb;
  border-radius:10px;
  font-size:14px;
  transition:all .2s ease;
  font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif;
  background:#fff;
}

.svm-form-v6 input:focus,
.svm-form-v6 textarea:focus {
  outline:none;
  border-color:#00d9ff;
  box-shadow:0 0 0 3px rgba(0,217,255,0.1);
}

.svm-form-row-2-v6 {
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:11px;
}

.svm-budget-input-v6 {
  position:relative;
  display:flex;
  align-items:center;
}

.svm-budget-input-v6 input {
  padding-right:60px;
}

.svm-currency-label {
  position:absolute;
  right:15px;
  color:#6b7280;
  font-weight:600;
  font-size:13px;
  pointer-events:none;
}

.svm-form-v6 textarea {
  resize:vertical;
  min-height:65px;
}

/* Payment Icons */
.svm-payment-icons-v6 {
  display:flex;
  flex-wrap:wrap;
  gap:11px;
  justify-content:center;
  align-items:center;
  padding:0;
  margin:4px 0;
}

.svm-payment-icons-v6 img {
  height:28px;
  width:auto;
  opacity:0.7;
  transition:all .2s ease;
  filter:grayscale(100%);
}

.svm-payment-icons-v6 img:hover {
  opacity:1;
  filter:grayscale(0%);
  transform:scale(1.05);
}

/* CTA Button */
.svm-cta-btn-v6 {
  width:100%;
  padding:13px 26px;
  background:linear-gradient(135deg,#00d9ff 0%,#00b8d9 100%);
  color:#fff;
  border:none;
  border-radius:50px;
  font-size:15px;
  font-weight:700;
  font-family:'Colour Brown',sans-serif;
  cursor:pointer;
  transition:all .3s ease;
  box-shadow:0 4px 16px rgba(0,217,255,0.3);
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;
}

.svm-cta-btn-v6:hover {
  transform:translateY(-2px);
  box-shadow:0 6px 24px rgba(0,217,255,0.45);
}

.svm-cta-btn-v6 svg {
  width:18px;
  height:18px;
}

/* Pricing */
.svm-price-display-v6 {
  display:flex;
  align-items:baseline;
  justify-content:center;
  gap:8px;
  margin-top:12px;
}

.svm-price-num-v6 {
  font-size:42px;
  font-weight:700;
  color:#1a1d35;
  font-family:'Colour Brown',sans-serif;
}

.svm-price-curr-v6 {
  font-size:18px;
  color:#6b7280;
  font-weight:600;
}

.svm-pricing-btns-v6 {
  display:flex;
  flex-direction:column;
  gap:11px;
  margin-bottom:16px;
}

.svm-btn-secondary-v6 {
  width:100%;
  padding:12px 24px;
  background:#fff;
  color:#1a1d35;
  border:2px solid #e5e7eb;
  border-radius:50px;
  font-size:14px;
  font-weight:600;
  font-family:'Colour Brown',sans-serif;
  cursor:pointer;
  transition:all .2s ease;
  text-decoration:none;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  gap:8px;
}

.svm-btn-secondary-v6:hover {
  border-color:#00d9ff;
  background:rgba(0,217,255,0.05);
}

.svm-btn-secondary-v6 svg {
  width:16px;
  height:16px;
}

.svm-trust-line-v6 {
  display:flex;
  align-items:flex-start;
  gap:10px;
  padding:14px;
  background:rgba(46,252,134,0.06);
  border-radius:10px;
  border:1px solid rgba(46,252,134,0.15);
  margin-top:12px;
}

.svm-trust-line-v6 svg {
  width:18px;
  height:18px;
  color:#1ec770;
  flex-shrink:0;
  margin-top:1px;
}

.svm-trust-line-v6 span {
  font-size:12px;
  color:#374151;
  line-height:1.5;
}

/* BELOW FOLD ROW */
.svm-below-fold-row-v6 {
  max-width:1280px;
  margin:0 auto;
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:40px;
  padding:40px 20px;
}

/* Feature Icons Container */
.svm-features-container-v6 {
  display:flex;
  flex-direction:column;
  gap:16px;
  justify-content:center;
}

.svm-feature-item-v6 {
  display:flex;
  align-items:center;
  gap:14px;
  padding:18px 22px;
  background:#f9fafb;
  border-radius:14px;
  border:1px solid #e5e7eb;
  transition:all .2s ease;
}

.svm-feature-item-v6:hover {
  background:#fff;
  border-color:#d1d5db;
  box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.svm-feature-icon-v6 {
  width:32px;
  height:32px;
  opacity:0.8;
  flex-shrink:0;
}

.svm-feature-item-v6 span {
  font-size:15px;
  color:#4b5563;
  font-weight:500;
  line-height:1.4;
}

/* Contact Box */
.svm-contact-box-v6 {
  background:#f9fafb;
  border-radius:16px;
  padding:20px;
  border:1px solid #e5e7eb;
}

.svm-contact-label-v6 {
  font-size:13px;
  font-weight:600;
  color:#374151;
  margin:0 0 12px;
  text-align:center;
}

.svm-contact-grid-v6 {
  display:grid;
  grid-template-columns:repeat(2,1fr);
  gap:10px;
}

.svm-contact-link-v6 {
  display:flex;
  flex-direction:column;
  align-items:center;
  gap:6px;
  padding:14px 12px;
  background:#fff;
  border-radius:10px;
  border:2px solid #e5e7eb;
  text-decoration:none;
  color:#374151;
  font-weight:500;
  font-size:12px;
  transition:all .2s ease;
}

.svm-contact-link-v6:hover {
  border-color:#00d9ff;
  background:rgba(0,217,255,0.05);
  transform:translateY(-2px);
  box-shadow:0 4px 12px rgba(0,0,0,0.06);
}

.svm-contact-link-v6 svg {
  width:22px;
  height:22px;
  color:#6b7280;
}

/* Alerts */
.svm-alert-v6 {
  display:flex;
  align-items:flex-start;
  gap:10px;
  padding:14px 16px;
  border-radius:10px;
  font-size:13px;
  line-height:1.5;
  margin-bottom:16px;
}

.svm-alert-v6 svg {
  width:18px;
  height:18px;
  flex-shrink:0;
  margin-top:1px;
}

.svm-alert-success {
  background:rgba(34,197,94,0.1);
  border:1px solid rgba(34,197,94,0.2);
  color:#166534;
}

.svm-alert-error {
  background:rgba(239,68,68,0.1);
  border:1px solid rgba(239,68,68,0.2);
  color:#991b1b;
}

.svm-alert-v6 strong {
  display:block;
  margin-bottom:4px;
}

.svm-alert-v6 p {
  margin:4px 0;
}

.svm-alert-v6 a {
  color:inherit;
  text-decoration:underline;
  font-weight:600;
}

/* Content Section */
.svm-content-section-v6 {
  background:#fff;
  padding:80px 24px;
}

.svm-content-inner-v6 {
  max-width:960px;
  margin:0 auto;
  color:#374151;
}

.svm-content-inner-v6 h1,
.svm-content-inner-v6 h2,
.svm-content-inner-v6 h3 {
  color:#1a1d35;
  font-family:'Colour Brown',sans-serif;
}


/* NEW: Description Section Styling */
.svm-description-section {
  background: linear-gradient(135deg, rgba(0, 217, 255, 0.03) 0%, rgba(46, 252, 134, 0.03) 100%);
  border-left: 4px solid #00d9ff;
  border-radius: 16px;
  padding: 48px;
  margin-bottom: 60px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
}

.svm-description-title {
  font-size: 32px;
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 28px;
  font-family: 'Colour Brown', sans-serif;
  line-height: 1.2;
}

.svm-description-content {
  font-size: 18px;
  line-height: 1.8;
  color: #4b5563;
}

.svm-description-content p {
  margin: 0 0 24px;
}

.svm-description-content p:last-child {
  margin-bottom: 0;
}

.svm-description-content strong {
  color: #1a1d35;
  font-weight: 600;
}

.svm-description-content a {
  color: #00d9ff;
  text-decoration: underline;
  transition: color 0.2s ease;
}

.svm-description-content a:hover {
  color: #00b8d9;
}

/* H2 Headings within Description - Styled with Brand Colors */
.svm-description-content h2 {
  font-size: 28px;
  font-weight: 700;
  color: #2B234A;
  margin: 48px 0 24px;
  line-height: 1.2;
  font-family: 'Colour Brown', sans-serif;
  background: linear-gradient(135deg, #2B234A 0%, #00d9ff 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  padding-bottom: 12px;
  border-bottom: 3px solid #00d9ff;
  position: relative;
}

.svm-description-content h2:first-child {
  margin-top: 0;
}

.svm-description-content h2::after {
  content: '';
  position: absolute;
  bottom: -3px;
  left: 0;
  width: 60px;
  height: 3px;
  background: linear-gradient(90deg, #2efc86 0%, #00d9ff 100%);
}

/* H3 Headings within Description */
.svm-description-content h3 {
  font-size: 22px;
  font-weight: 600;
  color: #1a1d35;
  margin: 36px 0 20px;
  line-height: 1.3;
  font-family: 'Colour Brown', sans-serif;
}

.svm-description-content h3:first-child {
  margin-top: 0;
}

/* Elementor Content Below Description */
.svm-elementor-content {
  margin-top: 60px;
  padding-top: 60px;
  border-top: 2px solid #f3f4f6;
}

/* Responsive */
@media (max-width: 768px) {
  .svm-description-section {
    padding: 32px 24px;
    margin-bottom: 40px;
  }
  
  .svm-description-title {
    font-size: 24px;
    margin-bottom: 20px;
  }
  
  .svm-description-content {
    font-size: 16px;
    line-height: 1.7;
  }
  
  .svm-description-content p {
    margin-bottom: 20px;
  }
}

/* FAQ Section */
.svm-faq-v6 {
  background:#f9fafb;
  padding:80px 24px;
}

.svm-faq-inner-v6 {
  max-width:900px;
  margin:0 auto;
}

.svm-faq-header-v6 {
  text-align:center;
  margin-bottom:50px;
}

.svm-faq-header-v6 h2 {
  font-size:42px;
  font-weight:700;
  color:#1a1d35;
  margin:0 0 12px;
  font-family:'Colour Brown',sans-serif;
}

.svm-faq-header-v6 p {
  font-size:18px;
  color:#6b7280;
  margin:0;
}

.svm-faq-list-v6 {
  display:flex;
  flex-direction:column;
  gap:16px;
}

.svm-faq-item-v6 {
  background:#fff;
  border-radius:16px;
  border:2px solid #e5e7eb;
  overflow:hidden;
  transition:all .2s ease;
}

.svm-faq-item-v6:hover {
  border-color:#d1d5db;
}

.svm-faq-item-v6.open {
  border-color:#00d9ff;
}

.svm-faq-question-v6 {
  width:100%;
  background:transparent;
  border:none;
  padding:24px;
  text-align:left;
  cursor:pointer;
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:20px;
  transition:background .2s ease;
  font-family:'Colour Brown',sans-serif;
}

.svm-faq-question-v6:hover {
  background:#f9fafb;
}

.svm-faq-question-v6 span {
  font-size:18px;
  font-weight:600;
  color:#1a1d35;
  line-height:1.3;
  flex:1;
}

.svm-faq-question-v6 svg {
  width:24px;
  height:24px;
  color:#6b7280;
  flex-shrink:0;
  transition:transform .3s ease;
}

.svm-faq-item-v6.open .svm-faq-question-v6 svg {
  transform:rotate(180deg);
}

.svm-faq-answer-v6 {
  max-height:0;
  overflow:hidden;
  transition:max-height .3s ease;
}

.svm-faq-answer-v6 p {
  padding:0 24px 24px;
  font-size:15px;
  line-height:1.7;
  color:#4b5563;
  margin:0;
}

/* CTA Section */
.svm-cta-v6 {
  background:linear-gradient(135deg,#1a1d35 0%,#0a0e27 100%);
  padding:100px 24px;
  position:relative;
  overflow:hidden;
}

.svm-cta-v6::before {
  content:'';
  position:absolute;
  inset:0;
  background:radial-gradient(circle at 50% 50%,rgba(0,217,255,0.08) 0%,transparent 70%);
  pointer-events:none;
}

.svm-cta-inner-v6 {
  max-width:800px;
  margin:0 auto;
  text-align:center;
  position:relative;
  z-index:1;
}

.svm-cta-inner-v6 h2 {
  font-size:42px;
  font-weight:700;
  color:#fff;
  margin:0 0 16px;
  font-family:'Colour Brown',sans-serif;
  line-height:1.2;
}

.svm-cta-inner-v6 p {
  font-size:20px;
  color:rgba(255,255,255,0.85);
  margin:0 0 40px;
}

.svm-cta-button-v6 {
  display:inline-flex;
  align-items:center;
  gap:10px;
  padding:18px 48px;
  background:linear-gradient(135deg,#00d9ff 0%,#00b8d9 100%);
  color:#fff;
  border-radius:50px;
  font-size:18px;
  font-weight:700;
  font-family:'Colour Brown',sans-serif;
  text-decoration:none;
  transition:all .3s ease;
  box-shadow:0 8px 28px rgba(0,217,255,0.35);
}

.svm-cta-button-v6:hover {
  transform:translateY(-2px);
  box-shadow:0 12px 36px rgba(0,217,255,0.5);
}

.spin-v6 {
  width:20px;
  height:20px;
  animation:spin-v6 1s linear infinite;
}

@keyframes spin-v6 {
  to{transform:rotate(360deg)}
}

/* RESPONSIVE - MOBILE FIXES */
@media (max-width:1200px) {
  .svm-hero-container,
  .svm-below-fold-row-v6 {
    gap:36px;
  }
}

@media (max-width:900px) {
  .svm-domain-hero-v6 {
    padding:calc(70px + 12px) 16px 0;
  }
  
  .svm-hero-container {
    grid-template-columns:1fr;
    gap:0;
    display:block;
  }
  
  /* Mobile: Remove min-height constraint */
  .svm-hero-left-v6 {
    display:block;
    min-height:auto;
  }
  
  .svm-hero-content-v6 {
    padding-bottom:16px;
    gap:8px;
  }
  
  .svm-domain-logo-v6 {
    max-width:200px;
    padding:12px;
    margin:0 auto 12px;
  }
  
  .svm-domain-logo-v6 img {
    max-height:80px;
  }
  
  .svm-domain-title-v6 {
    font-size:24px;
    margin:8px 0;
  }
  
  .svm-domain-subtitle-v6 {
    font-size:13px;
    margin-bottom:8px;
  }
  
  .svm-status-badge {
    padding:6px 14px;
    font-size:12px;
    margin-bottom:16px;
  }
  
  /* Mobile: Move trust logos AFTER form */
  .svm-trust-partners-v6 {
    order:10;
    flex-wrap:wrap;
    justify-content:center;
    gap:10px;
    padding:16px 0 20px;
    max-width:100%;
  }
  
  .svm-partner-logo-v6 {
    height:36px;
    max-width:72px;
  }
  
  /* Mobile: Form comes right after title */
  .svm-hero-right-v6 {
    order:5;
    margin-bottom:0;
  }
  
  .svm-hero-right-inner {
    max-width:100%;
  }
  
  .svm-form-box-v6,
  .svm-pricing-box-v6 {
    padding:16px;
    margin-bottom:16px;
  }
  
  .svm-form-header-v6,
  .svm-pricing-header-v6 {
    margin-bottom:10px;
  }
  
  .svm-form-header-v6 h3,
  .svm-pricing-header-v6 h3 {
    font-size:18px;
    margin-bottom:4px;
  }
  
  .svm-form-header-v6 p {
    font-size:12px;
  }
  
  .svm-form-v6 {
    gap:9px;
  }
  
  .svm-form-v6 input,
  .svm-form-v6 textarea {
    padding:9px 12px;
    font-size:13px;
  }
  
  .svm-form-v6 textarea {
    min-height:50px;
  }
  
  .svm-form-row-2-v6 {
    grid-template-columns:1fr 1fr;
    gap:9px;
  }
  
  .svm-payment-icons-v6 {
    gap:6px;
    padding:0;
    margin:6px 0;
    flex-wrap:wrap;
  }
  
  .svm-payment-icons-v6 img {
    height:20px;
  }
  
  .svm-cta-btn-v6 {
    padding:11px 24px;
    font-size:14px;
  }
  
  /* Mobile: Contact options directly below form */
  .svm-below-fold-row-v6 {
    grid-template-columns:1fr;
    gap:0;
    padding:0 16px 20px;
    display:block;
  }
  
  /* Hide feature icons on mobile - not needed above fold */
  .svm-features-container-v6 {
    display:none;
  }
  
  .svm-contact-box-v6 {
    padding:16px;
    margin-bottom:16px;
    background:#fff;
  }
  
  .svm-contact-label-v6 {
    font-size:12px;
    margin-bottom:10px;
  }
  
  .svm-contact-grid-v6 {
    grid-template-columns:repeat(2, 1fr);
    gap:8px;
  }
  
  .svm-contact-link-v6 {
    padding:10px 8px;
    font-size:11px;
  }
  
  .svm-contact-link-v6 svg {
    width:18px;
    height:18px;
  }
}

@media (max-width:640px) {
  .svm-domain-logo-v6 {
    max-width:180px;
    padding:10px;
  }
  
  .svm-domain-logo-v6 img {
    max-height:70px;
  }
  
  .svm-domain-title-v6 {
    font-size:22px;
  }
  
  .svm-form-row-2-v6 {
    grid-template-columns:1fr;
  }
  
  .svm-contact-grid-v6 {
    grid-template-columns:1fr;
    gap:8px;
  }
  
  .svm-partner-logo-v6 {
    height:32px;
    max-width:65px;
  }
}
</style>


<?php endwhile; get_footer(); ?>