<?php
/**
 * Template Name: FAQ Page
 * Description: Comprehensive FAQ directory for domain purchases and transfers
 */
get_header();
?>

<style>
/* FAQ Page Styles */
.faq-page {
  background: #f9fafb;
  min-height: 100vh;
}

.faq-page__hero {
  background: linear-gradient(135deg, #1a1d35 0%, #0a0e27 100%);
  padding: calc(62px + 90px) 40px 90px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.faq-page__hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.08) 0%, transparent 70%);
  pointer-events: none;
}

.faq-page__hero-inner {
  max-width: 900px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.faq-page__hero h1 {
  font-size: clamp(40px, 6vw, 56px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 20px;
  font-family: 'Colour Brown', sans-serif;
  line-height: 1.1;
}

.faq-page__hero p {
  font-size: clamp(17px, 2.5vw, 19px);
  color: rgba(255, 255, 255, 0.9);
  margin: 0 0 40px;
  line-height: 1.6;
}

.faq-page__search {
  max-width: 600px;
  margin: 0 auto;
  position: relative;
}

.faq-page__search input {
  width: 100%;
  padding: 18px 24px 18px 56px;
  border: none;
  border-radius: 50px;
  font-size: 16px;
  background: #fff;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
  transition: all 0.3s ease;
}

.faq-page__search input:focus {
  outline: none;
  box-shadow: 0 12px 40px rgba(0, 217, 255, 0.2);
  transform: translateY(-2px);
}

.faq-page__search-icon {
  position: absolute;
  left: 24px;
  top: 50%;
  transform: translateY(-50%);
  width: 20px;
  height: 20px;
  color: #6b7280;
  pointer-events: none;
}

.faq-page__content {
  max-width: 1200px;
  margin: 0 auto;
  padding: 80px 40px;
}

.faq-page__expand-all {
  text-align: right;
  margin-bottom: 32px;
}

.faq-page__expand-btn {
  background: transparent;
  border: 2px solid #7c3aed;
  color: #7c3aed;
  padding: 12px 24px;
  border-radius: 50px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Colour Brown', sans-serif;
}

.faq-page__expand-btn:hover {
  background: #7c3aed;
  color: #fff;
  transform: translateY(-2px);
}

.faq-category {
  background: #fff;
  border-radius: 16px;
  padding: 40px;
  margin-bottom: 32px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  border: 1px solid #f3f4f6;
}

.faq-category__header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 32px;
  padding-bottom: 20px;
  border-bottom: 3px solid #f3f4f6;
  cursor: pointer;
  user-select: none;
}

.faq-category__title-wrapper {
  display: flex;
  align-items: center;
  gap: 16px;
}

.faq-category__icon {
  width: 48px;
  height: 48px;
  background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  flex-shrink: 0;
}

.faq-category__icon svg {
  width: 24px;
  height: 24px;
}

.faq-category__title {
  font-size: 28px;
  font-weight: 700;
  color: #1a1d35;
  margin: 0;
  font-family: 'Colour Brown', sans-serif;
}

.faq-category__toggle {
  width: 32px;
  height: 32px;
  color: #6b7280;
  transition: transform 0.3s ease;
}

.faq-category.collapsed .faq-category__toggle {
  transform: rotate(0deg);
}

.faq-category:not(.collapsed) .faq-category__toggle {
  transform: rotate(180deg);
}

.faq-category__items {
  display: grid;
  gap: 20px;
  transition: all 0.3s ease;
}

.faq-category.collapsed .faq-category__items {
  display: none;
}

.faq-item {
  border-left: 4px solid transparent;
  padding-left: 24px;
  transition: all 0.3s ease;
}

.faq-item.active {
  border-left-color: #00d9ff;
}

.faq-item__question {
  width: 100%;
  background: transparent;
  border: none;
  padding: 0;
  text-align: left;
  cursor: pointer;
  display: flex;
  align-items: flex-start;
  gap: 12px;
  transition: all 0.2s ease;
}

.faq-item__question:hover .faq-item__question-text {
  color: #7c3aed;
}

.faq-item__number {
  font-size: 14px;
  font-weight: 700;
  color: #7c3aed;
  background: rgba(124, 58, 237, 0.1);
  padding: 4px 10px;
  border-radius: 6px;
  flex-shrink: 0;
  font-family: 'Colour Brown', sans-serif;
}

.faq-item__question-text {
  font-size: 18px;
  font-weight: 600;
  color: #1a1d35;
  line-height: 1.4;
  flex: 1;
  transition: color 0.2s ease;
  font-family: 'Colour Brown', sans-serif;
  margin: 0;
  padding-top: 2px;
}

.faq-item__answer {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.4s ease;
  padding-left: 38px;
}

.faq-item.active .faq-item__answer {
  max-height: 2000px;
}

.faq-item__answer-content {
  padding-top: 16px;
  font-size: 16px;
  line-height: 1.8;
  color: #4b5563;
}

.faq-item__answer-content p {
  margin: 0 0 16px;
}

.faq-item__answer-content p:last-child {
  margin-bottom: 0;
}

.faq-item__answer-content strong {
  color: #1a1d35;
  font-weight: 600;
}

.faq-item__answer-content a {
  color: #00d9ff;
  text-decoration: underline;
  transition: color 0.2s ease;
}

.faq-item__answer-content a:hover {
  color: #00b8d9;
}

.faq-item__answer-content ul {
  margin: 16px 0;
  padding-left: 24px;
}

.faq-item__answer-content li {
  margin-bottom: 8px;
}

.faq-contact {
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  border-radius: 16px;
  padding: 48px;
  text-align: center;
  color: #fff;
  margin-top: 60px;
}

.faq-contact h2 {
  font-size: 32px;
  font-weight: 700;
  margin: 0 0 16px;
  font-family: 'Colour Brown', sans-serif;
  color: #fff;
}

.faq-contact p {
  font-size: 17px;
  line-height: 1.6;
  margin: 0 0 32px;
  color: rgba(255, 255, 255, 0.9);
}

.faq-contact__buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.faq-contact__btn {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
  color: #fff;
  padding: 16px 32px;
  border-radius: 50px;
  text-decoration: none;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 16px rgba(124, 58, 237, 0.3);
  font-family: 'Colour Brown', sans-serif;
}

.faq-contact__btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(124, 58, 237, 0.4);
}

.faq-contact__btn svg {
  width: 20px;
  height: 20px;
}

.faq-contact__btn--secondary {
  background: transparent;
  border: 2px solid rgba(255, 255, 255, 0.3);
}

.faq-contact__btn--secondary:hover {
  background: rgba(255, 255, 255, 0.1);
  border-color: rgba(255, 255, 255, 0.5);
}

/* Button gradients for better contrast */
.btn-grad-cyan { background: linear-gradient(135deg, #00d9ff 0%, #2efc86 100%); color:#0b122b; }
.btn-grad-azure { background: linear-gradient(135deg, #2efc86 0%, #00d9ff 100%); color:#fff; }
.btn-grad-mint  { background: linear-gradient(135deg, var(--color-accent) 0%, var(--color-accent-hover) 100%); color:#fff; }
.btn-grad-azure:hover, .btn-grad-mint:hover { filter: brightness(1.05); }

/* Highlight matching text in search */
.faq-highlight {
  background: linear-gradient(135deg, rgba(124, 58, 237, 0.2) 0%, rgba(168, 85, 247, 0.2) 100%);
  padding: 2px 4px;
  border-radius: 4px;
  font-weight: 600;
}

/* Responsive */
@media (max-width: 768px) {
  .faq-page__hero {
    padding: calc(62px + 60px) 20px 60px;
  }

  .faq-page__content {
    padding: 60px 20px;
  }

  .faq-category {
    padding: 28px 24px;
  }

  .faq-category__header {
    margin-bottom: 24px;
  }

  .faq-category__title {
    font-size: 22px;
  }

  .faq-category__icon {
    width: 40px;
    height: 40px;
  }

  .faq-category__icon svg {
    width: 20px;
    height: 20px;
  }

  .faq-item__question-text {
    font-size: 16px;
  }

  .faq-item__answer {
    padding-left: 0;
  }

  .faq-contact {
    padding: 36px 24px;
  }

  .faq-contact__buttons {
    flex-direction: column;
  }

  .faq-contact__btn {
    width: 100%;
    justify-content: center;
  }

  .faq-page__expand-all {
    text-align: center;
  }
}
</style>

<div class="faq-page">
  <!-- Hero Section -->
  <section class="faq-page__hero">
    <div class="faq-page__hero-inner">
      <h1>Frequently Asked Questions</h1>
      <p>Everything you need to know about buying domains from S.Ventures</p>

      <div class="faq-page__search">
        <svg class="faq-page__search-icon" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
        </svg>
        <input type="text" id="faq-search" placeholder="Search for answers...">
      </div>
    </div>
  </section>

  <!-- Content -->
  <div class="faq-page__content">

    <div class="faq-page__expand-all">
      <button class="faq-page__expand-btn" id="expand-all">Expand All</button>
    </div>

    <!-- Category 1: Buying a Domain -->
    <div class="faq-category">
      <div class="faq-category__header">
        <div class="faq-category__title-wrapper">
          <div class="faq-category__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
              <line x1="2" y1="12" x2="22" y2="12"/>
            </svg>
          </div>
          <h2 class="faq-category__title">Buying a Domain</h2>
        </div>
        <svg class="faq-category__toggle" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </div>

      <div class="faq-category__items">
        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">1-1</span>
            <h3 class="faq-item__question-text">How do I get the domain after purchase?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Once you complete your purchase, we'll initiate the domain transfer process immediately. The exact process depends on your payment method:</p>
              <ul>
                <li><strong>Stripe Checkout:</strong> Access is typically available within 1-2 hours of purchase. We'll send you an email with transfer instructions and authorization codes.</li>
                <li><strong>Escrow.com:</strong> Transfer begins once payment clears through escrow (typically 1-3 business days).</li>
                <li><strong>Lease-to-Own:</strong> You'll receive DNS management access immediately, with full ownership transfer upon final payment.</li>
              </ul>
              <p>Purchases made after business hours (5 PM MT) will be processed the next business day. We provide full support throughout the transfer process via email, WhatsApp, Telegram, or SMS.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">1-2</span>
            <h3 class="faq-item__question-text">What comes with the domain name?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Your domain purchase from S.Ventures includes:</p>
              <ul>
                <li><strong>Full ownership rights</strong> to the domain name upon transfer completion</li>
                <li><strong>First year domain registration</strong> included in the purchase price</li>
                <li><strong>Transfer assistance</strong> to your preferred registrar (GoDaddy, Namecheap, Ionos, Porkbun, etc.)</li>
                <li><strong>DNS management support</strong> and configuration guidance</li>
                <li><strong>Buyer protection</strong> through secure payment processors and escrow services</li>
              </ul>
              <p>Whois privacy protection availability depends on your chosen registrar. Most registrars offer this as a free or low-cost add-on service.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">1-3</span>
            <h3 class="faq-item__question-text">Do I get other domain extensions when I purchase a domain?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>No. Your purchase is strictly for the specific domain name and extension (TLD) listed on the product page. If you're interested in acquiring additional extensions (.net, .org, .io, etc.) of the same domain name, you'll need to purchase those separately.</p>
              <p>If you're looking to secure multiple extensions for brand protection, contact us at <a href="mailto:info@s.ventures">info@s.ventures</a> to discuss package pricing options.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">1-4</span>
            <h3 class="faq-item__question-text">When is a sale considered final?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>All sales are subject to final approval by S.Ventures, and we reserve the right to deny fulfillment of any order at any time for any reason. If we decide to stop fulfillment after payment has been rendered, we will issue a complete refund immediately.</p>
              <p>A sale is considered final only when:</p>
              <ul>
                <li>The domain name has been successfully transferred to your chosen registrar</li>
                <li>You have confirmed receipt and full control of the domain</li>
                <li>All transfer documentation has been completed</li>
                <li>For lease-to-own arrangements, all scheduled payments have been completed</li>
              </ul>
              <p>We stand behind every transaction and ensure you receive exactly what you paid for before considering any sale complete.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">1-5</span>
            <h3 class="faq-item__question-text">Do I get immediate access to my domain after purchase?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>In most cases, domain access is available within 1-2 hours of purchase confirmation. Here's what to expect:</p>
              <ul>
                <li><strong>Immediate purchases (Stripe):</strong> 1-2 hours during business hours (9 AM - 5 PM MT, Monday-Friday)</li>
                <li><strong>After-hours purchases:</strong> Available by the next business day</li>
                <li><strong>Escrow transactions:</strong> Transfer begins upon payment clearance (1-3 business days)</li>
                <li><strong>Lease-to-own:</strong> DNS management access within 24 hours; full transfer upon completion</li>
              </ul>
              <p>The actual domain transfer process typically takes 5-7 days due to ICANN regulations, though you can often begin using the domain (via DNS pointing) much sooner.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">1-6</span>
            <h3 class="faq-item__question-text">How does S.Ventures protect my shopping experience?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>At S.Ventures, your online safety and security is our top priority. We understand the importance of protecting your personal and financial information.</p>
              <p><strong>Security measures we implement:</strong></p>
              <ul>
                <li><strong>SSL/TLS encryption</strong> for all data transmission on our website</li>
                <li><strong>Stripe payment processing</strong> with industry-leading security and PCI compliance</li>
                <li><strong>Escrow.com integration</strong> for high-value transactions and buyer protection</li>
                <li><strong>Spam and bot protection</strong> with multi-layer fraud detection</li>
                <li><strong>Secure authentication</strong> for all account access and domain management</li>
                <li><strong>Privacy-first approach</strong> - we never sell your personal information</li>
              </ul>
              <p>We value our relationship with you and want you to shop confidently, knowing that your information is secure throughout the entire transaction process.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Category 2: Transfer Questions -->
    <div class="faq-category">
      <div class="faq-category__header">
        <div class="faq-category__title-wrapper">
          <div class="faq-category__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <polyline points="16 3 21 3 21 8"/>
              <line x1="4" y1="20" x2="21" y2="3"/>
              <polyline points="21 16 21 21 16 21"/>
              <line x1="15" y1="15" x2="21" y2="21"/>
              <line x1="4" y1="4" x2="9" y2="9"/>
            </svg>
          </div>
          <h2 class="faq-category__title">Transfer Questions</h2>
        </div>
        <svg class="faq-category__toggle" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </div>

      <div class="faq-category__items">
        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">2-1</span>
            <h3 class="faq-item__question-text">Can I transfer my domain to another registrar after I buy it?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Yes! You have complete freedom to transfer your domain to any registrar of your choice after purchase. Popular options include GoDaddy, Namecheap, Ionos, Porkbun, Cloudflare, and Google Domains.</p>
              <p><strong>Transfer process:</strong></p>
              <ul>
                <li>We'll provide you with the domain authorization code (EPP code)</li>
                <li>Unlock the domain from the current registrar</li>
                <li>Initiate transfer at your new registrar following their process</li>
                <li>Transfers typically complete within 5-7 business days</li>
              </ul>
              <p><strong>Important notes:</strong></p>
              <ul>
                <li><strong>Lease-to-own domains</strong> are not eligible for transfer until all payments have been completed</li>
                <li>Domains may be subject to a 60-day Change of Registrant lock after purchase</li>
                <li>Some registrars charge transfer fees (typically $8-15)</li>
                <li>We provide full transfer support regardless of your chosen registrar</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">2-2</span>
            <h3 class="faq-item__question-text">How do domain name transfers work?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Domain transfers are a straightforward process of moving domain registration from one registrar to another. Here's how it works:</p>
              <p><strong>Step-by-step transfer process:</strong></p>
              <ul>
                <li><strong>Step 1:</strong> At the current registrar, unlock the domain and obtain the Authorization Code (also called EPP code or transfer key)</li>
                <li><strong>Step 2:</strong> Go to your new registrar and initiate a transfer request</li>
                <li><strong>Step 3:</strong> Enter the authorization code when prompted</li>
                <li><strong>Step 4:</strong> Approve the transfer via email confirmation</li>
                <li><strong>Step 5:</strong> Wait 5-7 days for the transfer to complete (ICANN requirement)</li>
              </ul>
              <p>S.Ventures provides complete transfer assistance including authorization codes, unlock instructions, and technical support. We'll guide you through every step to ensure a smooth transition.</p>
              <p><strong>During the transfer:</strong> Your website and email services remain active and uninterrupted. DNS settings are preserved during the transfer process.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">2-3</span>
            <h3 class="faq-item__question-text">How do I transfer my domain to GoDaddy, Namecheap, or other registrars?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Transferring your domain to popular registrars is simple. We'll provide you with everything you need:</p>
              <p><strong>What we provide:</strong></p>
              <ul>
                <li>Domain authorization code (EPP/auth code)</li>
                <li>Unlock confirmation from current registrar</li>
                <li>Step-by-step instructions specific to your chosen registrar</li>
                <li>Technical support throughout the transfer</li>
              </ul>
              <p><strong>Registrar-specific guides:</strong></p>
              <ul>
                <li><strong>GoDaddy:</strong> Visit GoDaddy's transfer page, enter your domain and auth code, complete checkout</li>
                <li><strong>Namecheap:</strong> Go to Namecheap transfer section, input domain and authorization code, approve via email</li>
                <li><strong>Cloudflare:</strong> Navigate to Cloudflare Registrar, add domain, enter auth code, confirm transfer</li>
                <li><strong>Porkbun:</strong> Use Porkbun's transfer tool, provide auth code, finalize payment</li>
              </ul>
              <p>Need help? Contact our team at <a href="mailto:info@s.ventures">info@s.ventures</a> or via WhatsApp, Telegram, or SMS for personalized transfer assistance.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Category 3: Payment Questions -->
    <div class="faq-category">
      <div class="faq-category__header">
        <div class="faq-category__title-wrapper">
          <div class="faq-category__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
              <line x1="1" y1="10" x2="23" y2="10"/>
            </svg>
          </div>
          <h2 class="faq-category__title">Payment Questions</h2>
        </div>
        <svg class="faq-category__toggle" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </div>

      <div class="faq-category__items">
        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">3-1</span>
            <h3 class="faq-item__question-text">Can I make an offer on a domain?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Absolutely! We're open to reasonable offers on all domains in our portfolio. If the listed price doesn't fit your budget, we encourage you to reach out.</p>
              <p><strong>How to make an offer:</strong></p>
              <ul>
                <li>Email us at <a href="mailto:info@s.ventures">info@s.ventures</a> with your offer</li>
                <li>Fill out the inquiry form on the domain's page</li>
                <li>Contact us via WhatsApp: +1 (281) 726-1751</li>
                <li>Reach out via Telegram: @s_ventures</li>
              </ul>
              <p><strong>Factors we consider:</strong></p>
              <ul>
                <li>Domain length, brandability, and keyword strength</li>
                <li>Comparable recent sales in the market</li>
                <li>Your intended use case and business plan</li>
                <li>Current market demand and trends</li>
              </ul>
              <p>S.Ventures will always consider your offer. Our pricing may or may not be negotiable depending on the specific domain. We also offer flexible alternatives like lease-to-own arrangements, equity partnerships, and revenue-sharing agreements.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">3-2</span>
            <h3 class="faq-item__question-text">Do you offer payment plans or financing?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Yes! S.Ventures offers several flexible payment structures to make premium domains accessible:</p>
              <p><strong>Lease-to-Own (LTO):</strong></p>
              <ul>
                <li>Break down the purchase price into monthly or quarterly payments</li>
                <li>Receive DNS management rights immediately</li>
                <li>Full ownership transfers upon final payment completion</li>
                <li>Terms typically range from 12-36 months</li>
                <li>Small interest fee may apply depending on terms</li>
              </ul>
              <p><strong>Equity Partnerships:</strong></p>
              <ul>
                <li>Exchange the domain for equity stake in your venture</li>
                <li>Ideal for startups with limited capital but strong potential</li>
                <li>Requires business plan review and due diligence</li>
                <li>Equity percentage negotiated based on domain value and business valuation</li>
              </ul>
              <p><strong>Revenue Sharing:</strong></p>
              <ul>
                <li>Acquire the domain in exchange for ongoing revenue percentage</li>
                <li>Perfect for businesses with proven revenue models</li>
                <li>Percentage and duration negotiated on case-by-case basis</li>
                <li>Formal revenue-sharing agreement required</li>
              </ul>
              <p>Contact us at <a href="mailto:info@s.ventures">info@s.ventures</a> to discuss which payment structure works best for your situation.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">3-3</span>
            <h3 class="faq-item__question-text">What payment methods do you accept?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>S.Ventures accepts all major payment methods to accommodate buyers worldwide:</p>
              <p><strong>Credit & Debit Cards (via Stripe):</strong></p>
              <ul>
                <li>Visa, Mastercard, American Express, Discover</li>
                <li>Instant checkout and processing</li>
                <li>Secure PCI-compliant payment processing</li>
                <li>Processing fee: 2.9% + $0.30</li>
              </ul>
              <p><strong>Digital Wallets:</strong></p>
              <ul>
                <li>PayPal</li>
                <li>Apple Pay</li>
                <li>Google Pay</li>
              </ul>
              <p><strong>Escrow Services:</strong></p>
              <ul>
                <li>Escrow.com (recommended for high-value transactions over $5,000)</li>
                <li>Dan.com escrow</li>
                <li>Provides buyer and seller protection</li>
                <li>Escrow fees typically split 50/50</li>
              </ul>
              <p><strong>Other Methods:</strong></p>
              <ul>
                <li>Bank wire transfers (ACH, international wire)</li>
                <li>Cryptocurrency (Bitcoin, Ethereum - select transactions)</li>
                <li>Custom arrangements for enterprise purchases</li>
              </ul>
              <p>All prices are quoted in USD. International buyers are welcome - we facilitate transfers worldwide.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">3-4</span>
            <h3 class="faq-item__question-text">How do I manage my lease-to-own payment plan?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>When you start a lease-to-own payment plan with S.Ventures, your payments are automatically processed on the same date each month that you initiated the agreement.</p>
              <p><strong>Payment schedule example:</strong></p>
              <ul>
                <li>If you start your plan on March 10, payments process on the 10th of every month</li>
                <li>Automatic charges to your selected payment method</li>
                <li>Email reminders sent 3 days before each payment</li>
              </ul>
              <p><strong>Managing your payment plan:</strong></p>
              <ul>
                <li>Access your billing portal via the link in your welcome email</li>
                <li>Update payment methods at any time through the portal</li>
                <li>Make early payments to pay off the domain faster</li>
                <li>View payment history and remaining balance</li>
                <li>Download invoices and receipts</li>
              </ul>
              <p><strong>Missed payment policy:</strong></p>
              <ul>
                <li>Grace period: 5 days from scheduled payment date</li>
                <li>After grace period: $25 late fee applies</li>
                <li>After 15 days: DNS access may be temporarily suspended</li>
                <li>After 30 days: Agreement may be terminated and domain reclaimed</li>
              </ul>
              <p>Need to adjust your payment schedule? Contact us at <a href="mailto:info@s.ventures">info@s.ventures</a> to discuss options.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Category 4: Domain Ownership -->
    <div class="faq-category">
      <div class="faq-category__header">
        <div class="faq-category__title-wrapper">
          <div class="faq-category__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            </svg>
          </div>
          <h2 class="faq-category__title">Domain Ownership</h2>
        </div>
        <svg class="faq-category__toggle" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </div>

      <div class="faq-category__items">
        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">4-1</span>
            <h3 class="faq-item__question-text">How long will I own my domain?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Once you complete your purchase and the transfer is finalized, you have full control of and exclusive registration rights to the domain name. You own it completely.</p>
              <p><strong>Domain ownership duration:</strong></p>
              <ul>
                <li>You own the domain for as long as you maintain annual registration</li>
                <li>Domain registration must be renewed yearly (typically $8-25/year depending on TLD and registrar)</li>
                <li>As long as you pay your annual renewal fees, you can own the domain indefinitely</li>
                <li>No additional fees to S.Ventures after purchase completion</li>
              </ul>
              <p><strong>Important:</strong> If you fail to pay yearly registration/renewal fees to your domain registrar, your domain will expire. After expiration, it goes through a grace period and redemption period before being released back to the open market. Set up auto-renewal at your registrar to avoid accidental expiration.</p>
              <p>You have complete freedom to:</p>
              <ul>
                <li>Use the domain for any legitimate purpose</li>
                <li>Sell or transfer the domain to others</li>
                <li>Change registrars at any time</li>
                <li>Modify DNS settings and hosting configuration</li>
                <li>Create subdomains and email addresses</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">4-2</span>
            <h3 class="faq-item__question-text">How do I keep my personal information private? What is Whois Privacy Protection?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Whois Privacy Protection (also called Domain Privacy or Whois Guard) hides your personal information from public Whois database lookups.</p>
              <p><strong>Without privacy protection, the following information is public:</strong></p>
              <ul>
                <li>Full name</li>
                <li>Physical address</li>
                <li>Email address</li>
                <li>Phone number</li>
              </ul>
              <p><strong>With privacy protection enabled:</strong></p>
              <ul>
                <li>Your registrar's information is displayed instead of yours</li>
                <li>Your personal details remain private</li>
                <li>You still receive important domain-related emails</li>
                <li>Reduces spam, unwanted solicitations, and identity theft risk</li>
              </ul>
              <p><strong>How to enable Whois Privacy:</strong></p>
              <ul>
                <li>Add privacy protection through your domain registrar's control panel</li>
                <li>Many registrars offer free Whois privacy (Namecheap, Porkbun, Cloudflare)</li>
                <li>Others charge $5-15/year for this service</li>
                <li>Can be enabled/disabled at any time</li>
              </ul>
              <p><strong>Note:</strong> Whois information updates are not immediate. It typically takes 2-48 hours for Whois data to fully propagate across all lookup services. Different registrars have different update speeds.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">4-3</span>
            <h3 class="faq-item__question-text">How do I update DNS, URL forwarding, and other domain settings?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Once your domain transfer is complete, you'll manage all domain settings through your chosen registrar's control panel.</p>
              <p><strong>Common domain management tasks:</strong></p>
              <ul>
                <li><strong>DNS Settings:</strong> Point your domain to your web hosting or configure custom nameservers</li>
                <li><strong>URL Forwarding:</strong> Redirect your domain to another website (with or without masking)</li>
                <li><strong>Email Configuration:</strong> Set up MX records for custom email addresses</li>
                <li><strong>Subdomain Creation:</strong> Create subdomains like blog.yourdomain.com or shop.yourdomain.com</li>
                <li><strong>SSL/TLS Certificates:</strong> Enable HTTPS for secure connections</li>
                <li><strong>DNSSEC:</strong> Add extra security layer to prevent DNS spoofing</li>
              </ul>
              <p><strong>Where to manage settings:</strong></p>
              <ul>
                <li><strong>GoDaddy:</strong> My Products → Domain Settings → DNS Management</li>
                <li><strong>Namecheap:</strong> Domain List → Manage → Advanced DNS</li>
                <li><strong>Cloudflare:</strong> Dashboard → DNS → Records</li>
                <li><strong>Porkbun:</strong> Domain Management → DNS → Edit</li>
              </ul>
              <p>Need help with DNS configuration? S.Ventures provides post-purchase support to help you get your domain configured correctly. Contact us at <a href="mailto:info@s.ventures">info@s.ventures</a>.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">4-4</span>
            <h3 class="faq-item__question-text">What are yearly registration fees and why do I need to pay them?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Yearly registration fees are the annual costs to maintain your domain registration with ICANN (Internet Corporation for Assigned Names and Numbers) through your chosen registrar.</p>
              <p><strong>Why registration fees exist:</strong></p>
              <ul>
                <li>ICANN charges registrars to maintain the global domain name system</li>
                <li>Registrars provide infrastructure, security, and support services</li>
                <li>Fees fund DNS servers, Whois databases, and domain management systems</li>
                <li>Ensures your domain remains active and accessible on the internet</li>
              </ul>
              <p><strong>Typical yearly costs by extension:</strong></p>
              <ul>
                <li>.com: $8.95 - $15/year</li>
                <li>.net: $10 - $16/year</li>
                <li>.org: $10 - $15/year</li>
                <li>.io: $35 - $60/year</li>
                <li>.ai: $80 - $120/year</li>
                <li>Premium TLDs vary widely</li>
              </ul>
              <p><strong>Important:</strong> If you fail to pay these yearly registration/renewal costs to your domain registrar, your domain will expire and you will lose ownership rights. The domain will go through an expiration process and eventually be released back to the public for anyone to register.</p>
              <p><strong>Pro tip:</strong> Set up auto-renewal at your registrar to prevent accidental expiration. Most registrars send multiple reminder emails before expiration, but auto-renewal provides peace of mind.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Category 5: Domains 101 -->
    <div class="faq-category">
      <div class="faq-category__header">
        <div class="faq-category__title-wrapper">
          <div class="faq-category__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <path d="M9.09 9a3 3 0 015.83 1c0 2-3 3-3 3"/>
              <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
          </div>
          <h2 class="faq-category__title">Domains 101</h2>
        </div>
        <svg class="faq-category__toggle" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </div>

      <div class="faq-category__items">
        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">5-1</span>
            <h3 class="faq-item__question-text">How do domain names work?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Domain names are the human-readable addresses that identify websites on the internet. They function similarly to street addresses in the physical world.</p>
              <p><strong>The technical process:</strong></p>
              <ul>
                <li><strong>Domain Name:</strong> The familiar name you type (like s.ventures)</li>
                <li><strong>IP Address:</strong> The numerical address computers use (like 192.0.2.1)</li>
                <li><strong>DNS (Domain Name System):</strong> Translates domain names to IP addresses</li>
                <li><strong>Web Servers:</strong> Store and deliver website content at those IP addresses</li>
              </ul>
              <p><strong>When you visit a website:</strong></p>
              <ul>
                <li>You type the domain name in your browser</li>
                <li>DNS servers look up the corresponding IP address</li>
                <li>Your browser connects to the web server at that IP address</li>
                <li>The server sends back the website content</li>
                <li>All of this happens in milliseconds</li>
              </ul>
              <p><strong>Domain name governance:</strong></p>
              <ul>
                <li>ICANN (Internet Corporation for Assigned Names and Numbers) oversees the domain name system</li>
                <li>ICANN ensures every domain has a unique address</li>
                <li>Registrars act as middlemen between domain owners and ICANN</li>
                <li>Domain registrations must be renewed annually to maintain ownership</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">5-2</span>
            <h3 class="faq-item__question-text">What's the difference between domain names, websites, and web hosting?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>While related, domain names, websites, and web hosting are three distinct components of your online presence:</p>
              <p><strong>Domain Name</strong> (like the address of a house):</p>
              <ul>
                <li>The URL people type to find you (e.g., yourbusiness.com)</li>
                <li>Your unique internet address</li>
                <li>Purchased separately and renewed annually</li>
                <li>Can be pointed to different hosts/servers</li>
              </ul>
              <p><strong>Website</strong> (like the house itself):</p>
              <ul>
                <li>The actual content, design, and functionality visitors see</li>
                <li>Includes HTML, CSS, JavaScript, images, videos, etc.</li>
                <li>Built with website builders, CMS platforms (WordPress, Shopify), or custom code</li>
                <li>Can be completely redesigned without changing your domain</li>
              </ul>
              <p><strong>Web Hosting</strong> (like the land the house sits on):</p>
              <ul>
                <li>Server space where your website files are stored</li>
                <li>Provides the technology to make your site accessible 24/7</li>
                <li>Services like Bluehost, SiteGround, WP Engine, Vercel, Netlify</li>
                <li>Monthly or annual subscription service</li>
              </ul>
              <p><strong>How they work together:</strong> You purchase a domain name, build a website, and host it on a web server. You point your domain's DNS to your hosting provider, so when people visit your domain, they see your website.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">5-3</span>
            <h3 class="faq-item__question-text">What's the difference between a registrar, registry, and registrant?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>These three terms are commonly confused but represent different roles in the domain name ecosystem:</p>
              <p><strong>Domain Registrar:</strong></p>
              <ul>
                <li>ICANN-accredited companies that sell and manage domain names</li>
                <li>Examples: GoDaddy, Namecheap, Porkbun, Cloudflare, Google Domains</li>
                <li>Provide interface for purchasing, renewing, and managing domains</li>
                <li>Handle customer support and domain configuration</li>
                <li>Act as intermediary between registrants and registries</li>
              </ul>
              <p><strong>Domain Registry:</strong></p>
              <ul>
                <li>Organizations that manage top-level domain (TLD) databases</li>
                <li>Maintain the master database of all domains within their TLD</li>
                <li>Examples: Verisign (.com, .net), Public Interest Registry (.org), Identity Digital (.io)</li>
                <li>Set wholesale pricing for their TLDs</li>
                <li>Registrars must connect to registries to register domains</li>
              </ul>
              <p><strong>Domain Registrant:</strong></p>
              <ul>
                <li>The person or organization who has registered and owns a domain name</li>
                <li>That's you after you purchase a domain from S.Ventures!</li>
                <li>Has legal rights to use the domain</li>
                <li>Responsible for annual renewal fees</li>
                <li>Listed in Whois database (unless privacy protection is enabled)</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">5-4</span>
            <h3 class="faq-item__question-text">What's a TLD? What's a gTLD?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p><strong>TLD (Top-Level Domain):</strong></p>
              <ul>
                <li>The part of the domain name to the right of the dot</li>
                <li>Examples: .com, .net, .org, .io, .ai, .co</li>
                <li>The highest level in the hierarchical domain name system</li>
                <li>Over 1,500 TLDs currently exist</li>
              </ul>
              <p><strong>Main categories of TLDs:</strong></p>
              <ul>
                <li><strong>gTLD (Generic Top-Level Domain):</strong> General-purpose TLDs like .com, .net, .org, .biz</li>
                <li><strong>ccTLD (Country Code TLD):</strong> Country-specific like .us, .uk, .de, .jp</li>
                <li><strong>sTLD (Sponsored TLD):</strong> Specialized like .gov, .edu, .mil</li>
                <li><strong>New gTLD:</strong> Recently launched like .app, .blog, .shop, .tech</li>
              </ul>
              <p><strong>Choosing the right TLD:</strong></p>
              <ul>
                <li><strong>.com:</strong> Most recognizable and trusted; ideal for businesses</li>
                <li><strong>.io:</strong> Popular with tech startups and SaaS companies</li>
                <li><strong>.ai:</strong> Perfect for artificial intelligence and tech companies</li>
                <li><strong>.co:</strong> Alternative to .com; good for companies and startups</li>
                <li><strong>.net:</strong> Originally for network services; now general purpose</li>
                <li><strong>.org:</strong> Traditionally for organizations; still carries trust</li>
              </ul>
              <p>At S.Ventures, we specialize in premium domains across all valuable TLDs, helping you find the perfect extension for your brand.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">5-5</span>
            <h3 class="faq-item__question-text">What's a URL?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p><strong>URL (Uniform Resource Locator)</strong> is the complete web address that specifies the exact location of a resource on the internet.</p>
              <p><strong>URL structure breakdown:</strong></p>
              <ul>
                <li><strong>Protocol:</strong> https:// or http:// (how data is transferred)</li>
                <li><strong>Subdomain:</strong> www. or blog. or shop. (optional)</li>
                <li><strong>Domain Name:</strong> s.ventures (your unique identifier)</li>
                <li><strong>TLD:</strong> .com, .io, .ai (top-level domain)</li>
                <li><strong>Path:</strong> /about or /contact (specific page location)</li>
                <li><strong>Parameters:</strong> ?id=123&ref=email (optional query strings)</li>
              </ul>
              <p><strong>Example URL:</strong> https://www.s.ventures/domains/aigentics</p>
              <ul>
                <li>Protocol: https://</li>
                <li>Subdomain: www.</li>
                <li>Domain: s</li>
                <li>TLD: .ventures</li>
                <li>Path: /domains/aigentics</li>
              </ul>
              <p><strong>Key differences:</strong></p>
              <ul>
                <li><strong>Domain Name:</strong> Just s.ventures</li>
                <li><strong>URL:</strong> The complete address including protocol and path</li>
                <li>Every URL contains a domain name, but not every domain name is a complete URL</li>
              </ul>
              <p><strong>Why it matters:</strong> When sharing your website, provide the full URL (https://yourdomain.com) so visitors can access it directly. When discussing domain ownership, you're referring to just the domain name portion.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Category 6: About S.Ventures -->
    <div class="faq-category">
      <div class="faq-category__header">
        <div class="faq-category__title-wrapper">
          <div class="faq-category__icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <circle cx="12" cy="12" r="10"/>
              <line x1="12" y1="16" x2="12" y2="12"/>
              <line x1="12" y1="8" x2="12.01" y2="8"/>
            </svg>
          </div>
          <h2 class="faq-category__title">About S.Ventures</h2>
        </div>
        <svg class="faq-category__toggle" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </div>

      <div class="faq-category__items">
        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">6-1</span>
            <h3 class="faq-item__question-text">Do you own your domains or are you selling them for someone else?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>S.Ventures owns 100% of the domains listed in our marketplace. We are not brokers or intermediaries selling domains on behalf of third parties.</p>
              <p><strong>What this means for you:</strong></p>
              <ul>
                <li><strong>Faster transactions:</strong> No need to wait for third-party approvals</li>
                <li><strong>Verified ownership:</strong> All domains are in our portfolio and ready for immediate transfer</li>
                <li><strong>Flexible negotiations:</strong> We have full authority to negotiate pricing and terms</li>
                <li><strong>Transparent process:</strong> You deal directly with the domain owner</li>
                <li><strong>Creative deal structures:</strong> We can offer LTO, equity partnerships, and revenue-sharing because we own the assets</li>
              </ul>
              <p>We can provide proof of ownership for any domain in our portfolio upon request. Our domains are registered across reputable registrars including GoDaddy, Namecheap, Ionos, and Porkbun.</p>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">6-2</span>
            <h3 class="faq-item__question-text">Can I sell you my domains? Do you acquire domains?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>Yes! S.Ventures actively acquires premium domain names that fit our investment criteria. We're always interested in evaluating quality domains for potential acquisition.</p>
              <p><strong>Domains we're interested in:</strong></p>
              <ul>
                <li><strong>Short domains:</strong> 3-7 character .com, .io, .ai domains</li>
                <li><strong>Brandable names:</strong> Memorable, pronounceable, unique</li>
                <li><strong>Industry keywords:</strong> AI, tech, SaaS, finance, crypto-related</li>
                <li><strong>Numeric domains:</strong> Short number sequences</li>
                <li><strong>One-word .com:</strong> Dictionary words and compounds</li>
                <li><strong>Premium TLDs:</strong> Valuable .io, .ai, .co extensions</li>
              </ul>
              <p><strong>What we're NOT looking for:</strong></p>
              <ul>
                <li>Domains with trademark conflicts</li>
                <li>Hyphenated domains</li>
                <li>Domains with numbers and letters mixed</li>
                <li>Niche or overly specific domains with limited appeal</li>
                <li>Domains with questionable history or penalties</li>
              </ul>
              <p><strong>How to submit your domain for consideration:</strong></p>
              <ul>
                <li>Email details to <a href="mailto:acquisitions@s.ventures">acquisitions@s.ventures</a></li>
                <li>Include: domain name, asking price, renewal date, current registrar</li>
                <li>Provide any relevant metrics: traffic, backlinks, age, previous offers</li>
                <li>We'll review within 2-3 business days and respond with interest level</li>
              </ul>
              <p><strong>Payment options we offer:</strong></p>
              <ul>
                <li>Outright cash purchase</li>
                <li>Escrow.com transactions for buyer/seller protection</li>
                <li>Payment plans for high-value portfolios</li>
                <li>Equity swaps or partnership arrangements in select cases</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-item__question">
            <span class="faq-item__number">6-3</span>
            <h3 class="faq-item__question-text">What makes S.Ventures different from other domain marketplaces?</h3>
          </button>
          <div class="faq-item__answer">
            <div class="faq-item__answer-content">
              <p>S.Ventures is more than a domain marketplace - we're a strategic partner for businesses looking to build powerful online brands.</p>
              <p><strong>What sets us apart:</strong></p>
              <ul>
                <li><strong>Flexible acquisition models:</strong> Beyond simple purchases, we offer lease-to-own, equity partnerships, and revenue-sharing arrangements</li>
                <li><strong>Curated portfolio:</strong> Every domain is hand-selected for quality, brandability, and investment potential</li>
                <li><strong>Startup-friendly:</strong> We work with early-stage companies to structure deals that preserve capital while securing premium domains</li>
                <li><strong>Personal service:</strong> Direct communication with decision-makers, not automated systems or offshore support</li>
                <li><strong>Multiple contact channels:</strong> Reach us via email, WhatsApp, Telegram, or SMS for fast responses</li>
                <li><strong>Transparent pricing:</strong> No hidden fees or surprise charges - what you see is what you pay</li>
                <li><strong>Post-purchase support:</strong> We help with transfer process, DNS configuration, and technical setup</li>
                <li><strong>Market expertise:</strong> Deep knowledge of domain valuation, trends, and strategic branding</li>
              </ul>
              <p><strong>Our mission:</strong> Make premium domain names accessible to ambitious entrepreneurs and growing businesses through creative deal structures and exceptional service.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Contact CTA -->
    <div class="faq-contact">
      <h2>Still Have Questions?</h2>
      <p>Our domain specialists are here to help. Reach out through your preferred channel:</p>
      <div class="faq-contact__buttons">
        <a href="<?php echo home_url('/contact'); ?>" class="faq-contact__btn">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
            <polyline points="22,6 12,13 2,6"/>
          </svg>
          Email Us
        </a>
        <a href="https://wa.me/12817261751" class="faq-contact__btn btn-grad-azure" target="_blank">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
          WhatsApp
        </a>
        <a href="https://t.me/s_ventures" class="faq-contact__btn btn-grad-mint" target="_blank">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-1.99 1.93c-.23.23-.42.42-.83.42z"/>
          </svg>
          Telegram
        </a>
      </div>
    </div>

  </div>
</div>

<script>
(function() {
  // FAQ Search functionality
  const searchInput = document.getElementById('faq-search');
  const faqItems = document.querySelectorAll('.faq-item');
  const faqCategories = document.querySelectorAll('.faq-category');

  if (searchInput) {
    searchInput.addEventListener('input', function(e) {
      const searchTerm = e.target.value.toLowerCase().trim();

      if (searchTerm === '') {
        // Reset: show all items and collapse categories
        faqItems.forEach(item => {
          item.style.display = 'block';
          item.classList.remove('active');
        });
        faqCategories.forEach(cat => {
          cat.classList.add('collapsed');
        });
        return;
      }

      // Expand all categories when searching
      faqCategories.forEach(cat => {
        cat.classList.remove('collapsed');
      });

      // Filter FAQ items
      faqItems.forEach(item => {
        const question = item.querySelector('.faq-item__question-text').textContent.toLowerCase();
        const answer = item.querySelector('.faq-item__answer-content').textContent.toLowerCase();

        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });

      // Hide empty categories
      faqCategories.forEach(cat => {
        const visibleItems = cat.querySelectorAll('.faq-item[style="display: block"]');
        if (visibleItems.length === 0) {
          cat.style.display = 'none';
        } else {
          cat.style.display = 'block';
        }
      });
    });
  }

  // Category collapse/expand
  const categoryHeaders = document.querySelectorAll('.faq-category__header');
  categoryHeaders.forEach(header => {
    header.addEventListener('click', function() {
      this.closest('.faq-category').classList.toggle('collapsed');
    });
  });

  // FAQ item toggle
  const faqQuestions = document.querySelectorAll('.faq-item__question');
  faqQuestions.forEach(question => {
    question.addEventListener('click', function() {
      const item = this.closest('.faq-item');
      const wasActive = item.classList.contains('active');

      // Close all other items in the same category
      const category = this.closest('.faq-category');
      category.querySelectorAll('.faq-item').forEach(i => {
        i.classList.remove('active');
      });

      // Toggle current item
      if (!wasActive) {
        item.classList.add('active');
      }
    });
  });

  // Expand/Collapse all button
  const expandAllBtn = document.getElementById('expand-all');
  let allExpanded = false;

  if (expandAllBtn) {
    expandAllBtn.addEventListener('click', function() {
      faqCategories.forEach(cat => {
        if (allExpanded) {
          cat.classList.add('collapsed');
        } else {
          cat.classList.remove('collapsed');
        }
      });

      allExpanded = !allExpanded;
      this.textContent = allExpanded ? 'Collapse All' : 'Expand All';
    });
  }

  // Start with all categories expanded
  faqCategories.forEach(cat => {
    cat.classList.remove('collapsed');
  });
  if (expandAllBtn) {
    expandAllBtn.textContent = 'Collapse All';
    allExpanded = true;
  }
})();
</script>

<?php get_footer(); ?>
