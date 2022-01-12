<?php 

    function getClientIP(){
        $cli_ip = $_SERVER['REMOTE_ADDR'];
        return $cli_ip;
    }
    
    function transformIP($ip){
        /*$ipParse = explode(".",$ip);
        $ipCalc = $ipParse[3] + $ipParse[2] * 256 + $ipParse[1] * 256 * 256 + $ipParse[0] * 256 * 256 * 256;*/
        return 16781311;
    }
    
    function getInfosByIP($ip, $dbConn){
        try{
            $sql = $dbConn->prepare("SELECT 'country_code', 'country_name', 'region_name', 'city_name', 'latitude', 'longitude' FROM geoip WHERE ip_from=?");
            $infos = $sql->execute(array($ip));
        } catch (PDOException $e){
            print "Error add!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    function geolocalisation($dbConn){
        $cli_ip = getClientIP();
        $cli_ip = transformIP($cli_ip);
        getInfosByIP($cli_ip, $dbConn);
    }

?>