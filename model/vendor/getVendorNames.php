<?php
require_once('../../inc/config/db.php');

try {
    $sql = 'SELECT vendorID, vendorName FROM vendor';
    $statement = $conn->prepare($sql);
    $statement->execute();
    $vendorList = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($vendorList as $vendor) {
        echo '<option value="' . $vendor['vendorID'] . '">' . $vendor['vendorName'] . '</option>';
    }
} catch (PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}
?>