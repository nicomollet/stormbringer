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

</div>
<!-- /#wrapper -->



<div id="fancybox-ajaxcontainer">
    <div id="fancybox-ajaxcontent">
        <div id="fancybox-ajaxinner">
            <!-- ajax load -->
        </div>
    </div>
</div>

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
	<!-- The container for the modal slides -->
	<div class="slides"></div>
	<!-- Controls for the borderless lightbox -->
	<h3 class="title"></h3>
	<a class="prev">‹</a>
	<a class="next">›</a>
	<a class="close">×</a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
	<!-- The modal dialog, which will be used to wrap the lightbox content -->
	<div class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" aria-hidden="true">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body next"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left prev">
						<i class="glyphicon glyphicon-chevron-left"></i>
						Previous
					</button>
					<button type="button" class="btn btn-primary next">
						Next
						<i class="glyphicon glyphicon-chevron-right"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /#modal-gallery -->

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

<?php //get_template_part('modal', 'login'); ?>

<?php wp_footer(); ?>

<script type="text/javascript">
var template_url = '<?php bloginfo("template_url"); ?>';
var lightbox ='<?php echo LIGHTBOX;?>';
</script>
</body>
</html>