<?php
try {
    $db = new PDO('sqlite::memory:');
    echo "SQLite is working!\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}