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

<div class="modal fade do-not-print" id="modal-default" tabindex="-1" aria-hidden="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body in-frame">
        <iframe id="modal-frame" name="modal-frame" src="about:blank" sandbox="allow-same-origin allow-forms allow-popups"></iframe>
      </div>

    </div>
  </div>
</div>
<!-- /#modal-default -->

<?php wp_footer(); ?>
</body>
</html>