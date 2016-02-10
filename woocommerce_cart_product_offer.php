<?php
/*
Plugin Name: Woocommerce Special Offer Add On
Plugin URI: http://www.martijnwip.nl/woocommerce-cart-product-offer
Description: module for adding a offer a special product underneath shopping cart. For example an insurance.
Version: 0.1
License: GPL
Author: Martijn Wip
Author URI: http://www.martijnwip.nl
*/



	

//we need javascript and css
function mrtnwip_wcpo_scripts(){
	wp_enqueue_style( 'insurance', plugins_url( '/woocommerce_insurance_addon/assets/insurance.css') );
	wp_enqueue_script( 'mooradian-insurance', plugins_url( '/woocommerce_insurance_addon/assets/insurance.js'), array(), '20130140', true );
}
add_action( 'wp_enqueue_scripts', 'mrtnwip_wcpo_scripts' );






add_action( 'plugins_loaded', 'mrtnwip_wcpo_constructor_plugin', 11 );

function mrtnwip_wcpo_constructor_plugin(){
	

	//magic will happen here

	//add the action to add the HTML  for the insurance module
	add_action("woocommerce_after_cart_table","add_table_insurance_offer");

	function add_table_insurance_offer(){

		//'product_cat' => 'insurance',	
		//first get products from insurance category
		$args = array( 
            'post_type' => 'product', 
        	'product_cat' => 'wcpo',
            'post_status' => 'publish'
        );
    	$insurance_products = query_posts($args);

		//we need to acces woocomerce
		global $woocommerce;

		//now get total price of shopping cart
		//subtotal is total without tax
		$cart_sub_total = $woocommerce->cart->subtotal;

		//we need 
		
		
		
		if(isset($cart_sub_total)){

			//get_post_custom_values($key, $post_id);

			//loop throug insurances

			foreach($insurance_products as $insurance){

				//get the minimum and the maximum from  the custom fields
				$minimum = intval(get_post_custom_values('minimum_price',$insurance->ID)[0]);
				$maximum = intval(get_post_custom_values('maximum_price',$insurance->ID)[0]);

				//catch the range
				if($cart_sub_total > $minimum && $cart_sub_total <= $maximum){
					//if($cart_sub_total > $minimum){
					//return the product
					$selected_insurance = $insurance;
					
					// we can break the loop now
					break;
				}

			}
		}



		?>

		<table class="insurance_table cart" cellspacing="0">
			<thead>			
				 <tr>
					<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
					<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
					<th class="product-price"><?php _e( '', 'woocommerce' ); ?></th>
				</tr>
			</thead>

				 <tr>
					<td class="product-name"  ><?php echo $selected_insurance->post_name; ?></td>
					<td class="product-price"><?php echo get_post_meta( $selected_insurance->ID, '_regular_price')[0];  ?></td>
					<td><button class="add_insurance" data-product-id="<?php echo $selected_insurance->ID; ?>"><?php _e( 'Add to cart', 'woocommerce' ); ?></button></td>
				</tr>


		</table>	

		<?php

	}


	function mrtnwip_wcpo_add_product_to_cart( $product_id ) {
		if ( ! is_admin() ) {
			//$product_id = 2240;
			$found = false;
			//check if product already in cart
			if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
				foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
					$_product = $values['data'];
					if ( $_product->id == $product_id )
						$found = true;
				}
				// if product not found, add it
				if ( ! $found )
					WC()->cart->add_to_cart( $product_id );
			} else {
				// if no products in cart, add it
				WC()->cart->add_to_cart( $product_id );
			}
		}
		/*
			echo '<pre>';
			print_r(WC()->cart);
			echo '</pre>';	
		*/	
	}



	

}


?>