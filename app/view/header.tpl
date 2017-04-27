<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="Description" content="Personalized netflix playlists">
		<title> Netflix Manager </title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Abhaya+Libre" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL ?>/public/css/css.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="<?= BASE_URL ?>/public/js/js.js"></script>
	</head>
  <body>
    <div class="navigation">
        <div class="logo">
          <a href="<?= BASE_URL ?>">LOGO</a>
        </div>
        <div class="sign-in">
					<?php if (isset($_SESSION['user'])) { ?>
          	<a href="<?= BASE_URL ?>/sign_out">Sign Out</a>
						<a href="#">My Account</a>
					<?php } else { ?>
						<a href="<?= BASE_URL ?>/sign_in">Sign In</a>
					<?php } ?>
        </div>
    </div>

    <div id="main">
