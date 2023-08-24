<?php
require_once 'connect.php';

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

$id = $_POST['id'];

if(isset($id)) {
    try {
        $sql = "DELETE FROM allitems WHERE id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../panel.php">';
    } catch (PDOException $th) {
        echo "Database error: " . $th->getMessage();
    }
}
?>
