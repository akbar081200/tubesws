<?php 

require_once "lib/EasyRdf.php";

// deklarasi prefix DBpedia yang diperlukan
EasyRdf_Namespace::set('dbp', 'http://dbpedia.org/property/');
EasyRdf_Namespace::set('dbr', 'http://dbpedia.org/resource/');
EasyRdf_Namespace::set('dbo', 'http://dbpedia.org/ontology/');
EasyRdf_Namespace::set('foaf', 'http://xmlns.com/foaf/0.1/');
EasyRdf_Namespace::set('geo', 'http://www.w3.org/2003/01/geo/wgs84_pos#');

// set DBpedia sparql endpoint
$sparql = new EasyRdf_Sparql_Client('http://dbpedia.org/sparql');
$situs = $_GET['situs'];
$result = $sparql->query(
                'SELECT distinct  ?lat ?long ?gambar ?situs ?namalokasi ?abstrak ?arsitektur ?tahundibuat ?pembangun  WHERE {   '.
                ' ?a dbo:architecturalStyle dbr:Neoclassical_architecture.'.
                ' ?a dbo:architecturalStyle ?arsitektur.'.
				        ' ?a dbo:location ?lokasi.   '.
                ' ?a foaf:name ?situs.  '.
                ' OPTIONAL {?a dbo:yearOfConstruction ?tahundibuat}.'.
                ' OPTIONAL {?a dbp:builder ?pembangun}.'.
                ' ?a dbo:thumbnail ?gambar.   '.
                ' ?a dbo:abstract ?abstrak.'.
                ' ?lokasi geo:lat ?lat.   '.
                ' ?lokasi geo:long ?long.  '.
               	' ?lokasi foaf:name ?namalokasi. '.
                ' FILTER regex(?situs,"'.$situs.'")'.
                'FILTER (lang(?namalokasi) = "en"). '.
                'FILTER (lang(?situs) = "en"). '.
                'FILTER (lang(?abstrak) = "en")'.
                '}LIMIT 1' 
            );
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>NeoTech</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Work+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="http://localhost/tubesws/logo.png">
  </head>
  <body>
  <div class="site-wrap">
    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> 
    
    
    <div class="site-navbar-wrap js-site-navbar bg-white">
      
      <div class="container">
        <div class="site-navbar bg-light">
          <div class="py-1">
            <div class="row align-items-center">
              <div class="col-2">
                <h2 class="mb-0 site-logo"><a href="index.php">Neo<strong class="font-weight-bold">Tech</strong> </a></h2>
              </div>
              <div class="col-10">
                <nav class="site-navigation text-right" role="navigation">
                  <div class="container">
                    <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

                    <ul class="site-menu js-clone-nav d-none d-lg-block">
                      
                      <li><a href="#">Tentang Kami</a></li>
                  </ul>
                  </div>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <div style="height: 113px;"></div>

    <div class="site-blocks-cover overlay" style="background-image: url('images/bg2.jpg');" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-12" data-aos="fade">
            <h1>Temukan Tempat</h1>
            <form action="index.php" method="post" >
              <div class="row mb-3">
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-12 mb-3 mb-md-0">
                      <input type="text" class="mr-3 form-control border-0 px-4" placeholder="Nama lokasi atau gedung" name="lokasi">
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-3">
                  <input type="submit" name="submit" class="btn btn-search btn-primary btn-block" value="Search">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section" data-aos="fade">
      <div class="container">
       
       <?php


        foreach ($result as $row) {
			
        echo "<h1><center><u>". $_GET['situs'] ."</u><center><br></h1>";
				echo "<center><img src=".$row->gambar." alt='".$row->situs."'></center>";
				echo "<br><p class='tengah'style='color:black'>".$row->abstrak."</p>";
				echo "<h4> Description : </h4>";

        echo "<table border='2' class='table tes'>";
        echo "<tr>";
        echo "<td style='color:black'><b> Bentuk Arsitektural</b></td>" ;
        echo "<td style='color:black'> ". $row->arsitektur . "</color></td></tr>";
        
        echo "<tr>";
        echo "<td style='color:black'><b> Lokasi </b></td>" ;
        echo "<td style='color:black'> ". $row->namalokasi. "</color></td></tr>";

        echo "<tr>";
        echo "<td style='color:black'><b> Tanggal Pembangunan </b></td>" ;
        echo "<td style='color:black'> ". $row->tahundibuat. "</color></td></tr>";

                echo "<tr>";
        echo "<td style='color:black'><b> Pembuat </b></td>" ;
        echo "<td style='color:black'> ". $row->pembangun. "</color></td></tr>";

				echo "<tr>";
        echo "<td style='color:black'><b>Koordinat(lat)</b></td>" ;
        echo "<td style='color:black'> ". $row->lat . "</color></td></tr>";
        
        echo "<tr>";
				echo "<td style='color:black'><b>Koordinat(long)</b></td>";
				echo "<td style='color:black'> ". $row->long . "</td>";
				echo "</tr>";

				// echo "<tr>";
				// echo "<td><b> Kepadatan Penduduk  </b></td>";
				// echo "<td style='color:blue'> ". $row->populasi . "</td>";
				// echo "</tr>";
				// echo "<tr>";
				// echo "<td><b> Mata Uang </b></td>";
				// echo "<td style='color:blue'> ". $row->uang. "</td>";
				// echo "</tr>";
				echo "</table>";
				echo "</p>";
        }

?>

<h3>Peta :</h3>
<center><div id="map" class="map map-home" style="height: 400px; width: 500px; margin-top: 50px"></div></center>
<br><br>

<script>
var lat = <?php foreach ($result as $row) { echo $row->lat; }?>;
var long = <?php foreach ($result as $row) { echo $row->long; }?>;
var map = L.map('map').setView([lat, long], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([lat, long]).addTo(map)
    .bindPopup("Lat : "+lat+" , Long : "+long)
    .openPopup();
</script>

      </div>
    </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/aos.js"></script>

  
  <script src="js/mediaelement-and-player.min.js"></script>

  <script src="js/main.js"></script>
  </body>
</html>