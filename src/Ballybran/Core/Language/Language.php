<?php

/**
 *
 * knut7 Framework (http://framework.artphoweb.com/)
 * knut7 FW(tm) : Rapid Development Framework (http://framework.artphoweb.com/)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @link      http://github.com/zebedeu/artphoweb for the canonical source repository
 * @copyright (c) 2016.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */
/**
 * Language - simple language handler.
 *
 * @author Bartek Kuśmierczuk - contact@qsma.pl - http://qsma.pl
 * @version 2.2
 * @date November 18, 2014
 * @date updated Sept 19, 2015
 */

namespace Ballybran\Core\Language;

use Ballybran\Core\Language\iLanguage;
use Ballybran\Exception\Exception;

/**
 * Language class to load the requested language file.
 */
class Language implements iLanguage {


    private $default = 'en';
    private $data = array();

    public function get($key) {
        return (isset($this->data[$key]) ? $this->data[$key] : $key);
    }

    public function set($filename, $Language = null) {
        $_ = array();


        $file = DIR_LANGUAGE . $this->default . '/' . $filename . '.php';

        if (is_file($file)) {
            require($file);
        }

        $file = DIR_LANGUAGE . $Language . '/' . $filename . '.php';

        if (is_file($file)) {
            require($file);
        }

        $this->data = array_merge($this->data, $_);

        return $this->data;
    }

}
