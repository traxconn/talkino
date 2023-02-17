<?php
/**
 * Displays the extensions.
 *
 * @link       https://traxconn.com
 * @since      1.0.0
 * @package    Talkino
 * @subpackage Talkino/admin/extensions/views
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<div class="container py-3 talkino">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom talkino">
      <a href="https://traxconn.com/plugins/talkino/" class="d-flex align-items-center text-dark text-decoration-none talkino">
        <span class="fs-4 talkino">Talkino Extension</span>
      </a>
      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto talkino">
        <a class="me-3 py-2 text-dark text-decoration-none talkino" href="https://traxconn.com">Official Site</a>
        <a class="me-3 py-2 text-dark text-decoration-none talkino" href="https://traxconn.com/plugins/talkino/docs/">Documentation</a>
        <a class="me-3 py-2 text-dark text-decoration-none talkino" href="https://traxconn.com/contact/">Support</a>
        <a class="py-2 text-dark text-decoration-none talkino" href="https://traxconn.com/blog/">Blog</a>
      </nav>
    </div>
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center talkino">
      <h1 class="display-4 fw-normal talkino">Talkino Bundle</h1>
      <p class="fs-5 text-muted talkino">An extension to bring your Talkino to the next level with the advanced features!</p>
      <p class="fs-5 text-muted talkino">Don't miss the limited time <b class="dicsount talkino">35% discount</b> offer.</p>
      <button type="button" class="btn btn-lg btn-primary talkino" onclick="location.href='https://traxconn.com/plugins/talkino/'">Get Started</button>
    </div>
  </header>
  <main>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 talkino">
      <div class="col d-flex align-items-start talkino">
        <div>
          <h3 class="fs-2 talkino">Automated Reply</h3>
          <p class="fs-6 talkino">
          Talkino provides integration with Typebot virtual assistant to answer many questions that don't require a real agent as if you created a list of frequently asked questions. As a bot is available 24 hours a day, you will save a great deal of money and your customers will be happier with your service.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start talkino">
        <div>
          <h3 class="fs-2 talkino">Shortcode Widget</h3>
          <p class="fs-6 talkino">Talkino supports displaying the agent's widget with his chat channels inside any post or WooCommerce page using a shortcode. You can manually create the shortcode with its attributes or use our shortcode generator to create Talkino's shortcode.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start talkino">
        <div>
          <h3 class="fs-2 talkino">Reporting</h3>
          <p class="fs-6 talkino">The reporting feature provides valuable insights into how customers are reaching your agents and which chat channels are being used most frequently. Through this, you can more effectively manage customer communication and improve the overall customer experience. </p>
        </div>
      </div>
    </div>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 talkino">
      <div class="col d-flex align-items-start talkino">
        <div>
          <h3 class="fs-2 talkino">Country Block</h3>
          <p class="fs-6 talkino">A fantastic blocking feature to help you to restrict users in certain countries from reaching you, especially countries where your service is not provided.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start talkino">
        <div>
          <h3 class="fs-2 talkino">Online Schedule</h3>
          <p class="fs-6 talkino">Online schedule of Talkino and able to cater for different agents and global business opening hours. Every agent can be configured for different online schedule time. Thus, different agents can be displayed on your site at different times.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start talkino">
        <div>
          <h3 class="fs-2 talkino">Contact Form</h3>
          <p class="fs-6 talkino">Provide a built-in contact form to let users email to admin when Talkino is under offline mode. It is a great way to stay connected with your customers and supports them even when you are offline. The contact form supports integration with Google reCaptcha v3 to protect it from spam.</p>
        </div>
      </div>
    </div>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 talkino">
      <div class="col d-flex align-items-start talkino">
        <div>
          <h3 class="fs-2 talkino">Premium Support</h3>
          <p class="fs-6 talkino">Provide a support ticket system for you to get support from our team. Whether you encounter any problems or bugs, we are ready to resolve the issue for you.</p>
        </div>
      </div>
    </div>
  </main>
</div>
<?php
?>
