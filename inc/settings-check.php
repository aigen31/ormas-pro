<?php
function is_smtp_settings_defined()
{
  return defined('SMTP_HOST') && defined('SMTP_PORT') && defined('SMTP_USERNAME') && defined('SMTP_PASSWORD') && defined('SMTP_AUTH') && defined('SMTP_SECURE') && defined('SMTP_FROM_NAME') && defined('SMTP_IS_HTML') && defined('SMTP_TO_EMAIL');
}
function smtp_settings_is_not_defined()
{
?>
  <div class="notice notice-warning">
    <p><?php echo 'SMTP настройки не определены. Пожалуйста, проверьте файл wp-config.php.'; ?></p>
  </div>
<?php
}
add_action('admin_notices', 'smtp_settings_is_not_defined');