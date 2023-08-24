<?php
require_once 'connect.php';

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

$title = $_POST["title"];
$link = $_POST["link"];
$description = $_POST["description"];
$img = $_FILES["img"]["name"];

$url = $_SERVER['REQUEST_URI'];
$url = explode('/', $url);
$str = end($url);

$sql = "UPDATE allitems SET title=:title, link=:link, description=:description WHERE id=$str";
$query = $pdo->prepare($sql);
$query->execute([
    "title" => $title,
    "link" => $link,
    "description" => $description
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

    if (isset($_FILES['img'])) {
        $uploadFile = $_FILES['img'];
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
    $blo = "UPDATE allitems SET img=:img WHERE id=$str";
    $sts = $pdo->prepare($blo);
    $sts->execute([
        "img" => $newFileName
    ]);
}

echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../../panel.php">';
?>