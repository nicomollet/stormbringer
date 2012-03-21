<?php get_header(); ?>

    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">

      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">

        <?php if (BREADCRUMB_ACTIVE) breadcrumb_trail();?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'stormbringer' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>
        <?php get_template_part('content', 'index'); ?>
      </div><!-- /#main -->

      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
        <?php get_sidebar(); ?>
      </aside><!-- /#sidebar -->

    </div><!-- /#content -->

<?php get_footer(); ?>