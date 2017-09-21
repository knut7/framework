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
namespace FWAP\Helpers\Security;


class Val
{

    /**
     * @param $data
     * @param $arg
     * @return bool
     */
    public function minLength($data , $arg){

        if(strlen($data ) < is_int($arg)) {
            echo "you streng can only $arg leng";
            return false;
        }
    }


    /**
     * @param $data
     * @param $arg
     * @return bool
     */
    public function maxLength($data, $arg){

        if(strlen($data ) > is_int($arg)) {
            echo "you streng can only $arg leng";
            return false;
        }
    }

    /**
     * @param $data
     * @return string
     */
    public function digit($data){

        if(ctype_digit($data ) == null ) {
            return "you streng must be a digited";
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @throws \Exception
     */
    function __call($name, $arguments)
    {
        throw new \Exception(" $name does not exist inside of :" . __CLASS__ );

    }

}