<?php
/**
 * Template Name: About Page
 * Description: Complete redesign with company overview and SEO optimization
 */
get_header();
?>

<style>
.about-hero {
  background: linear-gradient(135deg, #1a1d35 0%, #0a0e27 100%);
  padding: calc(70px + 80px) 20px 80px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.about-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.08) 0%, transparent 70%);
  pointer-events: none;
}

.about-hero__inner {
  max-width: 900px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.about-hero h1 {
  font-size: clamp(36px, 6vw, 56px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 24px;
  line-height: 1.1;
  letter-spacing: -0.02em;
  font-family: 'Colour Brown', sans-serif;
}

.about-hero__subtitle {
  font-size: clamp(18px, 3vw, 22px);
  color: rgba(255, 255, 255, 0.9);
  margin: 0;
  line-height: 1.5;
}

.about-section {
  padding: 80px 20px;
  background: #fff;
}

.about-section--gray {
  background: #f9fafb;
}

.about-section__inner {
  max-width: 1100px;
  margin: 0 auto;
}

.about-section h2 {
  font-size: clamp(28px, 5vw, 36px);
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 32px;
  line-height: 1.2;
  font-family: 'Colour Brown', sans-serif;
}

.about-section h3 {
  font-size: clamp(20px, 4vw, 24px);
  font-weight: 600;
  color: #1a1d35;
  margin: 48px 0 20px;
  line-height: 1.3;
  font-family: 'Colour Brown', sans-serif;
}

.about-section h3:first-child {
  margin-top: 0;
}

.about-section p {
  font-size: 17px;
  line-height: 1.75;
  color: #4b5563;
  margin: 0 0 24px;
}

.about-section p:last-child {
  margin-bottom: 0;
}

.about-section a {
  color: #00d9ff;
  text-decoration: underline;
  transition: color 0.2s ease;
}

.about-section a:hover {
  color: #00b8d9;
}

.two-column {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  margin-top: 48px;
}

.column h3 {
  margin-top: 0;
}

.highlight-box {
  background: linear-gradient(135deg, rgba(0, 217, 255, 0.08) 0%, rgba(0, 217, 255, 0.03) 100%);
  border-left: 4px solid #00d9ff;
  padding: 32px;
  margin: 40px 0;
  border-radius: 12px;
}

.highlight-box p {
  font-size: 18px;
  font-weight: 500;
  color: #1a1d35;
  margin: 0;
  line-height: 1.7;
}

.features-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 32px;
  margin: 48px 0;
}

.feature-card {
  background: #fff;
  padding: 32px;
  border-radius: 16px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  border: 1px solid #f3f4f6;
}

.feature-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
  border-color: rgba(0, 217, 255, 0.3);
}

.feature-card h3 {
  margin: 0 0 16px;
  font-size: 20px;
}

.feature-card p {
  font-size: 15px;
  margin: 0;
}

.cta-section {
  background: linear-gradient(135deg, #1a1d35 0%, #0a0e27 100%);
  padding: 80px 20px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.cta-section::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 70% 30%, rgba(0, 217, 255, 0.08) 0%, transparent 60%);
  pointer-events: none;
}

.cta-section__inner {
  max-width: 800px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.cta-section h2 {
  font-size: clamp(32px, 5vw, 42px);
  color: #fff;
  margin: 0 0 24px;
  font-family: 'Colour Brown', sans-serif;
}

.cta-section p {
  font-size: clamp(17px, 3vw, 20px);
  color: rgba(255, 255, 255, 0.9);
  margin: 0 0 40px;
}

.cta-buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.cta-btn {
  display: inline-block;
  padding: 16px 40px;
  background: linear-gradient(135deg, #00d9ff 0%, #00b8d9 100%);
  color: #fff;
  border-radius: 50px;
  font-size: 17px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 4px 16px rgba(0, 217, 255, 0.3);
  font-family: 'Colour Brown', sans-serif;
}

.cta-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(0, 217, 255, 0.45);
}

.cta-btn--secondary {
  background: rgba(255, 255, 255, 0.15);
  color: #fff;
  border: 2px solid rgba(255, 255, 255, 0.3);
  backdrop-filter: blur(10px);
}

.cta-btn--secondary:hover {
  background: rgba(255, 255, 255, 0.25);
  border-color: rgba(255, 255, 255, 0.5);
}

.btn-grad-azure { background: linear-gradient(135deg, #2efc86 0%, #00d9ff 100%); color:#fff; }
.btn-grad-azure:hover { filter: brightness(1.05); }

@media (max-width: 1024px) {
  .two-column { gap: 40px; }
  .features-grid { grid-template-columns: 1fr; gap: 24px; }
}

@media (max-width: 768px) {
  .about-hero { padding: calc(70px + 60px) 20px 60px; }
  .about-section { padding: 60px 20px; }
  .two-column { grid-template-columns: 1fr; gap: 32px; }
  .highlight-box { padding: 24px; margin: 32px 0; }
  .cta-section { padding: 60px 20px; }
  .cta-buttons { flex-direction: column; align-items: stretch; }
  .cta-btn { width: 100%; text-align: center; }
}
</style>

<!-- Hero Section -->
<section class="about-hero">
  <div class="about-hero__inner">
    <h1>Turning Visionary Names into Venture Success</h1>
    <p class="about-hero__subtitle">We're not your typical domain seller — we're the venture capitalists of brand names, with 20+ years of experience building the perfect portfolio.</p>
  </div>
</section>

<!-- Who We Are -->
<section class="about-section">
  <div class="about-section__inner">
    <h2>Who We Are</h2>
    <p>S Ventures began as an internal incubator for big ideas. Our founders and partners have launched software platforms, explored cutting-edge AI technologies, dabbled in e-commerce, and built companies in home services and finance. In all those ventures, one thing remained constant: our obsession with finding the perfect name.</p>
    
    <p>We hunted down short, memorable .coms, intuitive .AI addresses, and brandable names that make you say "aha!" — so that each new project had a strong foundation. Over time, our "name vault" grew into an enviable collection of high-value domains. Some became the cornerstone of successful businesses; others, however, ended up as unused treasures when plans pivoted or projects didn't get off the ground.</p>
    
    <div class="highlight-box">
      <p>Think of domain names as the skyscrapers of the internet — and we've been busy acquiring some of the choicest properties on the skyline.</p>
    </div>
  </div>
</section>

<!-- What We Do -->
<section class="about-section about-section--gray">
  <div class="about-section__inner">
    <h2>What We Do</h2>
    <p>Today, S Ventures serves as the bridge between opportunity and innovation. We realized that for every great domain we're holding, there's a passionate entrepreneur or marketing team out there who could turn it into a thriving brand. So rather than keeping our collection locked away, we're offering it to fellow dreamers and builders.</p>
    
    <div class="features-grid">
      <div class="feature-card">
        <h3>Domain Marketplace</h3>
        <p>Browse our portfolio to find names that can define an industry. From ultra-short, catchy .coms to keyword-rich names in tech, AI, finance, and more. All domains available for sale or lease-to-own with flexible payment options.</p>
      </div>
      
      <div class="feature-card">
        <h3>Strategic Partnerships</h3>
        <p>We're open to equity or revenue-sharing arrangements for select ventures. If you're a startup with a brilliant concept but limited funds, we'll invest our domain into your company in exchange for a stake or revenue share.</p>
      </div>
      
      <div class="feature-card">
        <h3>Acquisition & Brokerage</h3>
        <p>Need a name that's not in our catalog? We offer consulting and brokerage services to acquire domain names on your behalf, or to help sell your existing domain to the right buyer.</p>
      </div>
    </div>
    
    <h3>Strategic Partnerships</h3>
    <p>Here's where we really break the mold — S Ventures is open to equity or revenue-sharing arrangements for select ventures. If you're a startup with a brilliant concept but limited funds, talk to us. In some cases, we'll invest our domain into your company in exchange for a stake or revenue share.</p>
    
    <p>We've seen how a premium name can catapult a startup's credibility. Ever hear the story of how Uber got Uber.com for a small equity deal? It turned a taxi app into a global platform. We're not just sellers; we're potential partners in your success.</p>
  </div>
</section>

<!-- Why We're Different -->
<section class="about-section">
  <div class="about-section__inner">
    <h2>Why We're Different</h2>
    <p>We call ourselves S Ventures because we view each domain as a startup venture in the making. When you work with us, you're not dealing with a random domain flipper looking for a quick buck. You're collaborating with a team that understands startups, branding, and growth.</p>
    
    <div class="two-column">
      <div class="column">
        <h3>We Speak Startup</h3>
        <p>Whether you're a scrappy founder, a marketing lead, or a fellow domain investor, we know your challenges and we're here to add value. Our advice is free, our approach is consultative.</p>
      </div>
      
      <div class="column">
        <h3>Best of Both Worlds</h3>
        <p>We combine the scale and seriousness of a venture firm with the agility and heart of a boutique agency. We have a substantial portfolio and the backing of years in business, but every client gets personal attention.</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
  <div class="cta-section__inner">
    <h2>Ready to Venture?</h2>
    <p>Whether you're here to buy a killer domain, sell one, or just browse and learn, we welcome you to S Ventures. Let's find the perfect name for your next big idea.</p>
    <div class="cta-buttons">
      <a href="<?php echo get_post_type_archive_link('domains'); ?>" class="cta-btn">Browse Premium Domains</a>
      <a href="mailto:info@s.ventures?subject=General Inquiry" class="cta-btn btn-grad-azure">Get in Touch</a>
    </div>
  </div>
</section>


<?php get_footer(); ?>