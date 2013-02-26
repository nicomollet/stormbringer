<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-stacked">
    <fieldset>
			<div class="input-append">
				<input type="text" name="s" id="search" placeholder="<?php esc_attr_e( 'Recherche &hellip;', 'stormbringer' ); ?>" value="<?php the_search_query(); ?>" class="input-medium"/><span class="add-on"><i class="icon-search"></i></span><!--<button type="submit" class="btn"><?php esc_attr_e( 'Recherche', 'stormbringer' ); ?></button>-->
      </div>
    </fieldset>
</form>