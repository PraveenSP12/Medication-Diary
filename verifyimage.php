<?php

    $image_id = $_POST['image_id'];
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "medicationdiary";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve image data from database
    $sql = "SELECT image_data, image_type FROM images WHERE image_id = ?"; // Replace 'id' with the id of the image you want to display
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $image_id); // $imageId is the id of the image you want to display
    $stmt->execute();
    $stmt->store_result();
    
    // Check if image exists
    if ($stmt->num_rows > 0) {
       // Fetch image data
       $stmt->bind_result($imageData, $imageType);
       $stmt->fetch();

    // Set appropriate Content-Type header
    header("Content-Type: $imageType");

    // Output image data
    echo $imageData;
    } else {
        echo "Image not found.";
    }
    $stmt->close();
    $conn->close();
?>
