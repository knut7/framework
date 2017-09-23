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
namespace  Ballybran\Helpers\Images;

use Ballybran\Helpers\Images\Resize;
use  Ballybran\Helpers\Images\Iimage\interfaceResize;


class Image extends Resize implements interfaceResize {



  /**
   * 
   * @param type $filename  insert a file (jpg,jpeg, png, gif, )
   * @param type $new_width insert width for image. 
   * @param type $new_height insert Height for image.
   * @param type $options insert optional parans (lendscape, auto, crop, portrait, or exact)
   * 
   * Exemple: new Image('exemplo.jpg', 800, 600, 'lendscape');
   */
    public function __construct($filename, $new_width, $new_height, $options = "auto") {

        parent::__construct($filename);

        $this->crops($new_width, $new_height, $options);
    }


    public  function crops($new_width, $new_height, $options) {

        $this->resizeImage($new_width, $new_height, $options);
    }

}
