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

namespace Ballybran\Database;

use PDO;
use function var_dump;

class DBconnection extends PDO {

    /**
     * undocumented class variable
     *
     * @params array
     * */
    private $params = array();

    /**
     * undocumented class variable
     *
     * @_instances array
     * */
    private $_instances = array();

    /**
     * undocumented class variable
     *
     * @var string
     * */
    private $beginTransactioncount = 0;

    function __construct($params) {
        $this->params = $params;
    }


     /**
      * @return mixed
      * @throws \Exception
      */
     protected function connection() {
        if (empty($this->_instances['db']) || !is_array($this->_instances['db'])) {

            try {
                $this->_instances['db'] = new PDO($this->params['dns'], $this->params['users'], $this->params['pass']);
            } catch (\PDOException $exc) {
                throw new \Exception('Failed to connect to database. Reason: \'' . $exc->getMessage());
            }
        }

         $attributes = array(
             "AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
             "ORACLE_NULLS", "PERSISTENT", "SERVER_INFO", "SERVER_VERSION"
         );
         foreach ($attributes as $value) {
             $this->_instances['db']->getAttribute(constant("PDO::ATTR_$value")). "\n";
         }
        return $this->_instances['db'];
    }

// end connection

    /**
     * undocumented function
     *
     * @return bool
     * @author 
     * */
    protected function _beginTransaction() {
        if (!$this->beginTransactioncount && $this->beginTransactioncount++) {
            return parent::beginTransaction();
        }
        return $this->beginTransactioncount >= 0;
    }

    /**
     * undocumented function
     *
     * @return bool
     * @author Marcio Zebedeu
     * */
    protected function _commit() {
        $beginTransactioncount =0;
        if (!++$beginTransactioncount) {
            return parent::commit();
        }
        return $this->beginTransactioncount >= 0;
    }

    /**
     * undocumented function
     *
     * @return bool
     * @author Marcio Zebedeu
     * */
    protected function _Rollback() {
        if ($this->beginTransactioncount >= 0) {
            $this->beginTransactioncount = 0;
            return parent::rollBack();
        }
    }

}
