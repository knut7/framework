<?php


namespace Ballybran\Database\Drives;

use PDO;

interface iDatabase {

    /**
     * @param $sql
     * @param array $array
     * @param int $fetchMode
     * @return mixed
     */
    public function selectManager($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC);

    /**
     * select
     * @param string $sql An SQL string
     * @param array $array Paramters to bind
     * @param constant $fetchMode A PDO Fetch mode
     * @return mixed
     */
    public function select($table, $fields ="*", $where = ' ', $order='', $limit=null, $offset=null,  $array = array(), $fetchMode);

    /**
     * @param $table da base de dados
     * @param $data recebido do array
     * @return bool
     */
    public function insert($table, array $data);

    /**
     * @param $table
     * @param $data
     * @param $where
     * @return bool
     */
    public function update($table, $data, $where);

    /**
     * @param $table
     * @param $where
     * @param $limit
     * @return mixed
     */
    public function delete($table, $where, $limit);

    /**
     * @param $db
     * @return mixed
     */
    public function get_Data_definition($db);

    /**
     * @param String $table
     * @param array $fileds
     * @return mixed
     */
    public function createTable(String $table, array $fileds);



}
