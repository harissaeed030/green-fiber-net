<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
get_header();
?>
<div class="inner"><div class="wrap">
<?php if ( is_search() ) : ?>
<h1 class="arch-title"><?php echo esc_html( sprintf( 'Search results for: %s', get_search_query() ) ); ?></h1>
<?php elseif ( is_archive() ) : ?>
<h1 class="arch-title"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
<?php elseif ( is_home() ) : ?>
<h1 class="arch-title"><?php echo esc_html( is_front_page() ? get_bloginfo( 'name' ) : single_post_title( '', false ) ); ?></h1>
<?php endif; ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
<?php if ( has_post_thumbnail() ) : ?><a class="post-thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a><?php endif; ?>
<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<div class="post-meta"><span><?php echo esc_html( get_the_date() ); ?></span><?php the_category( ' ' ); ?></div>
<p><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
<a class="more" href="<?php the_permalink(); ?>">Read more<span class="sr">: <?php the_title(); ?></span></a>
</article>
<?php endwhile; the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => 'Newer', 'next_text' => 'Older' ) ); else : ?>
<div class="post-card">
<h1 class="post-title">Nothing found</h1>
<p>No posts match your request. Return to the home page to view packages and contact details.</p>
<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>">Back to Home</a>
</div>
<?php endif; ?>
</div></div>
<?php get_footer(); ?>
