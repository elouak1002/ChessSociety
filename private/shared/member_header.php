<!doctype html>

<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href= "<?php echo url_for('/stylesheets/public.css'); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    
    <title>Chess Society</title>
        
</head>
    
<body>
<header>
    <nav class="navbar fixed-top navbar-expand-lg ">
        <ul class="navbar-nav">
        <li><a href="<?php echo url_for('/member/sure.php')?>">Logout</a></li>
        <li><a href="<?php echo url_for('/member/news.php')?>">News</a></li>
        <li><a href="<?php echo url_for('/member/events.php')?>">Events</a></li>
        <li><a href="<?php echo url_for('/member/tournament.php')?>">Tournaments</a></li>
        <li><a href="<?php echo url_for('/member/records.php')?>">Records</a></li>
        <li><a class="active navbar-right" href="<?php echo url_for('/member/index.php')?>">Profile<span class="sr-only">(current)</span></a></li>
    </nav>
</header>
<div class="main">