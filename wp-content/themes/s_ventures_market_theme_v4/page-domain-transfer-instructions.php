<?php
/**
 * Template Name: Domain Transfer Instructions by Registrar
 * Description: Professional guide for domain transfers across all major registrars
 */
get_header();
?>

<style>
/* Domain Transfer Instructions Page Styles */
.domain-transfer-page {
  background: #ffffff;
  min-height: 100vh;
  padding: calc(var(--header-height) + 60px) 0 80px;
}

.transfer-container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Page Header */
.transfer-header {
  text-align: center;
  margin-bottom: 60px;
  padding-bottom: 40px;
  border-bottom: 3px solid #f3f4f6;
}

.transfer-header h1 {
  font-size: clamp(36px, 5vw, 52px);
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 20px;
  font-family: 'Poppins', sans-serif;
  letter-spacing: -0.02em;
  line-height: 1.2;
}

.transfer-header .subtitle {
  font-size: 18px;
  color: #6b7280;
  line-height: 1.6;
  max-width: 800px;
  margin: 0 auto;
}

/* Registrar Section */
.registrar-section {
  margin-bottom: 60px;
  padding-bottom: 60px;
  border-bottom: 2px solid #f3f4f6;
  position: relative;
}

.registrar-section:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}

/* Registrar Header with Logo */
.registrar-header {
  display: flex;
  align-items: center;
  gap: 20px;
  margin-bottom: 32px;
}

.registrar-logo {
  flex-shrink: 0;
  width: 60px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f9fafb;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  padding: 10px;
  transition: all 0.3s ease;
}

.registrar-logo img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.registrar-logo:hover {
  border-color: #00d9ff;
  background: rgba(0, 217, 255, 0.05);
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(0, 217, 255, 0.15);
}

.registrar-info {
  flex: 1;
}

.registrar-info h2 {
  margin: 0 0 8px;
  font-size: 32px;
  font-weight: 700;
  font-family: 'Poppins', sans-serif;
  line-height: 1.2;
}

.registrar-info h2 a {
  color: #2B234A;
  text-decoration: none;
  transition: color 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}

.registrar-info h2 a:hover {
  color: #00d9ff;
}

.registrar-info h2 a::after {
  content: '↗';
  font-size: 24px;
  opacity: 0.6;
  transition: opacity 0.2s ease;
}

.registrar-info h2 a:hover::after {
  opacity: 1;
}

.registrar-website {
  font-size: 14px;
  color: #6b7280;
  font-style: italic;
}

/* Transfer Instructions */
.transfer-instructions {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 40px;
  margin-top: 24px;
}

.transfer-direction {
  background: #f9fafb;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  padding: 28px;
  transition: all 0.3s ease;
}

.transfer-direction:hover {
  border-color: #00d9ff;
  background: rgba(0, 217, 255, 0.02);
}

.transfer-direction h3 {
  font-size: 20px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 16px;
  font-family: 'Poppins', sans-serif;
  display: flex;
  align-items: center;
  gap: 10px;
}

.transfer-direction h3::before {
  content: '';
  width: 4px;
  height: 24px;
  background: linear-gradient(135deg, #00d9ff 0%, #2efc86 100%);
  border-radius: 2px;
}

.transfer-direction p {
  font-size: 15px;
  line-height: 1.7;
  color: #374151;
  margin: 0 0 14px;
}

.transfer-direction p:last-child {
  margin-bottom: 0;
}

.transfer-direction strong {
  color: #1a1d35;
  font-weight: 600;
}

.transfer-direction em {
  color: #6b7280;
  font-style: italic;
}

/* Key Points / Highlights */
.key-point {
  background: rgba(0, 217, 255, 0.08);
  border-left: 4px solid #00d9ff;
  padding: 16px 20px;
  margin: 20px 0;
  border-radius: 0 8px 8px 0;
  font-size: 15px;
  color: #1a1d35;
  line-height: 1.6;
}

/* Timeline Badge */
.timeline-badge {
  display: inline-block;
  padding: 4px 12px;
  background: linear-gradient(135deg, rgba(0, 217, 255, 0.15) 0%, rgba(46, 252, 134, 0.15) 100%);
  color: #2B234A;
  border-radius: 6px;
  font-weight: 600;
  font-size: 13px;
  margin: 8px 0;
}

/* Table of Contents */
.toc {
  background: #f9fafb;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  padding: 32px;
  margin-bottom: 60px;
}

.toc h2 {
  font-size: 24px;
  font-weight: 700;
  color: #2B234A;
  margin: 0 0 20px;
  font-family: 'Poppins', sans-serif;
}

.toc-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  gap: 12px;
}

.toc-link {
  padding: 12px 16px;
  background: #ffffff;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  color: #374151;
  text-decoration: none;
  font-size: 15px;
  font-weight: 500;
  transition: all 0.2s ease;
  display: block;
}

.toc-link:hover {
  border-color: #00d9ff;
  background: rgba(0, 217, 255, 0.05);
  color: #2B234A;
  transform: translateX(4px);
}

/* Responsive */
@media (max-width: 768px) {
  .domain-transfer-page {
    padding: calc(var(--header-height) + 30px) 0 60px;
  }

  .transfer-header {
    margin-bottom: 40px;
  }

  .transfer-header h1 {
    font-size: 32px;
  }

  .transfer-instructions {
    grid-template-columns: 1fr;
    gap: 24px;
  }

  .registrar-section {
    margin-bottom: 40px;
    padding-bottom: 40px;
  }

  .registrar-header {
    flex-direction: column;
    align-items: flex-start;
  }

  .registrar-logo {
    width: 50px;
    height: 50px;
  }

  .registrar-info h2 {
    font-size: 26px;
  }

  .toc-grid {
    grid-template-columns: 1fr;
  }
}
</style>

<main class="domain-transfer-page">
  <div class="transfer-container">

    <!-- Page Header -->
    <header class="transfer-header">
      <h1>Domain Transfer Instructions by Registrar</h1>
      <p class="subtitle">
        A comprehensive guide to transferring domains in and out of all major registrars.
        Follow the step-by-step instructions for your specific registrar to ensure a smooth, secure transfer.
      </p>
    </header>

    <!-- Table of Contents -->
    <nav class="toc">
      <h2>Jump to Registrar</h2>
      <div class="toc-grid">
        <a href="#godaddy" class="toc-link">GoDaddy</a>
        <a href="#namecheap" class="toc-link">Namecheap</a>
        <a href="#google-domains" class="toc-link">Google Domains</a>
        <a href="#name-com" class="toc-link">Name.com</a>
        <a href="#domain-com" class="toc-link">Domain.com</a>
        <a href="#ionos" class="toc-link">IONOS</a>
        <a href="#network-solutions" class="toc-link">Network Solutions</a>
        <a href="#register-com" class="toc-link">Register.com</a>
        <a href="#hover" class="toc-link">Hover</a>
        <a href="#gandi" class="toc-link">Gandi.net</a>
        <a href="#cloudflare" class="toc-link">Cloudflare</a>
        <a href="#dynadot" class="toc-link">Dynadot</a>
        <a href="#namesilo" class="toc-link">NameSilo</a>
        <a href="#porkbun" class="toc-link">Porkbun</a>
        <a href="#bluehost" class="toc-link">Bluehost</a>
        <a href="#hostgator" class="toc-link">HostGator</a>
        <a href="#dreamhost" class="toc-link">DreamHost</a>
        <a href="#resellerclub" class="toc-link">ResellerClub/BigRock</a>
      </div>
    </nav>

    <!-- GoDaddy -->
    <section id="godaddy" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/godaddy.com" alt="GoDaddy logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.godaddy.com" target="_blank" rel="noopener noreferrer">GoDaddy</a></h2>
          <p class="registrar-website">The world's largest domain registrar</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>To transfer a domain away from GoDaddy, unlock the domain and retrieve its authorization (EPP) code from your account, then initiate the transfer at the new registrar.</p>
          <p>By default, inter-registrar transfers take about <strong>5–7 days</strong> to complete, but GoDaddy allows you to <strong>manually approve outgoing transfers</strong> via your account to speed up the process.</p>
          <p>If you approve the transfer-out in GoDaddy's interface, the domain can move <em>within minutes</em>; otherwise, GoDaddy will auto-approve it after seven days.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>To transfer a domain into GoDaddy, ensure it's unlocked at the current registrar and obtain its EPP code.</p>
          <p>Then, purchase a transfer on GoDaddy's site and enter the auth code during checkout. GoDaddy will <strong>add a year</strong> to the domain's registration term upon completion.</p>
          <p>Most incoming transfers also finalize within <strong>5–7 days</strong> (you can monitor status in your GoDaddy account).</p>
          <p class="timeline-badge">Timeline: 5-7 days (or minutes with manual approval)</p>
        </div>
      </div>
    </section>

    <!-- Namecheap -->
    <section id="namecheap" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/namecheap.com" alt="Namecheap logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.namecheap.com" target="_blank" rel="noopener noreferrer">Namecheap</a></h2>
          <p class="registrar-website">ICANN-accredited registrar known for affordable domains</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>At Namecheap, you can initiate a transfer-out at any time (no special waiting period beyond ICANN's 60-day rule).</p>
          <p>You'll need to <strong>disable the "Registrar Lock"</strong> and obtain your domain's EPP code from the Namecheap dashboard. Namecheap will email the auth code to the registrant contact if privacy is enabled.</p>
          <p>Namecheap sends you a confirmation email and allows you to <strong>approve the transfer immediately</strong> – if you confirm, the transfer completes quickly (often within minutes or hours), otherwise it will complete automatically after the 5-day window.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Transferring a domain to Namecheap is straightforward. Ensure the domain is unlocked at the current registrar and obtain its EPP code, then submit a transfer order on Namecheap's "Transfer" page.</p>
          <p>Namecheap notes that domain transfers typically take anywhere from <strong>30 minutes up to 8 days</strong> to finish, largely depending on how quickly the losing registrar cooperates.</p>
          <p>During an incoming transfer, Namecheap will email the domain's WHOIS contact to approve the transfer; once approved, Namecheap will finalize the transfer and <strong>add an extra year</strong> to your domain's term.</p>
          <p class="timeline-badge">Timeline: 30 minutes to 8 days</p>
        </div>
      </div>
    </section>

    <!-- Google Domains / Squarespace -->
    <section id="google-domains" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/squarespace.com" alt="Squarespace Domains logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://domains.squarespace.com" target="_blank" rel="noopener noreferrer">Google Domains (now Squarespace)</a></h2>
          <p class="registrar-website">Formerly Google Domains, acquired by Squarespace in 2023</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>In your Google Domains account (now transitioning to Squarespace), go to Registration Settings, unlock the domain, and click <strong>"Get Auth Code"</strong> under "Transfer Out".</p>
          <p>Once you supply this code to the new registrar and initiate the transfer, you'll receive a confirmation email. You can approve the transfer via that email to expedite the process.</p>
          <p>If you take no action, the transfer will complete automatically after about <strong>5 days</strong>.</p>
          <div class="key-point">
            <strong>Note:</strong> As of late 2023, all Google Domains customers are being migrated to Squarespace Domains. The transfer process remains similar.
          </div>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p><em>Google Domains is no longer accepting new transfers due to the transition to Squarespace.</em></p>
          <p>Previously, to transfer into Google Domains you'd initiate the transfer on Google's site and enter the auth code from your old registrar. The domain would be added to your Google account once the prior registrar released it.</p>
          <p>With the service now moving to Squarespace, users are advised to <strong>transfer their domains to another provider</strong> or manage them via Squarespace going forward.</p>
          <p class="timeline-badge">Timeline: N/A (transitioning to Squarespace)</p>
        </div>
      </div>
    </section>

    <!-- Name.com -->
    <section id="name-com" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/name.com" alt="Name.com logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.name.com" target="_blank" rel="noopener noreferrer">Name.com</a></h2>
          <p class="registrar-website">Well-known domain registrar (part of Identity Digital)</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>Log into your Name.com account and navigate to the domain's details page. There, turn off the <strong>Transfer Lock</strong> and click to reveal or request the auth code.</p>
          <p>Name.com also provides an option to <strong>export your DNS records</strong> before transfer (useful if you'll need to recreate them at the new provider).</p>
          <p>Transfers from Name.com generally complete in about <strong>5–7 days</strong>, but Name.com offers assistance to expedite outgoing transfers – you can contact Name.com support to approve the transfer out faster.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Ensure the domain is eligible (60+ days old, not recently transferred) and unlocked at the current registrar, and have its auth code.</p>
          <p>On Name.com's website, go to <strong>Transfer Domains</strong> and submit your domain name and EPP code to the cart.</p>
          <p>After checkout, Name.com will send a transfer request to the registry. The losing registrar may email their owner/admin contact for confirmation – approving that can speed things up.</p>
          <p class="timeline-badge">Timeline: 5-7 days</p>
        </div>
      </div>
    </section>

    <!-- Domain.com -->
    <section id="domain-com" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/domain.com" alt="Domain.com logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.domain.com" target="_blank" rel="noopener noreferrer">Domain.com</a></h2>
          <p class="registrar-website">Large registrar and hosting provider (Newfold Digital)</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>Log into your Domain.com account and <strong>unlock the domain</strong>. Then request the transfer authorization code.</p>
          <p>Domain.com will email the EPP code to the registrant contact email on file (make sure your WHOIS contact info is up to date).</p>
          <p>After you have the code, initiate the transfer at your new registrar. Domain.com domains follow the standard ICANN transfer timeline – once submitted and confirmed, it typically completes in <strong>5 to 7 days</strong>.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Ensure the domain is unlocked and obtain the auth code from the current registrar. Then go to Domain.com's Transfer page, enter your domain and EPP code, and proceed through checkout.</p>
          <p>Domain.com will email the domain's admin contact to approve the incoming transfer (as a security step). Once approved, the transfer is processed and should finish within a few days (up to a week).</p>
          <p>Domain.com also <strong>adds a year</strong> to the registration term for incoming transfers in most cases.</p>
          <p class="timeline-badge">Timeline: 5-7 days</p>
        </div>
      </div>
    </section>

    <!-- IONOS -->
    <section id="ionos" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/ionos.com" alt="IONOS logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.ionos.com" target="_blank" rel="noopener noreferrer">IONOS</a></h2>
          <p class="registrar-website">Formerly 1&1 Internet, major German-based registrar/host</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>In the IONOS control panel, prepare a domain for transfer by disabling <strong>Private Registration</strong> (if enabled) and then turning off the transfer lock (often called "Registrar Lock").</p>
          <p>Once unlocked, retrieve the domain's authorization code from the account (under the "Renewal & Transfer" section) – IONOS will display or email you the auth code after you click <strong>"Show Authorization Code."</strong></p>
          <p>Most domains transfer out of IONOS in about <strong>5–6 business days</strong> (roughly a week). If you want it faster, you can try contacting IONOS support.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Unlock the domain and get the auth code from your current registrar first. Then, initiate a transfer order on IONOS's website.</p>
          <p>IONOS's system will guide you through entering the domain and EPP code, and you'll need to confirm the transfer via emails (IONOS often sends an email to the current owner for confirmation).</p>
          <p>According to IONOS, generic TLD transfers take a maximum of <strong>5 to 6 business days</strong> to complete (many complete sooner). After completion, IONOS will add the standard 1-year extension to your domain.</p>
          <p class="timeline-badge">Timeline: 5-6 business days</p>
        </div>
      </div>
    </section>

    <!-- Network Solutions -->
    <section id="network-solutions" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/networksolutions.com" alt="Network Solutions logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.networksolutions.com" target="_blank" rel="noopener noreferrer">Network Solutions</a></h2>
          <p class="registrar-website">One of the oldest and most established registrars</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>Network Solutions has a few extra steps due to its legacy systems. First, ensure your domain is unlocked (at NetSol this is called <strong>"Domain Protect"</strong> status – it must be turned Off in your account's Domain Manager).</p>
          <p>Next, request the Authorization Code: in your Network Solutions account, find the option <strong>"Request Auth Code"</strong> for your domain. NetSol will email the auth code to the registrant/admin email on file (it can take up to 24 hours to arrive).</p>
          <div class="key-point">
            <strong>Important:</strong> Network Solutions often sends a transfer confirmation email via a partner domain (registrar-transfers.com). If you approve the transfer via that email, Network Solutions will release the domain immediately. If you do nothing, wait the full 5-day period.
          </div>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Unlock the domain and obtain the EPP code from the current registrar, then purchase a transfer on Network Solutions' site. During the purchase, you'll enter the domain and auth code.</p>
          <p>Network Solutions will send an email to the domain's administrative contact to authorize the incoming transfer. Meanwhile, your old registrar might also send a confirmation email.</p>
          <p>Network Solutions notes that typically domain transfers can take between <strong>30 minutes to 8 days</strong> to complete, depending on how quickly approvals happen. (In many cases it's around 5 days if no manual intervention.)</p>
          <p class="timeline-badge">Timeline: 30 minutes to 8 days</p>
        </div>
      </div>
    </section>

    <!-- Register.com -->
    <section id="register-com" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/register.com" alt="Register.com logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.register.com" target="_blank" rel="noopener noreferrer">Register.com</a></h2>
          <p class="registrar-website">Long-running registrar (same ownership as Network Solutions)</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>The process is very similar to NetSol's. Log in to your Register.com account, turn Off the domain lock, and request the auth code (Register.com provides an <strong>"Obtain Auth Info Code"</strong> option in the domain settings).</p>
          <p>They will send the code to your email within a few days (often within 4–5 days according to their help info).</p>
          <p>Register.com will send a confirmation email – approving it will finalize the transfer out more quickly. If you don't explicitly approve, the transfer will complete after the standard 5-day waiting period.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Unlock the domain and get the EPP code first. Then go to Register.com's transfer page and submit your transfer request with the domain name and auth code.</p>
          <p>You will likely receive an email from Register.com (or Network Solutions, their sister brand) to confirm you want to transfer in the domain – follow the instructions to approve.</p>
          <p>Expect the entire transfer-in to take about <strong>5 days</strong>, unless manually expedited by a quick approval from the previous registrar. Register.com will add a year to the domain's term for most extensions.</p>
          <p class="timeline-badge">Timeline: 5-7 days</p>
        </div>
      </div>
    </section>

    <!-- Hover -->
    <section id="hover" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/hover.com" alt="Hover logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.hover.com" target="_blank" rel="noopener noreferrer">Hover</a></h2>
          <p class="registrar-website">Retail domain service by Tucows (focuses on simplicity)</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>Hover makes it easy to leave if you choose. In your Hover account, select the domain and turn off the <strong>Transfer Lock</strong> (a simple toggle) and then click <strong>"Reveal Auth Code"</strong> to get your EPP code.</p>
          <p>After initiating the transfer at the new registrar, Hover will send a "transfer-away" confirmation email to the domain owner's address. This email contains a link that allows you to approve or cancel the transfer.</p>
          <p>If you want to speed things up, click the approval link – Hover will then immediately mark the domain transfer as approved and the domain can move as fast as the registry updates (often within an hour or two). If you do nothing, the transfer will complete after the standard waiting period (usually <strong>5 days</strong>).</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Unlock the domain and obtain the auth code from your current registrar. Then, on Hover's site, go to Transfer and enter the domain name.</p>
          <p>Hover will verify the domain is eligible (not in lock or within 60 days of recent transfer) and prompt for the EPP code. Proceed through payment.</p>
          <p>Transfers into Hover typically take <strong>5–7 days</strong> to complete. Hover advises that if you want to expedite, you can ask the losing registrar to approve the transfer out. When the transfer is done, Hover adds one year to your domain's expiration date.</p>
          <p class="timeline-badge">Timeline: 5-7 days (or 1-2 hours with approval)</p>
        </div>
      </div>
    </section>

    <!-- Gandi.net -->
    <section id="gandi" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/gandi.net" alt="Gandi.net logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.gandi.net" target="_blank" rel="noopener noreferrer">Gandi.net</a></h2>
          <p class="registrar-website">Reputable European registrar known for "no bullshit" service</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>Gandi's procedure is straightforward: <strong>Unlock your domain</strong> in the Gandi control panel (ensure the status is set to "unlocked") and copy the authorization code (called "Auth code" on Gandi).</p>
          <p>Gandi doesn't require any internal approval to transfer out; instead, once your new registrar initiates the transfer, the registry notifies Gandi and Gandi will send a standard FOA email to the domain owner for confirmation.</p>
          <p>If you confirm that email, the transfer goes through quickly. If you don't respond, Gandi will automatically finalize the transfer after <strong>5 days</strong> by design. This is aligned with ICANN policy.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Use Gandi's transfer page to enter the domain and its EPP code. Gandi will ask you to confirm the contact information for the domain.</p>
          <p>After placing the transfer order, the domain's current registrar will be notified. If the losing registrar sends an approval request email to you, make sure to confirm it.</p>
          <p>Gandi states that transfers proceed according to the registry's rules – for most common TLDs, it's done within <strong>5–7 days</strong>. (If the previous registrar has an expedited approval option, using it can make the transfer happen in a matter of hours.) After completion, Gandi will extend your domain's expiration by one year.</p>
          <p class="timeline-badge">Timeline: 5-7 days</p>
        </div>
      </div>
    </section>

    <!-- Cloudflare -->
    <section id="cloudflare" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/cloudflare.com" alt="Cloudflare logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.cloudflare.com/products/registrar/" target="_blank" rel="noopener noreferrer">Cloudflare Registrar</a></h2>
          <p class="registrar-website">Domains at cost for customers, emphasis on security</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>Cloudflare Registrar has a very clear process. In your Cloudflare dashboard, go to <strong>Manage Domains</strong>, select the domain and choose "Unlock". Confirm to unlock it, then Cloudflare will display the auth code (you can copy it or regenerate if needed).</p>
          <div class="key-point">
            <strong>Cloudflare stands out:</strong> Once the transfer request is submitted, Cloudflare allows you to manually approve the transfer out from their interface to speed it up. If you click approve and confirm, Cloudflare will release the domain right away. If you choose not to approve manually, the transfer will auto-approve on the 5th day.
          </div>
          <p>Cloudflare basically skips the standard outgoing FOA email in favor of this account-level approval, making it very quick and secure.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>To transfer domains into Cloudflare, Cloudflare requires that the domain use <strong>Cloudflare's nameservers</strong> (so you typically add the domain to Cloudflare's DNS first).</p>
          <p>Once that's done, you go to the Transfer to Cloudflare section of your account, and Cloudflare will show which of your eligible domains can be moved. You then enter the auth codes for each and pay the renewal fee.</p>
          <p>Many users report that transfers into Cloudflare can complete <strong>extremely fast</strong> (some within minutes if the previous registrar had already unlocked and you approved any emails). Otherwise, it will complete in the usual 5-day window by auto-processing.</p>
          <p class="timeline-badge">Timeline: Minutes to 5 days (very fast with approval)</p>
        </div>
      </div>
    </section>

    <!-- Dynadot -->
    <section id="dynadot" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/dynadot.com" alt="Dynadot logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.dynadot.com" target="_blank" rel="noopener noreferrer">Dynadot</a></h2>
          <p class="registrar-website">Independent ICANN registrar with advanced control panel</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>In your Dynadot account, go to your domain management, click on the domain, and you'll see a section for <strong>Transfer Lock</strong> and <strong>Authorization Code</strong>.</p>
          <p>Unlock the domain (Dynadot may ask you to unlock your account with a 2FA code first, as an extra security step). Once the domain is unlocked, Dynadot will display the auth code right on that page.</p>
          <p>After the new registrar submits the request, Dynadot will send you a "Transfer Away" email for confirmation. You can approve the transfer via a link in that email to have it complete sooner. If you take no action, the transfer will proceed and typically completes in <strong>5 days</strong> by auto-approval.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Initiate an order on Dynadot's Transfer page. Provide the domain name and its EPP code, and pay the fee.</p>
          <p>Once initiated, Dynadot will email the domain's WHOIS contact to authorize the transfer into Dynadot. The losing registrar might also send a confirmation email.</p>
          <p>The overall time frame is usually <strong>5–7 days</strong> (it can be faster if the previous registrar quickly approves the transfer). Dynadot's system will automatically update you via email when the transfer completes, and it will extend your domain by one year.</p>
          <p class="timeline-badge">Timeline: 5-7 days (up to 15 days for certain ccTLDs)</p>
        </div>
      </div>
    </section>

    <!-- NameSilo -->
    <section id="namesilo" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/namesilo.com" alt="NameSilo logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.namesilo.com" target="_blank" rel="noopener noreferrer">NameSilo</a></h2>
          <p class="registrar-website">Low-cost registrar popular for free privacy and user-friendly interface</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>Navigate to your domain management page, <strong>unlock the domain</strong>, and click to obtain the EPP code (NameSilo emails the auth code to you for security).</p>
          <p>Once you have the code, initiate the transfer at the new registrar. NameSilo will send a confirmation email asking if you approve the transfer. If you approve via the link, NameSilo releases the domain immediately.</p>
          <p>NameSilo is known for not putting up hurdles – they charge <strong>no extra fees</strong> to leave and their confirmation process is straightforward. Expect the transfer out to take around <strong>5 days</strong> if not manually approved sooner (or just a few hours if you do approve instantly).</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Unlock your domain and get the auth code from your current registrar, then submit a transfer request on NameSilo's website. NameSilo often offers <strong>discounted transfer rates</strong> for various TLDs.</p>
          <p>After initiating, check that the domain's WHOIS email is correct because NameSilo (and/or the losing registrar) will send approval emails.</p>
          <p>Once those are taken care of, the transfer completes in the typical timeframe (usually within <strong>5 days</strong>). They will add a year to your domain once it's moved in.</p>
          <p class="timeline-badge">Timeline: 5 days (or hours with instant approval)</p>
        </div>
      </div>
    </section>

    <!-- Porkbun -->
    <section id="porkbun" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/porkbun.com" alt="Porkbun logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://porkbun.com" target="_blank" rel="noopener noreferrer">Porkbun</a></h2>
          <p class="registrar-website">Newer registrar known for quirky name and very competitive pricing</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>At Porkbun, go to the domain's detail page, disable the <strong>"Transfer Lock,"</strong> and click the button to reveal the auth code. Porkbun will display the EPP code (or email it if required).</p>
          <p>Give that code to your new registrar to start the transfer. Porkbun will send an email with a confirmation link – they allow immediate approval of outbound transfers.</p>
          <p>If you click the approve link in the email, the transfer is expedited (often finishing the same day). If you do nothing, Porkbun will automatically approve the transfer after the standard waiting period (usually <strong>5 days</strong>). Porkbun prides itself on being friendly to customers, so they don't unnecessarily delay transfers.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Initiate a transfer on Porkbun's site by entering the domain and auth code and paying the fee (which often is among the lowest due to Porkbun's thin margins).</p>
          <p>The losing registrar's approval process (if any) will be the main speed factor – as soon as your old registrar releases the domain, Porkbun will finalize the transfer.</p>
          <p>Most users see transfers into Porkbun complete in <strong>2–5 days</strong>, occasionally up to 7 if the previous registrar waits it out. An extra year is added to your domain's expiration as usual.</p>
          <p class="timeline-badge">Timeline: 2-5 days (up to 7)</p>
        </div>
      </div>
    </section>

    <!-- Bluehost -->
    <section id="bluehost" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/bluehost.com" alt="Bluehost logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.bluehost.com" target="_blank" rel="noopener noreferrer">Bluehost</a></h2>
          <p class="registrar-website">Popular web hosting company that also provides domain registration</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>If your domain is registered with Bluehost, the management is done via the Bluehost Domain Manager (often in the cPanel). You need to ensure the domain is <strong>unlocked</strong> (Bluehost shows a lock status – switch it to unlocked) and then get the EPP code.</p>
          <p>In Bluehost's interface, you typically go to the domain, and under the transfer section click <strong>"Send EPP Code"</strong> – they will email the authorization code to the registrant email on file.</p>
          <p>Bluehost uses an external registrar platform (Tucows/OpenSRS for many domains), so you might receive a confirmation email from "Bluehost via OpenSRS" or a similar sender. Approve that email to speed up the transfer. If approved, the domain can transfer out in under a day. If not, it will automatically complete after <strong>5–7 days</strong> by default.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>In your Bluehost panel, there is a <strong>"Transfer a new domain to Bluehost"</strong> option. You'll provide the domain name and EPP code.</p>
          <p>Bluehost will then send the standard FOA email to the domain's current owner (if required) and also might require you to verify your Bluehost account email.</p>
          <p>Bluehost says transfers "typically take a few days but can take up to a week" depending on the other registrar. Once transferred, Bluehost will extend your domain by a year.</p>
          <p class="timeline-badge">Timeline: Few days to 1 week</p>
        </div>
      </div>
    </section>

    <!-- HostGator -->
    <section id="hostgator" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/hostgator.com" alt="HostGator logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.hostgator.com" target="_blank" rel="noopener noreferrer">HostGator</a></h2>
          <p class="registrar-website">Big hosting company with domain registrations (via reseller system)</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>Domains registered through HostGator may actually be managed in a separate portal (LaunchPad, which is HostGator's registrar service, or sometimes through Enom).</p>
          <p>The general steps are: log in to your HostGator Domain Control Panel (or LaunchPad panel), <strong>unlock the domain</strong>, and request the auth code. HostGator's system will email you the EPP code.</p>
          <p>After that, initiate the transfer at the new registrar. You'll get an email (from LaunchPad or HostGator's registrar partner) asking for approval to transfer away – by clicking approve, you can expedite the transfer. Without approval, the domain will transfer automatically after the usual <strong>5-day period</strong>.</p>
          <div class="key-point">
            <strong>Tip:</strong> Check spam if you don't see the auth code email – HostGator's LaunchPad sometimes sends from a generic address.
          </div>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>Use HostGator's Domain Transfer form on their website. Provide the domain and EPP code and pay the fee.</p>
          <p>HostGator (LaunchPad) will then send an email to the domain's current owner to authorize the incoming transfer (and possibly another to the account email for security).</p>
          <p>Expect up to <strong>5 days</strong> for completion, although if the previous registrar was Enom/Tucows or another that HostGator works closely with, sometimes it can be quicker. HostGator's support is available 24/7 if any hiccups occur.</p>
          <p class="timeline-badge">Timeline: Up to 5 days</p>
        </div>
      </div>
    </section>

    <!-- DreamHost -->
    <section id="dreamhost" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/dreamhost.com" alt="DreamHost logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.dreamhost.com" target="_blank" rel="noopener noreferrer">DreamHost</a></h2>
          <p class="registrar-website">Web host that also serves as an ICANN-accredited registrar</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>Transferring your domain away from DreamHost is done in their panel at <strong>Domains > Registrations</strong>. In the DreamHost panel, you'll click <strong>"Unlock"</strong> next to the domain to remove the transfer lock.</p>
          <p>Then, still on the Registrations page, there's an option "Send Auth Code" or "Reveal Auth Code" (DreamHost might email it or show it on screen).</p>
          <p>Shortly after the transfer is started, DreamHost will send an email to the account owner's email address with a link to <strong>"Approve transfer away"</strong>. If you log in through that email link and click the Approve button in DreamHost's panel, DreamHost will immediately release the domain.</p>
          <p>If you don't approve it manually, the transfer will proceed automatically and complete within <strong>5–7 days</strong> (DreamHost notes up to 7 days max). So you have the choice: actively approve for a quick transfer (often within minutes), or let it time out.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>First unlock it at your current registrar and get the auth code. In the DreamHost panel, navigate to <strong>Domains > Registrations > Transfer to DreamHost</strong>, and enter your domain name(s).</p>
          <p>DreamHost will prompt for the EPP code and then begin the transfer. The domain's current registrar should send you an email to confirm you approve moving to DreamHost.</p>
          <p>DreamHost itself does not require an extra confirmation email for incoming transfers (beyond ensuring you entered the auth code correctly and paid the fee). Once the losing registrar releases the domain, DreamHost will complete the transfer (often within a few minutes after release).</p>
          <p class="timeline-badge">Timeline: Minutes to 7 days</p>
        </div>
      </div>
    </section>

    <!-- ResellerClub / BigRock -->
    <section id="resellerclub" class="registrar-section">
      <div class="registrar-header">
        <div class="registrar-logo">
          <img src="https://logo.clearbit.com/resellerclub.com" alt="ResellerClub logo" loading="lazy">
        </div>
        <div class="registrar-info">
          <h2><a href="https://www.resellerclub.com" target="_blank" rel="noopener noreferrer">ResellerClub / BigRock</a></h2>
          <p class="registrar-website">Popular registrar services (both use the LogicBoxes platform)</p>
        </div>
      </div>
      <div class="transfer-instructions">
        <div class="transfer-direction">
          <h3>Transfer Out</h3>
          <p>If your domain is with a registrar that is a ResellerClub reseller (or BigRock, which is a direct brand on that platform), the transfer-out process uses the LogicBoxes interface.</p>
          <p>You would log into the Customer Portal, navigate to the domain's overview, and set <strong>"Lock"</strong> to Disabled (unlock the domain). Then click <strong>"Send Auth Code"</strong> – the system will email the transfer code to the registrant's email.</p>
          <p>You can speed it up: in the ResellerClub portal, there is often a button to <strong>Approve Transfer</strong> (once a transfer-out request is detected). Clicking that will immediately finalize the transfer away in the next batch process. Otherwise, the transfer will auto-complete after the usual <strong>5-day window</strong>.</p>
        </div>
        <div class="transfer-direction">
          <h3>Transfer In</h3>
          <p>To transfer into a ResellerClub-managed registrar (including BigRock), you'll initiate the transfer on their website. Provide the domain and EPP code, and complete the purchase.</p>
          <p>The domain's current registrar will likely email you asking for approval to transfer out – once you approve that, the transfer will be completed by the registry.</p>
          <p>The entire process should be done within <strong>5-7 days</strong>, barring any issues. ResellerClub's system will show the status "Pending Transfer" in your account during this time.</p>
          <div class="key-point">
            <strong>Tip:</strong> If your domain's losing registrar is also on LogicBoxes (e.g., from BigRock to ResellerClub), sometimes the transfer can be near-instant because it's an internal registry move.
          </div>
          <p class="timeline-badge">Timeline: 5-7 days (potentially instant for LogicBoxes transfers)</p>
        </div>
      </div>
    </section>

  </div>
</main>

<?php get_footer(); ?>
