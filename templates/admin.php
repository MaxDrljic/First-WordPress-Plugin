<div class="wrap">
  <h1>Max Plugin Required</h1>
  <?php settings_errors(); ?>

  <form method="post" action="options.php">
    <?php
      settings_fields( 'max_options_group' );
      do_settings_sections( 'max_plugin' );
      submit_button();
    ?>
  </form>
</div>