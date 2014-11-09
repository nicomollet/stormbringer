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



<div id="fancybox-ajaxcontainer">
    <div id="fancybox-ajaxcontent">
        <div id="fancybox-ajaxinner">
            <!-- ajax load -->
        </div>
    </div>
</div>

<div class="modal fade do-not-print" id="modal-default" tabindex="-1" aria-hidden="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body in-frame">
        <iframe id="modal-frame" name="modal-frame" src="about:blank"></iframe>
      </div>

    </div>
  </div>
</div>
<!-- /#modal-default -->

<script type="text/javascript">
var template_url = '<?php bloginfo("template_url"); ?>';
<?php
$lightbox = '';
if(current_theme_supports('lightbox')){
	$lightbox = get_theme_support('lightbox')[0];
}
?>
var lightbox = '<?php echo $lightbox;?>';
</script>
<?php wp_footer(); ?>
</body>
</html>