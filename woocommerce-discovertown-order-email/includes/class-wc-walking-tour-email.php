<?php

if(!defined('ABSPATH')){
  exit;
}


/**
 * New Order Email.
 *
 * An email sent to the admin when a new order is received/paid for.
 *
 * @class       WC_City_Tour_Email
 * @version     2.0.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */

class WC_Walking_Tours_Email extends WC_Email{
  var $countries;
  /**
  * Constructor
  */

  public function __construct(){
    $this->countries = new WC_Countries();
    $billingfields = $this->countries->get_address_fields($this->countries->get_base_country(), 'billing');

    $current_user = wp_get_current_user();
    //setting the ID
    $this->id               = 'walkingtour'; //changed this
  	$this->title            = __( 'Muir Woods', 'woocommerce' );
  	$this->description      = __( 'New order emails are sent to chosen recipient(s) when a new order is received.', 'woocommerce' );
  	$this->heading          = __( 'New customer order', 'woocommerce' );
  	$this->subject          = __( '[{site_title}] New customer order ({order_number}) - {order_date}', 'woocommerce' );
  	$this->template_html    = 'emails/admin-new-order.php';
  	$this->template_plain   = 'emails/plain/admin-new-order.php';


  add_action('woocommerce_order_actions', 'discovertown_action', 10, 1 );

    //call parent constructor to load any other defaults
  parent::__construct();
  		// Other settings
  $this->recipient = $this->get_option( 'recipient', get_option( 'customer_email' ) );
  }

  /**
  * Determine if the email should actually be sent and setup email merge variables
  *
  * @since 0.1
  * @param int $order_id
  */
  public function trigger( $order_id ) {
    if ( $order_id ) {
      $this->object                  = wc_get_order( $order_id );
      $this->find['order-date']      = '{order_date}';
      $this->find['order-number']    = '{order_number}';
      $this->replace['order-date']   = date_i18n( wc_date_format(), strtotime( $this->object->order_date ) );
      $this->replace['order-number'] = $this->object->get_order_number();
    }
    if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
      return;
    }


    $this->send( $this->recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
  }


  /**
  * get_content_html function.
  *
  * @access public
  * @since 0.1
  * @return string
  */

  public function get_content_html() {
  		return wc_get_template_html( $this->template_html, array(
  			'order'         => $this->object,
  			'email_heading' => $this->get_heading(),
  			'sent_to_admin' => true,
  			'plain_text'    => false,
  			'email'			=> $this
  		) );
  	}

  /**
  * get_content_plain function.
  *
  * @since 0.1
  * @access public
  * @return string
  */

  public function get_content_plain() {
  		return wc_get_template_html( $this->template_plain, array(
  			'order'         => $this->object,
  			'email_heading' => $this->get_heading(),
  			'sent_to_admin' => true,
  			'plain_text'    => true,
  			'email'			=> $this
  		) );
  	}

  /**
  * Initialize Settings Form Fields
  *
  * @since 0.1
  */

  public function init_form_fields() {
    $this->form_fields = array(
      'enabled' => array(
        'title'         => __( 'Enable/Disable', 'woocommerce' ),
        'type'          => 'checkbox',
        'label'         => __( 'Enable this email notification', 'woocommerce' ),
        'default'       => 'yes'
      ),
      'recipient' => array(
        'title'         => __( 'Recipient(s)', 'woocommerce' ),
        'type'          => 'text',
        'description'   => sprintf( __( 'Enter recipients (comma separated) for this email. Defaults to <code>%s</code>.', 'woocommerce' ), esc_attr( get_option($customer_email) ) ),
        'placeholder'   => '',
        'default'       => '',
        'desc_tip'      => true
      ),
      'subject' => array(
        'title'         => __( 'Subject', 'woocommerce' ),
        'type'          => 'text',
        'description'   => sprintf( __( 'This controls the email subject line. Leave blank to use the default subject: <code>%s</code>.', 'woocommerce' ), $this->subject ),
        'placeholder'   => '',
        'default'       => '',
        'desc_tip'      => true
      ),
      'heading' => array(
        'title'         => __( 'Email Heading', 'woocommerce' ),
        'type'          => 'text',
        'description'   => sprintf( __( 'This controls the main heading contained within the email notification. Leave blank to use the default heading: <code>%s</code>.', 'woocommerce' ), $this->heading ),
        'placeholder'   => '',
        'default'       => '',
        'desc_tip'      => true
      ),
      'email_type' => array(
        'title'         => __( 'Email type', 'woocommerce' ),
        'type'          => 'select',
        'description'   => __( 'Choose which format of email to send.', 'woocommerce' ),
        'default'       => 'html',
        'class'         => 'email_type wc-enhanced-select',
        'options'       => $this->get_email_type_options(),
        'desc_tip'      => true
      )
    );
  }
}

?>
