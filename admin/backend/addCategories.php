<?php include "conn.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $catName = trim($_POST['catName']);
    $catDescription = trim($_POST['catDescription']);

    // Handle file upload
    if (isset($_FILES['catImage']) && $_FILES['catImage']['error'] == 0) {
        $uploadDir = '../uploads/categories/'; // Set your upload directory
        $fileName = time() . '_' . basename($_FILES['catImage']['name']); // Unique file name
        $uploadFile = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['catImage']['tmp_name'], $uploadFile)) {
                // Insert into database
                $sql = "INSERT INTO tbl_categories (cat_name, cat_image, cat_description) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $catName, $fileName, $catDescription);

                if ($stmt->execute()) {
                    echo "<script> window.location.href='../categories.php';</script>";
                } else {
                    echo "<script>alert('Database error. Please try again!'); window.history.back();</script>";
                }

                $stmt->close();
            } else {
                echo "<script>alert('Error uploading file!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Invalid file type! Only JPG, JPEG, PNG, GIF allowed.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Please upload an image!'); window.history.back();</script>";
    }
}

$conn->close();


?>
