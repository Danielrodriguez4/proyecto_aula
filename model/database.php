<?php
class Database
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=docker-mysql;dbname=agpa;charset=utf8', 'agpa', 'agpa');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}