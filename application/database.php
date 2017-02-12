<?php

$databaseConnection = null;

class DB {

    public static function query($query, $types = null, ...$parameter) {
        // SQL Query ausführen
        $result = self::execute(self::connect(), $query, $types, $parameter);

        // Hier werden alle Zeilen von dem rückgelieferten mysqli_result Objekt als Array geholt
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        // Die einzelnen Zeilen werden zu einem Objekt umgewandelt und somit kann man schön mit dem Pfeil Operator auf die einzelenen Werte zugereifen: $zeile->spalten_name statt $zeile['spalten_name']
        $result = [];
        foreach ($rows as $row) {
            $result[] = (object) $row;
        }
        return $result;
    }

    // insert / update
    public static function modify($connection, $query, $types = null, ...$parameter) {
        // SQL Query ausführen
        $result = self::execute($connection, $query, $types, $parameter);
        // Als Rückgabewert wird die zuletzt geänderte Id zurück gegeben
        return $result->insert_id;
    }

    protected static function connect() {
        // Am Anfang dieser Datei wird die Variable $databaseConnection definiert. Damit man in dieser Funktion auf diese zugreifen kann, muss man mittels dem Keyword "global" diese Variable nochmals definieren, damit diese in diesem Scope verfügbar ist
        global $databaseConnection;

        // Wenn in der Variable ein gültiger Wert steht, dann wird dieser zurpck gegeben und somit wird nur ein einiges mal eine Datenbank verbindung aufgebaut
        if ($databaseConnection) {
            return $databaseConnection;
        }

        // Mittels der Config Klasse können hier die dementsprechnden Daten für die Datenbankverbindung geholt werden
        $config = Config::get('database.*');

        // In Config ist derzeit noch ein assoziatives Array. Mit dem ... Operator können einer Funktion Daten in Form eines Arrays übergeben werden. Diese Array darf aber nur aus Werten ohne Schlüsseln bestehen. Deswegen werden hier die Schlüsseln entfernt.
        $config = array_values($config);
        $connection = new Mysqli(...$config);

        // Setzen der globalen Variable, damit nicht nocheinmal eine Verbindung aufgebaut wird.
        $databaseConnection = $connection;

        // Die Datenbank Verbindung wird hier nicht explizit geschlossen. Dies übernimmit in diesem Fall der Garbage Collector. Dieser ruft spätestens am Ende es Programmes den Destruktor der Mysqli Klasse auf. 

        return $databaseConnection;
    }

    protected static function execute($connection, $query, $types = '', $parameter) {
        // Vorbereiten des SQL-Querys auf vielleicht folgende vorbereitete Parameter
        $stmt = $connection->prepare($query);

        // Überprüfen, ob die SQL-Query syntaktisch korrekt ist
        if (!$stmt) {
            throw new Exception('given query is not valid! (' . $query . ')');
        }

        $typesCount = strlen($types);
        $parameterCount = count($parameter);

        // Die Länge der Zeichenkette $types muss genau das gleiche Ergebnis zurück liefern wie die Anzahl der Elemente von $parameter
        if ($typesCount != $parameterCount) {
            throw new Exception(
                sprintf('Strlen of types (%s) must match the count of parameters (%s).', $typesCount, $parameterCount)
            );
        }

        // Wenn keine Typen mitgegeben wurden, dann müssen auch keine Parameter Eingebunden werden
        if ($typesCount > 0) {
            $stmt->bind_param($types, ...$parameter);
        }

        $stmt->execute();

        $result = $stmt->get_result();
        return $result;
    }
}