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

namespace Ballybran\Helpers\Form;

use Ballybran\Helpers\Security\Validate;

class Value
{

    private $_value;
    private $_post;
    private $_teste;

    function __construct()
    {
         $this->_teste = new ClassHtml();


    }

    public function value($string){

         $this->_value = $string;
        return $this;
    }
    public function getValue(){

        echo  "value=".$this->_value.">";
        return $this;
    }

    public function openForm($action, $method = "get")
    {
        echo "<form action=" .$action ."  enctype='multipart/form-data' method='". $method ."' >";
        return $this;
    }

    public function closeForm()
    {
        echo "</form>" ;

    }



}