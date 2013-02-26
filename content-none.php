<?php
/**
 * The template for displaying a 404 content.
 *
 * @package StormBringer
 * @since StormBringer 0.1
 */
?>

<article id="post-not-found">

  <header class="page-header entry-header 404-header">
    <h1 class="page-title entry-title"><?php _e("Page non trouvée", "stormbringer"); ?></h1>
  </header>

  <section class="entry-content">
    <p><?php _e("Le contenu que vous cherchez n'est pas ici.", "stormbringer"); ?></p>
  </section>

  <footer>
  </footer>

</article>

<?php get_search_form(); ?>
