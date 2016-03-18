<?php
/**
 * The template for displaying the Loop Content.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>

<?php
//$contents_per_row = 3;
?>

<?php
// Open row if $contents_per_row!=1
/*if(!is_singular() && $contents_per_row != 1){
	if($wp_query->current_post % $contents_per_row == 0){
		echo '<div class="content-row">';
	}
}*/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?>>

	<?php // Only show edit button if user has permission to edit posts
	global $user_level;
	if ( ($user_level > 0 && !is_singular()) || ( !is_admin_bar_showing() && $user_level > 0 && is_singular() ) ) {
		$edit_link = '<a href="' . get_edit_post_link( get_the_ID() ) . '" class="btn btn-success edit-post pull-right"><span class="glyphicon glyphicon-pencil"></span> ' . __( 'Edit', 'stormbringer' ) . '</a>';
	}
	?>
	<?php if ( is_single() || is_page() || is_singular() ) { ?>
		<header class="page-header">
			<?php echo $edit_link; ?>
			<h1 class="entry-title page-title"><?php the_title(); ?></h1>
		</header>
	<?php } else { ?>
		<header class="entry-header">
			<?php echo $edit_link; ?>
			<h2 class="entry-title">
				<a title="<?php printf( esc_attr__( 'Link to %s', 'stormbringer' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
		</header>
	<?php } ?>
	<!-- /.entry-header -->

	<footer class="entry-meta">

		<p class="entry-date">
			<i class="glyphicon glyphicon-calendar"></i>
			<time datetime="<?php echo the_time( 'c' ); ?>" class="updated"><?php echo get_the_date( esc_attr__( 'F j, Y', 'stormbringer' ) ); ?></time>
		</p>

		<p class="entry-author">
			<i class="glyphicon glyphicon-user"></i> <?php _e( 'By', 'stormbringer' ); ?> <span class="vcard author"><span class="fn"><?php echo get_the_author(); ?></span></span>
		</p>

		<?php if ( comments_open() && ! is_page() ) : ?>
			<p class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply"><span class="glyphicon glyphicon-comment"></span> ' . __( 'Leave a comment', 'stormbringer' ) . '</span>', '<span class="glyphicon glyphicon-comment"></span> ' . _x( '1 comment', 'comments number', 'stormbringer' ), '<span class="glyphicon glyphicon-comment"></span> ' . _x( '% comments', 'comments number', 'stormbringer' ) ); ?>
			</p>
		<?php endif; // End if comments_open() ?>

		<?php
		$categories_list = get_the_category_list( __( ', ', 'stormbringer' ) );
		if ( $categories_list ): ?>
			<p class="entry-categories">
				<?php printf( __( '<span class="%1$s"><span class="glyphicon glyphicon-book"></span> Categories:</span> %2$s', 'stormbringer' ), 'intro', $categories_list ); ?>
			</p>
		<?php endif; // End if $categories_list ?>

		<?php
		$tags_list = get_the_tag_list( '', __( ', ', 'stormbringer' ) );
		if ( $tags_list ): ?>
			<p class="entry-tags">
				<?php printf( __( '<span class="%1$s"><span class="glyphicon glyphicon-tags"></span> Tags:</span> %2$s', 'stormbringer' ), 'intro', $tags_list ); ?>
			</p>
		<?php endif; // End if $tags_list ?>


	</footer>

	<!-- /.entry-meta -->

	<div class="entry-content">

		<?php if ( is_archive() || is_search() ) { ?>
			<?php echo get_the_excerpt(); ?>
		<?php } else { ?>
			<?php the_content(); ?>
			<?php
			// JetPack sharing
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
			?>
		<?php } ?>

	</div>
	<!-- /.entry-content -->

</article>
<!-- /#post -->

<?php
// Close row if $contents_per_row!=1
/*if(!is_singular() && $contents_per_row != 1){
	if($wp_query->current_post % $contents_per_row == ($contents_per_row - 1 )){
		echo '</div>';
	}
	elseif (($wp_query->current_post+1) == $wp_query->post_count) {
		echo '</div> <!-- the last row -->';
	}
}*/
?>