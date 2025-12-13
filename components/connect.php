<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Try connecting without specifying port first
    $host = '127.0.0.1'; // Using IP instead of localhost
    $dbname = 'food_db';
    $username = 'root';
    $password = '';
    $port = 3307; // Default MySQL port
    
    $dsn = "mysql:host=$host;dbname=$dbname";
    
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 5
    );

    $conn = new PDO($dsn, $username, $password, $options);
    
} catch(PDOException $e) {
    $error_message = "Connection failed: " . $e->getMessage() . "\n";
    $error_message .= "Error Code: " . $e->getCode() . "\n";
    $error_message .= "Please check:\n";
    $error_message .= "1. MySQL service is running in XAMPP\n";
    $error_message .= "2. Database 'food_db' exists\n";
    $error_message .= "3. Username and password are correct\n";
    die($error_message);
}

?>