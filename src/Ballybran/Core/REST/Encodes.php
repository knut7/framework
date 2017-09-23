<?php 

/**
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * Copyright (c) 2017.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

namespace Ballybran\Core\REST;
 class Encodes{ 

 private static $version = '1.0';
 private static $encode = 'UTF-8';
 	public function __construct() {

    }
 static function parse($arr){
        $dom = new \DOMDocument('1.0');
        self::recursiveParser($dom,$arr,$dom);
        return $dom->saveXML();
    }
    private static function recursiveParser(&$root, $arr, &$dom){
         foreach($arr as $key => $item){
            if(is_array($item) && !is_numeric($key)){
                $node = $dom->createElement($key);
                self::recursiveParser($node,$item,$dom);
                $root->appendChild($node);
            }elseif(is_array($item) && is_numeric($key)){
                self::recursiveParser($root,$item,$dom);
            }else{
                $node = $dom->createElement($key, $item);
                $root->appendChild($node);
            }
        }
    }


 	public static function encodeHtml($responseData) {
    
        $htmlResponse = "<table border='1'>";
        foreach($responseData as $key=>$value) {
                $htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
        }
        $htmlResponse .= "</table>";
        return $htmlResponse;       
    }
    
    public static function  encodeJson($responseData) {
        $jsonResponse = json_encode($responseData);
        return $jsonResponse;       
    }
    
    public static function encodeXml($responseData) {
        // creating object of SimpleXMLElement
        $version = self::$version;
        $encoding = self::$encode;
        $xml = new \SimpleXMLElement("<?xml version='$version' encoding='$encoding' ?>\n<mobile></mobile>");
       
            foreach($responseData as $key=>$variable) {
           
            foreach ($variable as $k => $v) {
            $xml->addChild($k, $v);
            }

            }
        return $xml->asXML();
    }
 } 