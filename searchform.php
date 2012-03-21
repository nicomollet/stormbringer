<form action="<?php echo home_url( '/' ); ?>" method="get" class="form-stacked">
    <fieldset>
			<div class="input-prepend input-append">
				<span class="add-on"><i class="icon-search"></i></span><input type="text" name="s" id="search" placeholder="<?php esc_attr_e( 'Search &hellip;', 'stormbringer' ); ?>" value="<?php the_search_query(); ?>" class="input-medium"/><button type="submit" class="btn"><?php esc_attr_e( 'Search', 'stormbringer' ); ?></button>
      </div>
    </fieldset>
</form>