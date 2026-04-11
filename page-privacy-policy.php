<?php
/**
 * Template Name: Privacy Policy
 */
get_header();
$updated  = 'April 2026';
$contact  = get_permalink( get_page_by_path('contact') ) ?: home_url('/contact/');
?>

<div class="legal-page">

  <div class="legal-hero">
    <div class="tag">Site Policy</div>
    <h1 class="legal-headline">Privacy Policy</h1>
    <p class="legal-meta">Last updated: <?php echo esc_html( $updated ); ?> · Effective immediately</p>
  </div>

  <div class="legal-body">

    <div class="legal-intro-box">
      <p>This Privacy Policy explains how The Brow Beast ("we," "us," or "our"), operated by Gabrielle Lowe and located at 2 Hicks Lane, Great Neck, NY 11024, collects, uses, and protects information when you visit <strong>browbeast.com</strong> or use our services. By using this website you agree to the practices described in this policy.</p>
    </div>

    <section class="legal-section">
      <h2>1. Information We Collect</h2>

      <h3>Information you provide directly</h3>
      <ul>
        <li><strong>Contact form submissions</strong> — your name, email address, phone number (optional), and message content when you contact us through the website</li>
        <li><strong>Booking information</strong> — when you book an appointment through Acuity Scheduling, you provide your name, email, phone number, and any intake information requested. This data is collected and stored by Acuity Scheduling on our behalf</li>
        <li><strong>Course enrolment</strong> — if you purchase our online course through Thinkific, your name, email, and payment information are collected by Thinkific. We receive confirmation of your enrolment but do not store your payment details</li>
      </ul>

      <h3>Information collected automatically</h3>
      <ul>
        <li><strong>Usage data</strong> — pages visited, time on site, referring URL, browser type and device information, collected via Google Analytics if enabled</li>
        <li><strong>Cookies</strong> — this website uses cookies for analytics and to remember your preferences. See Section 5 for full details</li>
        <li><strong>Server logs</strong> — our hosting provider automatically records IP addresses, access times, and requested pages as part of standard server operation</li>
      </ul>

      <h3>Information from third parties</h3>
      <ul>
        <li><strong>Instagram</strong> — we display posts from our public Instagram account via the Instagram Basic Display API. We do not collect your personal data through this feed; it displays our own content only</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>2. How We Use Your Information</h2>
      <p>We use the information we collect to:</p>
      <ul>
        <li>Respond to your enquiries and provide customer support</li>
        <li>Process and manage your appointment bookings</li>
        <li>Send booking confirmations, reminders, and follow-up communications related to your appointment</li>
        <li>Improve the website and understand how visitors use it</li>
        <li>Comply with legal obligations</li>
      </ul>
      <p>We do <strong>not</strong> sell, rent, or trade your personal information to any third party for marketing purposes.</p>
    </section>

    <section class="legal-section">
      <h2>3. Third-Party Services</h2>
      <p>This website uses the following third-party services, each with their own privacy policies:</p>

      <div class="legal-third-party-list">
        <div class="legal-third-party-item">
          <div class="legal-third-party-name">Acuity Scheduling (Squarespace)</div>
          <div class="legal-third-party-desc">Handles appointment booking, client intake forms, payment deposits, and booking communications. Your booking data is stored on Acuity's servers.</div>
          <a href="https://www.squarespace.com/privacy" target="_blank" rel="noopener noreferrer">Privacy Policy →</a>
        </div>
        <div class="legal-third-party-item">
          <div class="legal-third-party-name">Thinkific</div>
          <div class="legal-third-party-desc">Hosts and delivers our online course. If you purchase the course, Thinkific collects your name, email, and payment information.</div>
          <a href="https://www.thinkific.com/privacy-policy/" target="_blank" rel="noopener noreferrer">Privacy Policy →</a>
        </div>
        <div class="legal-third-party-item">
          <div class="legal-third-party-name">Meta / Instagram</div>
          <div class="legal-third-party-desc">We use the Instagram Basic Display API to show our public posts on this website. No visitor data is transmitted to Meta through this integration.</div>
          <a href="https://privacycenter.instagram.com/policy" target="_blank" rel="noopener noreferrer">Privacy Policy →</a>
        </div>
        <div class="legal-third-party-item">
          <div class="legal-third-party-name">Google Analytics</div>
          <div class="legal-third-party-desc">If enabled, collects anonymised usage data including pages visited, session duration, and device information. You can opt out using the Google Analytics Opt-out Browser Add-on.</div>
          <a href="https://policies.google.com/privacy" target="_blank" rel="noopener noreferrer">Privacy Policy →</a>
        </div>
        <div class="legal-third-party-item">
          <div class="legal-third-party-name">Hosting Provider</div>
          <div class="legal-third-party-desc">This website is hosted on a managed WordPress hosting environment. Server logs including IP addresses are retained for security and diagnostic purposes.</div>
        </div>
      </div>
    </section>

    <section class="legal-section">
      <h2>4. Data Retention</h2>
      <ul>
        <li><strong>Contact form enquiries</strong> — retained in email for up to 2 years, then deleted</li>
        <li><strong>Booking records</strong> — retained by Acuity Scheduling per their data retention policy; we retain appointment history for up to 3 years for business records</li>
        <li><strong>Analytics data</strong> — aggregated and anonymised; not linked to individual identities</li>
        <li><strong>Server logs</strong> — retained for up to 90 days by our hosting provider</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>5. Cookies</h2>
      <p>This website uses cookies — small text files stored in your browser. We use:</p>
      <ul>
        <li><strong>Essential cookies</strong> — required for the website to function (e.g. WordPress session cookies, security nonces). You cannot opt out of these</li>
        <li><strong>Analytics cookies</strong> — Google Analytics cookies that help us understand how the site is used. These are anonymised and do not identify you personally. You may opt out via your browser settings or the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">Google Analytics opt-out add-on</a></li>
        <li><strong>Third-party cookies</strong> — Acuity Scheduling sets cookies when the booking embed loads on our booking page. These are necessary for the booking flow to work</li>
      </ul>
      <p>Most browsers allow you to refuse or delete cookies through your browser settings. Note that disabling cookies may affect functionality on this site and on third-party services.</p>
    </section>

    <section class="legal-section">
      <h2>6. Your Rights</h2>
      <p>Depending on your location, you may have the following rights regarding your personal information:</p>
      <ul>
        <li><strong>Access</strong> — request a copy of the personal data we hold about you</li>
        <li><strong>Correction</strong> — request that we correct inaccurate or incomplete information</li>
        <li><strong>Deletion</strong> — request that we delete your personal information, subject to legal retention requirements</li>
        <li><strong>Objection</strong> — object to certain types of processing</li>
        <li><strong>Portability</strong> — request your data in a portable format</li>
      </ul>
      <p>To exercise any of these rights, please contact us using the details in Section 8. We will respond within 30 days.</p>
      <p>If you are located in the European Economic Area (EEA), you also have the right to lodge a complaint with your local data protection authority.</p>
    </section>

    <section class="legal-section">
      <h2>7. Children's Privacy</h2>
      <p>This website is not directed at children under the age of 13. We do not knowingly collect personal information from children. If you believe we have inadvertently collected information from a child, please contact us immediately and we will delete it.</p>
    </section>

    <section class="legal-section">
      <h2>8. Changes to This Policy</h2>
      <p>We may update this Privacy Policy from time to time to reflect changes in our practices or legal requirements. When we do, we will update the "Last updated" date at the top of this page. We encourage you to review this policy periodically. Continued use of this website after changes are posted constitutes your acceptance of the updated policy.</p>
    </section>

    <section class="legal-section">
      <h2>9. Contact Us</h2>
      <p>If you have any questions about this Privacy Policy, wish to exercise your data rights, or have a concern about how your information is handled, please contact us:</p>
      <div class="legal-contact-block">
        <div><strong>The Brow Beast</strong></div>
        <div>Gabrielle Lowe</div>
        <div>2 Hicks Lane, Great Neck, NY 11024</div>
        <div><strong>Phone:</strong> <a href="tel:5168407314">516-840-7314</a></div>
        <div><strong>Contact form:</strong> <a href="<?php echo esc_url( $contact ); ?>">browbeast.com/contact</a></div>
      </div>
    </section>

  </div>

</div>

<?php get_footer(); ?>