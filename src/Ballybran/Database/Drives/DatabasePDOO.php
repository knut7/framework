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

namespace Ballybran\Database\Drives;
use Ballybran\Database\DBconnection;
use PDO;
use function var_dump;

final class DatabasePDOO  extends DBconnection implements iDatabase {

    public $conn;
    public $stmt;
    /**
     * @var array
     */
    private $param;

    /**
     * DatabasePDOO constructor.
     * @param array $param
     */
    public function __construct(array $param = array() ) {
        parent::__construct($param);
        $this->conn = $this->connection();
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($table, $fields="*", $where=' ', $order='', $limit= null, $offset=null,  $array = array(), $fetchMode = PDO::FETCH_ASSOC) {

        $sql = ' SELECT ' . $fields . ' FROM ' . $table
            . (($where) ? ' WHERE ' . $where : " ")
             . (($limit) ? ' LIMIT ' . $limit : " ")
            . (($offset && $limit) ? ' OFFSET ' . $offset : " ")
             . (($order) ? ' ORDER BY ' . $order : " ");
        $this->stmt = $this->conn->prepare($sql);


        foreach ($array as $key => $values) {
            $this->stmt->bindValue("$key", $values);
        }
        $this->stmt->execute();
        do {
            return $this->stmt->fetchAll($fetchMode);
        } while (
            $this->stmt->nextRowset());

    }

    public function selectManager($sql, $array = array(), $fetchMode = \PDO::FETCH_ASSOC)
    {
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
    public function insert($table, array $data) {

        krsort($data);

        $fieldNme = implode('`,`', array_keys($data));
        $fieldValues = ':' . implode(',:', array_keys($data));
        try {

            $stmt = $this->conn->prepare("INSERT INTO $table (`$fieldNme`) VALUES ($fieldValues)");

            foreach ($data as $key => $values) {
                $stmt->bindValue(":$key", $values);
            }
        } catch (Exception $e) {
            $this->_Rollback();
            echo "error insert " . $e->getMessage();
        }



         $stmt->execute();
        unset($stmt);
    }

    /**
     * @param $table
     * @param $data
     * @param $where
     * @return bool
     */
    public function update($table, $data, $where) {
        ksort($data);

        $fielDetail = null;

        foreach ($data as $key => $values) {
            $fielDetail .= "`$key`=:$key,";
        }

        $fielDetail = trim($fielDetail, ',');
        $stmt = $this->prepare("UPDATE $table SET $fielDetail WHERE $where ");
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
    public function delete($table, $where, $limit = 1) {
        return $this->conn->exec("DELETE FROM $table WHERE $where LIMIT $limit");
    }

    /**
     * @param string $table_name
     * @return string
     */
    public function getTable($table_name = "")
     {

         if ($table_name === '') {
             $table_name = $_POST['Database'];
         }

         $sql = "SHOW TABLES FROM " . $this->ensureTicks($table_name);

         $result = $this->prepare($sql);
         $output= "";
         $output .= "<RESULTSET><FIELDS>";
         $output .= "<FIELD><NAME>TABLE_CATALOG</NAME></FIELD>";
         $output .= "<FIELD><NAME>TABLE_SHEMA</NAME></FIELD>";
         $output .= "<FIELD><NAME>TABLE_NAME</NAME></FIELD>";
         $output .= "</FIELD><ROWS>";

         if (is_resource($result)) {
             $stmt ="";
             while ($stmt->fetchAll($result) > 0) {

                 $output .= '<ROW><VALUE/><VALUE/><VALUE>' . $stmt[0] . '</VALUE></ROW>';

             }
             $output .= "</ROWS></RESULTSET>";

         }

         return $output;

     }

     private function ensureTicks($inputSQL)
     {
         $outSQL = $inputSQL;
         //added backtick for handling reserved words and special characters
         //http://dev.mysql.com/doc/refman/5.0/en/legal-names.html

         //only add ticks if not already there
         $oLength = strlen($outSQL);
         $bHasTick = false;
         if (($oLength > 0) && (($outSQL[0] == "`") && ($outSQL[$oLength-1] == "`")))
         {
             $bHasTick = true;
         }
         if ($bHasTick == false)
         {
             $outSQL = "`".$outSQL."`";
         }
         return $outSQL;
     }


    /**
     * @param String $table
     * @param array $fileds
     * @return mixed
     */
    public function createTable(String $table, array $fileds) : array {
         ksort($fileds);

         $fieldNme = implode('`,`', array_keys($fileds));
        var_dump($fieldNme);

        $fieldValues =  implode('`,`', array_values($fileds[$fieldNme]));

         $teste = $fieldNme.' '.$fieldValues;

         var_dump($teste);

         $sql = "CREATE TABLE IF NOT EXISTS  clinica.$table ( $fieldValues );" ;


         $th = $this->conn->exec($sql);

        return $th;

     }

    /**
     * @param $db
     */
    public function get_Data_definition($db)
     {
         // TODO: Implement get_Data_definitin() method.
     }
 }
