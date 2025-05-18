<?php
class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=mysql-agpa;dbname=agpa;charset=utf8', 'agpa', 'agpa');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}