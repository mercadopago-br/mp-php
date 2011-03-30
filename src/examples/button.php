<?php

include("../classes/MercadoPago.php");

$mp = new MercadoPago(array(
    'acc_id' => '19767148',
    'enc' => 'Z7VHQVdZYgyaqKbGGKxhYGLSMho%3D',
    'url_succesfull' => 'http://www.mercadopago.com/sucesso',
    'url_process' => 'http://www.mercadopago.com/analise',
    'url_cancel' => 'http://www.mercadopago.com/cancel',
    'currency' => 'REA',
    'ship_cost_mode' => 'DS',
    'shipping_cost' => ''
));

$mp->setClient(array(
    'cart_name' => 'Carlos',
    'cart_surname' => 'Corrêa',
    'cart_email' => 'carlos.correa@mercadopago.com.br',
    'cart_cep' => '06541-005',
    'cart_street' => 'Avenida Marte',
    'cart_number' => '489',
    'cart_complement' => '',
    'cart_phone' => '11-25435400',
    'cart_district' => 'Alphaville',
    'cart_city' => 'Santana de Parnaíba',
    'cart_state' => 'SP',
));

$mp->setItem(array(
    'item_id' => '789456',
    'name' => 'Nome_do_Produto',
    'price' => '12.67'
));

echo $mp->showButton();


?>