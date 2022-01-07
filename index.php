<?php 

    function geolocalisation(){
        echo "test";
    }

    //database infos
    $dsn = 'mysql:dbname=geoip;host=127.0.0.1';
    $user = 'root';
    $password = '';

    //Conection to the db
    try {
        $dbh = new PDO($dsn, $user, $password, array(
            PDO::MYSQL_ATTR_LOCAL_INFILE => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL
        ));
    } catch (PDOException $e) {
        print "Error connect !: " . $e->getMessage() . "<br/>";
        die();
    }
    
    //Get files content and add value to db
    $open = fopen("geoip.csv", "r");
    $line = fgetcsv($open, 1000, ",");
    $i = 0;

    $fieldseparator = ",";
    $contentseparator = '"';
    $lineseparator = "\n";
    $csvfile = "geoip.csv";
    $databasetable = "geoip";

    while (($line = fgetcsv($open, 1000, ",")) !== FALSE) 
    {
        try{
            $sql = $dbh->prepare("INSERT INTO geoip (id, ip_from, ip_to, country_code, country_name, region_name, city_name, latitude, longitude) VALUES (NULL, :ip_from, :ip_to, :country_code, :country_name, :region_name, :city_name, :latitude, :longitude)", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sql->execute(array(
                ':ip_from' => $line[0], 
                ':ip_to' => $line[1], 
                ':country_code' => $line[2],
                ':country_name' => $line[3],
                ':region_name' => $line[4],
                ':city_name' => $line[5],
                ':latitude' => $line[6],
                ':longitude' => $line[7]
            ));
        } catch (PDOException $e){
            print "Error add!: " . $e->getMessage() . "<br/>";
            die();
        }
        $i++;
    }
    fclose($open);

?>