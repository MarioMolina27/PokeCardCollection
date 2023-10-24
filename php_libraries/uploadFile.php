<?php
function uploadImage($fieldName) 
{
    $target_dir = "../img/pokemon/";
    $target_file = $target_dir . basename($_FILES[$fieldName]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a real image
    $check = getimagesize($_FILES[$fieldName]["tmp_name"]);
    if ($check === false) 
    {
        $_SESSION['error'] = "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) 
    {
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES[$fieldName]["size"] > 500000) 
    {
        $_SESSION['error'] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) 
    {
        $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) 
    {
        if (move_uploaded_file($_FILES[$fieldName]["tmp_name"], $target_file)) 
        {
            echo "The file " . htmlspecialchars(basename($_FILES[$fieldName]["name"])) . " has been uploaded.";
        } 
        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>