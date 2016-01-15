<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main front-page" role="main">
    <!--begin of Paralax-->
    <div>
      <div id="tagline" class="tagline-container">
        <div class="tagline-centered">
            FAJAR BARU GERAKAN<br>PERANGKAT LUNAK MERDEKA<br>
						<div class="tagline-button-container">
							<button class="custom-button custom-button-red">Tentang KOPRAL Merdeka</button>
							<button class="custom-button custom-button-green">Bergabung!</button>
						</div>
        </div>
      </div><!--End of block-->
			<div id="about" class="about-container">
				<div class="about-title">
					Tentang Kopral Merdeka
				</div>
				<div class="about-content entry-content">
			    <?php
			    	// Get about post's content
           $args=array(
             'tag' => 'about',
             'showposts'=>1,
             'caller_get_posts'=>1
           );
           $my_query = new WP_Query($args);
           if( $my_query->have_posts() ) {
             while ($my_query->have_posts()) : $my_query->the_post();
			    	    echo apply_filters('the_content', get_post_field('post_content'));
             endwhile;
           }
  	    		wp_reset_query();  // Restore global post
			    ?>
					<!-- insert fist image from http://vollkorndesign.deviantart.com/art/fist-158695469-->
					<img class="fist" src="wp-content/themes/twentysixteen/img/fist.png">
				</div>
      </div><!--End of block-->
      <div id="member" class="member-container">
				<div class="member-title">
					<button class="custom-button custom-button-blue">Yang bergabung...</button>
				</div>
				<div class="member-content entry-content">
					<div>
						<!--Iteration example-->
				    <!--div class="member-item">
				    	<div class="member-item-logo"></div>
				    	<div class="member-item-title">GNU/Linux Bogor</div>
				    </div>
				    <div class="member-item">
				    	<div class="member-item-logo"></div>
				    	<div class="member-item-title">BelajarFreeBSD</div>
				    </div-->
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
				    echo "<div class=\"member-item\" onclick=\"location.href='".$author_posts_url."';\">";
				    echo "<div class=\"member-item-logo\">";
 						echo get_avatar( $user->ID, 170 );
						echo "</div>";
				    echo "<div class=\"member-item-title\">".$user->user_nicename."</div>";
				    echo "</div>";
  }
}
?>
					</div>
				</div>
      </div><!--End of block-->
			<div id="register" class="register-container">
				<div class="register-title">Mari bergabung</div>
				<div class="entry-content">
<?php
echo do_shortcode("[wppb-register]");
?>
				</div>
      </div><!--End of block-->
    </div>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
