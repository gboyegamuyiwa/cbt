<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'prodigyt_cbt');
   define('DB_PASSWORD', 'IbadanPanel@2018');
   define('DB_NAME', 'prodigyt_cbtnew');

   /* Attempt to connect to MySQL database */
   $link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

   // Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}