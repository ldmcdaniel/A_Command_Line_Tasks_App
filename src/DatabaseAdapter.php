<?php namespace Acme;

use PDO;

class DatabaseAdapter {
    protected $connection;


    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll($tableName)
    {
        return $this->connection->query('select * from ' . $tableName)->fetchAll();
    }

    public function query($sql, $parameters)
    {
        // insert into tasks (name) values(:name)
        return $this->connection->prepare($sql)->execute($parameters);
    }
}
