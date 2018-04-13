<?php
/**
 * The template for displaying a 404 content.
 *
 * @package StormBringer
 * @since   StormBringer 0.0.1
 */
?>

<article id="post-not-found" class="post-not-found">

    <header class="page-header error404-header">
        <h1 class="page-title error404-title"><?php _e('Page not found', 'stormbringer'); ?></h1>
    </header>

    <div class="entry-content">
        <p><?php _e('The content you are looking for is not here.', 'stormbringer'); ?></p>
    </div>

    <footer class="entry-meta">
    </footer>

</article>

<?php get_search_form(); ?>
