<?php
/**
 * Title: Contact Layout
 * Slug: krystal-commerce/contact-layout
 * Categories: text
 */
?>
<!-- wp:columns {"align":"wide"} -->
<div class="wp-block-columns alignwide"><!-- wp:column {"width":"60%"} -->
<div class="wp-block-column" style="flex-basis:60%"><!-- wp:heading -->
<h2 class="wp-block-heading">Get in touch</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Need help with sizing, shipping, or an order? We usually reply within one business day.</p>
<!-- /wp:paragraph -->
<!-- wp:html -->
<form class="kc-contact-form" action="#" method="post">
  <label for="kc-contact-name">Name</label>
  <input id="kc-contact-name" name="name" type="text" required />
  <label for="kc-contact-email">Email</label>
  <input id="kc-contact-email" name="email" type="email" required />
  <label for="kc-contact-message">Message</label>
  <textarea id="kc-contact-message" name="message" rows="6" required></textarea>
  <button type="submit">Send Message</button>
</form>
<!-- /wp:html --></div>
<!-- /wp:column -->
<!-- wp:column {"width":"40%"} -->
<div class="wp-block-column" style="flex-basis:40%"><!-- wp:group {"className":"kc-card","style":{"spacing":{"blockGap":"0.5rem"}}} -->
<div class="wp-block-group kc-card"><!-- wp:heading {"level":4} --><h4 class="wp-block-heading">Support</h4><!-- /wp:heading -->
<!-- wp:paragraph --><p>Email: support@example.com</p><!-- /wp:paragraph -->
<!-- wp:paragraph --><p>Mon–Fri: 9AM–6PM</p><!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
