<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pTitle = trim($_POST['pTitle']);
    $pDescription = trim($_POST['pDescription']);
    $pPrice = floatval($_POST['pPrice']);
    $pAge = intval($_POST['pAge']);
    $pType = intval($_POST['pType']);

    // Handle image upload
    $targetDir = "../uploads/products/";
    $fileName = basename($_FILES["pImage"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allowed file types
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array(strtolower($fileType), $allowedTypes)) {
        die("Invalid file type. Only JPG, JPEG, PNG & GIF are allowed.");
    }

    // Move uploaded file
    if (move_uploaded_file($_FILES["pImage"]["tmp_name"], $targetFilePath)) {
        // Insert data into database
        $sql = "INSERT INTO tbl_products (p_image, p_title, p_description, p_price, p_age, p_type)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdis", $fileName, $pTitle, $pDescription, $pPrice, $pAge, $pType);

        if ($stmt->execute()) {
            header("Location: ../products.php?success=Product added successfully");
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error uploading image.";
    }
}

$conn->close();
?>
