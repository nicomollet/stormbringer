<?php /* If there are no posts to display, such as an empty archive page */ ?>

<article id="post-not-found">
  <header class="entry-header 404-header">
    <h1 class="entry-title"><?php _e("Page non trouvée", "stormbringer"); ?></h1>
  </header>
  <footer>
  </footer>
  <section class="entry-content">
    <p><?php _e("Le contenu que vous cherchez n'est pas ici.", "stormbringer"); ?></p>
  </section>
</article>
<?php get_search_form(); ?>
