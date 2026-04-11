<?php
/**
 * Template Name: Accessibility Statement
 */
get_header();
$updated = 'April 2026';
?>

<div class="legal-page">

  <div class="legal-hero">
    <div class="tag">Site Policy</div>
    <h1 class="legal-headline">Accessibility Statement</h1>
    <p class="legal-meta">Last updated: <?php echo esc_html( $updated ); ?></p>
  </div>

  <div class="legal-body">

    <section class="legal-section">
      <h2>Our Commitment</h2>
      <p>The Brow Beast is committed to ensuring that this website is accessible to all visitors, including people with disabilities. We believe that every person has the right to access information and services with dignity, comfort, and independence — and we take that responsibility seriously.</p>
      <p>This website has been designed and built with accessibility as a core consideration, not an afterthought. We follow recognised best practices and work continuously to improve the experience for everyone.</p>
    </section>

    <section class="legal-section">
      <h2>Standards We Follow</h2>
      <p>This website aims to conform to the <strong>Web Content Accessibility Guidelines (WCAG) 2.1, Level AA</strong>. These guidelines explain how to make web content more accessible to people with disabilities, and define requirements for designers and developers.</p>
    </section>

    <section class="legal-section">
      <h2>What We've Done</h2>
      <p>The following accessibility measures are built into this website:</p>
      <ul>
        <li>Semantic HTML5 structure with correct heading hierarchy throughout</li>
        <li>Descriptive <code>alt</code> text on all meaningful images</li>
        <li>ARIA labels on interactive elements including navigation, buttons, and accordions</li>
        <li><code>aria-expanded</code> and <code>aria-controls</code> on all accordion and toggle components</li>
        <li>Keyboard-navigable menus — the mobile drawer can be opened, navigated, and closed without a mouse</li>
        <li>Focus management when the mobile drawer opens and closes</li>
        <li>Sufficient colour contrast ratios between text and background throughout</li>
        <li>Skip to content link at the top of every page for screen reader users</li>
        <li>No content relies solely on colour to convey meaning</li>
        <li>Form fields have associated labels and inline error messages</li>
        <li>All videos and media embedded through third-party services (Acuity, Thinkific) are subject to those platforms' own accessibility provisions</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>Known Limitations</h2>
      <p>While we strive for full WCAG 2.1 AA compliance, some areas may not yet meet every criterion:</p>
      <ul>
        <li>The before/after image drag slider is a mouse and touch interaction — keyboard equivalents are in progress</li>
        <li>Third-party embedded content (Acuity Scheduling booking flow, Thinkific course platform) is outside our direct control; those platforms have their own accessibility commitments</li>
        <li>Instagram feed images sourced from the Instagram API use caption text as alt text, which may not always be fully descriptive</li>
      </ul>
      <p>We are actively working to address these limitations.</p>
    </section>

    <section class="legal-section">
      <h2>Technical Information</h2>
      <p>This website is built using semantic HTML5, CSS3, and JavaScript. It has been tested with the following assistive technologies:</p>
      <ul>
        <li>VoiceOver on macOS and iOS (Safari)</li>
        <li>NVDA on Windows (Chrome and Firefox)</li>
        <li>Keyboard-only navigation (Chrome, Firefox, Safari)</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>Feedback & Contact</h2>
      <p>We welcome feedback on the accessibility of this website. If you encounter any barriers, experience difficulty accessing any content, or require information in an alternative format, please contact us:</p>
      <div class="legal-contact-block">
        <div><strong>Studio:</strong> The Brow Beast, 2 Hicks Lane, Great Neck, NY 11024</div>
        <div><strong>Phone:</strong> <a href="tel:5168407314">516-840-7314</a></div>
        <div><strong>Contact form:</strong> <a href="<?php echo esc_url( get_permalink( get_page_by_path('contact') ) ?: home_url('/contact/') ); ?>">browbeast.com/contact</a></div>
      </div>
      <p>We aim to respond to accessibility feedback within <strong>2 business days</strong>.</p>
    </section>

    <section class="legal-section">
      <h2>Formal Complaints</h2>
      <p>If you are not satisfied with our response, you may contact the <a href="https://www.ada.gov/" target="_blank" rel="noopener noreferrer">U.S. Department of Justice ADA Information Line</a> at 1-800-514-0301 (voice) or 1-800-514-0383 (TTY).</p>
    </section>

  </div>

</div>

<?php get_footer(); ?>