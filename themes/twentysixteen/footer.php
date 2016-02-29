<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
      <div class="entry-content centered site-footer-content">
      <div class="social-media-button-container">
        <a href="https://twitter.com/KopralMerdeka" class="social-media-button"><img class="fist" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/twentysixteen/img/twitter.png"></a>
        <a href="https://www.facebook.com/Kopral-Merdeka-726624010806396/?ref=aymt_homepage_panel" class="social-media-button"><img class="fist" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/twentysixteen/img/facebook.png"></a>
        <a href="https://github.com/kopralmerdeka" class="social-media-button"><img class="fist" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/twentysixteen/img/github.png"></a>
        <!--a href="" class="social-media-button"><img class="fist" src="<?php echo esc_url( home_url( '/' ) ); ?>wp-content/themes/twentysixteen/img/youtube.png"></a-->
      </div>
				<br>
			<div><span style="color:grey;font-size:small">Surat elektronik</span><br>info@kopralmerdeka.id</div><br>
			<div><span style="color:grey;font-size:small">Milis</span><br><a href="https://groups.google.com/forum/#!forum/kopral-merdeka" target="_blank">kopral-merdeka@googlegroups.com</a></div>
				<br>
				<br>
			<div class="site-info">
				<?php
					/**
					 * Fires before the twentysixteen footer text for footer customization.
					 *
					 * @since Twenty Sixteen 1.0
					 */
					do_action( 'twentysixteen_credits' );
				?>
				<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
      </div>
		</footer><!-- .site-footer -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
