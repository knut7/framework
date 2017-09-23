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

namespace Ballybran\Library;

class Breadcrumb {

    private $default = 'portugese';
    private $title;
    private $options = array();

    public function breadcrumb($options) {

        $this->options = array(
            'before' => '<span class="arrow">',
            'after' => '</span>',
            'delimiter' => '&raquo;'
        );

        if (is_array($options)) {
            return $this->options = array_merge($this->options, $options);
        }

        return $markup = $this->options['before'] . $this->options['delimiter'] . $this->options['after'];

        global $post;
        echo '<p class="breadcrumb"><a href="' . URL . '">';
        echo '</a>';
    }

}
