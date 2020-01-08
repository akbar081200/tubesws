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

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>NeoTech</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Work+Sans:300,400,700" rel="stylesheet">
    <link rel="shortcut icon" href="http://localhost/tubesws/logo.png">
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
            <!-- <form action="index.php" method="post">
              <div class="row mb-3">
                <div class="col-md-9">
                  <div class="row">
                    <div class="col-md-12 mb-3 mb-md-0">
                      <input type="text" class="mr-3 form-control border-0 px-4" placeholder="job title, keywords or company name ">
                    </div>
                   
                  </div>
                </div>
                <div class="col-md-3">
                  <input type="submit" class="btn btn-search btn-primary btn-block" value="Search">
                </div>
              </div>
              </div>
              
            </form> -->
          </div>
        </div>
      </div>
    </div>

    <div class="site-section" data-aos="fade">
      <div class="container">
       
       <?php

if(isset($_POST['lokasi']))
{
        $result = $sparql->query(
                'SELECT distinct  ?lat ?long ?situs ?namalokasi ?abstrak WHERE {   '.
                ' ?a dbo:architecturalStyle dbr:Neoclassical_architecture.'.
                ' ?a foaf:name ?situs. '.
                ' ?a dbo:location ?lokasi.   '.
              	' ?lokasi foaf:name ?namalokasi. '.
                ' ?a dbo:abstract ?abstrak.'.
		        		' FILTER regex(?namalokasi,"'.str_replace(' ', '_', ucwords($_POST['lokasi'])).'")'.
		        		'FILTER (lang(?namalokasi) = "en"). '.
			        	'FILTER (lang(?situs) = "en"). '.
			        	'FILTER (lang(?abstrak) = "en")'.
                '}LIMIT 10' 
            );
foreach ($result as $row) {
			
        echo "<hr><a href='detail.php?situs=$row->situs' ><table>";
				echo "<tr>";
                echo "<td><h2><b>". $row->situs. "</b></h2></td>" ;
				echo "<td>". $row->namalokasi . "</td></tr>";
                echo "<tr>";
				echo "<td colspan=2>". $row->abstrak . "</td>";
				echo "</tr>";
				echo "</table></a>";
				echo "</p><hr>";
				
        }
}

       
?>

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