<?php
/**
 * The template for displaying the Footer.
 *
 * @package StormBringer
 * @since StormBringer 0.1
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

<?php //get_template_part('modal', 'login'); ?>

<?php wp_footer(); // js scripts are inserted using this function ?>
<script type="text/javascript">
var template_url = '<?php bloginfo("template_url"); ?>';
</script>
</body>
</html>