<?php

$pdo = new PDO('mysql:host=localhost; port = 3306; dbname = hospital', 'gayangi','Pswrd');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //provide a description in case of errors
