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
 * Date: 18/08/17
 * Time: 02:24
 */

namespace FWAP\Core\Model;


use function constant;
use FWAP\Config\Config;
use function var_dump;

class Model
{

    private $modelClass;
    private $model;
    private $db;
    public $modelPath = "/Models/";



    /**
     * @return string
     */

    /**
     * @return mixed
     */
    public function getModelPath()
    {
        return $this->modelPath;
    }


    public function getloadModel() {

        $this->modelClass = get_class($this) . 'Model';
        $path = DIR_FILE . $this->modelPath . $this->modelClass . '.php';

        if (file_exists($path)  || is_readable($path)) {
            require_once $path;

            return  $this->dbObject();

        }
        return null;

    }

    private function dbObject() {
        $baseClass = "\FWAP\Database\Drives\Database%db%";
        $className = str_replace('%db%', TYPE , $baseClass);

        // testar um array como parametro

        $a = require 'Config/Database/Config.php';
        $this->db = new $className($a);
         return $this->model = new $this->modelClass($this->db);

    }


}