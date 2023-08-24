<?php
require_once 'admin/functions/connect.php';

if (isset($_POST['reserve'])) {
    $productId = $_POST['reserve'];

    $updateQuery = $pdo->prepare("UPDATE `allitems` SET `reserved` = NOT `reserved` WHERE `id` = :id");
    $updateQuery->execute(array(':id' => $productId));

    $success = true;
} else {
    $success = false;
}

echo json_encode(['success' => $success]);
?>