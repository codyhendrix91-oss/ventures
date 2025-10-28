<?php
/**
 * Template Name: Privacy Policy
 * Description: Privacy Policy page template with S.Ventures branding
 */
get_header();
?>

<style>
/* Privacy Policy Page Styles */
.privacy-policy {
  background: #f9fafb;
  min-height: 100vh;
}

.privacy-policy__hero {
  background: linear-gradient(135deg, #1a1d35 0%, #0a0e27 100%);
  padding: calc(70px + 90px) 40px 90px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.privacy-policy__hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.08) 0%, transparent 70%);
  pointer-events: none;
}

.privacy-policy__hero-inner {
  max-width: 900px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.privacy-policy__hero h1 {
  font-size: clamp(40px, 6vw, 56px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 20px;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
  line-height: 1.1;
}

.privacy-policy__hero p {
  font-size: clamp(17px, 2.5vw, 19px);
  color: rgba(255, 255, 255, 0.9);
  margin: 0;
  line-height: 1.6;
}

.privacy-policy__content {
  max-width: 900px;
  margin: 0 auto;
  padding: 80px 40px;
}

.privacy-policy__last-updated {
  background: linear-gradient(135deg, rgba(43, 35, 74, 0.08) 0%, rgba(43, 35, 74, 0.04) 100%);
  border-left: 4px solid #7c3aed;
  padding: 20px 24px;
  margin-bottom: 60px;
  border-radius: 8px;
  font-size: 15px;
  color: #4b5563;
}

.privacy-policy__last-updated strong {
  color: #2B234A;
  font-weight: 600;
}

.privacy-policy__section {
  background: #fff;
  border-radius: 16px;
  padding: 40px;
  margin-bottom: 32px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  border: 1px solid #f3f4f6;
}

.privacy-policy__section-header {
  display: flex;
  align-items: flex-start;
  gap: 20px;
  margin-bottom: 24px;
}

.privacy-policy__icon {
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

.privacy-policy__icon svg {
  width: 24px;
  height: 24px;
}

.privacy-policy__section h2 {
  font-size: 26px;
  font-weight: 700;
  color: #2B234A;
  margin: 0;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
  line-height: 1.3;
}

.privacy-policy__section h3 {
  font-size: 20px;
  font-weight: 600;
  color: #2B234A;
  margin: 28px 0 16px;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
}

.privacy-policy__section p {
  font-size: 16px;
  line-height: 1.8;
  color: #4b5563;
  margin: 0 0 16px;
}

.privacy-policy__section ul {
  margin: 16px 0;
  padding-left: 24px;
}

.privacy-policy__section li {
  font-size: 16px;
  line-height: 1.8;
  color: #4b5563;
  margin-bottom: 8px;
}

.privacy-policy__section strong {
  color: #2B234A;
  font-weight: 600;
}

.privacy-policy__contact {
  background: linear-gradient(135deg, #2B234A 0%, #3d3158 100%);
  border-radius: 16px;
  padding: 48px;
  text-align: center;
  color: #fff;
  margin-top: 60px;
}

.privacy-policy__contact h2 {
  font-size: 32px;
  font-weight: 700;
  margin: 0 0 16px;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
  color: #fff;
}

.privacy-policy__contact p {
  font-size: 17px;
  line-height: 1.6;
  margin: 0 0 28px;
  color: rgba(255, 255, 255, 0.9);
}

.privacy-policy__contact-btn {
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

.privacy-policy__contact-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(124, 58, 237, 0.4);
  background: linear-gradient(135deg, #a855f7 0%, #7c3aed 100%);
}

.privacy-policy__contact-btn svg {
  width: 20px;
  height: 20px;
}

/* Responsive */
@media (max-width: 768px) {
  .privacy-policy__hero {
    padding: calc(70px + 60px) 20px 60px;
  }

  .privacy-policy__content {
    padding: 60px 20px;
  }

  .privacy-policy__section {
    padding: 28px 24px;
  }

  .privacy-policy__section-header {
    gap: 16px;
  }

  .privacy-policy__icon {
    width: 40px;
    height: 40px;
  }

  .privacy-policy__icon svg {
    width: 20px;
    height: 20px;
  }

  .privacy-policy__contact {
    padding: 36px 24px;
  }
}
</style>

<div class="privacy-policy">
  <!-- Hero Section -->
  <section class="privacy-policy__hero">
    <div class="privacy-policy__hero-inner">
      <h1>Privacy Policy</h1>
      <p>Your privacy is important to us. Learn how we collect, use, and protect your information.</p>
    </div>
  </section>

  <!-- Content -->
  <div class="privacy-policy__content">

    <div class="privacy-policy__last-updated">
      <strong>Last Updated:</strong> <?php echo date('F j, Y'); ?>
    </div>

    <!-- Introduction -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 2L2 7l10 5 10-5-10-5z"/>
            <path d="M2 17l10 5 10-5"/>
            <path d="M2 12l10 5 10-5"/>
          </svg>
        </div>
        <div>
          <h2>Our Commitment to Privacy</h2>
        </div>
      </div>
      <p>
        At S.Ventures ("Company," "we," "us," or "our"), we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website and use our premium domain marketplace services.
      </p>
      <p>
        S.Ventures operates as a premium domain name marketplace and investment platform. We specialize in high-value domain acquisitions, lease-to-own arrangements, equity partnerships, and revenue-sharing agreements. By accessing or using our services, you acknowledge that you have read, understood, and agree to be bound by this Privacy Policy.
      </p>
      <p>
        Your privacy is of paramount importance to us. We are dedicated to maintaining the confidentiality and security of your personal information throughout your engagement with our platform.
      </p>
    </div>

    <!-- Information We Collect -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/>
            <circle cx="12" cy="7" r="4"/>
          </svg>
        </div>
        <div>
          <h2>Information We Collect</h2>
        </div>
      </div>

      <h3>Personal Information</h3>
      <p>We collect information that you voluntarily provide to us when you:</p>
      <ul>
        <li>Submit an inquiry about a domain name</li>
        <li>Register for our newsletter</li>
        <li>Contact us through our contact forms</li>
        <li>Engage in domain purchase or lease-to-own transactions</li>
        <li>Communicate with us via email, WhatsApp, Telegram, or SMS</li>
      </ul>
      <p>This information may include:</p>
      <ul>
        <li>Name and contact details (email address, phone number)</li>
        <li>Business or project information</li>
        <li>Domain purchase offers and preferences</li>
        <li>Payment information (processed through secure third-party payment processors)</li>
        <li>Communication history and correspondence</li>
      </ul>

      <h3>Automatically Collected Information</h3>
      <p>When you visit our website, we automatically collect certain information about your device and browsing behavior, including:</p>
      <ul>
        <li>IP address and geographic location</li>
        <li>Browser type and version</li>
        <li>Device information and operating system</li>
        <li>Referring website and navigation paths</li>
        <li>Pages viewed and time spent on our website</li>
        <li>Cookies and similar tracking technologies</li>
      </ul>
    </div>

    <!-- How We Use Your Information -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="3"/>
            <path d="M12 1v6m0 6v6M5.64 5.64l4.24 4.24m4.24 4.24l4.24 4.24M1 12h6m6 0h6M5.64 18.36l4.24-4.24m4.24-4.24l4.24-4.24"/>
          </svg>
        </div>
        <div>
          <h2>How We Use Your Information</h2>
        </div>
      </div>
      <p>We use the information we collect for the following purposes:</p>
      <ul>
        <li><strong>Domain Transactions:</strong> Process domain inquiries, sales, lease-to-own agreements, and equity/revenue share arrangements</li>
        <li><strong>Communication:</strong> Respond to your inquiries, provide customer support, and send transaction-related notifications</li>
        <li><strong>Marketing:</strong> Send newsletters, updates about our domain portfolio, and promotional offers (with your consent)</li>
        <li><strong>Analytics:</strong> Analyze website usage to improve our services and user experience</li>
        <li><strong>Security:</strong> Protect against fraud, unauthorized access, and spam submissions</li>
        <li><strong>Legal Compliance:</strong> Comply with applicable laws, regulations, and legal processes</li>
        <li><strong>Business Operations:</strong> Manage our domain portfolio and venture investments</li>
      </ul>
    </div>

    <!-- Information Sharing -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87"/>
            <path d="M16 3.13a4 4 0 010 7.75"/>
          </svg>
        </div>
        <div>
          <h2>Information Sharing and Disclosure</h2>
        </div>
      </div>
      <p>We do not sell your personal information. We may share your information in the following circumstances:</p>
      <ul>
        <li><strong>Service Providers:</strong> Trusted third-party vendors who assist with payment processing, email delivery, analytics, and hosting services</li>
        <li><strong>Domain Registrars:</strong> When transferring domain ownership (GoDaddy, Namecheap, Ionos, Porkbun, etc.)</li>
        <li><strong>Business Transfers:</strong> In connection with mergers, acquisitions, or asset sales</li>
        <li><strong>Legal Requirements:</strong> When required by law, subpoena, or legal process</li>
        <li><strong>Protection:</strong> To protect our rights, property, safety, or that of our users</li>
        <li><strong>With Consent:</strong> Any other purpose disclosed to you with your consent</li>
      </ul>
    </div>

    <!-- Data Security -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0110 0v4"/>
          </svg>
        </div>
        <div>
          <h2>Data Security</h2>
        </div>
      </div>
      <p>
        We implement appropriate technical and organizational security measures to protect your personal information from unauthorized access, disclosure, alteration, and destruction. These measures include:
      </p>
      <ul>
        <li>SSL/TLS encryption for data transmission</li>
        <li>Secure payment processing through trusted third-party providers</li>
        <li>Regular security assessments and updates</li>
        <li>Access controls and authentication requirements</li>
        <li>Spam and bot protection systems</li>
      </ul>
      <p>
        However, no method of transmission over the Internet or electronic storage is 100% secure. While we strive to protect your information, we cannot guarantee absolute security.
      </p>
    </div>

    <!-- Analytics and Tracking -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
        <div>
          <h2>Analytics and Tracking</h2>
        </div>
      </div>
      <p>
        To better understand our website traffic, improve user experience, and enhance our services, we utilize the following analytics platforms:
      </p>

      <h3>Google Analytics</h3>
      <p>
        We use Google Analytics to track website performance, user behavior, and traffic sources. Google Analytics uses cookies to collect anonymous information about visitor interactions.
      </p>

      <h3>Cloudflare Web Analytics</h3>
      <p>
        We utilize Cloudflare Web Analytics to monitor website performance, security threats, and page views. Cloudflare provides privacy-respecting analytics without tracking individual users across websites.
      </p>

      <h3>Server Logs and Performance Monitoring</h3>
      <p>
        Our hosting infrastructure automatically collects server logs containing IP addresses, timestamps, requested URLs, and HTTP response codes for security and performance optimization purposes.
      </p>
    </div>

    <!-- Cookies -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <circle cx="12" cy="12" r="10"/>
            <circle cx="12" cy="12" r="4"/>
            <line x1="21.17" y1="8" x2="12" y2="8"/>
            <line x1="3.95" y1="6.06" x2="8.54" y2="14"/>
            <line x1="10.88" y1="21.94" x2="15.46" y2="14"/>
          </svg>
        </div>
        <div>
          <h2>Cookies and Tracking Technologies</h2>
        </div>
      </div>
      <p>
        We use cookies and similar tracking technologies to enhance your browsing experience and analyze website usage. Cookies are small text files stored on your device that help us provide better services.
      </p>

      <h3>Types of Cookies We Use</h3>
      <ul>
        <li><strong>Essential Cookies:</strong> Required for website functionality, security, and navigation</li>
        <li><strong>Analytics Cookies:</strong> Help us understand visitor interactions and improve our services</li>
        <li><strong>Preference Cookies:</strong> Remember your settings and preferences (such as theme preferences)</li>
        <li><strong>Performance Cookies:</strong> Monitor website speed, loading times, and technical performance</li>
        <li><strong>Security Cookies:</strong> Prevent spam, bot activity, and fraudulent transactions</li>
      </ul>

      <h3>Cookie Management</h3>
      <p>
        You can control cookie preferences through your browser settings. Most browsers allow you to:
      </p>
      <ul>
        <li>View and delete existing cookies</li>
        <li>Block third-party cookies</li>
        <li>Block cookies from specific sites</li>
        <li>Delete all cookies when closing your browser</li>
      </ul>
      <p>
        Please note that disabling certain cookies may affect website functionality and limit your ability to access certain features of our platform.
      </p>
    </div>

    <!-- Data Retention -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
            <path d="M9 3v18M15 3v18"/>
          </svg>
        </div>
        <div>
          <h2>Data Retention</h2>
        </div>
      </div>
      <p>
        We retain personal information only for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required or permitted by law.
      </p>

      <h3>Retention Periods</h3>
      <ul>
        <li><strong>Contact Form Submissions:</strong> Retained for 3 years or until you request deletion</li>
        <li><strong>Newsletter Subscriptions:</strong> Retained until you unsubscribe</li>
        <li><strong>Domain Transaction Records:</strong> Retained for 7 years for legal and tax compliance</li>
        <li><strong>Analytics Data:</strong> Aggregated and anonymized after 26 months</li>
        <li><strong>Security Logs:</strong> Retained for 90 days for fraud prevention and security purposes</li>
      </ul>

      <p>
        When personal information is no longer needed, we securely delete or anonymize it to prevent unauthorized access or use.
      </p>
    </div>

    <!-- Your Rights -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
          </svg>
        </div>
        <div>
          <h2>Your Privacy Rights</h2>
        </div>
      </div>
      <p>Depending on your location, you may have certain rights regarding your personal information:</p>
      <ul>
        <li><strong>Access:</strong> Request a copy of the personal information we hold about you</li>
        <li><strong>Correction:</strong> Request correction of inaccurate or incomplete information</li>
        <li><strong>Deletion:</strong> Request deletion of your personal information (subject to legal obligations)</li>
        <li><strong>Opt-Out:</strong> Unsubscribe from marketing communications at any time</li>
        <li><strong>Data Portability:</strong> Request your data in a structured, machine-readable format</li>
        <li><strong>Objection:</strong> Object to certain processing activities</li>
      </ul>
      <p>
        To exercise these rights, please contact us using the information provided below. We will respond to your request within a reasonable timeframe.
      </p>
    </div>

    <!-- Third-Party Links -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/>
            <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
          </svg>
        </div>
        <div>
          <h2>Third-Party Links</h2>
        </div>
      </div>
      <p>
        Our website may contain links to third-party websites, including domain registrars, payment processors, and other services. We are not responsible for the privacy practices or content of these external sites. We encourage you to review the privacy policies of any third-party websites you visit.
      </p>
    </div>

    <!-- Children's Privacy -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
          </svg>
        </div>
        <div>
          <h2>Children's Privacy</h2>
        </div>
      </div>
      <p>
        Our services are not directed to individuals under the age of 18. We do not knowingly collect personal information from children. If we become aware that we have collected information from a child without parental consent, we will take steps to delete that information.
      </p>
    </div>

    <!-- Changes to Policy -->
    <div class="privacy-policy__section">
      <div class="privacy-policy__section-header">
        <div class="privacy-policy__icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21.5 2v6h-6M2.5 22v-6h6M2 11.5a10 10 0 0118.8-4.3M22 12.5a10 10 0 01-18.8 4.2"/>
          </svg>
        </div>
        <div>
          <h2>Changes to This Privacy Policy</h2>
        </div>
      </div>
      <p>
        We may update this Privacy Policy from time to time to reflect changes in our practices, technology, legal requirements, or other factors. We will notify you of any material changes by posting the updated policy on this page with a new "Last Updated" date.
      </p>
      <p>
        We encourage you to review this Privacy Policy periodically to stay informed about how we protect your information.
      </p>
    </div>

    <!-- Contact -->
    <div class="privacy-policy__contact">
      <h2>Questions About Privacy?</h2>
      <p>If you have questions or concerns about this Privacy Policy or our data practices, please contact us:</p>
      <a href="<?php echo home_url('/contact'); ?>" class="privacy-policy__contact-btn">
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
