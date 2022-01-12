<?php 

    //include 'loadCsv.php';
    require_once 'geolocalize.php';

    //database infos
    $dsn = 'mysql:dbname=geoip;host=127.0.0.1';
    $user = 'root';
    $password = '';

    //Conection to the db
    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        print "Error connect !: " . $e->getMessage() . "<br/>";
        die();
    }

    $status = geolocalisation($dbh);
    var_dump($status);

?>