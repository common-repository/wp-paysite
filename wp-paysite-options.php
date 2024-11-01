<?php

### Variables Variables Variables
$base_name = plugin_basename('wp-paysite/paysite-options.php');
$base_page = 'admin.php?page='.$base_name;
$mode = trim($_GET['mode']);
$paysite_settings = array('paysite_options');

if(!empty($_POST['Submit'])) {
        $paysite_options = array();
        $paysite_options['members_root'] = addslashes($_POST['paysite_members_root']);
        $paysite_options['thumbs_dir'] = addslashes($_POST['paysite_thumbs_dir']);
        $paysite_options['thumbs_prefix'] = addslashes($_POST['paysite_thumbs_prefix']);
        $update_paysite_queries = array();
        $update_paysite_text = array();
        $update_paysite_queries[] = update_option('paysite_options', $paysite_options);
        $i=0;
        $text = '';
        foreach($update_paysite_queries as $update_paysite_query) {
                if($update_paysite_query) {
                        $text .= '<font color="green">'.$update_paysite_text[$i].' '.__('Updated', 'wp-paysite').'</font><br />';
                }
                $i++;
        }
        if(empty($text)) {
                $text = '<font color="red">'.__('No Option Updated', 'wp-paysite').'</font>';
        }
}


 $paysite_options = get_option('paysite_options');

?>
<?php if(!empty($text)) { echo '<!-- Last Action --><div id="message" class="updated fade"><p>'.$text.'</p></div>'; } ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=<?php echo plugin_basename(__FILE__); ?>">
<div class="wrap">
        <?php screen_icon(); ?>
        <h2><?php _e('Paysite Settings', 'wp-paysite'); ?></h2>
        <table class="form-table">
                <tr><th scope="row" valign="top"><?php _e('<strong>Server Path to Member Area Root</strong><br /><small>Full path is required.</small>', 'wp-paysite'); ?></th>
                    <td><input type="text" name="paysite_members_root" value="<?php echo stripslashes($paysite_options['members_root']); ?>" size="50" /><br />
                        <?php _e('e.g. /home/usr/sitename/public_html/members', 'wp-paysite'); ?>
                    </td>
                </tr>
                <tr><th scope="row" valign="top"><?php _e('<strong>Thumbnails Directory Path</strong><br /><small>Relative to original set folder.</small>', 'wp-paysite'); ?></th>
                    <td><input type="text" name="paysite_thumbs_dir" value="<?php echo stripslashes($paysite_options['thumbs_dir']); ?>" size="50" /><br />
                        <?php _e('e.g. ../thumbnails', 'wp-paysite'); ?>
                    </td>
                </tr>
                <tr><th scope="row" valign="top"><?php _e('<strong>Thumbnails Prefix</strong><br /><small>Blank for same name.</small>', 'wp-paysite'); ?></th>
                    <td><input type="text" name="paysite_thumbs_prefix" value="<?php echo stripslashes($paysite_options['thumbs_prefix']); ?>" size="50" /><br />
                        <?php _e('e.g. thumb_', 'wp-paysite'); ?>
                    </td>
                </tr>
        </table>
        <p class="submit">
                <input type="submit" name="Submit" class="button" value="<?php _e('Save Changes', 'wp-paysite'); ?>" />
        </p>
</div>
</form> 
<p>&nbsp;</p>