<?php
require_once 'vendor/autoload.php';
use GeoIp2\Database\Reader;

// This creates the Reader object, which should be reused across
// lookups.
$reader = new Reader('pai/mapa/GeoLite2-City.mmdb');

// Replace "city" with the appropriate method for your database, e.g.,
// "country".

isset($ip)?$ip = $ip :$ip = $_SERVER['REMOTE_ADDR'];

$ip2 = $_SERVER['REMOTE_ADDR'];

// Replace "city" with the appropriate method for your database, e.g.,
// "country".



//print($record->mostSpecificSubdivision->name . "\n"); // 'Minnesota'
//print($record->mostSpecificSubdivision->isoCode . "\n"); // 'MN'

try{

$record = $reader->city($ip);

}catch(Exception $ex){

$record = $reader->city($ip2);

$ip=$ip2;

}

$CCode = $record->country->isoCode; // 'US'
$CName = $record->country->names['pt-BR']; 
$city = $record->city->name; // 'Minneapolis'
$cep = $record->postal->code; // '55455'
$lat = $record->location->latitude; // 44.9733
$long = $record->location->longitude; // -93.2323
$hostname = gethostbyaddr($ip);
//echo "Código do País: ".$CCode."<br>";
//echo "País: ".$CName."<br>";
//echo "Cidade: ".$city."<br>";
//echo "CEP: ".$cep."<br>";
//echo "Latitude: ".$lat."<br>";
//echo "Longitude: ".$long."<br>";

?>



<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>

<?php  

/*
//P01

$P01_label = $city;
$P01 = $ip;

$fp_01= @fsockopen($P01, 443, $errno, $errstr, 1);
if($fp_01 >= 1){ 

?>

<div class="chat-user" style="padding-left: 50px">
                    
                        <div class="chat-user-name" style="margin:20px 0px 10px 5px;">
            
                        <a href="#"><?php echo $P01_label; ?></a>
            <span class="pull-right label label-success">Online</span>
                        </div>
</div>


<?php  

//P01

}else{

?>

<div class="chat-user" style="padding-left: 50px">
                    
                        <div class="chat-user-name" style="margin:20px 0px 10px 5px;">
            
                        <a href="#"><?php echo $P01_label; ?></a>
            <span class="pull-right label label-danger">Offline</span>
                        </div>
</div>

<?php  

}

*/


?>
    <div id="map"></div>
    <script>

      function initMap() {
        var myLatLng = {lat: <?php echo $lat ?>, lng: <?php echo $long ?>};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: myLatLng
        });

         var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h2 id="firstHeading" class="firstHeading">Dados do Usuário</h2>'+
            '<div id="bodyContent">'+

            '<b>Código do País: </b> <?php echo $CCode."<br>"; ?> ' +
            '<b>País: </b> <?php echo $CName."<br>"; ?> ' +
            '<b>Cidade: </b> <?php echo $city."<br>"; ?> ' +
            '<b>Latitude: </b> <?php echo $lat."<br>"; ?> ' +
            '<b>Longitude: </b> <?php echo $long."<br>"; ?> ' +
            '<b>Hostname: </b> <?php echo $hostname."<br><br>"; ?> ' +
        
            '</div>'+
            '</div>';

         var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: '<?php echo $city?>',
        });

          marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
      }
    </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB61T9rIphb-uq8qkB6_sRmo5LnYREMVZs&callback=initMap">
    </script>
  </body>
</html>

<?php 

/*

function pingaMasNaoChove($ip){
     //$resultado = exec("/bin/ping -n 4 $ip", $rsp, $estado);

  $status = exec("ping -n 1 -w 1 " . $ip, $output, $result);

// TESTA O RESULTADO
if ($result == 0) {
  //echo "ON";
  $ip = $ip;
} else {
  //echo "OFF";
  $ip = $_SERVER['REMOTE_ADDR'];
}
 //echo($output[0]);  
// var_dump(status);  
}

pingaMasNaoChove($ip);

*/

?>
