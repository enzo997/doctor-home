<?php
/*
Plugin Name: Contact Form 7 - Embed  MailChimp
Plugin URI: https://pixel-perfect.com.au/
Description: Just another contact form plugin. Simple but flexible.
Author: Mr. Oliver
Author URI: https://pixel-perfect.com.au/
Text Domain: pp_cf7_mailchimp
Domain Path: /languages/
Version: 1.0.0
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$cf7_active = is_plugin_active('contact-form-7/wp-contact-form-7.php');
if($cf7_active) {

    define('PPCF7MC_PLUGIN', __FILE__);
    define('PPCF7MC_PLUGIN_DIR', untrailingslashit(dirname(PPCF7MC_PLUGIN)));

    require_once PPCF7MC_PLUGIN_DIR . '/integration.php';
    require_once PPCF7MC_PLUGIN_DIR . '/mailchimp.php';

    add_filter('wpcf7_editor_panels', 'ppwpcf7mc_editor_panels');
    function ppwpcf7mc_editor_panels($panels)
    {
        $panels['pp-cf7-mailchimp-panel'] = array(
            'title' => __('MailChimp', 'pp_cf7_mailchimp'),
            'callback' => 'pp_cf7_mailchimp_panel_content',
        );
        return $panels;
    }

    function pp_cf7_mailchimp_panel_content($post)
    {
        $api = WPCF7::get_option( 'mailchimp' );
        if(!$api){
            $url = menu_page_url( 'wpcf7-integration', false );
            $url = add_query_arg( array( 'service' => 'mailchimp' ), $url );

            if ( ! empty( $args) ) {
                $url = add_query_arg( $args, $url );
            }

            $url = $url.'&action=setup';
            ?>
            <h2>MailChimp</h2>
            <div>
                <a href="<?php echo $url; ?>"><?php _e('Please setup API key'); ?></a>
            </div>
            <?php
        }
        else {
            $values = $post->get_properties()['mailchimp'];
            $v_list = isset($values['list']) ? $values['list'] : '';
            $email = isset($values['email']) ? $values['email'] : '[your-email]';
            $name = isset($values['name']) ? $values['name'] : '[your-name]';
            $mailchimp = new MailChimp_API();
            $list = $mailchimp->get_lists();
            ?>
            <h2>MailChimp</h2>
            <fieldset>
                <table class="form-table">
                    <tr>
                        <th scope="row">
                            <label for="wpcf7-mailchimp-list">List</label>
                        </th>
                        <td>
                            <select name="wpcf7-mailchimp-list" id="wpcf7-mailchimp-list" class="large-text code"
                                    data-config-field="mailchimp.list">
                                <option value="">Select a list</option>
                                <?php foreach ($list as $item): ?>
                                    <option value="<?php echo $item->id; ?>" <?php if ($v_list == $item->id) echo 'selected'; ?>><?php echo $item->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpcf7-mailchimp-email">Email</label>
                        </th>
                        <td>
                            <input type="text" id="wpcf7-mailchimp-email" name="wpcf7-mailchimp-email"
                                   class="large-text code" value="<?php echo $email; ?>"
                                   data-config-field="mailchimp.email">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="wpcf7-mailchimp-name">Name</label>
                        </th>
                        <td>
                            <input type="text" id="wpcf7-mailchimp-name" name="wpcf7-mailchimp-name"
                                   class="large-text code"
                                   value="<?php echo $name; ?>" data-config-field="mailchimp.name">
                        </td>
                    </tr>
                </table>
            </fieldset>
            <?php
        }
    }

    add_filter('wpcf7_contact_form_properties', 'ppwpcf7mc_contact_form_properties');
    function ppwpcf7mc_contact_form_properties($properties)
    {
        if (!isset($properties['mailchimp'])) {
            $properties['mailchimp'] = array();
        }
        return $properties;
    }

    add_action('wpcf7_save_contact_form', 'ppwpcf7mc_save_contact_form', 10, 3);
    function ppwpcf7mc_save_contact_form($contact_form, $args, $context = 'save')
    {
        $properties = $contact_form->get_properties();
        $properties['mailchimp'] = array(
            'list' => $args["wpcf7-mailchimp-list"],
            'email' => $args["wpcf7-mailchimp-email"],
            'name' => $args["wpcf7-mailchimp-name"],
        );
        $contact_form->set_properties($properties);

        $properties = $contact_form->get_properties();
        if ('save' == $context) {
            $contact_form->save();
        }

        return $contact_form;
    }

    add_action('wpcf7_before_send_mail','ppwpcf7mc_before_send_mail',1);
    function ppwpcf7mc_before_send_mail($contact_form) {
        $api_key = WPCF7::get_option('mailchimp');
        if($api_key) {
            $properties = $contact_form->get_properties();
            if (isset($properties['mailchimp']) && isset($properties['mailchimp']['list']) && $properties['mailchimp']['list'] && isset($properties['mailchimp']['email']) && $properties['mailchimp']['email']) {
                $list = $properties['mailchimp']['list'];
                $email = $properties['mailchimp']['email'];
                $user = array();
				if(isset($_POST[preg_replace('/[^A-Za-z0-9:._-]/', '', $email)]) && trim($_POST[preg_replace('/[^A-Za-z0-9:._-]/', '', $email)])){
					$user['email'] = $_POST[preg_replace('/[^A-Za-z0-9:._-]/', '', $email)];
					$name = $properties['mailchimp']['name'];
					if(isset($_POST[preg_replace('/[^A-Za-z0-9:._-]/', '', $name)]) && trim($_POST[preg_replace('/[^A-Za-z0-9:._-]/', '', $name)])){
						$name = trim($_POST[preg_replace('/[^A-Za-z0-9:._-]/', '', $name)]);
						$user['fname'] = $name;
						$user['lname'] = '';
						if ($name) {
							$pos = strpos($name, ' ');
							if ($pos !== false) {
								$user['fname'] = trim(substr($name, 0, $pos));
								$user['lname'] = trim(substr($name, $pos));
							}
						}
					}
					$mailchimp = new MailChimp_API();
					$msg = $mailchimp->add_subscribe($user, $list);
				}
            }
        }
        return $contact_form;
    }

}