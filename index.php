<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Resiconnect Community System</title>
    <link rel="stylesheet" href="css/header_navigationbar.css" />
    <link rel="stylesheet" href="css/index.css" />
    <?php
    include_once "setting/index_navigation.php";
    ?>

    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
        }

        .column {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .column img {
            max-width: 100%;
            max-height: 100%;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<br><br>
<div id="welcome">
    <script src="javascript/index.js"></script>

    <div class="container">
        <div class="column">
            <img src="pictures/slider1.jpg" alt="Image 1">
        </div>

        <div class="column">
            <img src="pictures/slider2.jpg" alt="Image 2">
        </div>

        <div class="column">
            <img src="pictures/slider3.jpg" alt="Image 3">
        </div>
    </div>

    <div class="container">
        <div class="column">
            <img src="pictures/slider4.jpg" alt="Image 1">
        </div>

        <div class="column">
            <img src="pictures/slider5.jpg" alt="Image 2">
        </div>

        <div class="column">
            <img src="pictures/slider6.jpg" alt="Image 3">
        </div>
    </div>
</div>
</body>
</html>
