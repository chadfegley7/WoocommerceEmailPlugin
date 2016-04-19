<?php
/**
* Plugin Name: WooCommerce Discovertown Order Email
* Plugin URI: http://discovertown.com/
* Description: Plugin for sending custom WooCommerce emails.
* Author: Chad Fegley
* Version: 0.1

* License: GNU General Public License v3.0
* License URI: http://www.gnu.org/licenses/gpl-3.0.html
*
*/

if(!defined('ABSPATH')) exit; //Exit if accessed directly

function discovertown_email($email_classes){
  require('includes/class-wc-expedited-order-email.php');
  require('includes/class-wc-citytour-email.php');
  require('includes/class-wc-muirwoods-email.php');
  require('includes/class-wc-winecountry-email.php');
  require('includes/class-wc-alcatraz-email.php');
  require('includes/class-wc-yosemite-email.php');
  require('includes/class-wc-monterey-carmel-email.php');
  require('includes/class-wc-baycruise-email.php');
  require('includes/class-wc-walking-tour-email.php');

  $email_classes['WC_Discovertown_Order_Email'] = new WC_Discovertown_Order_Email();
  $email_classes['WC_City_Tour_Email'] = new WC_City_Tour_Email();
  $email_classes['WC_Muir_Woods_Email'] = new WC_Muir_Woods_Email();
  $email_classes['WC_Wine_Country_Email'] = new WC_Wine_Country_Email();
  $email_classes['WC_Alcatraz_Email'] = new WC_Alcatraz_Email();
  $email_classes['WC_Yosemite_Email'] = new WC_Yosemite_Email();
  $email_classes['WC_Monterey_Carmel_Email'] = new WC_Monterey_Carmel_Email();
  $email_classes['WC_Bay_Cruise_Email'] = new WC_Bay_Cruise_Email();
  $email_classes['WC_Walking_Tours_Email'] = new WC_Walking_Tours_Email();
  return $email_classes;
}

add_filter('woocommerce_email_classes', 'discovertown_email');

function discovertown_action( $actions ) {

	if ( is_array( $actions ) ) {
		$actions['discovertown'] = __( 'Discovertown Email' );
    $actions['citytour'] = __('City Tour');
    $actions['muirwoods'] = __('Muir Woods');
    $actions['winecountry'] = __('Wine Country');
    $actions['alcatraz'] = __('Alcatraz');
    $actions['yosemite'] = __('Yosemite');
    $actions['montereycarmel'] = __('Monterey/Carmel');
    $actions['baycruise'] = __('Bay Cruise');
    $actions['walkingtour'] = __('Walking Tour');
	}
	return $actions;
}
/**
 * Register "woocommerce_order_action_discovertown" as an email trigger
 */
add_action( 'woocommerce_order_action_discovertown', 'fired_discovertown', 3, 1 );
function fired_discovertown($order) {
  $current_user = wp_get_current_user();
  $current_user_email = $current_user->user_email;
  $user_billing_email = $order->billing_email;
  $mailer = WC()->mailer();
  $mails = $mailer->get_emails();
  if ( ! empty( $mails ) ) {
      foreach ( $mails as $mail ) {
          if ( $mail->id == 'discovertown') {
             $mail->trigger( $order );
             $mail->send($user_billing_email, $mail->get_subject(),$mail->get_content(), $mail->get_headers(), $mail->get_attachments());
          }
       }
  }

}
/**
 * Register "woocommerce_order_action_citytour" as an email trigger
 */
add_action( 'woocommerce_order_action_citytour', 'fired_citytour', 3, 1 );
function fired_citytour($order) {
  $current_user = wp_get_current_user();
  $current_user_email = $current_user->user_email;
  $user_billing_email = $order->billing_email;
  $mailer = WC()->mailer();
  $mails = $mailer->get_emails();
  if ( ! empty( $mails ) ) {
      foreach ( $mails as $mail ) {
          if ( $mail->id == 'city_tour') {
             $mail->trigger( $order );
             $mail->send($user_billing_email, $mail->get_subject(),$mail->get_content(), $mail->get_headers(), $mail->get_attachments());
          }
       }
  }

}
/**
 * Register "woocommerce_order_action_muirwoods" as an email trigger
 */
add_action( 'woocommerce_order_action_muirwoods', 'fired_muirwoods', 3, 1 );
function fired_muirwoods($order) {
  $current_user = wp_get_current_user();
  $current_user_email = $current_user->user_email;
  $user_billing_email = $order->billing_email;
  $mailer = WC()->mailer();
  $mails = $mailer->get_emails();
  if ( ! empty( $mails ) ) {
      foreach ( $mails as $mail ) {
          if ( $mail->id == 'muir_woods') {
             $mail->trigger( $order );
             $mail->send($user_billing_email, $mail->get_subject(),$mail->get_content(), $mail->get_headers(), $mail->get_attachments());
          }
       }
  }

}
/**
 * Register "woocommerce_order_action_winecountry" as an email trigger
 */
add_action( 'woocommerce_order_action_winecountry', 'fired_winecountry', 3, 1 );
function fired_winecountry($order) {
  $current_user = wp_get_current_user();
  $current_user_email = $current_user->user_email;
  $user_billing_email = $order->billing_email;
  $mailer = WC()->mailer();
  $mails = $mailer->get_emails();
  if ( ! empty( $mails ) ) {
      foreach ( $mails as $mail ) {
          if ( $mail->id == 'wine_country') {
             $mail->trigger( $order );
             $mail->send($user_billing_email, $mail->get_subject(),$mail->get_content(), $mail->get_headers(), $mail->get_attachments());
          }
       }
  }

}
/**
 * Register "woocommerce_order_action_alcatraz" as an email trigger
 */
add_action( 'woocommerce_order_action_alcatraz', 'fired_alcatraz', 3, 1 );
function fired_alcatraz($order) {
  $current_user = wp_get_current_user();
  $current_user_email = $current_user->user_email;
  $user_billing_email = $order->billing_email;
  $mailer = WC()->mailer();
  $mails = $mailer->get_emails();
  if ( ! empty( $mails ) ) {
      foreach ( $mails as $mail ) {
          if ( $mail->id == 'alcatraz') {
             $mail->trigger( $order );
             $mail->send($user_billing_email, $mail->get_subject(),$mail->get_content(), $mail->get_headers(), $mail->get_attachments());
          }
       }
  }

}
/**
 * Register "woocommerce_order_action_yosemite" as an email trigger
 */
add_action( 'woocommerce_order_action_yosemite', 'fired_yosemite', 3, 1 );
function fired_yosemite($order) {
  $current_user = wp_get_current_user();
  $current_user_email = $current_user->user_email;
  $user_billing_email = $order->billing_email;
  $mailer = WC()->mailer();
  $mails = $mailer->get_emails();
  if ( ! empty( $mails ) ) {
      foreach ( $mails as $mail ) {
          if ( $mail->id == 'yosemite') {
             $mail->trigger( $order );
             $mail->send($user_billing_email, $mail->get_subject(),$mail->get_content(), $mail->get_headers(), $mail->get_attachments());
          }
       }
  }

}
/**
 * Register "woocommerce_order_action_montereycarmel" as an email trigger
 */
add_action( 'woocommerce_order_action_montereycarmel', 'fired_montereycarmel', 3, 1 );
function fired_montereycarmel($order) {
  $current_user = wp_get_current_user();
  $current_user_email = $current_user->user_email;
  $user_billing_email = $order->billing_email;
  $mailer = WC()->mailer();
  $mails = $mailer->get_emails();
  if ( ! empty( $mails ) ) {
      foreach ( $mails as $mail ) {
          if ( $mail->id == 'montereycarmel') {
             $mail->trigger( $order );
             $mail->send($user_billing_email, $mail->get_subject(),$mail->get_content(), $mail->get_headers(), $mail->get_attachments());
          }
       }
  }

}
/**
 * Register "woocommerce_order_action_baycruise" as an email trigger
 */
add_action( 'woocommerce_order_action_baycruise', 'fired_baycruise', 3, 1 );
function fired_baycruise($order) {
  $current_user = wp_get_current_user();
  $current_user_email = $current_user->user_email;
  $user_billing_email = $order->billing_email;
  $mailer = WC()->mailer();
  $mails = $mailer->get_emails();
  if ( ! empty( $mails ) ) {
      foreach ( $mails as $mail ) {
          if ( $mail->id == 'baycruise') {
             $mail->trigger( $order );
             $mail->send($user_billing_email, $mail->get_subject(),$mail->get_content(), $mail->get_headers(), $mail->get_attachments());
          }
       }
  }

}
/**
 * Register "woocommerce_order_action_walkingtour" as an email trigger
 */
add_action( 'woocommerce_order_action_walkingtour', 'fired_walkingtour', 3, 1 );
function fired_walkingtour($order) {
  $current_user = wp_get_current_user();
  $current_user_email = $current_user->user_email;
  $user_billing_email = $order->billing_email;
  $mailer = WC()->mailer();
  $mails = $mailer->get_emails();
  if ( ! empty( $mails ) ) {
      foreach ( $mails as $mail ) {
          if ( $mail->id == 'walkingtour') {
             $mail->trigger( $order );
             $mail->send($user_billing_email, $mail->get_subject(),$mail->get_content(), $mail->get_headers(), $mail->get_attachments());
          }
       }
  }

}


?>
