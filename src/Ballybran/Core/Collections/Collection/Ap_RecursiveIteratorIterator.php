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

namespace Ballybran\Core\FWCols\BallybranColections;

/**
 * Description of RecursiveIteratorIterator
 *
 * @author artphotografie
 */
class Ap_RecursiveIteratorIterator {

    /**
     * @var array
     */
    private $elements;

    //put your code here

    public function __construct($elements) {

        $this->elements = $elements;
    }

    public function recursiveIteratorIterator() {

        $obj = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($this->elements));
       echo $obj->rewind();
        return iterator_to_array($obj, TRUE);
    }

}
