<?php
require_once 'connect.php';

$card = $_POST["card"];
$about = $_POST["about"];
$telegram = $_POST["telegram"];
$instagram = $_POST["instagram"];
$mainimg = $_FILES["mainimg"]["name"];

$sql = "UPDATE base SET card=:card, about=:about, telegram=:telegram, instagram=:instagram";
$query = $pdo->prepare($sql);
$query->execute([
    "card" => $card,
    "about" => $about,
    "telegram" => $telegram,
    "instagram" => $instagram
]);

define('BASE_UPLOAD_DIR', '../../img/');

$newFileName = '';

if (isset($_POST["save"])) {
    $maxFileSize = 3000 * 3000;

    function generateUniqueFileName($originalName) {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '', $originalName);
        return uniqid() . '_' . $safeName . '.' . $extension;
    }

    function isAllowedExtension($filename, $allowedExtensions) {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        return in_array($extension, $allowedExtensions);
    }

    function isAllowedMimeType($mime) {
        $allowedMimeTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/svg', 'image/heic', 'image/avif', 'image/webp'];
        return in_array(strtolower($mime), $allowedMimeTypes);
    }

    if (isset($_FILES['mainimg'])) {
        $uploadFile = $_FILES['mainimg'];
        if ($uploadFile['error'] === UPLOAD_ERR_OK) {
            if ($uploadFile['size'] <= $maxFileSize) {
                $newFileName = generateUniqueFileName($uploadFile['name']);
                if (isAllowedMimeType($uploadFile['type'])) {
                    $destination = BASE_UPLOAD_DIR . $newFileName;
                    if (move_uploaded_file($uploadFile['tmp_name'], $destination)) {
                        echo "File uploaded successfully!";
                    } else {
                        echo "File could not be uploaded.";
                    }
                } else {
                    echo "File extension or type is not allowed.";
                }
            } else {
                echo "File is too large.";
            }
        } else {
            echo "Error uploading file.";
        }
    }
}

if (!empty($newFileName)) {
    $blo = "UPDATE base SET mainimg=:mainimg";
    $query = $pdo->prepare($blo);
    $query->execute([
        "mainimg" => $newFileName
    ]);
}

echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../panel.php">';
?>