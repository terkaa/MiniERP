<?php
//File that has language specific phrases for purchase orders 
//Language used is based on suppliers "language" field in database
//Finnish-purchase_order_strings
if($lang == 0){
$purchase_order_header_string = 'Ostotilaus'; 
$purchase_order_date_string = 'Tilaus PVM:';
$purchase_order_no_string = 'Tilaus NRO:';
$purchase_order_supplier_string = 'Toimittaja:';
$purchase_order_delivery_address_string = 'Toimitusosoite:';
$purchase_order_pos_string = 'Pos';
$purchase_order_code_string = 'Koodi';
$purchase_order_desc_string = 'Kuvaus';
$purchase_order_amount_string = 'Maara';
$purchase_delivery_date_string = 'Toimitus PVM:';
$purchase_order_price_string = 'Yks.Hinta';
$purchase_order_payment_term_string = 'Maksuehto:';
$purchase_order_delivery_term_string = 'Toimitusehto:';
$purchase_order_days_string = 'pv';
$purchase_order_delivery_way_string = 'Toimitustapa:';
$purchase_order_total_price_string = 'Yhteensa ALV 0%:';
$purchase_order_row_price_string = 'Rivi yht';
$purchase_order_message_string = "Liitteena uusi tilauksemme\r\nVahvistatteko osoitteeseen turo.kaarlela@co.inet.fi\r\n\r\nJos olette Extranet toimittajamme kuittaattehan tilauksen osoitteessa";
$purchase_order_filename_string = 'tilaus.pdf';
$purchase_order_offer_string = 'tarjous';
$purchase_order_vat_string = 'LY ';
 }
else{
//English_purchase_order_strings
$purchase_order_header_string = 'Purchase Order';
$purchase_order_date_string = 'Order Date:';
$purchase_order_no_string = 'Order NO:';
$purchase_order_supplier_string = 'Seller:';
$purchase_order_delivery_address_string = 'Delivery address:';
$purchase_order_pos_string = 'Pos';
$purchase_order_pos_string = 'Code';
$purchase_order_desc_string = 'Desc';
$purchase_order_amount_string = 'PCS';
$purchase_delivery_date_string = 'Delivery Date:';
$purchase_order_price_string = 'Price/EA';
$purchase_order_payment_term_string = 'Payment Term:';
$purchase_order_delivery_term_string = 'Incoterm:';
$purchase_order_days_string = 'days';
$purchase_order_delivery_way_string = 'Shipping By:';
$purchase_order_total_price_string = 'Total Price:';
$purchase_order_row_price_string = 'Row tot';
$purchase_order_message_string = "Attached is our new order\r\nPls send confirmation to turo.kaarlela@co.inet.fi\r\n\r\nIf you are our Extranet partner pls confirm order at";
$purchase_order_filename_string = 'order.pdf';
$purchase_order_offer_string = 'offer';
$purchase_order_vat_string = 'VAT# FI';
      }
?>
