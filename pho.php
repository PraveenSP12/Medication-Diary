<?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "medicationdiary";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
    // Check if file was uploaded without errors
    if (isset($_FILES["upphoto"]) && $_FILES["upphoto"]["error"] == 0) {
        // Get file data
        $image_name = $_FILES["upphoto"]["name"];
        $image_type = $_FILES["upphoto"]["type"];
        $image_size = $_FILES["upphoto"]["size"];
        $image_tmp_name = $_FILES["upphoto"]["tmp_name"];

        // Read image data
        $image_data = file_get_contents($image_tmp_name);

        // Prepare SQL statement to insert image data into database
        $stmt = $conn->prepare("INSERT INTO images (image_name, image_type, image_size, image_data) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $image_name, $image_type, $image_size, $image_data);

        // Execute SQL statement
        if ($stmt->execute()) {
            echo "Image uploaded successfully.";
        } else {
            echo "Error uploading image.";
        }
        $stmt->close();
    } else {
        echo "Error: " . $_FILES["upphoto"]["error"];
    }
    $conn->close();
    }
?>