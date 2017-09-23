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

namespace Ballybran\Helpers\Routing;

use \Ballybran\Exception\Exception;
use Ballybran\Helpers\Log;

final class Bootstrap {

    private $_url = null;
    private $_controller = "";
    private $_controllerPath = PV . APP . DS. "Controllers/";
    private $_modelPath = 'Models';
    private $_errorPath = 'Error.php';
    private $_defaultFile = 'Index.php';
    private $log;

    /**
     * Starts the Bootstrap
     * 
     * @return boolean
     */
    public function init() {
        // Sets the protected $_url
        $this->_getUrl();

        // Load the default Ap_Controller if no URL is set
        // eg: Visit http://localhost it loads Default Ap_Controller
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }

        $this->_loadExistingController();
        $this->_callControllerMethod();
    }

    /**
     * (Optional) Set a custom path to Ap_Controllers
     * @param string $path
     */
    public function setControllerPath($path) {
        $this->_ControllerPath = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set a custom path to models
     * @param string $path
     */
    public function setModelPath($path) {
        $this->_modelPath = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your Ap_Controller, eg: error.php
     */
    public function setErrorFile($path) {
        $this->_errorFile = trim($path, '/');
    }

    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your Ap_Controller, eg: Index.php
     */
    public function setDefaultFile($path) {
        $this->_defaultFile = trim($path, '/');
    }
    

    /**
     * Fetches the $_GET from 'url'
     */
    private function _getUrl() {
        $url = $_GET['url'] ?? "Index/index";
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $this->_url = explode('/', $url);

    }

    /**
     * This loads if there is no GET parameter passed
     */
    private function _loadDefaultController() {
        require $this->_controllerPath . $this->_defaultFile;
        $this->_controller = new Index();
        $this->_controller->index();
    }

    /**
     * Load an existing Ap_Controller if there IS a GET parameter passed
     * 
     * @return boolean|string
     */
    private function _loadExistingController() {
        $file = $this->_controllerPath . ucfirst($this->_url[0]) . '.php';

        if (file_exists($file)) {
            require $file;

            $this->_controller = new $this->_url[0];
        } else {
            $this->_error();
            return false;
        }
    }

    /**
     * If a method is passed in the GET url paremter
     * 
     *  http://localhost/Controller/method/(param)/(param)/(param)
     *  url[0] = Ap_Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    private function _callControllerMethod() {
        $length = count($this->_url);

        // Make sure the method we are calling exists
        if ($length > 1) {
            if (!method_exists($this->_controller, $this->_url[1])) {
                $this->_error();
            }
        }

        // Determine what to load
        switch ($length) {
            case 5:
                //Ap_Controller->Method(Param1, Param2, Param3)
                $data=  $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;

            case 4:
                //Ap_Controller->Method(Param1, Param2)
                $data= $this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
                break;

            case 3:
                //Ap_Controller->Method(Param1, Param2)
                $data= $this->_controller->{$this->_url[1]}($this->_url[2]);
                break;

            case 2:
                //Ap_Controller->Method(Param1, Param2)
                $data=  $this->_controller->{$this->_url[1]}();
                break;

            default:
                $data=  $this->_controller->index();

                break;
        }
    }

    /**
     * Display an error page if nothing exists
     * 
     * @return boolean
     */
    private function _error() {
        Exception::notFound();

        exit;
    }

}
