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

namespace Ballybran\Helpers\Routing;

use Ballybran\Exception\ApException;
use Ballybran\Helpers\Language;

class Routes
{
    private $routes;

    public function __construct()
    {
        /** @var  $routerPath */

        $routerPath = 'Config/routes.php';

        $this->routes = include($routerPath);
    }

    /**
     * @return string
     */
    private function getURI()
    {

        /** @var TYPE_NAME $_SERVER */
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     *
     */
    public function run()
    {
        $uri = $this->getURI();
        foreach ($this->routes as $uripattern => $path) {
//
//            echo $uripattern . '<br/>';
//            echo $path. '<br/>';
//            echo $uri;
//
            if (preg_match("~$uripattern~", $uri)) {
//
//                $internaroute = preg_replace(" ~$uripattern~ ", $path,  $uri);

//
                $segmento = explode('/', $path);
//
                $Ap_ControllerName = array_shift($segmento) . 'Ap_Controller';

//                echo $Ap_ControllerName;
                $Ap_ControllerName = ucfirst($Ap_ControllerName);

                $actionName = 'action' . ucfirst(array_shift($segmento));

                $parameters = $segmento;


                $Ap_ControllerPath = DIR_FILE . '/Controllers/' . $Ap_ControllerName . '.php';

                if(file_exists($Ap_ControllerPath))
                {
                    include_once $Ap_ControllerPath;

                }

                $objec = new $Ap_ControllerName;


                $result = call_user_func_array(array($objec, $actionName), $parameters);

                if($result != null){
                    break;
                }
            }
        }
    }

    public static function route() {
        if( 7.1 >= phpversion()  ) {
            $bootstrap = new \Ballybran\Helpers\Routing\Bootstrap();
            $bootstrap->init();
        }else {
            $lang = new Language();
            $lang->Load('welcome');
            ApException::error("<p class='btn btn-warning'>".$lang->get("version")."</p>");
        }
    }
}
