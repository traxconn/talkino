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
        <span class="fs-4 talkino">Talkino Bundle</span>
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
      <p class="fs-5 text-muted talkino">Bring your Talkino to the next level through the advanced features of the Talkino Bundle!</p>
      <p class="fs-5 text-muted talkino">Don't miss the limited time <b class="dicsount talkino">25% discount</b> offer.</p>
    </div>
  </header>
  <main>
    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 talkino">
      <div class="col d-flex align-items-start talkino">
        <div class="icon-square text-bg-light d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 talkino">
          <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
        </div>
        <div>
          <h3 class="fs-2 talkino">Online Schedule</h3>
          <p class="fs-6 talkino">Online time schedule of chatbox and able to cater for different agents and global business opening hours. Every agent can be configured for different online schedule time. Thus, different agents can be displayed on the chatbox at different times.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start talkino">
        <div class="icon-square text-bg-light d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 talkino">
          <svg class="bi talkino" width="1em" height="1em"><use xlink:href="#cpu-fill "/></svg>
        </div>
        <div>
          <h3 class="fs-2 talkino">Contact Form</h3>
          <p class="fs-6 talkino">Support contact form to let users email to admin when chatbox is under offline mode and Google reCaptcha v3 to protect the form from spam. This is a great way to stay connected with your customers and provide them with support even when you are offline.</p>
        </div>
      </div>
      <div class="col d-flex align-items-start talkino">
        <div class="icon-square text-bg-light d-inline-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 talkino">
          <svg class="bi talkino" width="1em" height="1em"><use xlink:href="#tools"/></svg>
        </div>
        <div>
          <h3 class="fs-2 talkino">Premium Support</h3>
          <p class="fs-6 talkino">Provide a support ticket system for you to get support from our team. Whether you encounter any problems or bugs, we are ready to resolve the issue for you.</p>
        </div>
      </div>
    </div>
    <div class="row row-cols-2 row-cols-md-2 mb-2 text-center talkino">
      <div class="col talkino">
        <div class="card mb-4 rounded-3 shadow-sm talkino">
          <div class="card-header py-3 talkino">
            <h4 class="my-0 fw-normal talkino">Talkino</h4>
          </div>
          <div class="card-body talkino">
            <h1 class="card-title pricing-card-title talkino">Free<small class="text-muted fw-light"></small></h1>
            <ul class="list-unstyled mt-3 mb-4 talkino">
              <li>Multi chat</li>
              <li>Unlimited agents’ accounts</li>
              <li>Online modes</li>
              <li>Editable text</li>
              <li>Ordering list</li>  
              <li>Display or hide chatbox on pages</li> 
              <li>Fully customizable style</li> 
              <li>Translation ready</li> 
              <li>Mobile responsive</li> 
              <li>Unlimited site license</li> 
            </ul>
          </div>
        </div>
      </div>
      <div class="col talkino">
        <div class="card mb-4 rounded-3 shadow-sm border-primary talkino">
          <div class="card-header py-3 text-bg-primary border-primary talkino">
            <h4 class="my-0 fw-normal talkino">Bundle for Talkino</h4>
          </div>
          <div class="card-body talkino">
            <h1 class="card-title pricing-card-title talkino">$29<small class="text-muted fw-light talkino">/year</small></h1>
            <h5 class="original-price talkino">Normally $39</h5>
            <ul class="list-unstyled mt-3 mb-4 talkino talkino">
              <li>Online time schedule</li>
              <li>Contact form</li>
              <li>Google reCaptcha v3</li>
              <li>1 year of update</li>
              <li>1 year of premium support</li>
              <li>Single site license</li>
              <li>14 days money-back guarantee</li>
            </ul>
            <button type="button" class="w-100 btn btn-lg btn-primary talkino" onclick="location.href='https://traxconn.com/plugins/talkino/'">Get Started</button>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<?php
?>
