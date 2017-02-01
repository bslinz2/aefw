<?php

require_once __DIR__ . "/config.php";

$databaseConnection = null;

class DB {

    // select
    public static function query($query, $types = null, ...$parameter) {
        $result = self::execute(self::connect(), $query, $types, $parameter);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    // insert / update
    public static function modify($connection, $query, $types = null, ...$parameter) {
        $result = self::execute($connection, $query, $types, $parameter);
        return $result->insert_id;
    }

    protected static function connect() {
        global $databaseConnection;

        if($databaseConnection) {
            return $databaseConnection;
        }
        $config = Config::get('database.*');
        $config = array_values($config);
        $connection = new Mysqli(...$config);
        $databaseConnection = $connection;

        return $databaseConnection;
    }

    protected static function execute($connection, $query, $types = null, ...$parameter) {
        $stmt = $connection->prepare($query);

        if(!$stmt) {
            throw new Exception('given query is not valid! (' . $query . ')');
        }

        if(!is_null($types)) {
            $stmt->bind_param($types, ...$parameter);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
}

