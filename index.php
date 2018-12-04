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
				<img class="card-img-top" src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg" alt="Card image cap">
				<a href="#!">
				  <div class="mask rgba-white-slight"></div>
				</a>
			  </div>

			  <!-- Card content -->
			  <div class="card-body">

				<!-- Title -->
				<h4 class="card-title">Card title</h4>
				<!-- Text -->
				<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
				<!-- Button -->
				<div class="btn-group" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-pink btn-rounded">Left</button>
  <button type="button" class="btn btn-pink btn-rounded">Middle</button>
  <button type="button" class="btn btn-pink btn-rounded">Right</button>
</div>

			  </div>

			</div>
<!-- Card -->
			<?php require_once './includes/footer.inc.php' ?>
		</div>
		
	</body>
</html>