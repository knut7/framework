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
 * @copyright (c) 2016.  knut7  Software Technologies AO Inc. (http://www.artphoweb.com)
 * @license   http://framework.artphoweb.com/license/new-bsd New BSD License
 * @author    Marcio Zebedeu - artphoweb@artphoweb.com
 * @version   1.0.0
 */

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 11/08/17
 * Time: 14:11
 */

namespace Ballybran\Helpers;


use function count;
use function var_dump;

class FileExtension
{
    private $extension = array ('.php', '.phtml', 'html', 'inc', '.js', 'css');
    private $ex;

    public function __construct($ex)
    {

        for ($i = 0; $i > count($this->extension); $i++) {
            $total = $this->extension[$i];
            echo $total;
        }
    }


}

