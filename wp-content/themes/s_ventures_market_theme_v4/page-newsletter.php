<?php
/**
 * Template Name: Newsletter Signup
 * Description: Standalone newsletter signup page for external links (like Impact.com)
 */

get_header();
?>

<main class="svm-newsletter-page">
  <section class="svm-newsletter-hero">
    <div class="svm-newsletter-hero__inner">
      <h1>Subscribe to Re.Ventures</h1>
      <p class="svm-newsletter-hero__subtitle">
        Because you deserve better than recycled LinkedIn advice, made up X stories and founders patting themselves on the back.
      </p>
    </div>
  </section>

  <section class="svm-newsletter-form-section">
    <div class="svm-newsletter-form-container">
      <?php echo svm_newsletter_form(true); ?>

      <div class="svm-newsletter-benefits">
        <h3>What you'll get:</h3>
        <ul>
          <li>Weekly insights on premium domains and digital real estate</li>
          <li>Exclusive opportunities before they hit the market</li>
          <li>Industry trends and expert analysis</li>
          <li>No spam, unsubscribe anytime</li>
        </ul>
      </div>
    </div>
  </section>
</main>

<style>
.svm-newsletter-page {
  background: #f9fafb;
  min-height: 100vh;
}

.svm-newsletter-hero {
  background: linear-gradient(135deg, #1a1d35 0%, #0a0e27 100%);
  padding: calc(var(--header-height) + 120px) 24px 120px;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.svm-newsletter-hero::before {
  content: '';
  position: absolute;
  inset: 0;
  background: radial-gradient(circle at 50% 50%, rgba(91, 33, 182, 0.2) 0%, transparent 70%);
  pointer-events: none;
}

.svm-newsletter-hero__inner {
  max-width: 800px;
  margin: 0 auto;
  position: relative;
  z-index: 1;
}

.svm-newsletter-hero h1 {
  font-size: clamp(36px, 5vw, 56px);
  font-weight: 700;
  color: #fff;
  margin: 0 0 24px;
  font-family: 'Colour Brown', sans-serif;
  line-height: 1.1;
}

.svm-newsletter-hero__subtitle {
  font-size: clamp(18px, 2.5vw, 22px);
  color: rgba(255, 255, 255, 0.9);
  margin: 0;
  line-height: 1.6;
}

.svm-newsletter-form-section {
  padding: 80px 24px;
}

.svm-newsletter-form-container {
  max-width: 700px;
  margin: 0 auto;
  background: #ffffff;
  border-radius: 20px;
  padding: 50px;
  box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
}

.svm-newsletter-benefits {
  margin-top: 50px;
  padding-top: 40px;
  border-top: 1px solid #e8e9ea;
}

.svm-newsletter-benefits h3 {
  font-size: 20px;
  font-weight: 700;
  color: #1a1d35;
  margin: 0 0 20px;
  font-family: 'Colour Brown', sans-serif;
}

.svm-newsletter-benefits ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.svm-newsletter-benefits li {
  padding: 12px 0 12px 32px;
  position: relative;
  color: #4b5563;
  font-size: 16px;
  line-height: 1.6;
}

.svm-newsletter-benefits li::before {
  content: '✓';
  position: absolute;
  left: 0;
  color: #7c3aed;
  font-weight: 700;
  font-size: 18px;
}

@media (max-width: 768px) {
  .svm-newsletter-hero {
    padding: calc(var(--header-height) + 80px) 20px 80px;
  }

  .svm-newsletter-form-container {
    padding: 30px 24px;
  }

  .svm-newsletter-form-section {
    padding: 60px 20px;
  }
}
</style>

<?php get_footer(); ?>
