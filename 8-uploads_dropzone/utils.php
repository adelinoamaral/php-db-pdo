<?php

define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "company");

function connect_db()
{

    try {
        $db = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
        // falta definir o charset utf-8
    } catch (PDOException $e) {
        // die("ERRO: problemas na ligação ao servidor" . $e->getMessage());
        return $e;
    }
}
