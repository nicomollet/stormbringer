    </div>
  </div>
</div>
<!-- /#main -->

<footer role="contentinfo" id="prefooter" class="do-not-print">
  <div class="container">
    <div class="row">
      <div class="span5">
        <div id="prefooter-brand">
        </div>
      </div>
      <div class="span7">
        <div id="prefooter-formnewsletter">

        </div>
      </div>
    </div>
  </div>
</footer>

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