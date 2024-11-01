<?php
/**
 * @package Wonderm00n's Gallery Link Size Changer
 * @subpackage Settings Page
 *
 * @since 0.1
 * @author Marco Almeida (Wonderm00n)
 *
 *
 */
 
		//First we save!
		if ( isset($_POST['action']) ) {
			if (trim($_POST['action'])=='save') {
				//This should also use the $wonderm00n_gallery_link_plugin_settings array, but because of intval and trim we still can't
				update_option($wonderm00n_gallery_link_plugin_settings_prefix.'settings_set', 1);
				update_option($wonderm00n_gallery_link_plugin_settings_prefix.'default_size', trim(stripslashes($_POST['default_size'])));
				update_option($wonderm00n_gallery_link_plugin_settings_prefix.'add_to_link', trim(stripslashes($_POST['add_to_link'])));
			}
		}
		//And we get the values again
		foreach($wonderm00n_gallery_link_plugin_settings as $key) {
			$wonderm00n_gallery_link_settings[$key]=get_option($wonderm00n_gallery_link_plugin_settings_prefix.$key);
		}
	
?>
	<div class="wrap">
		
	<?php screen_icon(); ?>
  	<h2>Wonderm00n's  Gallery Link Size Changer (<?php echo $wonderm00n_gallery_link_plugin_version; ?>)</h2>
  	
  	<?php
  	settings_fields('wonderm00n_gallery_link');
  	?>
  	
  	<div class="postbox-container" style="width: 69%;">
  		<div id="poststuff">
  			<form name="form1" method="post">
	  			<div id="wonderm00n_gallery_link-settings" class="postbox">
	  				<h3 id="settings">Settings</h3>
	  				<div class="inside">
	  					<table width="100%" class="form-table">
								
								<tr class="default_size_options">
									<th scope="row" nowrap="nowrap">Default size for gallery links:</th>
									<td>
										<?php
										$sizes[]='thumbnail';
										$sizes[]='medium';
										$sizes[]='large';
										$sizes[]='full';
										?>
										<select name="default_size" id="default_size">
											<?php
											foreach($sizes as $size) {
												?>
												<option value="<?php echo $size; ?>"<?php if ($size==$wonderm00n_gallery_link_settings['default_size']) echo ' selected="selected"'; ?>><?php echo $size; ?></option>
												<?php
											}
											?>
										</select>
									</td>
								</tr>
								
								<tr class="add_to_link_options">
									<th scope="row" nowrap="nowrap">Add to link (A) tag:</th>
									<td>
										<input type="text" name="add_to_link" id="add_to_link" size="50" value="<?php echo htmlentities(trim($wonderm00n_gallery_link_settings['add_to_link'])); ?>"/>
										<br/>Arguments to be added to the link tag.<br/>Example: <code>class="fancybox" rel="gallery"</code> to use the Fancybox tool (which you need to call from your theme) on gallery mode.
									</td>
								</tr>
								
	  					</table>
	  				</div>
	  			</div>
	  			
	  			<p class="submit">
	  				<input type="hidden" name="action" value="save"/>
						<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
					</p>
  			</form>
  		</div>
  	</div>
  	
  	<?php
  		$links[30]['text']='Plugin official URL (feedback is welcomed)';
  		$links[30]['url']='http://blog.wonderm00n.com/2012/11/23/wordpress-plugin-gallery-link-size-changer/';
  		$links[40]['text']='Author\'s website: Marco Almeida (Wonderm00n)';
  		$links[40]['url']='http://wonderm00n.com';
  		$links[50]['text']='Author\'s Twitter account: @Wonderm00n';
  		$links[50]['url']='http://twitter.com/wonderm00n';
  		$links[60]['text']='Author\'s Facebook account: Wonderm00n';
  		$links[60]['url']='http://www.facebook.com/wonderm00n';
  	?>
  	<div class="postbox-container" style="width: 29%; float: right;">
  		
  		<div id="poststuff">
  			<div id="wonderm00n_gallery_link_links" class="postbox">
  				<h3 id="settings">Rate this plugin</h3>
  				<div class="inside">
  					If you like this plugin, <a href="http://wordpress.org/extend/plugins/wonderm00ns-gallery-link-size-changer/" target="_blank">please give it a high Rating</a>.
  				</div>
  			</div>
  		</div>
		
  		<div id="poststuff">
  			<div id="wonderm00n_gallery_link_links" class="postbox">
  				<h3 id="settings">Useful links</h3>
  				<div class="inside">
  					<ul>
  						<?php foreach($links as $link) { ?>
  							<li>- <a href="<?php echo $link['url']; ?>" target="_blank"><?php echo $link['text']; ?></a></li>
  						<?php } ?>
  					</ul>
  				</div>
  			</div>
  		</div>
  	
  		<div id="poststuff">
  			<div id="wonderm00n_gallery_link_donation" class="postbox">
  				<h3 id="settings">Donate</h3>
  				<div class="inside">
  					<p>If you find this plugin useful and want to make a contribution towards future development please consider making a small, or big ;-), donation.</p>
  					<center><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_donations">
						<input type="hidden" name="business" value="wonderm00n@gmail.com">
						<input type="hidden" name="lc" value="PT">
						<input type="hidden" name="item_name" value="Marco Almeida (Wonderm00n)">
						<input type="hidden" name="item_number" value="wonderm00n_gallery_link">
						<input type="hidden" name="currency_code" value="USD">
						<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHosted">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form></center>
  				</div>
  			</div>
  		</div>
  		
  	</div>
  	
  	<div class="clear">
  		<p><br/>&copy 2012<?php if(date('Y')>2012) echo '-'.date('Y'); ?> <a href="http://wonderm00n.com" target="_blank">Marco Almeida (Wonderm00n)</a></p>
  	</div>
		
	</div>
	
	<script type="text/javascript">
	</script>
	<style type="text/css">
		TABLE.form-table TR TH {
			font-weight: bold;
		}
	</style>