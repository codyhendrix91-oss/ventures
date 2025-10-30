<?php
/**
 * Template Name: Contact Page
 * Description: Custom contact page template for S.Ventures
 */
get_header();
?>

<style>
.contact-hero {
  background: linear-gradient(135deg, #1a1d35 0%, #0a0e27 100%);
  padding: calc(62px + 80px) 20px 70px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.contact-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(0, 217, 255, 0.08) 0%, transparent 70%);
  pointer-events: none;
}

.contact-hero__inner {
  max-width: 900px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.contact-hero h1 {
  font-size: clamp(36px, 6vw, 52px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 20px;
  line-height: 1.1;
  letter-spacing: -0.02em;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
}

.contact-hero__subtitle {
  font-size: clamp(18px, 3vw, 20px);
  color: rgba(255, 255, 255, 0.9);
  margin: 0 auto;
  line-height: 1.6;
  max-width: 700px;
}

.contact-section {
  padding: 70px 20px;
  background: #fff;
}

.contact-section--gray {
  background: #f9fafb;
}

.contact-section__inner {
  max-width: 1100px;
  margin: 0 auto;
}

.contact-section h2 {
  font-size: clamp(28px, 5vw, 34px);
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 28px;
  line-height: 1.2;
  text-align: center;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
}

.contact-section p {
  font-size: 17px;
  line-height: 1.75;
  color: #4b5563;
  margin: 0 0 20px;
}

.contact-methods {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
  margin: 50px 0;
}

.contact-method {
  background: #fff;
  padding: 32px;
  border-radius: 16px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  gap: 16px;
  border: 1px solid #f3f4f6;
}

.contact-method:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
  border-color: rgba(0, 217, 255, 0.3);
}

.contact-method__icon {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 8px;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
}

.contact-method__icon svg {
  width: 26px;
  height: 26px;
  color: #fff;
}

.contact-method__icon--email {
  background: linear-gradient(135deg, #EA4335 0%, #C5221F 100%);
}

.contact-method__icon--whatsapp {
  background: linear-gradient(135deg, #25D366 0%, #1DA851 100%);
}

.contact-method__icon--telegram {
  background: linear-gradient(135deg, #0088cc 0%, #0077B5 100%);
}

.contact-method__icon--sms {
  background: linear-gradient(135deg, #5AC8FA 0%, #3BA5D9 100%);
}

.contact-method h3 {
  font-size: 22px;
  font-weight: 600;
  color: #1a1d35;
  margin: 0 0 8px;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
}

.contact-method p {
  font-size: 15px;
  margin: 0 0 16px;
  color: #4b5563;
}

.contact-method__link {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 11px 24px;
  background: linear-gradient(135deg, #2efc86 0%, #00d9ff 100%);
  color: #fff;
  text-decoration: none;
  border-radius: 50px;
  font-weight: 600;
  font-size: 15px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 12px rgba(46, 252, 134, 0.25);
  align-self: flex-start;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
}

.contact-method__link:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(46, 252, 134, 0.35);
}

.contact-method__link svg {
  width: 16px;
  height: 16px;
}

.tips-list {
  background: linear-gradient(135deg, rgba(0, 217, 255, 0.08) 0%, rgba(0, 217, 255, 0.03) 100%);
  border-left: 4px solid #00d9ff;
  padding: 32px;
  border-radius: 12px;
  margin: 40px 0;
}

.tips-list h3 {
  font-size: 22px;
  font-weight: 600;
  color: #1a1d35;
  margin: 0 0 20px;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
}

.tips-list ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.tips-list li {
  font-size: 16px;
  line-height: 1.7;
  color: #4b5563;
  margin-bottom: 16px;
  padding-left: 32px;
  position: relative;
}

.tips-list li:last-child {
  margin-bottom: 0;
}

.tips-list li::before {
  content: '✓';
  position: absolute;
  left: 0;
  color: #00d9ff;
  font-weight: 700;
  font-size: 20px;
}

.tips-list strong {
  color: #1a1d35;
  font-weight: 600;
}

.trust-badges {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
  margin: 50px 0;
  text-align: center;
}

.trust-badge__number {
  font-size: 40px;
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 8px;
  line-height: 1;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
}

.trust-badge__text {
  font-size: 15px;
  color: #4b5563;
  margin: 0;
  line-height: 1.4;
}

.cta-section {
  background: linear-gradient(135deg, #1a1d35 0%, #0a0e27 100%);
  padding: 70px 20px;
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
  font-size: clamp(30px, 5vw, 38px);
  color: #fff;
  margin: 0 0 20px;
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
}

.cta-section p {
  font-size: clamp(17px, 3vw, 19px);
  color: rgba(255, 255, 255, 0.9);
  margin: 0 0 36px;
  line-height: 1.6;
}

.cta-buttons {
  display: flex;
  gap: 16px;
  justify-content: center;
  flex-wrap: wrap;
}

.cta-btn {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  padding: 15px 36px;
  background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
  color: #fff;
  border-radius: 50px;
  font-size: 16px;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 4px 16px rgba(124, 58, 237, 0.3);
  font-family: Poppins, Avenir, Helvetica, Arial, sans-serif;
}

.cta-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(124, 58, 237, 0.45);
}

.cta-btn svg {
  width: 18px;
  height: 18px;
}

.cta-btn--secondary {
  background: linear-gradient(135deg, #2efc86 0%, #00d9ff 100%);
  color: #fff;
  border: none;
  box-shadow: 0 4px 16px rgba(46, 252, 134, 0.3);
}

.cta-btn--secondary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(46, 252, 134, 0.45);
}

@media (max-width: 1024px) {
  .contact-methods { grid-template-columns: 1fr; gap: 24px; }
  .trust-badges { grid-template-columns: repeat(2, 1fr); gap: 24px; }
}

@media (max-width: 768px) {
  .contact-hero { padding: calc(62px + 60px) 20px 50px; }
  .contact-section { padding: 50px 20px; }
  .contact-method { padding: 24px; }
  .tips-list { padding: 24px; }
  .trust-badges { grid-template-columns: 1fr; }
  .cta-section { padding: 50px 20px; }
  .cta-buttons { flex-direction: column; align-items: stretch; }
  .cta-btn { width: 100%; justify-content: center; }
}
</style>

<!-- Hero Section -->
<section class="contact-hero">
  <div class="contact-hero__inner">
    <h1>Let's Start a Conversation</h1>
    <p class="contact-hero__subtitle">Every great business starts with a simple message. Whether you're ready to buy a premium domain, sell one from your portfolio, or explore partnership opportunities, we'd love to hear from you.</p>
  </div>
</section>

<!-- Intro Section -->
<section class="contact-section">
  <div class="contact-section__inner">
    <p style="text-align:center; font-size:18px; max-width:800px; margin:0 auto 40px;">We work with founders, startups, and creative thinkers who want to build something that lasts. If that sounds like you, reach out today. We reply quickly and take every message seriously.</p>
  </div>
</section>

<!-- Contact Methods -->
<section class="contact-section contact-section--gray">
  <div class="contact-section__inner">
    <h2>How to Reach Us</h2>
    <p style="text-align:center; max-width:700px; margin:0 auto 20px;">We keep things personal and easy. Choose what works best for you and our team will get back to you within one business day.</p>
    
    <div class="contact-methods">
      <div class="contact-method">
        <div class="contact-method__icon contact-method__icon--email">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
          </svg>
        </div>
        <h3>Email</h3>
        <p>Send us a message anytime. This is the best way to reach our main team for questions, offers, or introductions.</p>
        <a href="mailto:info@s.ventures" class="contact-method__link">
          info@s.ventures
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
        </a>
      </div>
      
      <div class="contact-method">
        <div class="contact-method__icon contact-method__icon--whatsapp">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
          </svg>
        </div>
        <h3>WhatsApp</h3>
        <p>Start a quick chat for pricing, availability, or domain inquiries. Perfect for fast responses.</p>
        <a href="https://wa.me/12817261751?text=Hi,%20I'd%20like%20to%20connect%20with%20S%20Ventures" class="contact-method__link" target="_blank" rel="noopener">
          Message on WhatsApp
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
        </a>
      </div>
      
      <div class="contact-method">
        <div class="contact-method__icon contact-method__icon--telegram">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M9.78 18.65l.28-4.23 7.68-6.92c.34-.31-.07-.46-.52-.19L7.74 13.3 3.64 12c-.88-.25-.89-.86.2-1.3l15.97-6.16c.73-.33 1.43.18 1.15 1.3l-2.72 12.81c-.19.91-.74 1.13-1.5.71L12.6 16.3l-1.99 1.93c-.23.23-.42.42-.83.42z"/>
          </svg>
        </div>
        <h3>Telegram</h3>
        <p>If you prefer a secure conversation, we're available on Telegram for encrypted messaging.</p>
        <a href="https://t.me/s_ventures?text=Hi,%20I'd%20like%20to%20connect%20with%20S%20Ventures" class="contact-method__link" target="_blank" rel="noopener">
          Connect on Telegram
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
        </a>
      </div>
      
      <div class="contact-method">
        <div class="contact-method__icon contact-method__icon--sms">
          <svg viewBox="0 0 24 24" fill="currentColor">
            <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM9 11H7V9h2v2zm4 0h-2V9h2v2zm4 0h-2V9h2v2z"/>
          </svg>
        </div>
        <h3>Text Message</h3>
        <p>Send us an SMS and we'll reply or set up a time to talk. Simple and direct.</p>
        <a href="sms:+12815295954&body=Hi,%20I'd%20like%20to%20connect%20with%20S%20Ventures" class="contact-method__link">
          Text +1 (281) 529-5954
          <svg viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
          </svg>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- Tips Section -->
<section class="contact-section">
  <div class="contact-section__inner">
    <div class="tips-list">
      <h3>What to Include in Your Message</h3>
      <p style="margin-bottom:20px;">To help us respond quickly, please include a few details:</p>
      <ul>
        <li><strong>If you're buying a domain:</strong> Tell us which name you're interested in or what type of business you're starting.</li>
        <li><strong>If you're selling a domain:</strong> Share the name you want to sell and any price range or timeline you have in mind.</li>
        <li><strong>If you want to partner with us:</strong> Let us know what you're building and how we might collaborate.</li>
      </ul>
      <p style="margin-top:24px; font-size:15px; font-style:italic;">We treat every message with confidentiality and respect. Your ideas and assets are always safe with us.</p>
    </div>
  </div>
</section>

<!-- Trust Section -->
<section class="contact-section contact-section--gray">
  <div class="contact-section__inner">
    <h2>Why People Trust S Ventures</h2>
    <div class="trust-badges">
      <div class="trust-badge">
        <div class="trust-badge__number">20+</div>
        <div class="trust-badge__text">Years of Experience</div>
      </div>
      <div class="trust-badge">
        <div class="trust-badge__number">100%</div>
        <div class="trust-badge__text">Human Approach</div>
      </div>
      <div class="trust-badge">
        <div class="trust-badge__number">24hr</div>
        <div class="trust-badge__text">Response Time</div>
      </div>
      <div class="trust-badge">
        <div class="trust-badge__number">Global</div>
        <div class="trust-badge__text">Client Base</div>
      </div>
    </div>
    <p style="text-align:center; max-width:800px; margin:40px auto 0;">We know what it takes to build trust online. Every interaction reflects our commitment to transparency, security, and client success across technology, e-commerce, finance, and beyond.</p>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
  <div class="cta-section__inner">
    <h2>Ready to Connect?</h2>
    <p>Reach out today and tell us what you're working on. Whether you need a strong brand name or want to turn your unused domains into profit, S Ventures is ready to help.</p>
    <div class="cta-buttons">
      <a href="mailto:info@s.ventures" class="cta-btn">
        <svg viewBox="0 0 24 24" fill="currentColor">
          <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
        </svg>
        Send Email
      </a>
      <a href="<?php echo get_post_type_archive_link('domains'); ?>" class="cta-btn cta-btn--secondary">
        Browse Domains
      </a>
    </div>
  </div>
</section>


<?php get_footer(); ?>