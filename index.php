<?php
	header('Content-type: text/html');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Index</title>
		<?php require_once './includes/main.inc.php' ?>
	</head>
	<body>
		<?php require_once './includes/navbar.inc.php' ?>
		<div class="container-fluid" id="main">
			
			<!-- Card -->
			<div class="card">

			  <!-- Card image -->
			  <div class="view overlay">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="./imgs/13524498_1355525024475110_341246408285628536_n.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./imgs/14138715_10210283076183583_2563936512643780707_o.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="./imgs/14224805_1287416131271200_1849041609591974141_n.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
			  </div>

			  <!-- Card content -->
			  <div class="card-body">

				<!-- Title -->
				<h4 class="card-title">Fred Dilapisho, 22</h4>
				<!-- Text -->
				<p class="card-text">WeThinkCode_</p>
				<!-- Button -->
				<div class="btn-group" role="group" aria-label="Basic example">
				
					<button class="btn purple-gradient">Like</button>
					<button class="btn blue-gradient">Reject</button>
				
				</div>

			  </div>

			</div>
<!-- Card -->
			<?php require_once './includes/footer.inc.php' ?>
		</div>
		
	</body>
</html>