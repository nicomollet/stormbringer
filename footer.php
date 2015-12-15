<?php
/**
 * The template for displaying the Footer.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>

      </div>
      <!-- /.main-inner -->
    </div>
    <!-- /#main -->
  </div>
    <!-- /.main-wrapper -->

  <div class="footer-wrapper">

    <footer role="contentinfo" id="footer">
      <div class="footer-inner">
        <?php if (is_active_sidebar('footer_widgets')) : ?>
          <?php dynamic_sidebar('footer_widgets'); ?>
        <?php endif; ?>
      </div>
    </footer>
    <!-- /#footer -->

  </div>
	<!-- /.footer-wrapper -->

</div>
<!-- /#wrapper -->

<?php wp_footer(); ?>
</body>
</html>