<?php
/**
 * The template for displaying Author description
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<?php
// If a user has filled out their description, show a bio on their entries.
if ( get_the_author_meta( 'description' ) ) : ?>
	<div class="author-info">
		<div class="media">
			<div class="pull-left">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'stormbringer_author_bio_avatar_size', 100 ) ); ?>
				</div>
			</div>
			<!-- /.author-avatar -->
			<div class="media-body">
				<div class="author-description">
					<h4 class="media-heading"><?php printf( __( 'About %s', 'stormbringer' ), get_the_author() ); ?></h4>
					<?php $author_description = get_the_author_meta( 'description' );
					echo wpautop( $author_description ); ?>
					<?php if ( get_the_author_meta( 'user_fb' ) ) {
						printf( '<p>' . __( 'Facebook:', 'strombringer' ) . ' <a href="%s">%s</a></p>', get_the_author_meta( 'user_fb' ), get_the_author() );
					} ?>
					<?php if ( get_the_author_meta( 'user_tw' ) ) {
						printf( '<p>' . __( 'Twitter:', 'strombringer' ) . ' <a href="http://twitter.com/%s">%s</a></p>', get_the_author_meta( 'user_tw' ), get_the_author_meta( 'user_tw' ) );
					} ?>
					<?php if ( get_the_author_meta( 'google_profile' ) ) {
						printf( '<p>' . __( 'Google Plus:', 'strombringer' ) . ' <a href="%s">%s</a></p>', get_the_author_meta( 'google_profile' ), get_the_author() );
					} ?>
				</div>
			</div>
			<!-- /.author-description	-->
		</div>
	</div>
	<!-- /.author-info -->
<?php endif; ?>