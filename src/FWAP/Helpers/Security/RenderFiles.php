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



namespace FWAP\Helpers\Security;


use FWAP\Exception\Exception;

class RenderFiles implements iRenderFiles
{
    private $index = "index.phtml";
    private $header = "header.phtml";
    private $footer = "footer.phtml";
    private $ex = '.phtml';

    public function isViewPath($controller) {
        if (!file_exists(VIEW) || !is_readable(VIEW)) {
            return Exception::noPathView();
        }

        if (!is_readable(VIEW . $controller) || !file_exists(VIEW . $controller)) {
            return Exception::noPathinView($controller);
        }

    }
    public function isHeader(){


        if (!file_exists(VIEW . $this->header) || !is_readable(VIEW . $this->header)) {
            return Exception::notHeader();
        }
        require_once VIEW . $this->header;

    }
    public function isFooter() {

        if (!is_readable(VIEW . $this->footer) || !file_exists(VIEW . $this->footer)) {
            return Exception::notFooter();
        }

        require_once VIEW . $this->footer;
    }

    public function isIndex($controller, $view)
    {

        if (!is_readable(VIEW . $controller . DS . $view . $this->ex) || !file_exists(VIEW . $controller . DS . $view . $this->ex)) {
            return Exception::notIndex($controller);
        }
        require_once VIEW . $controller . DS . $view . $this->ex;
    }

}