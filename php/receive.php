<!DOCTYPE html>
<html lang="en">
<head>
    <title>GD thing website</title>
	
	<meta charset="UTF-8" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="keywords" content="" />
	
	<!-- CSS Links -->

	<link rel="stylesheet" href="../index.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500&display=swap" />
  
	<!-- JS Scripts (start) -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="navbar">
        <div class="topnav">
            <a class="active" href="#">Home</a>
            <a href="html/creators.html">Pinoy Creators</a>
            <a href="html/demonlist.html">PH Demonlist</a>
            <a href="html/about.html">About</a>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="mid" id="col">Vote Now!</h3>
            </div>
        </div>
	</div>
	
	<?php
		if ($_SERVER['REQUEST_METHOD'] === "GET") {
			echo "got it";
		} else if ($_SERVER['REQUEST_METHOD'] === "POST") {
			echo "posted it";
		}
	?>
</body>
</html>
