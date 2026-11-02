<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<div class="inner"><div class="wrap">
<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
<nav aria-label="Breadcrumb" class="crumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a><span aria-hidden="true"> / </span><span><?php the_title(); ?></span></nav>
<h1 class="post-title"><?php the_title(); ?></h1>
<div class="post-meta"><span><?php echo esc_html( get_the_date() ); ?></span><?php the_category( ' ' ); ?></div>
<?php if ( has_post_thumbnail() ) : ?><div class="post-thumb"><?php the_post_thumbnail( 'large', array( 'fetchpriority' => 'high' ) ); ?></div><?php endif; ?>
<div class="post-body"><?php the_content(); wp_link_pages(); ?></div>
<div class="post-cta"><span>Need fiber internet in Latifabad, Hyderabad?</span><a class="btn btn-sm" href="https://wa.me/923061035806" rel="noopener noreferrer" target="_blank">WhatsApp 0306-1035806</a></div>
</article>
<?php if ( comments_open() || get_comments_number() ) { comments_template(); } ?>
<?php the_post_navigation(); ?>
<?php endwhile; ?>
</div></div>
<?php get_footer(); ?>
