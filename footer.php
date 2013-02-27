<?php
/**
 * The template for displaying the Footer.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 */
?>

    </div>
  </div>
</div>
<!-- /#main -->

<footer role="contentinfo" id="footer">
  <div class="container">
    <div class="row">
      <?php if (is_active_sidebar('footer_widgets')) : ?>
        <?php dynamic_sidebar('footer_widgets'); ?>
      <?php endif; ?>
    </div>
  </div>
</footer>
<!-- /#footer -->

<div id="fancybox-ajaxcontainer">
    <div id="fancybox-ajaxcontent">
        <div id="fancybox-ajaxinner">
            <!-- ajax load -->
        </div>
    </div>
</div>

<div class="modal hide do-not-print" id="modal-item" tabindex="-1" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <p class="modal-title"></p>
  </div>
  <div class="modal-body">
    <p>Chargement…</p>
  </div>
</div>
<!-- /#modal-item -->

<?php //get_template_part('modal', 'login'); ?>

<?php wp_footer(); ?>

<script type="text/javascript">
var template_url = '<?php bloginfo("template_url"); ?>';
</script>
</body>
</html>