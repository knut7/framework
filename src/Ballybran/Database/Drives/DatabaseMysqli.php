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

use mysqli;

class DatabaseMysqli extends mysqli implements iDatabase
{

    private $mysqli;
    private $limit;
    private $table = array ();
    private $result;

    public function __construct($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $PORT)
    {
        $this->mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME, $PORT);
        $this->conexao();
    }

    public function conexao()
    {

        if ($this->mysqli->connect_errno) {
            throw new \Exception("Error: " . mysqli_error($this->mysqli) . '<br/>
            Error No: ' . mysqli_errno($this->mysqli) . '<br/> 
            Error in: <b>' . $trace[1]['file'] . '</b> line <b>' . $trace[1]['line'] . '</b><br/>' . $sql);
        }
    }

    public function selectManager($sql, $array = array (), $fetchMode = MYSQLI_ASSOC)
    {

        if ($this->result = $this->mysqli->query($sql))
            ;
//            $this->message();

        while ($this->myrow = $this->result->fetch_array()) {
            return $this->myrow;
        }
        $this->result->close();
    }

    public function insert($table, $data)
    {

        ksort($data);

        $fieldName = implode(', ', array_keys($data));
        $fieldValues = implode("', '", array_values($data));

        $this->result = $this->mysqli->query("INSERT INTO $table ($fieldName) VALUES ('$fieldValues')");
        $this->mysqli->close();
    }

    public function insert2($table, array $data)
    {

        $fieldName = implode(',', array_keys($data));
        foreach (array_values($data) as $value) {

            isset($fieldva) ? $fieldva .= ',' : $fieldva = '';
            $fieldva .= '\'' . $this->mysqli->real_escape_string($value) . '\'';
        }
        $this->mysqli->real_query('INSERT INTO ' . $table . ' (' . $fieldName . ') VALUES (' . $fieldva . ')');
        $this->mysqli->close();
    }

    public function update($table, $data, $where)
    {
        $fieldetail = Null;

        foreach ($data as $key => $value) {
            $fieldetail .= "$key= $$key, ";
        }

        $fieldetail = trim($fieldetail, ',');
        $this->mysqli->real_query("UPDATE $table SET $fieldetail WHERE $where");

        $this->mysqli->close();
    }

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($table, $fields = "*", $where = ' ', $order = '', $limit = null, $offset = null, $array = array (), $fetchMode)
    {
        // TODO: Implement select() method.
    }

    public function delete($table, $where, $limit)
    {
        // TODO: Implement delete() method.
    }

    public function get_Data_definition($db)
    {
        // TODO: Implement get_Data_definitin() method.
    }

    public function createTable(String $table, array $fileds)
    {
        // TODO: Implement createTable() method.
    }
}