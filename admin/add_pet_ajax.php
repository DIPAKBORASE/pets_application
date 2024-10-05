<?php
// Include your PDO connection file
include_once 'C:\\xampp\\htdocs\\pets_application\\ltservcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $user_id = $_POST['user_id']; // Get user ID from the POST data
    $pet_name = $_POST['pet_name'];
    $pet_breed = $_POST['pet_breed'];
    $pet_sex = $_POST['pet_sex'];
    $pet_age = $_POST['pet_age'];
    $pet_weight = $_POST['pet_weight'];
    $pet_color = $_POST['pet_color'];
    $neutering_status = $_POST['neutering_status'];
    $microchip = $_POST['microchip'];
    $passed_away = isset($_POST['passed_away']) ? 1 : 0; // Assuming it's a checkbox
    $notes = $_POST['notes'];

    // if (isset($_FILES['pet_image']) && $_FILES['pet_image']['error'] === UPLOAD_ERR_OK) {
    //     $image_tmp_name = $_FILES['pet_image']['tmp_name'];
    //     $image_name = $_FILES['pet_image']['name'];
    //     $image_size = $_FILES['pet_image']['size'];
    //     $image_type = $_FILES['pet_image']['type'];

    //     // Define the upload directory
    //     $upload_dir = 'C:\\xampp\\htdocs\\pets_application\\uploads\\';
    //     $image_path = $upload_dir . basename($image_name);

    //     // Check if the file is an actual image
    //     $check = getimagesize($image_tmp_name);
    //     if ($check !== false) {
    //         // Move the uploaded file to the server
    //         if (move_uploaded_file($image_tmp_name, $image_path)) {
    //             echo "Image uploaded successfully.";
    //         } else {
    //             echo "Error uploading image.";
    //             exit; // Stop further execution if the image fails to upload
    //         }
    //     } else {
    //         echo "File is not an image.";
    //         exit;
    //     }
    // } else {
    //     echo "No image uploaded or there was an upload error.";
    //     exit; // Stop further execution if no image is uploaded
    // }

    try {
        // Insert the pet data into the database
        $sql = "INSERT INTO pets (pet_name, pet_breed, pet_sex, pet_age, pet_weight, pet_color, neutering_status, microchip, passed_away, notes, user_id) 
                VALUES (:pet_name, :pet_breed, :pet_sex, :pet_age, :pet_weight, :pet_color, :neutering_status, :microchip, :passed_away, :notes, :user_id)";

        $stmt = $userdata->prepare($sql);
        $stmt->execute([
            ':pet_name' => $pet_name,
            ':pet_breed' => $pet_breed,
            ':pet_sex' => $pet_sex,
            ':pet_age' => $pet_age,
            ':pet_weight' => $pet_weight,
            ':pet_color' => $pet_color,
            ':neutering_status' => $neutering_status,
            ':microchip' => $microchip,
            ':passed_away' => $passed_away,
            ':notes' => $notes,
            ':user_id'=>$user_id
            // ':pet_image' => basename($image_name) // Save only the file name in the database
        ]);

        echo 'Pet added successfully';
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
