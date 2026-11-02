<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if ( post_password_required() ) { return; }
?>
<section class="comments-area post-card" id="comments">
<?php if ( have_comments() ) : ?>
<h2 class="posts-h">Comments</h2>
<ol class="comment-list"><?php wp_list_comments( array( 'style' => 'ol', 'short_ping' => true ) ); ?></ol>
<?php the_comments_pagination(); ?>
<?php endif; ?>
<?php comment_form(); ?>
</section>
