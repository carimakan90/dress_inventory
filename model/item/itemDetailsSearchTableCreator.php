<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../../inc/config/constants.php');
require_once('../../inc/config/db.php');

// Modify the SQL query to join the item table with the vendor table
$itemDetailsSearchSql = 'SELECT item.*, vendor.vendorName FROM item LEFT JOIN vendor ON item.vendorName = vendor.vendorID';
$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
$itemDetailsSearchStatement->execute();

$output = '<table id="itemReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Item Number</th>
                    <th>Item Name</th>
                    <th>Discount %</th>
                    <th>Stock</th>
                    <th>Unit Price</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Vendor Name</th>
                </tr>
            </thead>
            <tbody>';

// Create table rows from the selected data
while($row = $itemDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
    $output .= '<tr>' .
                    '<td>' . $row['productID'] . '</td>' .
                    '<td>' . $row['itemNumber'] . '</td>' .
                    '<td><a href="#" class="itemDetailsHover" data-toggle="popover" id="' . $row['productID'] . '">' . $row['itemName'] . '</a></td>' .
                    '<td>' . $row['discount'] . '</td>' .
                    '<td>' . $row['stock'] . '</td>' .
                    '<td>' . $row['unitPrice'] . '</td>' .
                    '<td>' . $row['status'] . '</td>' .
                    '<td>' . $row['description'] . '</td>' .
                    '<td>' . $row['vendorName'] . '</td>' .
                '</tr>';
}

$itemDetailsSearchStatement->closeCursor();

$output .= '</tbody>
            <tfoot>
                <tr>
                    <th>Product ID</th>
                    <th>Item Number</th>
                    <th>Item Name</th>
                    <th>Discount %</th>
                    <th>Stock</th>
                    <th>Unit Price</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Vendor Name</th>
                </tr>
            </tfoot>
        </table>';

echo $output;
?>