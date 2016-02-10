<?php
/*
 * Template Name: Add Insurance Backend Page
 *
 * The template for adding an insurance product serverside
 */
$insurance_id = $_POST['insurance_id'];

mrtnwip_wcpo_add_product_to_cart( $insurance_id );

$insurance .= 'now added to cart';
$data = array( 'result' => $insurance);
header('Content-Type: application/json');
echo json_encode($data);


?>