<?php
/**
 * The template for displaying Taxonomy description
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<?php
if ( is_category() ) {
  $category = get_the_category();
  echo '<a href="'.get_category_feed_link( $category[0]->term_id).'" class="taxonomy-feed">'.__("Feed",'stormbringer').'</a>';
  // show an optional category description
  $category_description = category_description();
  if ( ! empty( $category_description ) )
    echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );

} elseif ( is_tag() ) {
  // show an optional tag description
  $tag_description = tag_description();
  if ( ! empty( $tag_description ) )
    echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
}
?>