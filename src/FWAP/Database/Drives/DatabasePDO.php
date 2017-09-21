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

namespace FWAP\Database\Drives;

use FWAP\Database\DBconnection;

 class DatabasePDO extends DBconnection implements iDatabase
 {

     private $columns;
     private $conn;

     /* in plan
       private $join = array();
       private $on = array();
       private $and= array();
      */

     public function __construct(array $param = array ())
     {
         parent::__construct($param);
         $this->conn = $this->connection();
     }

     /**
      * select
      * @param string $sql An SQL string
      * @param array $array Paramters to bind
      * @param A|int $fetchMode A PDO Fetch mode
      * @return mixed
      */
     public function selectManager($sql, $array = array (), $fetchMode = \PDO::FETCH_ASSOC)
     {

         $stmt = $this->conn->prepare($sql);

         foreach ($array as $key => $values) {
             $stmt->bindValue("$key", $values);
         }
         $stmt->execute();
//        $stmt->getColumnMeta(0);

         do {
             return $stmt->fetchAll($fetchMode);
         } while (
             $stmt->nextRowset());

     }

     public function select($table, $fields = "*", $where = ' ', $order = '', $limit = null, $offset = null, $array = array (), $fetchMode = \PDO::FETCH_ASSOC)
     {
         $sql = ' SELECT ' . $fields . ' FROM ' . $table
             . (($where) ? ' WHERE ' . $where : " ")
             . (($limit) ? ' LIMIT ' . $limit : " ")
             . (($offset && $limit) ? ' OFFSET ' . $offset : " ")
             . (($order) ? ' ORDER BY ' . $order : " ");

         $stmt = $this->conn->prepare($sql);

         foreach ($array as $key => $values) {
             $stmt->bindValue("$key", $values);
         }
         $stmt->execute();


         do {
             return $stmt->fetchAll($fetchMode);
         } while (
             $stmt->nextRowset());
     }


     /**
      * @param $table da base de dados
      * @param $data recebido do array
      * @return bool
      */
     public function insert($table, array $data)
     {
         krsort($data);

         $fieldNme = implode('`,`', array_keys($data));
         $fieldValues = ':' . implode(',:', array_keys($data));
         try {
             $stmt = $this->conn->prepare("INSERT INTO $table (`$fieldNme`) VALUES ($fieldValues)");

             foreach ($data as $key => $values) {
                 $stmt->bindValue(":$key", $values);
             }
         } catch (Exception $e) {
             echo "errr insert " . $e->getMessage();
         }

         return $stmt->execute();
         unset($stmt);
     }

     /**
      * @param $table
      * @param $data
      * @param $where
      * @return bool
      */
     public function update($table, $data, $where)
     {
         ksort($data);

         $fielDetail = null;

         foreach ($data as $key => $values) {
             $fielDetail .= "`$key`=:$key,";
         }

         $fielDetail = trim($fielDetail, ',');
         $stmt = $this->conn->prepare("UPDATE $table SET $fielDetail WHERE $where ");
         foreach ($data as $key => $values) {
             $stmt->bindValue(":$key", $values);
         }

         return $stmt->execute();
     }

     /**
      * @param $table
      * @param $where
      * @param int $limit
      * @return int
      */
     public function delete($table, $where, $limit = 1)
     {
         return $this->conn->exec("DELETE FROM $table WHERE $where LIMIT $limit");
     }

     public function get_Data_definition($db)
     {

         $stmt = $this->conn->prepare("SHOW COLUMNS FROM $db");

         if ($stmt->execute()) {
             while ($row = $stmt->fetch()) {
                 return $this->columns[$row['Field']] = array ('allow_null' => $row['Null'],
                     'decimal' => NULL,
                     'default' => $row['Default'],
                     'extra' => $row['Extra'],
                     'key' => $row['Key'],
                     'length' => NULL,
                     'name' => $row['Field'],
                     'text' => NULL,
                     'type' => $row['Type']);
             }
         }
         ksort($this->columns);
     }

     public function createTable(String $table, array $fileds)
     {
         ksort($fileds);

         $fieldNme = implode('`,', array_keys($fileds));
         $fieldValues = implode(', ', array_values($fileds[$fieldNme]));
         echo $fieldNme . ' ' . $fieldValues;

         $sql = "CREATE TABLE IF NOT EXISTS  clinica.$table ($fieldNme  $fieldValues)";
         var_dump($sql);

         $c = $this->conn->exec($sql);
         var_dump($c);

     }
 }