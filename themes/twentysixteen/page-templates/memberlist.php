<?php
/**
 * Template Name: Member List
 */
get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main" style="text-align:center">
		<div class="member-title">Komunitas yang bergabung</div>
      <?php
      //sort users descending by number of posts, display username and avatar
      $uc=array();
      $blogusers = get_users_of_blog();
      if ($blogusers) {
        foreach ($blogusers as $bloguser) {
          $post_count = get_usernumposts($bloguser->user_id);
          $uc[$bloguser->user_id]=$post_count;
        }
        arsort($uc);
        foreach ($uc as $key => $value) {
          $user = get_userdata($key);
          $author_posts_url = get_author_posts_url($key);
          $post_count = $value;
            if ($user->user_nicename != "admin") {
      				    echo "<div class=\"member-item\" onclick=\"location.href='".$author_posts_url."';\">";
      				    echo "<div class=\"member-item-logo\">";
       						echo get_avatar( $user->ID, 170 );
      						echo "</div>";
      				    echo "<div class=\"member-item-title\">".$user->nickname."</div>";
      				    echo "</div>";
            }
        }
      }
      ?>

		</div><!-- #content -->
	</div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
