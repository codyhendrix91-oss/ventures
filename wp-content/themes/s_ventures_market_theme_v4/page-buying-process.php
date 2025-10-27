<?php
/**
 * Template Name: Buying Process
 * Description: Premium domain buying process timeline with visual steps
 */
get_header();
?>

<style>
/* Premium Domain Buying Process Page Styles */
.buying-process {
  background: #ffffff;
  min-height: 100vh;
}

.buying-process__hero {
  background: linear-gradient(135deg, #1a1d35 0%, #0a0e27 100%);
  padding: calc(70px + 90px) 40px 90px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.buying-process__hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.08) 0%, transparent 70%);
  pointer-events: none;
}

.buying-process__hero-inner {
  max-width: 900px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.buying-process__hero h1 {
  font-size: clamp(40px, 6vw, 56px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 20px;
  font-family: 'Poppins', sans-serif;
  line-height: 1.1;
}

.buying-process__hero p {
  font-size: clamp(17px, 2.5vw, 19px);
  color: rgba(255, 255, 255, 0.9);
  margin: 0;
  line-height: 1.6;
}

.buying-process__content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 100px 40px;
  position: relative;
}

.buying-process__timeline {
  position: relative;
}

/* Timeline steps */
.process-step {
  position: relative;
  margin-bottom: 120px;
  display: grid;
  grid-template-columns: 1fr 140px 1fr;
  gap: 40px;
  align-items: center;
}

/* Connecting lines between steps - continuous line through all steps */
.process-step:not(:last-child)::after {
  content: '';
  position: absolute;
  left: 50%;
  top: 60px;
  width: 4px;
  height: calc(100% + 120px);
  background: linear-gradient(180deg, #00d9ff 0%, #2efc86 100%);
  transform: translateX(-50%);
  border-radius: 2px;
  z-index: 0;
}

/* White circle behind icon to create break in line for icon visibility */
.process-step__icon-wrapper::before {
  content: '';
  position: absolute;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: #ffffff;
  z-index: 1;
}

.process-step:last-child {
  margin-bottom: 0;
}

/* Alternating layout */
.process-step:nth-child(odd) .process-step__content {
  grid-column: 1;
  text-align: right;
}

.process-step:nth-child(odd) .process-step__icon-wrapper {
  grid-column: 2;
}

.process-step:nth-child(odd) .process-step__spacer {
  grid-column: 3;
}

.process-step:nth-child(even) .process-step__spacer {
  grid-column: 1;
}

.process-step:nth-child(even) .process-step__icon-wrapper {
  grid-column: 2;
}

.process-step:nth-child(even) .process-step__content {
  grid-column: 3;
  text-align: left;
}

/* Icon wrapper */
.process-step__icon-wrapper {
  position: relative;
  z-index: 2;
  display: flex;
  align-items: center;
  justify-content: center;
}

.process-step__icon {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  background: #ffffff;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  border: 4px solid #f3f4f6;
  transition: all 0.3s ease;
  z-index: 2;
}

.process-step:hover .process-step__icon {
  transform: scale(1.1);
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.16);
}

/* Alternating icon backgrounds */
.process-step:nth-child(odd) .process-step__icon {
  background: linear-gradient(135deg, rgba(0, 217, 255, 0.1) 0%, rgba(0, 217, 255, 0.05) 100%);
  border-color: #00d9ff;
}

.process-step:nth-child(even) .process-step__icon {
  background: linear-gradient(135deg, rgba(46, 252, 134, 0.1) 0%, rgba(46, 252, 134, 0.05) 100%);
  border-color: #2efc86;
}

.process-step__icon svg {
  width: 64px;
  height: 64px;
}

/* Step number badge */
.process-step__number {
  position: absolute;
  top: -8px;
  right: -8px;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
  color: #fff;
  font-size: 14px;
  font-weight: 700;
  font-family: 'Poppins', sans-serif;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 4px 12px rgba(124, 58, 237, 0.4);
}

/* Content */
.process-step__content {
  padding: 20px;
}

.process-step__label {
  font-size: 24px;
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 12px;
  font-family: 'Poppins', sans-serif;
  line-height: 1.2;
}

.process-step__description {
  font-size: 16px;
  line-height: 1.8;
  color: #4b5563;
  margin: 0;
}

.process-step__description strong {
  color: #1a1d35;
  font-weight: 600;
}

/* CTA Section */
.buying-process__cta {
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  border-radius: 16px;
  padding: 60px 48px;
  text-align: center;
  color: #fff;
  margin-top: 100px;
  position: relative;
  overflow: hidden;
}

.buying-process__cta::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.1) 0%, transparent 70%);
  pointer-events: none;
}

.buying-process__cta-inner {
  position: relative;
  z-index: 1;
  max-width: 700px;
  margin: 0 auto;
}

.buying-process__cta h2 {
  font-size: 36px;
  font-weight: 700;
  margin: 0 0 16px;
  font-family: 'Poppins', sans-serif;
  color: #fff;
}

.buying-process__cta p {
  font-size: 18px;
  line-height: 1.6;
  margin: 0 0 32px;
  color: rgba(255, 255, 255, 0.9);
}

.buying-process__cta-btn {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  background: linear-gradient(135deg, #00d9ff 0%, #2efc86 100%);
  color: #1a1d35;
  padding: 18px 40px;
  border-radius: 50px;
  text-decoration: none;
  font-weight: 700;
  font-size: 16px;
  transition: all 0.3s ease;
  box-shadow: 0 8px 24px rgba(0, 217, 255, 0.3);
  font-family: 'Poppins', sans-serif;
}

.buying-process__cta-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 12px 32px rgba(0, 217, 255, 0.4);
}

.buying-process__cta-btn svg {
  width: 20px;
  height: 20px;
}

/* Responsive */
@media (max-width: 968px) {
  .buying-process__hero {
    padding: calc(70px + 60px) 20px 60px;
  }

  .buying-process__content {
    padding: 80px 20px;
  }

  .process-step {
    grid-template-columns: 80px 1fr;
    gap: 24px;
    margin-bottom: 80px;
  }

  /* Mobile connecting lines - continuous through all steps */
  .process-step:not(:last-child)::after {
    left: 40px;
    top: 40px;
    height: calc(100% + 80px);
  }

  /* Mobile white circle mask for icon visibility */
  .process-step__icon-wrapper::before {
    width: 60px;
    height: 60px;
  }

  .process-step:nth-child(odd) .process-step__icon-wrapper,
  .process-step:nth-child(even) .process-step__icon-wrapper {
    grid-column: 1;
    grid-row: 1;
  }

  .process-step:nth-child(odd) .process-step__content,
  .process-step:nth-child(even) .process-step__content {
    grid-column: 2;
    grid-row: 1;
    text-align: left;
  }

  .process-step__spacer {
    display: none;
  }

  .process-step__icon {
    width: 80px;
    height: 80px;
  }

  .process-step__icon svg {
    width: 48px;
    height: 48px;
  }

  .process-step__number {
    width: 28px;
    height: 28px;
    font-size: 12px;
    top: -6px;
    right: -6px;
  }

  .process-step__label {
    font-size: 20px;
  }

  .process-step__description {
    font-size: 15px;
  }

  .buying-process__cta {
    padding: 40px 24px;
    margin-top: 60px;
  }

  .buying-process__cta h2 {
    font-size: 28px;
  }
}
</style>

<div class="buying-process">
  <!-- Hero Section -->
  <section class="buying-process__hero">
    <div class="buying-process__hero-inner">
      <h1>The Premium Domain Buying Process</h1>
      <p>Your step-by-step journey from discovery to ownership. Simple, secure, and transparent.</p>
    </div>
  </section>

  <!-- Timeline Content -->
  <div class="buying-process__content">
    <div class="buying-process__timeline">

      <!-- Step 1: Choose Domain -->
      <div class="process-step">
        <div class="process-step__content">
          <h2 class="process-step__label">Choose Your Domain</h2>
          <p class="process-step__description">Browse our curated portfolio of premium domains. Use our search and filtering tools to find the perfect domain name that matches your brand vision and business goals.</p>
        </div>
        <div class="process-step__icon-wrapper">
          <div class="process-step__icon">
            <span class="process-step__number">1</span>
            <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="150" cy="120" r="70" stroke="#00d9ff" stroke-width="12" fill="none"/>
              <circle cx="150" cy="120" r="50" stroke="#00d9ff" stroke-width="8" fill="none"/>
              <line x1="200" y1="170" x2="250" y2="220" stroke="#00d9ff" stroke-width="12" stroke-linecap="round"/>
              <circle cx="150" cy="120" r="25" fill="#00d9ff" opacity="0.2"/>
              <path d="M130 120 L140 130 L170 100" stroke="#00d9ff" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            </svg>
          </div>
        </div>
        <div class="process-step__spacer"></div>
      </div>

      <!-- Step 2: Make Offer or Buy Now -->
      <div class="process-step">
        <div class="process-step__spacer"></div>
        <div class="process-step__icon-wrapper">
          <div class="process-step__icon">
            <span class="process-step__number">2</span>
            <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="60" y="80" width="180" height="140" rx="20" fill="#2efc86" opacity="0.1" stroke="#2efc86" stroke-width="8"/>
              <text x="150" y="140" font-family="'Colour Brown', sans-serif" font-size="48" font-weight="700" fill="#2efc86" text-anchor="middle">$</text>
              <rect x="90" y="170" width="120" height="30" rx="15" fill="#2efc86"/>
              <text x="150" y="192" font-family="sans-serif" font-size="16" font-weight="700" fill="#ffffff" text-anchor="middle">BUY NOW</text>
              <circle cx="210" cy="110" r="8" fill="#2efc86"/>
              <circle cx="230" cy="110" r="8" fill="#2efc86"/>
              <circle cx="250" cy="110" r="8" fill="#2efc86"/>
            </svg>
          </div>
        </div>
        <div class="process-step__content">
          <h2 class="process-step__label">Make an Offer or Buy Now</h2>
          <p class="process-step__description">Submit an inquiry to receive instant pricing, or make a custom offer. We're flexible with <strong>outright purchases</strong>, <strong>lease-to-own arrangements</strong>, <strong>equity partnerships</strong>, and <strong>revenue-sharing deals</strong>.</p>
        </div>
      </div>

      <!-- Step 3: Secure Escrow -->
      <div class="process-step">
        <div class="process-step__content">
          <h2 class="process-step__label">Secure Payment & Escrow</h2>
          <p class="process-step__description">Choose your payment method: Stripe checkout for instant processing, or Escrow.com for high-value transactions over $5,000. All payments are secured with industry-leading encryption and buyer protection.</p>
        </div>
        <div class="process-step__icon-wrapper">
          <div class="process-step__icon">
            <span class="process-step__number">3</span>
            <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M150 60 L220 100 L220 200 L150 240 L80 200 L80 100 Z" stroke="#00d9ff" stroke-width="10" fill="rgba(0, 217, 255, 0.1)"/>
              <circle cx="150" cy="150" r="35" fill="#00d9ff"/>
              <path d="M135 150 L145 160 L165 140" stroke="#ffffff" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              <circle cx="190" cy="130" r="20" fill="#00d9ff" opacity="0.3"/>
              <path d="M190 120 L190 125 M180 130 L185 130 M195 130 L200 130" stroke="#00d9ff" stroke-width="3" stroke-linecap="round"/>
            </svg>
          </div>
        </div>
        <div class="process-step__spacer"></div>
      </div>

      <!-- Step 4: Seller Initiates Transfer -->
      <div class="process-step">
        <div class="process-step__spacer"></div>
        <div class="process-step__icon-wrapper">
          <div class="process-step__icon">
            <span class="process-step__number">4</span>
            <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="50" y="100" width="100" height="100" rx="12" fill="#2efc86" opacity="0.2" stroke="#2efc86" stroke-width="6"/>
              <rect x="150" y="100" width="100" height="100" rx="12" fill="#2efc86" opacity="0.2" stroke="#2efc86" stroke-width="6"/>
              <path d="M110 150 L190 150" stroke="#2efc86" stroke-width="8" stroke-linecap="round"/>
              <path d="M170 135 L190 150 L170 165" stroke="#2efc86" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              <circle cx="85" cy="135" r="5" fill="#2efc86"/>
              <circle cx="215" cy="165" r="5" fill="#2efc86"/>
            </svg>
          </div>
        </div>
        <div class="process-step__content">
          <h2 class="process-step__label">Seller Initiates Transfer</h2>
          <p class="process-step__description">Once payment clears, we unlock the domain and prepare it for transfer. You'll receive the <strong>authorization code</strong> (EPP/auth code) and detailed transfer instructions within 1-2 hours during business hours.</p>
        </div>
      </div>

      <!-- Step 5: Authorization & Verification -->
      <div class="process-step">
        <div class="process-step__content">
          <h2 class="process-step__label">Authorization & Verification</h2>
          <p class="process-step__description">We email you the domain authorization code and transfer approval link. You'll verify your email address and confirm you're ready to receive the domain at your chosen registrar.</p>
        </div>
        <div class="process-step__icon-wrapper">
          <div class="process-step__icon">
            <span class="process-step__number">5</span>
            <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="75" y="110" width="150" height="110" rx="8" fill="rgba(0, 217, 255, 0.1)" stroke="#00d9ff" stroke-width="8"/>
              <path d="M75 140 L150 180 L225 140" stroke="#00d9ff" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              <circle cx="190" cy="160" r="30" fill="#00d9ff"/>
              <rect x="180" y="155" width="8" height="15" rx="2" fill="#ffffff"/>
              <circle cx="184" cy="150" r="4" fill="#ffffff"/>
              <path d="M195 165 L200 170 L210 155" stroke="#ffffff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            </svg>
          </div>
        </div>
        <div class="process-step__spacer"></div>
      </div>

      <!-- Step 6: Registrar Transfer Begins -->
      <div class="process-step">
        <div class="process-step__spacer"></div>
        <div class="process-step__icon-wrapper">
          <div class="process-step__icon">
            <span class="process-step__number">6</span>
            <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <rect x="80" y="80" width="70" height="90" rx="8" fill="rgba(46, 252, 134, 0.2)" stroke="#2efc86" stroke-width="6"/>
              <rect x="150" y="130" width="70" height="90" rx="8" fill="rgba(46, 252, 134, 0.2)" stroke="#2efc86" stroke-width="6"/>
              <line x1="115" y1="100" x2="135" y2="100" stroke="#2efc86" stroke-width="4"/>
              <line x1="115" y1="115" x2="135" y2="115" stroke="#2efc86" stroke-width="4"/>
              <line x1="115" y1="130" x2="135" y2="130" stroke="#2efc86" stroke-width="4"/>
              <line x1="165" y1="150" x2="185" y2="150" stroke="#2efc86" stroke-width="4"/>
              <line x1="165" y1="165" x2="185" y2="165" stroke="#2efc86" stroke-width="4"/>
              <path d="M125 145 L155 165" stroke="#2efc86" stroke-width="6" stroke-linecap="round"/>
              <path d="M145 155 L155 165 L145 175" stroke="#2efc86" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            </svg>
          </div>
        </div>
        <div class="process-step__content">
          <h2 class="process-step__label">Registrar Transfer Begins</h2>
          <p class="process-step__description">You initiate the transfer at your new registrar (GoDaddy, Namecheap, Cloudflare, etc.) using the authorization code. The transfer process typically takes <strong>5-7 business days</strong> due to ICANN regulations.</p>
        </div>
      </div>

      <!-- Step 7: Transfer Complete -->
      <div class="process-step">
        <div class="process-step__content">
          <h2 class="process-step__label">Transfer Complete</h2>
          <p class="process-step__description">Domain ownership is successfully transferred to your name and registrar account. You now have full control of the domain, including DNS settings, renewal management, and all administrative rights.</p>
        </div>
        <div class="process-step__icon-wrapper">
          <div class="process-step__icon">
            <span class="process-step__number">7</span>
            <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <defs>
                <linearGradient id="globeGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                  <stop offset="0%" style="stop-color:#00d9ff;stop-opacity:0.3" />
                  <stop offset="100%" style="stop-color:#2efc86;stop-opacity:0.3" />
                </linearGradient>
              </defs>
              <circle cx="150" cy="150" r="80" fill="url(#globeGrad)" stroke="#00d9ff" stroke-width="8"/>
              <ellipse cx="150" cy="150" rx="80" ry="40" fill="none" stroke="#00d9ff" stroke-width="4"/>
              <line x1="70" y1="150" x2="230" y2="150" stroke="#2efc86" stroke-width="4"/>
              <circle cx="190" cy="110" r="35" fill="#2efc86"/>
              <path d="M175 110 L185 120 L205 100" stroke="#ffffff" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            </svg>
          </div>
        </div>
        <div class="process-step__spacer"></div>
      </div>

      <!-- Step 8: DNS Setup -->
      <div class="process-step">
        <div class="process-step__spacer"></div>
        <div class="process-step__icon-wrapper">
          <div class="process-step__icon">
            <span class="process-step__number">8</span>
            <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="150" cy="150" r="50" fill="none" stroke="#2efc86" stroke-width="8"/>
              <circle cx="150" cy="150" r="20" fill="#2efc86"/>
              <circle cx="150" cy="80" r="15" fill="#2efc86" opacity="0.6"/>
              <circle cx="220" cy="150" r="15" fill="#2efc86" opacity="0.6"/>
              <circle cx="150" cy="220" r="15" fill="#2efc86" opacity="0.6"/>
              <line x1="150" y1="130" x2="150" y2="95" stroke="#2efc86" stroke-width="4"/>
              <line x1="170" y1="150" x2="205" y2="150" stroke="#2efc86" stroke-width="4"/>
              <line x1="150" y1="170" x2="150" y2="205" stroke="#2efc86" stroke-width="4"/>
              <path d="M135 145 L140 150 L135 155 L130 150 Z M165 145 L170 150 L165 155 L160 150 Z M145 135 L150 140 L155 135 L150 130 Z M145 165 L150 170 L155 165 L150 160 Z" fill="#2efc86"/>
            </svg>
          </div>
        </div>
        <div class="process-step__content">
          <h2 class="process-step__label">DNS Setup & Configuration</h2>
          <p class="process-step__description">Point your domain to your website hosting, configure email settings, and set up any custom subdomains. We provide post-purchase support to help you configure DNS correctly if needed.</p>
        </div>
      </div>

      <!-- Step 9: Transaction Closed -->
      <div class="process-step">
        <div class="process-step__content">
          <h2 class="process-step__label">Transaction Closed</h2>
          <p class="process-step__description">Welcome to domain ownership! Your transaction is complete. You're now the proud owner of a premium digital asset that will serve as the foundation of your online brand for years to come.</p>
        </div>
        <div class="process-step__icon-wrapper">
          <div class="process-step__icon">
            <span class="process-step__number">9</span>
            <svg viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
              <!-- Left hand (palm) -->
              <rect x="60" y="130" width="30" height="80" rx="4" fill="#00d9ff" opacity="0.3"/>
              <rect x="60" y="130" width="30" height="50" rx="4" stroke="#00d9ff" stroke-width="6" fill="none"/>
              <!-- Right hand (palm) -->
              <rect x="210" y="130" width="30" height="80" rx="4" fill="#2efc86" opacity="0.3"/>
              <rect x="210" y="130" width="30" height="50" rx="4" stroke="#2efc86" stroke-width="6" fill="none"/>
              <!-- Fingers - left hand -->
              <circle cx="75" cy="120" r="8" fill="#00d9ff"/>
              <circle cx="75" cy="105" r="8" fill="#00d9ff"/>
              <!-- Fingers - right hand -->
              <circle cx="225" cy="120" r="8" fill="#2efc86"/>
              <circle cx="225" cy="105" r="8" fill="#2efc86"/>
              <!-- Handshake connection/grip -->
              <path d="M90 150 L130 150 L150 165 L170 150 L210 150" stroke="#00d9ff" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              <path d="M90 165 L130 165 L150 150 L170 165 L210 165" stroke="#2efc86" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
              <!-- Agreement checkmark -->
              <circle cx="150" cy="140" r="25" fill="#fff" stroke="#00d9ff" stroke-width="4"/>
              <path d="M140 140 L147 147 L162 132" stroke="#00d9ff" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
            </svg>
          </div>
        </div>
        <div class="process-step__spacer"></div>
      </div>

    </div>

    <!-- CTA -->
    <div class="buying-process__cta">
      <div class="buying-process__cta-inner">
        <h2>Ready to Start Your Journey?</h2>
        <p>Browse our curated portfolio of premium domains and find the perfect foundation for your brand.</p>
        <a href="<?php echo get_post_type_archive_link('domains'); ?>" class="buying-process__cta-btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="11" cy="11" r="8"/>
            <path d="M21 21l-4.35-4.35"/>
          </svg>
          Browse Domains
        </a>
      </div>
    </div>

  </div>
</div>

<?php get_footer(); ?>
