<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package OceanWP WordPress theme
 */

get_header(); ?>

	<?php do_action( 'ocean_before_content_wrap' ); ?>

	<div id="content-wrap" class="container clr">

		<?php do_action( 'ocean_before_primary' ); ?>

		<div id="primary" class="content-area clr">

			<?php do_action( 'ocean_before_content' ); ?>

			<div id="content" class="site-content clr">

				<?php do_action( 'ocean_before_content_inner' ); ?>

				<?php
				// Elementor `single` location.
				if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'single' ) ) {

					// Start loop.
					while ( have_posts() ) :
						the_post();

						get_template_part( 'partials/page/layout' );

					endwhile;

				}
				?>
				<div class="container">
					<div class="row apple-324">
						<!-- <div class="col-md-4"></div> -->
						<div class="col-md-4">
							<form method="post">
								<p>
									<label for="cptTitle"><?php _e('Enter the storage/container name:', 'oceanwp') ?></label>
									<input id="cptTitle" name="cptTitle" type="text" />
								</p><!--?php _e(‘Select image of storage’, ‘oceanwp’) ?-->
								<p>
									<label for="container-img"><?php _e('Select image of storage/container', 'oceanwp') ?></label>
									<input id="container-img" accept="image/png, image/jpeg" name="container-img" type="file" >
								</p>
								<button class="btn-apple-324" type="submit"><?php _e('Add', 'oceanwp') ?></button>
								<input id="container" name="container" type="hidden" value="my_custom_post_type" /> 
								<?php wp_nonce_field( 'cpt_nonce_action', 'cpt_nonce_field' ); ?>
							</form>
						</div>
						<!-- <div class="col-md-4"></div> -->
					</div>
											
				</div>

				<?php do_action( 'ocean_after_content_inner' ); ?>

			</div><!-- #content -->

			<?php do_action( 'ocean_after_content' ); ?>

		</div><!-- #primary -->

		<?php do_action( 'ocean_after_primary' ); ?>

	</div><!-- #content-wrap -->

	<?php do_action( 'ocean_after_content_wrap' ); ?>

<?php get_footer(); ?>
