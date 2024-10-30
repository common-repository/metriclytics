<div class="wrap">
<h2>MetricLytics</h2>
<div>If you do not already have an account, you can go to <a href="http://www.metriclytics.com">MetricLytics.com</a> and create an account.</div>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<?php settings_fields('metriclytics'); ?>

<table class="form-table">

<tr valign="top">
<th scope="row">Web Token ID:</th>
<td><input name="webTokenId" type="text" value="<?php echo get_option('webTokenId'); ?>" size="40" maxlength="40" /> (You can find in the section "tracking code" in the site of your account of MetricLytics)</td>
</tr>
</table>

<input type="hidden" name="action" value="update" />
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
