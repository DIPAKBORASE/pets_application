<?php
try {
    $userdata = new PDO('mysql:host=localhost;port=3306;dbname=pets_application', 'damahe', 'damahe123');
    $userdata->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
