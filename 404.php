<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<div class="inner"><div class="wrap">
<div class="post-card">
<h1 class="post-title">Page not found</h1>
<p>The page you are looking for is not available. Return to the home page to view packages and contact details.</p>
<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to Home</a>
</div>
</div></div>
<?php get_footer(); ?>
