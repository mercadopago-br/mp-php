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

    private $safe_button = "";

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

        if ($safe) {
            $this->getSafeButton();
            $url_button = $this->safe_button;
        } else {
            $url_button = "https://www.mercadopago.com/mlb/buybutton";
        }

        $html  = '<form target="_top" action="'.$url_button.'" method="post">';
        $html .= '  <input type="image" src="'.$img.'" border="0" alt="Comprar Agora">';

        if (!$safe || $this->safe_button == ""){
            foreach ($this->all as $field => $value) {
                $html .= "  <input type=\"hidden\" name=\"$field\" value=\"$value\">\n";
            }
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

    private function getSafeButton(){

        $url ="https://www.mercadopago.com/mlb/orderpreference" ;

        $elements = array();

        foreach ($this->all as $name => $value) {
           $elements[] = "{$name}=".urlencode($value);
        }
        
        $postData = implode ("&", $elements);

        $handler = curl_init();

        curl_setopt($handler, CURLOPT_URL, $url);
        curl_setopt($handler, CURLOPT_POST, true);
        curl_setopt($handler, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handler, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec ($handler);

        curl_close($handler);

        $this->safe_button = $response;
    }

}
?>
