<?php
// Include your database connection file
include_once 'C:\\xampp\\htdocs\\pets_application\\ltservcon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get JSON data from the request
    $data = json_decode(file_get_contents('php://input'), true);

    // Prepare and execute the SQL query to insert the task
    $stmt = $userdata->prepare("INSERT INTO tasks (category, date, time, repeated_times, repeat_interval, ends, notification, notification_time, notification_unit, notes) VALUES (:category, :date, :time, :repeated_times, :repeat_interval, :ends, :notification, :notification_time, :notification_unit, :notes)");

    try {
        $stmt->execute([
            'category' => $data['category'],
            'date' => $data['date'],
            'time' => $data['time'],
            'repeated_times' => $data['repeatedTimes'],
            'repeat_interval' => $data['repeatInterval'],
            'ends' => $data['ends'],
            'notification' => $data['notification'] ? 1 : 0,
            'notification_time' => $data['notificationTime'],
            'notification_unit' => $data['notificationUnit'],
            'notes' => $data['notes']
        ]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
