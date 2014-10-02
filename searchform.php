<?php
/**
 * The template for displaying a Search Form
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>
<form action="<?php echo home_url( '/' ); ?>" method="get" class="form">
    <div class="input-group">
      <input type="text" name="s" id="search" placeholder="<?php esc_attr_e( 'Search &hellip;', 'stormbringer' ); ?>" value="<?php the_search_query(); ?>" class="form-control"/><span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><!--<button type="submit" class="btn"><?php esc_attr_e( 'Search', 'stormbringer' ); ?></button>-->
    </div>
</form>