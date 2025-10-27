<?php
/**
 * Template Name: Sell Domain Page
 * Description: Page for domain sellers
 */

get_header();
?>

<style>
    .sell-hero {
        background: linear-gradient(135deg, var(--color-dark) 0%, var(--color-darker) 100%);
        padding: 112px 20px 80px;
        position: relative;
        overflow: hidden;
    }

    .sell-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 60%;
        height: 200%;
        background: radial-gradient(circle, rgba(0, 217, 255, 0.08) 0%, transparent 70%);
        pointer-events: none;
    }

    .sell-hero-container {
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: 1fr 450px;
        gap: 60px;
        align-items: start;
    }

    .sell-hero-content h1 {
        font-size: 3.5rem;
        font-weight: 700;
        color: var(--color-white);
        margin-bottom: 24px;
        line-height: 1.2;
    }

    .sell-hero-content .subtitle {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .hero-features {
        display: grid;
        gap: 20px;
    }

    .hero-feature {
        display: flex;
        align-items: flex-start;
        gap: 16px;
    }

    .hero-feature-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.1), rgba(46, 252, 134, 0.1));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .hero-feature-icon svg {
        width: 24px;
        height: 24px;
        fill: var(--color-accent);
    }

    .hero-feature-content h3 {
        font-size: 1.25rem;
        color: var(--color-white);
        margin-bottom: 8px;
        font-weight: 600;
    }

    .hero-feature-content p {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .sell-form-card {
        background: var(--color-white);
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        position: sticky;
        top: 100px;
    }

    .sell-form-card h2 {
        font-size: 1.5rem;
        color: var(--color-dark);
        margin-bottom: 8px;
        font-weight: 600;
    }

    .sell-form-card .form-subtitle {
        color: var(--color-text-muted);
        font-size: 0.95rem;
        margin-bottom: 24px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--color-dark);
        margin-bottom: 8px;
    }

    .form-group label .required {
        color: #ef4444;
        margin-left: 4px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid var(--color-border);
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        transition: border-color 0.2s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: var(--color-accent);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .honeypot {
        position: absolute;
        left: -9999px;
        opacity: 0;
    }

    .submit-btn {
        width: 100%;
        padding: 14px 24px;
        background: linear-gradient(135deg, #7c3aed, #a855f7);
        color: var(--color-white);
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        font-family: 'Poppins', sans-serif;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(124, 58, 237, 0.3);
    }

    .content-section {
        max-width: 1400px;
        margin: 80px auto;
        padding: 0 20px;
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 60px;
    }

    .main-content h2 {
        font-size: 2.5rem;
        color: var(--color-dark);
        margin-bottom: 24px;
        font-weight: 700;
        line-height: 1.2;
    }

    .main-content h3 {
        font-size: 1.75rem;
        color: var(--color-dark);
        margin-top: 48px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .main-content p {
        color: #4b5563;
        font-size: 1.05rem;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .benefits-list {
        list-style: none;
        padding: 0;
        margin: 32px 0;
    }

    .benefits-list li {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        margin-bottom: 20px;
        padding: 20px;
        background: var(--color-bg-light);
        border-radius: 12px;
        border-left: 4px solid var(--color-accent);
    }

    .benefits-list li svg {
        width: 24px;
        height: 24px;
        fill: var(--color-accent);
        flex-shrink: 0;
        margin-top: 2px;
    }

    .benefits-list li strong {
        color: var(--color-dark);
        font-weight: 600;
        display: block;
        margin-bottom: 6px;
    }

    .benefits-list li p {
        margin: 0;
        font-size: 0.95rem;
        color: #6b7280;
    }

    .sidebar-info {
        position: sticky;
        top: 100px;
    }

    .info-card {
        background: var(--color-white);
        border: 1px solid var(--color-border);
        border-radius: 16px;
        padding: 28px;
        margin-bottom: 24px;
    }

    .info-card h4 {
        font-size: 1.25rem;
        color: var(--color-dark);
        margin-bottom: 16px;
        font-weight: 600;
    }

    .info-card p {
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 12px;
    }

    .info-stat {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }

    .info-stat svg {
        width: 32px;
        height: 32px;
        fill: var(--color-green);
    }

    .info-stat-content {
        flex: 1;
    }

    .info-stat-number {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--color-dark);
        line-height: 1;
    }

    .info-stat-label {
        font-size: 0.85rem;
        color: #6b7280;
        margin-top: 4px;
    }

    .cta-section {
        background: linear-gradient(135deg, var(--color-purple), var(--color-purple-light));
        padding: 60px 20px;
        margin: 80px auto;
        max-width: 900px;
        border-radius: 16px;
        text-align: center;
    }

    .cta-section h3 {
        font-size: 2rem;
        color: var(--color-white);
        margin-bottom: 20px;
        font-weight: 700;
    }

    .cta-section p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.1rem;
        margin-bottom: 32px;
        line-height: 1.6;
    }

    .cta-btn {
        display: inline-block;
        padding: 16px 48px;
        background: var(--color-white);
        color: var(--color-purple);
        border-radius: 8px;
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .process-steps {
        display: grid;
        gap: 24px;
        margin: 40px 0;
    }

    .process-step {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    .step-number {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--color-accent), var(--color-green));
        color: var(--color-white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .step-content h4 {
        font-size: 1.25rem;
        color: var(--color-dark);
        margin-bottom: 8px;
        font-weight: 600;
    }

    .step-content p {
        color: #6b7280;
        font-size: 0.95rem;
        margin: 0;
    }

    @media (max-width: 768px) {
        .sell-hero-container {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .sell-form-card {
            position: static;
        }

        .content-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .sidebar-info {
            position: static;
        }

        .sell-hero-content h1 {
            font-size: 2.5rem;
        }

        .main-content h2 {
            font-size: 2rem;
        }
    }

    .form-error {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 4px;
        display: none;
    }

    .form-success {
        background: #d1fae5;
        color: #065f46;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: none;
    }
</style>

<section class="sell-hero">
    <div class="sell-hero-container">
        <div class="sell-hero-content">
            <h1>Sell Your Domain Name Fast</h1>
            <p class="subtitle">Looking to sell your domain quickly at a fair price? We are always searching for quality domain names to power our projects and the ventures in our network.</p>

            <div class="hero-features">
                <div class="hero-feature">
                    <div class="hero-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M13 2L3 14h8l-1 8 10-12h-8l1-8z"/>
                        </svg>
                    </div>
                    <div class="hero-feature-content">
                        <h3>Quick Turnaround</h3>
                        <p>Get an offer within 24-48 hours and close the deal in days, not months.</p>
                    </div>
                </div>

                <div class="hero-feature">
                    <div class="hero-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
                        </svg>
                    </div>
                    <div class="hero-feature-content">
                        <h3>Active Buyers Network</h3>
                        <p>We buy domains for our growing portfolio of digital ventures and partner businesses.</p>
                    </div>
                </div>

                <div class="hero-feature">
                    <div class="hero-feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                        </svg>
                    </div>
                    <div class="hero-feature-content">
                        <h3>Simple Process</h3>
                        <p>No middlemen, no commissions. Direct purchase with secure transfer and fast payment.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="sell-form-card">
            <h2>Get Your Offer</h2>
            <p class="form-subtitle">Fill out the form below and we will review your domain within 1-2 business days.</p>

            <div class="form-success" id="formSuccess">
                Thank you! We have received your submission and will be in touch soon.
            </div>

            <form id="sellDomainForm" method="post" action="">
                <input type="hidden" name="action" value="submit_domain_sell">
                <input type="hidden" name="sell_domain_nonce" value="<?php echo wp_create_nonce('sell_domain_form'); ?>">
                <input type="text" name="website" class="honeypot" tabindex="-1" autocomplete="off">

                <div class="form-group">
                    <label>First Name <span class="required">*</span></label>
                    <input type="text" name="first_name" required>
                    <div class="form-error" id="firstNameError">Please enter your first name</div>
                </div>

                <div class="form-group">
                    <label>Last Name <span class="required">*</span></label>
                    <input type="text" name="last_name" required>
                    <div class="form-error" id="lastNameError">Please enter your last name</div>
                </div>

                <div class="form-group">
                    <label>Email Address <span class="required">*</span></label>
                    <input type="email" name="email" required>
                    <div class="form-error" id="emailError">Please enter a valid email address</div>
                </div>

                <div class="form-group">
                    <label>Domain Name <span class="required">*</span></label>
                    <input type="text" name="domain_name" placeholder="example.com" required>
                    <div class="form-error" id="domainError">Please enter your domain name</div>
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone">
                </div>

                <div class="form-group">
                    <label>Additional Information</label>
                    <textarea name="message" placeholder="Tell us about your domain, asking price, or any other details..."></textarea>
                </div>

                <button type="submit" class="submit-btn">Submit Domain</button>
            </form>
        </div>
    </div>
</section>

<section class="content-section">
    <div class="content-grid">
        <div class="main-content">
            <h2>Why Sell Your Domain to S Ventures</h2>
            <p>We are not your typical domain broker. Instead of waiting months for the perfect buyer willing to pay top dollar, we offer a faster, more straightforward approach. S Ventures is constantly launching new digital projects, websites, and ventures - and we need quality domain names to bring these ideas to life.</p>

            <p>When you sell to us, your domain gets put to use quickly. We are building an ecosystem of digital businesses, and every domain we acquire becomes part of something bigger. Whether it is for our own ventures or for businesses in our network, we value domains that inspire creativity and fit our growing portfolio.</p>

            <h3>What Makes Us Different</h3>
            <p>Traditional domain sales can be slow and uncertain. Brokers take commissions, negotiations drag on, and buyers disappear. We take a different approach focused on speed and value.</p>

            <ul class="benefits-list">
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                    </svg>
                    <div>
                        <strong>Direct Acquisition</strong>
                        <p>We buy domains for our own use, not to resell. This means faster decisions and simpler transactions with no third-party delays.</p>
                    </div>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                    </svg>
                    <div>
                        <strong>Name Inspiration Focus</strong>
                        <p>We look for domains that spark ideas and fit naturally with our business concepts. If your domain has strong branding potential, we want to hear from you.</p>
                    </div>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                    </svg>
                    <div>
                        <strong>Network Opportunities</strong>
                        <p>Beyond our own projects, we acquire domains for ventures in our business network, expanding the range of names we are interested in.</p>
                    </div>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                    </svg>
                    <div>
                        <strong>Fair Market Value</strong>
                        <p>While we are not paying premium prices, we offer competitive rates that reflect current market conditions and the practical value of the domain.</p>
                    </div>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                    </svg>
                    <div>
                        <strong>Secure Transfers</strong>
                        <p>All transactions are handled through trusted escrow services, ensuring safe and professional domain transfers every time.</p>
                    </div>
                </li>
            </ul>

            <h3>Domains We Are Looking For</h3>
            <p>Our portfolio spans many industries and niches. We acquire domains for technology startups, digital services, content platforms, e-commerce ventures, and more. The common thread is that each domain should have strong branding potential and inspire business ideas.</p>

            <p>We typically look for short, memorable names that are easy to spell and have broad appeal. Single-word domains, brandable two-word combinations, and creative coined terms all catch our attention. While we consider all extensions, we have a preference for .com, .co, .io, and industry-specific extensions that align with our projects.</p>

            <p>Even if your domain does not fit these exact criteria, we encourage you to submit it. We review every submission and you might be surprised by what sparks our interest.</p>

            <div class="cta-section">
                <h3>Ready to Sell Your Domain?</h3>
                <p>Submit your domain using the form above and get a response within 1-2 business days. We review every submission personally and provide straightforward feedback.</p>
                <a href="#sellDomainForm" class="cta-btn">Sell Your Domain Name</a>
            </div>

            <h3>Our Acquisition Process</h3>
            <p>Selling a domain to S Ventures is designed to be as simple and transparent as possible. Here is exactly what happens after you submit your domain through our form.</p>

            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h4>Submit Your Domain</h4>
                        <p>Fill out the form with your domain details. Include any relevant information about traffic, history, or why you think it would be a good fit for our ventures.</p>
                    </div>
                </div>

                <div class="process-step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h4>Initial Review</h4>
                        <p>Our team reviews your submission within 1-2 business days. We evaluate the domain based on branding potential, relevance to our projects, and market value.</p>
                    </div>
                </div>

                <div class="process-step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h4>Offer or Feedback</h4>
                        <p>If we are interested, we will send you a straightforward offer. If the domain is not a fit right now, we will let you know and may keep it on file for future consideration.</p>
                    </div>
                </div>

                <div class="process-step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h4>Agreement and Transfer</h4>
                        <p>Once we agree on terms, we initiate the transfer through a secure escrow service. You will receive payment as soon as the domain is successfully transferred.</p>
                    </div>
                </div>
            </div>

            <h3>Frequently Asked Questions</h3>
            <p>We know selling a domain can raise questions, especially if you have never done it before. Here are answers to some common questions from domain sellers.</p>

            <p><strong>How quickly will I hear back?</strong> We review submissions within 1-2 business days. If we are interested in your domain, we will reach out with an offer. Even if we pass, we will send you a brief response so you are not left wondering.</p>

            <p><strong>What price can I expect?</strong> Our offers are based on current market comparables, the domain's characteristics, and how well it fits our needs. We are transparent about our evaluation and happy to explain how we arrived at our offer. Keep in mind we are looking for value acquisitions, not premium pricing.</p>

            <p><strong>Do you buy all types of domains?</strong> We focus on domains with strong branding potential that could work for our ventures or network businesses. While we consider all submissions, we are most interested in short, memorable names with broad commercial appeal.</p>

            <p><strong>Is there a minimum or maximum value?</strong> We do not have strict limits, but we typically focus on domains in the lower to mid-range market. If you have a premium domain worth six figures, we may not be the right buyer. For everything else, we are happy to take a look.</p>

            <p><strong>What happens after I accept an offer?</strong> We will coordinate the transfer through a reputable escrow service like Escrow.com or Dan.com. This protects both parties and ensures a smooth transaction. Once the domain is transferred and verified, payment is released to you.</p>

            <p><strong>Can I negotiate the offer?</strong> Absolutely. Our initial offer is based on our evaluation, but we are open to discussion. If you have specific reasons why the domain is worth more, we are happy to listen and consider adjusting our offer.</p>

            <h3>Get Started Today</h3>
            <p>If you have a domain sitting unused and want to turn it into cash quickly, we would love to hear from you. Use the form at the top of this page to submit your domain, and we will get back to you within 1-2 business days with our evaluation. It is that simple.</p>

            <p>S Ventures is committed to building valuable digital properties, and your domain could be the perfect fit for our next project. Let us take a look and see if we can make a deal that works for both of us.</p>
        </div>

        <div class="sidebar-info">
            <div class="info-card">
                <h4>Why We Buy Domains</h4>
                <p>We are constantly developing new digital ventures and need quality domain names to bring our ideas to market.</p>
                <p>Every domain we acquire serves a purpose - whether it is launching a new platform, rebranding an existing project, or supporting ventures in our business network.</p>
            </div>

            <div class="info-card">
                <div class="info-stat">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    <div class="info-stat-content">
                        <div class="info-stat-number">24-48</div>
                        <div class="info-stat-label">Hour Response Time</div>
                    </div>
                </div>
                <p>Get a decision on your domain within 1-2 business days, not weeks or months.</p>
            </div>

            <div class="info-card">
                <h4>Active Portfolio</h4>
                <p>We manage an active portfolio of digital ventures across multiple industries including technology, media, services, and e-commerce.</p>
                <p>Our diverse interests mean we evaluate domains with a wide lens, looking for names that could fit various business concepts.</p>
            </div>

            <div class="info-card">
                <h4>Secure Transactions</h4>
                <p>All domain transfers are handled through established escrow services, providing security and peace of mind for both parties.</p>
                <p>We follow industry-standard transfer procedures and ensure you are paid promptly once the domain is successfully transferred.</p>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('sellDomainForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Basic spam check - honeypot
    if (document.querySelector('input[name="website"]').value !== '') {
        return false;
    }

    // Get form data
    const formData = new FormData(this);

    // Basic validation
    let hasError = false;

    if (!formData.get('first_name')) {
        document.getElementById('firstNameError').style.display = 'block';
        hasError = true;
    } else {
        document.getElementById('firstNameError').style.display = 'none';
    }

    if (!formData.get('last_name')) {
        document.getElementById('lastNameError').style.display = 'block';
        hasError = true;
    } else {
        document.getElementById('lastNameError').style.display = 'none';
    }

    const email = formData.get('email');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email || !emailRegex.test(email)) {
        document.getElementById('emailError').style.display = 'block';
        hasError = true;
    } else {
        document.getElementById('emailError').style.display = 'none';
    }

    if (!formData.get('domain_name')) {
        document.getElementById('domainError').style.display = 'block';
        hasError = true;
    } else {
        document.getElementById('domainError').style.display = 'none';
    }

    if (hasError) {
        return false;
    }

    // Submit via AJAX
    fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('formSuccess').style.display = 'block';
            document.getElementById('sellDomainForm').reset();
            // Scroll to success message
            document.getElementById('formSuccess').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

// Smooth scroll for CTA button
document.querySelector('.cta-btn').addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('sellDomainForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
});
</script>

<?php get_footer(); ?>
