<?php defined('BASEPATH') or exit('No direct script access allowed');
echo theme_head_view();
get_template_part_pur($navigationEnabled ? 'navigation' : '');
?>
<div id="wrapper">
   <div id="content">
      <div class="container">
         <div class="row">
            <?php get_template_part_pur('alerts'); ?>
         </div>
      </div>
  
      <div class="container">
         <?php hooks()->do_action('customers_content_container_start'); ?>
         <div class="row">
           
            <?php echo theme_template_view(); ?>
         </div>
      </div>
   </div>
   <?php
   echo theme_footer_view();
   ?>
</div>
<?php
/* Always have app_customers_footer() just before the closing </body>  */
app_customers_footer();
   /**
   * Check for any alerts stored in session
   */
   app_js_alerts();

   //9.4 AG: for test
   
   ?>
   <!-- select 2 js -->
<script src="<?php echo base_url();?>assets/plugins/select2/js/select2.min.js"></script>;
   <!-- custom js -->
<link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/acer-custom.css" rel="stylesheet">
   <!-- light box  -->
<script type="text/javascript" src="<?php echo module_dir_url(PURCHASE_MODULE_NAME, 'assets/plugins/simplelightbox/simple-lightbox.min.js'); ?> " > </script>
<script type="text/javascript" src="<?php echo module_dir_url(PURCHASE_MODULE_NAME, 'assets/plugins/simplelightbox/simple-lightbox.jquery.min.js'); ?> " > </script>
<script type="text/javascript" src="<?php echo module_dir_url(PURCHASE_MODULE_NAME, 'assets/plugins/simplelightbox/masonry-layout-vanilla.min.js'); ?> " > </script>

</body>
</html>
