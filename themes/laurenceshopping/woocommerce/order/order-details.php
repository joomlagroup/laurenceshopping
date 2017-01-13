<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order = wc_get_order( $order_id );

$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
?>
<h4><?php _e( 'Order Details', 'woocommerce' ); ?></h4>
<table class="shop_table order_details">
	<thead>
	<tr>
		<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
		<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach( $order->get_items() as $item_id => $item ) {
		$product = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );

		wc_get_template( 'order/order-details-item.php', array(
			'order'			     => $order,
			'item_id'		     => $item_id,
			'item'			     => $item,
			'show_purchase_note' => $show_purchase_note,
			'purchase_note'	     => $product ? get_post_meta( $product->id, '_purchase_note', true ) : '',
			'product'	         => $product,
		) );
	}
	?>
	<?php do_action( 'woocommerce_order_items_table', $order ); ?>
	</tbody>
	<tfoot>
	<?php
	foreach ( $order->get_order_item_totals() as $key => $total ) {
		?>
		<tr>
			<th scope="row"><?php echo $total['label']; ?></th>
			<td><?php echo $total['value']; ?></td>
		</tr>
	<?php
	}
	?>
	</tfoot>
</table>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

<?php if ( $show_customer_details ) : ?>
<header>
	<h4><?php _e( 'Customer details', 'woocommerce' ); ?></h4>
</header>
<table class="shop_table shop_table_responsive customer_details">
<?php
	if ( $order->billing_email ) {
		echo '<tr><th>' . __( 'Email:', 'woocommerce' ) . '</th><td data-title="' . __( 'Email', 'woocommerce' ) . '">' . $order->billing_email . '</td></tr>';
	}

	if ( $order->billing_phone ) {
		echo '<tr><th>' . __( 'Telephone:', 'woocommerce' ) . '</th><td data-title="' . __( 'Telephone', 'woocommerce' ) . '">' . $order->billing_phone . '</td></tr>';
	}

	// Additional customer details hook
	do_action( 'woocommerce_order_details_after_customer_details', $order );
?>
</table>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

<div class="row addresses">

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 order_billing-address">

<?php endif; ?>

		<header class="title">
			<h4><?php _e( 'Billing Address', 'woocommerce' ); ?></h4>
		</header>
		<address>
			<?php
				if ( ! $order->get_formatted_billing_address() ) {
					_e( 'N/A', 'woocommerce' );
				} else {
					echo balanceTags( $order->get_formatted_billing_address() );
				}
			?>
		</address>

<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

	</div><!-- /.col-1 -->

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 order_shipping-address">

		<header class="title">
			<h4><?php _e( 'Shipping Address', 'woocommerce' ); ?></h4>
		</header>
		<address>
			<?php
				if ( ! $order->get_formatted_shipping_address() ) {
					_e( 'N/A', 'woocommerce' );
				} else {
					echo balanceTags( $order->get_formatted_shipping_address(), true );
				}
			?>
		</address>

	</div><!-- /.col-2 -->

</div><!-- /.col2-set -->

<?php endif; ?>

<div class="clear"></div>

<?php endif; ?>