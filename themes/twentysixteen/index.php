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
							<a href="#about"><button class="custom-button custom-button-red">Tentang KOPRAL Merdeka</button></a>
							<a href="#join"><button class="custom-button custom-button-green">Bergabung!</button></a>
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
					<a href="/komunitas"><button class="custom-button custom-button-blue">Yang bergabung...</button></a>
				</div>
				<div class="member-content entry-content">
					<div id="member">
						<!--Iteration example-->
				    <!--div class="member-item">
				    	<div class="member-item-logo"></div>
				    	<div class="member-item-title">GNU/Linux Bogor</div>
				    </div>
				    <div class="member-item">
				    	<div class="member-item-logo"></div>
				    	<div class="member-item-title">BelajarFreeBSD</div>
				    </div-->
						<div class="jcarousel-wrapper">
                <div class="jcarousel">
                    <ul>
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
                            $id = $user->ID;
                            $count = $value;
                            if ($user->user_nicename != "admin" && $id > 3 && $count > 0) {
                      						echo "<li>";
                      				    echo "<div class=\"member-item\" onclick=\"location.href='".$author_posts_url."';\">";
                      				    echo "<div class=\"member-item-logo\">";
                       						echo get_avatar( $user->ID, 170 );
                      						echo "</div>";
                                  echo "<div class=\"member-item-title\">".$user->nickname."</div>";
                      				    echo "</div>";
                                  echo "</li>";
                            }
                        }
                      }
                      ?>
                    </ul>
                </div>


                <p class="jcarousel-pagination"></p>
            </div>
					</div>
				</div>
      </div><!--End of block-->
			<div id="join" class="register-container">
				<div class="register-title">Mari bergabung</div>
				<div class="entry-content">
        <?php
        	/* echo do_shortcode("[wppb-register]"); */
        	/* echo do_shortcode("[CRF_Form id='1']"); */
        	echo do_shortcode("[bergabung]");
        ?>
        <script>
        /* var passwd = Math.random().toString(36).replace(/[^a-z]+/g, '').substr(0, 30); */
        /* document.getElementById("passw1").value = passwd; */
        /* document.getElementById("passw2").value = passwd; */
        /* document.getElementById("register").value = "Bergabung!"; */
        </script>
				</div>
      </div><!--End of block-->
      <div class="member-container" style="margin-bottom:-125px;background:white">
        <div class="member-title" style="color:black">Didukung oleh</div>
        <div class="entry-content centered supporter-container">
          <div id="sponsorship">
          <!--img src="/wp-content/uploads/2016/01/Screen-Shot-2016-01-18-at-12.12.54-AM-300x286.png" class="supporter-logo"-->
          </div>
        </div>
      </div><!--End of block-->
    </div>
        <script type="text/javascript" src="wp-content/themes/twentysixteen/lib/carousel.js"></script>
        <script type="text/javascript">
          jQuery(function($) {
          	var jcarousel = $('.jcarousel');
            jcarousel
              .on('jcarousel:reload jcarousel:create', function () {
                  var carousel = $(this),
                      width = carousel.innerWidth();
                  if (width >= 600) {
                      width = width / 3;
                  } else if (width >= 350) {
                      width = width / 2;
                  }
                  carousel.jcarousel('items').css('width', Math.ceil(width) + 'px');
              })
              .jcarousel({
                  wrap: 'circular'
              });
              $('.jcarousel').jcarouselAutoscroll({
                  interval: 3000
              });
              var sponsorBasePath = 'https://raw.githubusercontent.com/kopralmerdeka/kopral-sponsorship-logo/master/';
              jQuery.get(sponsorBasePath + 'index.json', function(result) {
                var data = JSON.parse(result);
                console.log(data);
                data.forEach(function(item){
                  $('#sponsorship').append('<img src=\'' + sponsorBasePath + item.logo + '\' class=\'supporter-logo\'>')
                })
              })

          });
        </script>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
