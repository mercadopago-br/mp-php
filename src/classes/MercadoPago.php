<?php
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

/*
 * Verifica se os módulos CURL e JSON estão configurados no PHP
 */
if (!function_exists('curl_init')){
    die ('MercadoPago needs the CURL PHP extension.');
}
if (!function_exists('json_decode')){
    die ('MercadoPago needs the JSON PHP extension.');
}

class MercadoPago {

    /*
     * Version
     */
    private $version = "3.0.1";

    /*
     * Parametros
     */
    private $config = array();
    private $client = array();
    private $item = array();
    private $all = array();

    public function  __construct($args = array()) {
        $this->setConfig($args);
    }

    public function getVersion(){
        return $this->version;
    }

    public function getAllParams(){
        $this->all = $this->config + $this->item + $this->client;
    }

    public function showButton($safe = false, $img = null){

        $this->getAllParams();

        if (is_null($img)) $img = "https://www.mercadopago.com/org-img/MP3/buy_now_07_mlb.gif";

        $html  = '<form target="_top" action="https://www.mercadopago.com/mlb/buybutton" method="post">';
        $html .= '  <input type="image" src="'.$img.'" border="0" alt="Comprar Agora">';

        foreach ($this->all as $field => $value) {
            $html .= "  <input type=\"hidden\" name=\"$field\" value=\"$value\">\n";
        }

        $html .= '</form>';

        return $html;
    }

    public function setClient($args = array()){
        $this->client = $args;
    }

    public function setItem($args = array()){
        $this->item = $args;
    }

    private function setConfig( $args = array() ){
        $this->config = $args;
    }

}
?>
