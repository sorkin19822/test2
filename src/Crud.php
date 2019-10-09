<?php


namespace App\Test;
use Doctrine\DBAL\DriverManager;

class Crud
{
public $connectionParams = array('dbname' => 'data',
                                'user' => 'postgres',
                                'password' => '',
                                'host' => '127.0.0.1',
                                'port ' =>'5432',
                                'driver' => 'pdo_pgsql');
public $conn;
public function __construct()
{
    $config = new \Doctrine\DBAL\Configuration();
    return $this->conn = DriverManager::getConnection($this->connectionParams, $config);
}

    /**
     * @param $tableName
     * @param array $arrayData
     * @return string
     * @throws \Doctrine\DBAL\ConnectionException
     */
public function insert($tableName,array $arrayData){
    $this->conn->beginTransaction();
    try{
        $this->conn->insert($tableName,$arrayData);
        $this->conn->commit();
        return 'success';
    } catch (\Exception $e) {
        $this->conn->rollBack();
        return $e->getMessage();
    }
}

}