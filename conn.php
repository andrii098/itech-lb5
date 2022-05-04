<?php
    $host = '127.0.0.1';
    $db   = 'pdo_var0';
    $user = 'alx';
    $pass = 'zzz';

    $dsn = "mysql:host=$host;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass);
