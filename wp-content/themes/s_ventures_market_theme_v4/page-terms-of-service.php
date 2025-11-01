<?php
/**
 * Template Name: Terms of Service
 * Description: Terms of Service page template with S.Ventures branding
 */
get_header();
?>

<style>
/* Terms of Service Page Styles */
.terms-of-service {
  background: #f9fafb;
  min-height: 100vh;
}

.terms-of-service__hero {
  background: linear-gradient(135deg, #1a1d35 0%, #0a0e27 100%);
  padding: calc(var(--header-height) + 90px) 40px 90px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.terms-of-service__hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.08) 0%, transparent 70%);
  pointer-events: none;
}

.terms-of-service__hero-inner {
  max-width: 900px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.terms-of-service__hero h1 {
  font-size: clamp(40px, 6vw, 56px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 20px;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
  line-height: 1.1;
}

.terms-of-service__hero p {
  font-size: clamp(17px, 2.5vw, 19px);
  color: rgba(255, 255, 255, 0.9);
  margin: 0;
  line-height: 1.6;
}

.terms-of-service__content {
  max-width: 900px;
  margin: 0 auto;
  padding: 80px 40px;
}

.terms-of-service__last-updated {
  background: linear-gradient(135deg, rgba(43, 35, 74, 0.08) 0%, rgba(43, 35, 74, 0.04) 100%);
  border-left: 4px solid #7c3aed;
  padding: 20px 24px;
  margin-bottom: 60px;
  border-radius: 8px;
  font-size: 15px;
  color: #4b5563;
}

.terms-of-service__last-updated strong {
  color: #2B234A;
  font-weight: 600;
}

.terms-of-service__section {
  background: #fff;
  border-radius: 16px;
  padding: 40px;
  margin-bottom: 32px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  border: 1px solid #f3f4f6;
}

.terms-of-service__section-header {
  display: flex;
  align-items: flex-start;
  gap: 20px;
  margin-bottom: 24px;
}

.terms-of-service__icon {
  flex-shrink: 0;
  width: 48px;
  height: 48px;
  background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
}

.terms-of-service__icon svg {
  width: 24px;
  height: 24px;
}

.terms-of-service__section h2 {
  font-size: 26px;
  font-weight: 700;
  color: #2B234A;
  margin: 0;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
  line-height: 1.3;
}

.terms-of-service__section h3 {
  font-size: 20px;
  font-weight: 600;
  color: #2B234A;
  margin: 28px 0 16px;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
}

.terms-of-service__section p {
  font-size: 16px;
  line-height: 1.8;
  color: #4b5563;
  margin: 0 0 16px;
}

.terms-of-service__section ul {
  margin: 16px 0;
  padding-left: 24px;
}

.terms-of-service__section li {
  font-size: 16px;
  line-height: 1.8;
  color: #4b5563;
  margin-bottom: 8px;
}

.terms-of-service__section strong {
  color: #2B234A;
  font-weight: 600;
}

.terms-of-service__contact {
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  border-radius: 16px;
  padding: 48px;
  text-align: center;
  color: #fff;
  margin-top: 60px;
}

.terms-of-service__contact h2 {
  font-size: 32px;
  font-weight: 700;
  margin: 0 0 16px;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
  color: #fff;
}

.terms-of-service__contact p {
  font-size: 17px;
  line-height: 1.6;
  margin: 0 0 28px;
  color: rgba(255, 255, 255, 0.9);
}

.terms-of-service__contact-btn {
  display: inline-flex;
  align-items: center;
  gap: 12px;
  background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
  color: #fff;
  padding: 16px 32px;
  border-radius: 12px;
  text-decoration: none;
  font-weight: 600;
  font-size: 16px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 16px rgba(124, 58, 237, 0.3);
}

.terms-of-service__contact-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(124, 58, 237, 0.4);
  background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);
}

.terms-of-service__contact-btn svg {
  width: 20px;
  height: 20px;
}

/* Responsive */
@media (max-width: 768px) {
  .terms-of-service__hero {
    padding: calc(var(--header-height) + 60px) 20px 60px;
  }

  .terms-of-service__content {
    padding: 60px 20px;
  }

  .terms-of-service__section {
    padding: 28px 24px;
  }

  .terms-of-service__section-header {
    gap: 16px;
  }

  .terms-of-service__icon {
    width: 40px;
    height: 40px;
  }

  .terms-of-service__icon svg {
    width: 20px;
    height: 20px;
  }

  .terms-of-service__contact {
    padding: 36px 24px;
  }
}
</style>

<div class="terms-of-service">
  <!-- Hero Section -->
  <section class="terms-of-service__hero">
    <div class="terms-of-service__hero-inner">
      <h1>Terms of Service</h1>
      <p>Please read these terms carefully before using our domain marketplace services.</p>
    </div>
  </section>

  <!-- Content -->
  <div class="terms-of-service__content">

    <div class="terms-of-service__last-updated">
      <strong>Last Updated:</strong> <?php echo date('F j, Y'); ?>
    </div>

    <!-- Agreement -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/>
            <polyline points="14,2 14,8 20,8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
            <polyline points="10,9 9,9 8,9"/>
          </svg>
        </div>
        <div>
          <h2>Agreement to Terms</h2>
        </div>
      </div>
      <p>
        These Terms of Service ("Terms") constitute a legally binding agreement between you and S.Ventures ("Company," "we," "us," or "our") regarding your use of our website and services. By accessing or using our platform, you agree to be bound by these Terms. If you disagree with any part of these Terms, you may not access or use our services.
      </p>
      <p>
        S.Ventures operates as a premium domain name marketplace and investment platform offering high-value domain acquisitions, portfolio management, strategic advisory services, brokerage services for domain transactions, lease-to-own arrangements, equity partnerships, and revenue-sharing agreements. These Terms apply to all visitors, users, investors, and others who access or use our services.
      </p>
      <p>
        Please read these Terms carefully before using our platform. Your continued use of our services constitutes acceptance of these Terms and any future modifications.
      </p>
    </div>

    <!-- Service Description -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2v20M2 12h20"/>
            <circle cx="12" cy="12" r="9"/>
          </svg>
        </div>
        <div>
          <h2>Service Description</h2>
        </div>
      </div>
      <p>
        S.Ventures specializes in premium domain name investments and strategic partnerships. Our comprehensive services include:
      </p>
      <ul>
        <li><strong>Domain Name Sales:</strong> Outright purchase of premium domain names from our curated portfolio</li>
        <li><strong>Lease-to-Own Arrangements:</strong> Flexible payment structures allowing gradual ownership acquisition</li>
        <li><strong>Equity Partnerships:</strong> Domain acquisition in exchange for equity stakes in promising ventures</li>
        <li><strong>Revenue Sharing:</strong> Domain provision in return for ongoing revenue participation</li>
        <li><strong>Portfolio Management:</strong> Strategic domain portfolio consultation and optimization</li>
        <li><strong>Market Intelligence:</strong> Industry insights, valuation services, and market analysis</li>
        <li><strong>Brokerage Services:</strong> Professional facilitation of domain transactions and transfers</li>
        <li><strong>Strategic Advisory:</strong> Expert guidance on domain acquisitions and branding strategy</li>
      </ul>
    </div>

    <!-- Investment Disclaimers -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            <line x1="12" y1="9" x2="12" y2="13"/>
            <line x1="12" y1="17" x2="12.01" y2="17"/>
          </svg>
        </div>
        <div>
          <h2>Investment Disclaimers</h2>
        </div>
      </div>
      <p>
        <strong>IMPORTANT:</strong> Domain name investments involve substantial risk and may not be suitable for all investors. You should carefully consider your investment objectives, level of experience, risk appetite, and financial circumstances before engaging in any domain transaction.
      </p>

      <h3>Risk Factors</h3>
      <ul>
        <li><strong>Market Volatility:</strong> Domain values can fluctuate significantly based on market conditions, technology trends, and industry developments</li>
        <li><strong>No Guaranteed Returns:</strong> Past performance, comparable sales, or market valuations do not guarantee future results or appreciation</li>
        <li><strong>Liquidity Risk:</strong> Domain names may not be readily marketable or easily converted to cash</li>
        <li><strong>Technology Risk:</strong> Changes in internet technology, search algorithms, or user behavior may affect domain value</li>
        <li><strong>Regulatory Risk:</strong> Changes in laws, regulations, or trademark policies may impact domain ownership or value</li>
        <li><strong>Loss of Investment:</strong> You may lose some or all of your investment in domain acquisitions</li>
      </ul>

      <h3>No Investment Advice</h3>
      <p>
        S.Ventures does not provide financial, investment, legal, or tax advice. All information provided on our platform is for informational purposes only and should not be construed as investment recommendations. You are solely responsible for conducting your own due diligence and consulting with qualified professionals before making any investment decisions.
      </p>
    </div>

    <!-- Domain Listings -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <line x1="2" y1="12" x2="22" y2="12"/>
            <path d="M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z"/>
          </svg>
        </div>
        <div>
          <h2>Domain Listings and Availability</h2>
        </div>
      </div>
      <p>
        All domain names listed on S.Ventures are owned by us and are available for acquisition through various transaction structures. Domain availability and pricing are subject to change without notice.
      </p>

      <h3>Listing Accuracy</h3>
      <ul>
        <li>We strive to provide accurate information about each domain name</li>
        <li>Pricing, availability, and transaction terms may change at any time</li>
        <li>Domain listings do not constitute a binding offer to sell</li>
        <li>We reserve the right to refuse any offer or withdraw any domain from sale</li>
      </ul>

      <h3>Domain Ownership Verification</h3>
      <p>
        All domains listed on our platform are verified as owned by S.Ventures. Upon request, we can provide proof of ownership through registrar verification or domain control validation.
      </p>
    </div>

    <!-- Purchase Terms -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <path d="M12 6v6l4 2"/>
          </svg>
        </div>
        <div>
          <h2>Purchase and Transaction Terms</h2>
        </div>
      </div>

      <h3>Purchase Process</h3>
      <p>When you submit an inquiry or offer for a domain:</p>
      <ul>
        <li>You will receive our asking price and a secure checkout link</li>
        <li>If the asking price meets your budget, you may proceed with immediate purchase</li>
        <li>If alternate arrangements are needed (LTO, equity share, etc.), our team will contact you</li>
        <li>All transactions are processed through secure, trusted payment providers</li>
      </ul>

      <h3>Transaction Structures</h3>
      <p>S.Ventures offers flexible domain acquisition options:</p>
      <ul>
        <li><strong>Outright Purchase:</strong> Full payment and immediate domain transfer upon clearance</li>
        <li><strong>Lease-to-Own (LTO):</strong> Structured payment plans with eventual ownership transfer upon completion</li>
        <li><strong>Equity Partnerships:</strong> Domain exchange for equity stake in your venture (subject to due diligence)</li>
        <li><strong>Revenue Sharing:</strong> Domain provided in exchange for ongoing revenue percentage (requires formal agreement)</li>
        <li><strong>Installment Plans:</strong> Custom payment schedules for high-value domain acquisitions</li>
      </ul>
      <p>
        All non-standard transaction structures require formal written agreements, legal documentation, and are subject to approval by both parties. Lease-to-own and revenue sharing arrangements may include specific performance milestones and conditions.
      </p>

      <h3>Escrow and Secure Transactions</h3>
      <p>
        For your protection and ours, all domain transactions must be conducted through approved escrow services:
      </p>
      <ul>
        <li>All transactions over $5,000 require escrow services (Escrow.com, Dan.com, or mutually agreed provider)</li>
        <li>Escrow fees are typically split between buyer and seller unless otherwise agreed</li>
        <li>Domain transfer is initiated only after full payment verification and escrow clearance</li>
        <li>Escrow services provide buyer protection and ensure secure fund transfer</li>
      </ul>

      <h3>Brokerage Fees</h3>
      <p>
        When S.Ventures facilitates a domain transaction as a broker or intermediary:
      </p>
      <ul>
        <li>Brokerage fees range from 10-20% depending on transaction value and complexity</li>
        <li>Fees are clearly disclosed before transaction initiation</li>
        <li>No hidden fees or surprise charges</li>
        <li>Consultation services may be provided at hourly rates or retainer agreements</li>
      </ul>

      <h3>Pricing and Fees</h3>
      <ul>
        <li>All prices are quoted in USD unless otherwise specified</li>
        <li>Listed prices are subject to change without notice until formal offer acceptance</li>
        <li>Prices do not include applicable sales tax, VAT, transfer fees, or registrar fees</li>
        <li>Payment processing fees may apply (typically 2.9% + $0.30 for credit card payments)</li>
        <li>Domain transfer fees charged by registrars are the buyer's responsibility</li>
        <li>Annual domain renewal fees are buyer's responsibility after transfer</li>
      </ul>
    </div>

    <!-- Payment Terms -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
            <line x1="1" y1="10" x2="23" y2="10"/>
          </svg>
        </div>
        <div>
          <h2>Payment and Transfer</h2>
        </div>
      </div>

      <h3>Payment Methods</h3>
      <p>We accept payment through:</p>
      <ul>
        <li>Secure escrow services (recommended for high-value transactions)</li>
        <li>Credit/debit cards via trusted payment processors</li>
        <li>Wire transfers and ACH payments</li>
        <li>Cryptocurrency (for select transactions)</li>
        <li>Custom payment arrangements by agreement</li>
      </ul>

      <h3>Domain Transfer Process</h3>
      <p>Upon successful payment verification:</p>
      <ul>
        <li>Domain will be unlocked and prepared for transfer</li>
        <li>Transfer authorization code (EPP/auth code) will be provided</li>
        <li>You may choose your preferred registrar (GoDaddy, Namecheap, Ionos, Porkbun, etc.)</li>
        <li>Transfer typically completes within 5-7 business days</li>
        <li>We provide full support throughout the transfer process</li>
      </ul>

      <h3>Refund Policy</h3>
      <p>
        Due to the nature of domain transfers, all sales are final once the domain transfer has been initiated. If a transfer fails due to issues on our end, a full refund will be provided. Buyers are responsible for ensuring they can receive the domain at their chosen registrar before purchase.
      </p>
    </div>

    <!-- User Obligations -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
            <circle cx="8.5" cy="7" r="4"/>
            <polyline points="17,11 19,13 23,9"/>
          </svg>
        </div>
        <div>
          <h2>User Obligations and Conduct</h2>
        </div>
      </div>
      <p>When using our services, you agree to:</p>
      <ul>
        <li>Provide accurate, current, and complete information in all communications</li>
        <li>Maintain the confidentiality of any account credentials or transaction details</li>
        <li>Use domains acquired through S.Ventures in compliance with all applicable laws</li>
        <li>Not engage in fraudulent, abusive, or illegal activities</li>
        <li>Not attempt to manipulate pricing or game our inquiry system</li>
        <li>Respect intellectual property rights and trademark laws</li>
        <li>Communicate professionally and respectfully with our team</li>
      </ul>
    </div>

    <!-- Warranties -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
            <path d="M9 12l2 2 4-4"/>
          </svg>
        </div>
        <div>
          <h2>Warranties and Representations</h2>
        </div>
      </div>

      <h3>Our Warranties</h3>
      <p>S.Ventures warrants that:</p>
      <ul>
        <li>We have full legal ownership and authority to sell listed domains</li>
        <li>Domains are free from liens, encumbrances, or legal disputes</li>
        <li>We will provide all necessary documentation for domain transfer</li>
        <li>Transfer process will be conducted professionally and in good faith</li>
      </ul>

      <h3>Disclaimer of Warranties</h3>
      <p>
        EXCEPT AS EXPRESSLY STATED ABOVE, OUR SERVICES ARE PROVIDED "AS IS" WITHOUT WARRANTIES OF ANY KIND, EITHER EXPRESS OR IMPLIED. WE DO NOT WARRANT THAT:
      </p>
      <ul>
        <li>Domain names will generate specific traffic, revenue, or business outcomes</li>
        <li>Domain names are free from trademark conflicts or legal challenges</li>
        <li>Services will be uninterrupted, timely, secure, or error-free</li>
        <li>Any particular domain will remain available at listed prices</li>
      </ul>
      <p>
        Buyers are responsible for conducting their own due diligence regarding trademark status, domain history, SEO value, and commercial viability.
      </p>
    </div>

    <!-- Limitation of Liability -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
        </div>
        <div>
          <h2>Limitation of Liability</h2>
        </div>
      </div>
      <p>
        TO THE MAXIMUM EXTENT PERMITTED BY LAW, S.VENTURES SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, INCLUDING BUT NOT LIMITED TO:
      </p>
      <ul>
        <li>Loss of profits, revenue, or business opportunities</li>
        <li>Loss of data or goodwill</li>
        <li>Service interruptions or delays</li>
        <li>Trademark disputes or legal challenges related to domain use</li>
        <li>Third-party claims or actions</li>
      </ul>
      <p>
        Our total liability for any claim arising from these Terms or our services shall not exceed the amount paid by you for the specific domain in question.
      </p>
    </div>

    <!-- Intellectual Property -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M9 12h6M9 16h6M12 3v18m0 0l-3-3m3 3l3-3"/>
          </svg>
        </div>
        <div>
          <h2>Intellectual Property</h2>
        </div>
      </div>
      <p>
        All content on our website, including but not limited to text, graphics, logos, button icons, images, audio clips, video content, digital downloads, data compilations, and software, is the property of S.Ventures or its content suppliers and is protected by United States and international copyright, trademark, patent, trade secret, and other intellectual property laws.
      </p>

      <h3>Proprietary Information</h3>
      <p>
        The following constitute trade secrets and proprietary information of S.Ventures:
      </p>
      <ul>
        <li>Domain valuation methodologies and algorithms</li>
        <li>Market analysis techniques and pricing strategies</li>
        <li>Business processes and operational procedures</li>
        <li>Domain portfolio composition and acquisition strategies</li>
        <li>Client lists, transaction histories, and business relationships</li>
        <li>Proprietary research, market intelligence, and industry insights</li>
      </ul>

      <h3>Domain Ownership Transfer</h3>
      <p>
        Upon completion of a domain purchase and successful transfer, you receive full ownership rights to the domain name itself, including:
      </p>
      <ul>
        <li>Complete ownership and registration rights</li>
        <li>Full control over DNS settings and configuration</li>
        <li>Right to use, develop, or resell the domain</li>
        <li>All future renewal rights and privileges</li>
      </ul>
      <p>
        However, domain ownership transfer does not include any S.Ventures branding, website content, trademarks, proprietary methodologies, or intellectual property. You may not use S.Ventures trademarks, logos, or branding without explicit written permission.
      </p>

      <h3>Trademark Considerations</h3>
      <p>
        While we verify ownership of all domains in our portfolio, we do not guarantee that domain names are free from trademark conflicts or third-party intellectual property claims. Buyers are responsible for conducting their own trademark searches and due diligence before purchase.
      </p>
    </div>

    <!-- Dispute Resolution -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="3"/>
            <path d="M12 1v6m0 6v6"/>
          </svg>
        </div>
        <div>
          <h2>Dispute Resolution</h2>
        </div>
      </div>

      <h3>Informal Resolution</h3>
      <p>
        If you have any dispute or concern regarding our services, please contact us first. We are committed to resolving issues amicably and will work in good faith to address your concerns.
      </p>

      <h3>Arbitration</h3>
      <p>
        Any dispute that cannot be resolved informally shall be settled through binding arbitration in accordance with the rules of the American Arbitration Association. Arbitration will be conducted in English and held in a mutually agreed location.
      </p>

      <h3>Class Action Waiver</h3>
      <p>
        You agree that any dispute resolution proceedings will be conducted on an individual basis and not as a class action or representative action.
      </p>
    </div>

    <!-- Indemnification -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <div>
          <h2>Indemnification</h2>
        </div>
      </div>
      <p>
        You agree to indemnify, defend, and hold harmless S.Ventures and its affiliates, officers, directors, employees, and agents from any claims, liabilities, damages, losses, or expenses arising from:
      </p>
      <ul>
        <li>Your use of acquired domains</li>
        <li>Your violation of these Terms</li>
        <li>Your violation of any third-party rights, including trademark or intellectual property rights</li>
        <li>Any fraudulent or illegal activity related to your account or transactions</li>
      </ul>
    </div>

    <!-- Termination -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <line x1="15" y1="9" x2="9" y2="15"/>
            <line x1="9" y1="9" x2="15" y2="15"/>
          </svg>
        </div>
        <div>
          <h2>Termination</h2>
        </div>
      </div>
      <p>
        We reserve the right to refuse service, terminate accounts, or cancel transactions at our sole discretion, including for:
      </p>
      <ul>
        <li>Violation of these Terms</li>
        <li>Fraudulent, abusive, or illegal activity</li>
        <li>Failure to pay or complete transactions</li>
        <li>Misrepresentation or providing false information</li>
        <li>Any conduct we deem harmful to our business or other users</li>
      </ul>
    </div>

    <!-- Governing Law -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M3 3h18v18H3zM21 9H3M9 21V9"/>
          </svg>
        </div>
        <div>
          <h2>Governing Law</h2>
        </div>
      </div>
      <p>
        These Terms shall be governed by and construed in accordance with the laws of the United States and the State of Texas, without regard to conflict of law principles.
      </p>
      <p>
        You consent to the exclusive jurisdiction of the courts located in Texas for any legal proceedings related to these Terms or our services.
      </p>
    </div>

    <!-- Changes to Terms -->
    <div class="terms-of-service__section">
      <div class="terms-of-service__section-header">
        <div class="terms-of-service__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0118.8-4.3M22 12.5a10 10 0 01-18.8 4.2"/>
          </svg>
        </div>
        <div>
          <h2>Changes to Terms</h2>
        </div>
      </div>
      <p>
        We reserve the right to modify these Terms at any time. Changes will be effective immediately upon posting on this page with an updated "Last Updated" date.
      </p>
      <p>
        Your continued use of our services after any changes constitutes acceptance of the modified Terms. We encourage you to review these Terms periodically.
      </p>
    </div>

    <!-- Contact -->
    <div class="terms-of-service__contact">
      <h2>Questions About These Terms?</h2>
      <p>If you have questions about these Terms of Service, please don't hesitate to reach out:</p>
      <a href="<?php echo home_url('/contact'); ?>" class="terms-of-service__contact-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
          <polyline points="22,6 12,13 2,6"/>
        </svg>
        Contact Us
      </a>
    </div>

  </div>
</div>

<?php get_footer(); ?>
