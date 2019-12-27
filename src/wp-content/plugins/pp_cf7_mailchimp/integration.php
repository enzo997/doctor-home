<?php
class PPWPCF7_MailChimp extends WPCF7_Service {
    private static $instance;
    private $api;

    public static function get_instance() {
        if ( empty( self::$instance ) ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    private function __construct() {
        $this->api = WPCF7::get_option( 'mailchimp' );
    }

    public function get_title() {
        return __( 'MailChimp', 'pp_cf7_mailchimp' );
    }

    public function is_active() {
        $api = $this->get_api();
        return $api;
    }

    public function icon() {
    }

    public function get_api() {
        if ( empty( $this->api ) ) {
            return false;
        }

        $apikey = $this->api;

        return $apikey;
    }

    private function menu_page_url( $args = '' ) {
        $args = wp_parse_args( $args, array() );

        $url = menu_page_url( 'wpcf7-integration', false );
        $url = add_query_arg( array( 'service' => 'mailchimp' ), $url );

        if ( ! empty( $args) ) {
            $url = add_query_arg( $args, $url );
        }

        return $url;
    }

    public function load( $action = '' ) {
        if ( 'setup' == $action ) {
            if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
                check_admin_referer( 'ppwpcf7-mailchimp-setup' );

                $apikey = isset( $_POST['mc_api'] ) ? trim( $_POST['mc_api'] ) : '';
                if ( '' !== $apikey ) {
                    $mailchimp = new MailChimp_API($apikey);
                    $list = $mailchimp->get_lists();
                    if ($list === false) {
                        $apikey = NULL;
                    }
                }
                if ( $apikey ) {
                    WPCF7::update_option( 'mailchimp', $apikey );
                    $redirect_to = $this->menu_page_url( array(
                        'message' => 'success',
                    ) );
                } elseif ( '' === $apikey ) {
                    WPCF7::update_option( 'mailchimp', null );
                    $redirect_to = $this->menu_page_url( array(
                        'message' => 'success',
                    ) );
                } else {
                    $redirect_to = $this->menu_page_url( array(
                        'action' => 'setup',
                        'message' => 'invalid',
                    ) );
                }

                wp_safe_redirect( $redirect_to );
                exit();
            }
        }
    }

    public function admin_notice( $message = '' ) {
        if ( 'invalid' == $message ) {
            echo sprintf(
                '<div class="error notice notice-error is-dismissible"><p><strong>%1$s</strong>: %2$s</p></div>',
                esc_html( __( "ERROR", 'contact-form-7' ) ),
                esc_html( __( "Invalid key values.", 'contact-form-7' ) ) );
        }

        if ( 'success' == $message ) {
            echo sprintf( '<div class="updated notice notice-success is-dismissible"><p>%s</p></div>',
                esc_html( __( 'Settings saved.', 'contact-form-7' ) ) );
        }
    }

    public function display( $action = '' ) {
        ?>
        <?php
        if ( 'setup' == $action ) {
            $this->display_setup();
            return;
        }

        if ( $this->is_active() ) {
            $sitekey = $this->get_api();
            ?>
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row"><?php echo esc_html( __( 'API Key', 'contact-form-7' ) ); ?></th>
                    <td class="code"><?php echo esc_html( $sitekey ); ?></td>
                </tr>
                </tbody>
            </table>

            <p><a href="<?php echo esc_url( $this->menu_page_url( 'action=setup' ) ); ?>" class="button"><?php echo esc_html( __( "Reset Keys", 'contact-form-7' ) ); ?></a></p>

            <?php
        } else {
            ?>
            <p><a href="<?php echo esc_url( $this->menu_page_url( 'action=setup' ) ); ?>" class="button"><?php echo esc_html( __( "Configure Keys", 'contact-form-7' ) ); ?></a></p>
            <?php
        }
    }

    public function display_setup() {
        ?>
        <form method="post" action="<?php echo esc_url( $this->menu_page_url( 'action=setup' ) ); ?>">
            <?php wp_nonce_field( 'ppwpcf7-mailchimp-setup' ); ?>
            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row"><label for="mc_api"><?php echo esc_html( __( 'API Key', 'contact-form-7' ) ); ?></label></th>
                    <td><input type="text" aria-required="true" value="" id="mc_api" name="mc_api" class="regular-text code" /></td>
                </tr>
                </tbody>
            </table>

            <p class="submit"><input type="submit" class="button button-primary" value="<?php echo esc_attr( __( 'Save', 'contact-form-7' ) ); ?>" name="submit" /></p>
        </form>
        <?php
    }
}

add_action( 'wpcf7_init', 'ppwpcf7_mailchimp_register_service' );

function ppwpcf7_mailchimp_register_service() {
    $integration = WPCF7_Integration::get_instance();

    $categories = array(
        'mailchimp' => __( 'MailChimp', 'contact-form-7' ),
    );

    foreach ( $categories as $name => $category ) {
        $integration->add_category( $name, $category );
    }

    $services = array(
        'mailchimp' => PPWPCF7_MailChimp::get_instance(),
    );

    foreach ( $services as $name => $service ) {
        $integration->add_service( $name, $service );
    }
}