<footer role="contentinfo" id="footer">

  <div id="inner-footer" class="clearfix">
    <hr/>
    <div id="widget-footer" class="clearfix row">
      <?php if (is_active_sidebar('footer_widgets')) : ?>
        <?php dynamic_sidebar('footer_widgets'); ?>
      <?php else : ?>
        <div class="alert alert-block fade in">
          <a class="close" data-dismiss="alert">×</a>
          <p><?php _e('Please activate some Widgets', 'roots'); ?></p>
        </div>
      <?php endif; ?>
    </div>
  </div><!-- /#inner-footer -->
</footer><!-- /#footer -->

</div><!-- /#wrap -->

<?php get_template_part('modal', 'login'); ?>

<?php wp_footer(); // js scripts are inserted using this function ?>
</body>
</html>