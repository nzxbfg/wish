<?php
require_once 'connect.php';

// ini_set('display_errors', 1);
// error_reporting(E_ALL);

$title = $_POST['titlenew'];
$link = $_POST['linknew'];
$description = $_POST['descriptionnew'];
$img = $_FILES["imgnew"]["name"];

try {
    $sql = "INSERT INTO allitems (title, link, description, img) VALUES (:title, :link, :description, :img)";
    $query = $pdo->prepare($sql);
    $query->execute([
        "title" => $title,
        "link" => $link,
        "description" => $description,
        "img" => $img
    ]);

    define('BASE_UPLOAD_DIR', '../../img/');

    if (isset($_POST["add"])) {
        $maxFileSize = 3000 * 3000;

        function generateUniqueFileName($originalName) {
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);
            $safeName = preg_replace('/[^a-zA-Z0-9_\-]/', '', $originalName);
            return uniqid() . '_' . $safeName . '.' . $extension;
        }

        function isAllowedMimeType($mime) {
            $allowedMimeTypes = ['image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/svg', 'image/heic', 'image/avif', 'image/webp'];
            return in_array(strtolower($mime), $allowedMimeTypes);
        }

        if (isset($_FILES['imgnew'])) {
            $uploadFile = $_FILES['imgnew'];
            if ($uploadFile['error'] === UPLOAD_ERR_OK) {
                if ($uploadFile['size'] <= $maxFileSize) {
                    $newFileName = generateUniqueFileName($uploadFile['name']);
                    if (isAllowedMimeType($uploadFile['type'])) {
                        $destination = BASE_UPLOAD_DIR . $newFileName;
                        if (move_uploaded_file($uploadFile['tmp_name'], $destination)) {
                            echo "File uploaded successfully!";
                            $img = $newFileName;
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

    if (!empty($img)) {
        $updateImgSql = "UPDATE allitems SET img = :img WHERE title = :title";
        $updateImgQuery = $pdo->prepare($updateImgSql);
        $updateImgQuery->execute([
            "img" => $img,
            "title" => $title
        ]);
    }

    echo '<meta HTTP-EQUIV="Refresh" Content="0; URL=../panel.php">';
    } catch (PDOException $th) {
    echo "Database error: " . $th->getMessage();
}
?>