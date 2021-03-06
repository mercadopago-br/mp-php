<?php header('Content-Type: text/html; charset=ISO-8859-1');
/**
 *  MercadoPago - PHP
 *  Copyright (C) 2011  MercadoPago Brasil
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

include("../classes/MercadoPago.php");

$mp = new MercadoPago(array(
    'acc_id' => 'XXXXXXXXXXX',
    'enc' => 'XXXXXXXXXXXXXXXXXXXXXXXXXX',
    'token' => 'XXXXXXXXXXXXXXXXXXXXXXX',
    'url_succesfull' => 'http://www.seusite.com/sucesso',
    'url_process' => 'http://www.seusite.com/analise',
    'url_cancel' => 'http://www.seusite.com/cancel',
    'currency' => 'REA',
    'ship_cost_mode' => 'DS',
    'shipping_cost' => ''
));

$mp->setClient(array(
    'cart_name' => 'Nome',
    'cart_surname' => 'Sobrenome',
    'cart_email' => 'email_do_cliente@seusite.com.br',
    'cart_cep' => '06541-005',
    'cart_street' => 'Avenida Marte',
    'cart_number' => '489',
    'cart_complement' => '',
    'cart_phone' => '11-25435400',
    'cart_district' => 'Alphaville',
    'cart_city' => 'Santana de Parna�ba',
    'cart_state' => 'SP',
));

$mp->setItem(array(
    'item_id' => '789456',
    'name' => 'Nome_do_Produto',
    'price' => '12.67'
));

echo $mp->showButton(false, null);


?>