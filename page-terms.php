<?php
/**
 * Template Name: Terms & Conditions
 */
get_header();
$updated = 'April 2026';
$contact = get_permalink( get_page_by_path('contact') ) ?: home_url('/contact/');
$booking_url = get_theme_mod( 'browbeast_acuity_url', 'https://app.acuityscheduling.com/schedule.php?owner=19201786' );
?>

<div class="legal-page">

  <div class="legal-hero">
    <div class="tag">Site Policy</div>
    <h1 class="legal-headline">Terms &amp; Conditions</h1>
    <p class="legal-meta">Last updated: <?php echo esc_html( $updated ); ?></p>
  </div>

  <div class="legal-body">

    <div class="legal-intro-box">
      <p>These Terms &amp; Conditions govern your use of the browbeast.com website and the services offered by The Brow Beast, operated by Gabrielle Lowe ("Studio," "we," "us") at 2 Hicks Lane, Great Neck, NY 11024. By using this website or booking a service, you agree to these terms in full.</p>
    </div>

    <section class="legal-section">
      <h2>1. Appointments &amp; Booking</h2>
      <p>All appointments are booked through our online scheduling system (Acuity Scheduling). By completing a booking, you confirm that you have read and agree to these terms.</p>
      <ul>
        <li>A <strong>deposit is required</strong> at the time of booking to secure your appointment. The deposit amount is displayed during the booking process and is applied toward your total service cost on the day.</li>
        <li>You must be at least <strong>18 years of age</strong> to book semi-permanent brow services. Clients aged 16–17 can't book any service with me or without parental consent.</li>
        <li>A brief <strong>consultation</strong> is conducted at the start of every appointment to confirm suitability, discuss the desired outcome, and review any contraindications. The Studio reserves the right to decline service if a client is deemed unsuitable at the consultation stage. In such cases, the deposit will be refunded.</li>
        <li>By booking, you confirm that you have reviewed the <strong>contraindications</strong> listed on the relevant service page and that none apply to you. If you are unsure, please contact us before booking.</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>2. Cancellation &amp; Rescheduling Policy</h2>
      <ul>
        <li>All deposits are non-refundable.
        <li>Cancellations or reschedules must be made at least <strong>48 hours before</strong> your appointment to receive a refund of your deposit or to transfer it to a new appointment date.</li>
        <li>When rescheduling - to have your depoist transferred to a new appointment date, you must contact us directly via email or phone with a minimum of 48 hours notice before your scheduled appointment.</li>
        <li>Cancellations made <strong>less than 48 hours before</strong> your appointment – or cancellations without intent to reschedule – will result in <strong>forfeiture of the deposit</strong>. No exceptions, including illness, unless a medical certificate is provided.</li>
        <li><strong>No-shows</strong> (failure to attend without notice) will result in forfeiture of the full deposit and may require a new deposit to rebook.</li>
        <li>The Studio reserves the right to cancel or reschedule appointments due to illness, emergency, or circumstances beyond our control. In such cases, a full refund of the deposit or a complimentary reschedule will be offered.</li>
        <li>Repeated late cancellations may result in a requirement to prepay the full service cost at the time of booking.</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>3. Late Arrivals</h2>
      <p>Please arrive on time for your appointment. We allocate specific time slots to ensure each client receives the full attention they deserve.</p>
      <ul>
        <li>Arrivals more than <strong>15 minutes late</strong> may result in a shortened service or the appointment being cancelled at the Studio's discretion.</li>
        <li>If your appointment is cancelled due to late arrival, your deposit will be forfeited.</li>
        <li>If you are running late, please contact us as soon as possible so we can do our best to accommodate you.</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>6. Results &amp; Disclaimer</h2>
      <p>Semi-permanent and cosmetic brow services involve individual results that vary based on skin type, lifestyle, health conditions, and adherence to aftercare instructions. By booking a service, you acknowledge and accept the following:</p>
      <ul>
        <li>Results <strong>cannot be guaranteed</strong> to be identical to photographs or examples shown on this website or social media. Images are illustrative of typical results.</li>
        <li>Semi-permanent pigment will <strong>fade over time</strong>. Duration of results is approximate and varies by individual.</li>
        <li>Henna brows involve plant-based dye. Reactions are rare but possible. A patch test is strongly recommended for clients with known sensitivities.</li>
        <li>The Studio is not liable for reactions resulting from undisclosed allergies, skin conditions, or failure to disclose relevant health information at the consultation.</li>
        <li>Colour may appear significantly darker for the first 5–7 days following a semi-permanent procedure before settling to the final result. This is normal and expected.</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>7. Health &amp; Safety</h2>
      <ul>
        <li>Clients must disclose all relevant medical conditions, medications, allergies, and recent cosmetic procedures at the consultation. Failure to do so releases the Studio from any liability for adverse outcomes.</li>
        <li>Semi-permanent brow services are <strong>not suitable</strong> for: pregnant or breastfeeding women; clients on Accutane or blood thinners; those with active skin conditions in the brow area; clients who have had a chemical peel or laser treatment in the area within 4 weeks. Please review the full contraindications list on the service pages before booking.</li>
        <li>The Studio maintains a clean, sanitary environment and uses single-use, sterile equipment for all procedures.</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>8. Photography &amp; Social Media</h2>
      <ul>
        <li>The Studio may take before and after photographs of your brows for portfolio, social media, and marketing purposes.</li>
        <li>If you do <strong>not</strong> consent to photography, please inform us at your appointment. No photographs will be taken without your agreement.</li>
        <li>Where photographs are shared publicly, we will not include your name or identifying information unless you have given explicit permission.</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>9. Online Course</h2>
      <ul>
        <li>The Brow Beast online course is hosted on Thinkific. Purchase of the course grants a <strong>non-transferable, personal licence</strong> to access the course content.</li>
        <li>Course content may not be reproduced, resold, shared, or distributed in any form without prior written consent from The Brow Beast.</li>
        <li>All sales of the online course are <strong>final</strong>. Refunds are not offered once course access has been granted, except where required by law.</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>10. Website Use</h2>
      <ul>
        <li>All content on this website — including text, images, branding, and course materials — is the intellectual property of The Brow Beast and may not be copied or reproduced without permission.</li>
        <li>We make reasonable efforts to ensure the accuracy of information on this website but do not guarantee that all content is current, complete, or error-free.</li>
        <li>Links to third-party websites (Acuity Scheduling, Thinkific, Instagram) are provided for convenience. We are not responsible for the content or practices of those sites.</li>
      </ul>
    </section>

    <section class="legal-section">
      <h2>11. Limitation of Liability</h2>
      <p>To the fullest extent permitted by law, The Brow Beast shall not be liable for any indirect, incidental, or consequential damages arising from use of this website or our services. Our total liability to any client shall not exceed the amount paid for the specific service in question.</p>
    </section>

    <section class="legal-section">
      <h2>12. Governing Law</h2>
      <p>These Terms &amp; Conditions are governed by the laws of the State of New York. Any disputes shall first be attempted to be resolved informally by contacting us. If unresolved, disputes shall be subject to the jurisdiction of the courts of Nassau County, New York.</p>
    </section>

    <section class="legal-section">
      <h2>13. Changes to These Terms</h2>
      <p>We reserve the right to update these Terms &amp; Conditions at any time. Changes will be effective upon posting to this page with an updated date. Continued use of this website or our services constitutes acceptance of the updated terms.</p>
    </section>

    <section class="legal-section">
      <h2>14. Contact</h2>
      <p>If you have any questions about these terms, please contact us:</p>
      <div class="legal-contact-block">
        <div><strong>The Brow Beast</strong> — Gabrielle Lowe</div>
        <div>2 Hicks Lane, Great Neck, NY 11024</div>
        <div><strong>Phone:</strong> <a href="tel:5168407314">516-840-7314</a></div>
        <div><strong>Contact form:</strong> <a href="<?php echo esc_url( $contact ); ?>">browbeast.com/contact</a></div>
      </div>
    </section>

  </div>
</div>

<?php get_footer(); ?>