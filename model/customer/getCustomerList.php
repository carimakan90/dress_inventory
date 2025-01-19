<?php
require_once('inc/config/constants.php');
require_once('../../inc/config/db.php');

$customerList = [];

try {
    $sql = 'SELECT customerID, fullName FROM customer';
    $statement = $conn->prepare($sql);
    $statement->execute();
    $customerList = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}
?>