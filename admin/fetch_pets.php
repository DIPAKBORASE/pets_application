<?php
session_start();
include_once 'C:\\xampp\\htdocs\\pets_application\\ltservcon.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, send an error response
    echo json_encode(['error' => 'User not logged in']);
    exit();
}

$userId = $_SESSION['user_id'];

try {
    $query = $userdata->prepare("SELECT id, pet_name FROM pets WHERE user_id = :user_id");
    $query->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $query->execute();

    $pets = $query->fetchAll(PDO::FETCH_ASSOC);

    // Check if any pets were found
    if (count($pets) > 0) {
        echo json_encode($pets);
    } else {
        echo json_encode(['message' => 'No pets found.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
