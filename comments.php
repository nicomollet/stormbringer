<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to alienship_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @package StormBringer
 * @since StormBringer 0.1
 */
?>

<section id="comments">
<?php if ( post_password_required() ) : ?>
  	<div class="alert alert-info"><?php _e("Ce contenu est protégé par un mot de passe. Saisissez le mot de passe pour voir les commentaires.","stormbringer"); ?></div>
  <?php
    return;
  endif;
?>

<?php if ( have_comments() ) : ?>
	
	<h3 class="comments-title"><?php comments_number('<span>' . __("Aucun","stormbringer") . '</span> ' . __("commentaire","stormbringer") . '', '<span>' . __("Un","stormbringer") . '</span> ' . __("commentaire","stormbringer") . '', '<span>%</span> ' . __("commentaires","stormbringer") );?> <?php _e("sur","stormbringer"); ?> &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="comments-list media-list">
		<?php wp_list_comments('type=comment&callback=stormbringer_comments'); ?>
	</ol>

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comments-nav" class="pager">
      <div class="nav-previous pull-left"><?php previous_comments_link( __( '&larr; Précédents commentaires', 'stormbringer' ) ); ?></div>
      <div class="nav-next pull-right"><?php next_comments_link( __( 'Commentaires suivants &rarr;', 'stormbringer' ) ); ?></div>
    </nav>
  <?php endif; // check for comment navigation ?>

  
	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
    <!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed 
	?>
	
    <!-- If comments are closed. -->
    <p class="alert alert-info comments-closed"><?php _e("Les commentaires sont fermés","stormbringer"); ?>.</p>


	<?php endif; ?>

<?php endif; ?>


<?php if ( comments_open() ) : ?>

<section id="respond" class="respond-form">

	<h3 id="comment-form-title"><?php comment_form_title( __("Laisser un commentaire","stormbringer"), __("Laisse un commentaire en réponse à","stormbringer") . ' %s' ); ?></h3>

	<div id="cancel-comment-reply">
		<p class="small"><?php cancel_comment_reply_link( __("Annuler","stormbringer") ); ?></p>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
  	<div class="help">
  		<p><?php _e("Vous devez être","stormbringer"); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e("identifié","stormbringer"); ?></a> <?php _e("pour laisser un commentaire","stormbringer"); ?>.</p>
  	</div>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="form-vertical" id="commentform">

	<?php if ( is_user_logged_in() ) : ?>

	<p class="comments-logged-in-as"><?php _e("Identifié en tant que","stormbringer"); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php _e("Se déconnecter de ce compte","stormbringer"); ?>"><?php _e("Se déconnecter","stormbringer"); ?> &raquo;</a></p>

	<?php else : ?>
	
	<ul id="comment-form-elements" class="clearfix">
		
		<li>
			<div class="control-group">
			  <label for="author"><?php _e("Nom","stormbringer"); ?> <?php if ($req) _e("(obligatoire)","stormbringer"); ?></label>
			  <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span><input class="input-small" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" placeholder="<?php _e("Votre nom","stormbringer"); ?>" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
			  </div>
		  	</div>
		</li>
		
		<li>
			<div class="control-group">
			  <label for="email"><?php _e("Email","stormbringer"); ?> <?php if ($req) _e("(obligatoire)","stormbringer"); ?></label>
			  <div class="input-prepend"><span class="add-on"><i class="icon-mail"></i></span><input class="input-small" type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" placeholder="<?php _e("Votre email","stormbringer"); ?>" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
			  	<span class="help-inline">(<?php _e("ne sera pas publié","stormbringer"); ?>)</span>
			  </div>
		  	</div>
		</li>
		
		<li>
			<div class="control-group">
			  <label for="url"><?php _e("Site web","stormbringer"); ?></label>
			  <div class="input-prepend"><span class="add-on"><i class="icon-home"></i></span><input class="input-small" type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" placeholder="<?php _e("Votre site web","stormbringer"); ?>" tabindex="3" />
			  </div>
		  	</div>
		</li>
	</ul>

	<?php endif; ?>
	
  <label for="comment" class="control-label"><?php _e('Commentaire', 'stormbringer'); ?></label>
  <div class="input-prepend"><span class="add-on"><i class="icon-comment"></i></span><textarea placeholder="<?php _e("Votre commentaire…","stormbringer"); ?>" name="comment" id="comment" class="input-large" rows="6" tabindex="4"></textarea>
  </div>

  <div class="form-actions">
    <input class="btn btn-primary" name="submit" type="submit" id="submit" tabindex="5" value="<?php _e("Envoyer le commentaire","stormbringer"); ?>" />
  </div>
  <?php comment_id_fields(); ?>

	<?php 
		//comment_form();
		do_action('comment_form()', $post->ID); 
	
	?>
	
	</form>
	
	<?php endif; // If registration required and not logged in ?>
</section>

<?php endif; // if you delete this the sky will fall on your head ?>
</section>