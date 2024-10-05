<?php
session_start();
include_once 'C:\\xampp\\htdocs\\pets_application\\ltservcon.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    echo json_encode(['error' => 'User not logged in']);

    header("Location: login.php");
    exit();
}
try {
    // Fetch all pets from the database
    $sql = "SELECT * FROM pets";
    $stmt = $userdata->prepare($sql);
    $stmt->execute();
    $pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Your Pet</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/add_pet.css">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Add custom styles to make the page more engaging */
        .hero {
            background-image: url('../imgs/266770.jpg');
            /* Replace with your preferred image */
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 2rem;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            font-family: cursive;
            color: black;
        }

        .hero p {
            font-size: 1.3rem;
            font-family: cursive;
            color: black
        }

        /* Custom styles for the modal and form */
        .modal-body {
            padding: 2rem;
        }

        #addPetForm .form-label {
            font-weight: bold;
        }

        /* Button hover effect */
        .btn-primary:hover {
            background-color: #0048a0;
            border-color: #0048a0;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero">
        <div>
            <h1>Welcome to the Pet Hub!</h1>
            <p>Keep track of your beloved pets' information and ensure they are always healthy and happy. Add your pet details below to get started!</p>
            <button type="button" class="btn btn-light mt-3" data-bs-toggle="modal" data-bs-target="#addPetModal">
                Add Your Pet Now!
            </button>
        </div>
    </section>

    <div class="container my-5">
        <div class="text-center mb-4">
            <h2>Manage Your Pets</h2>
            <p class="lead">Easily add and manage your beloved pets' details below.</p>
        </div>

        <!-- New modern styled button -->
        <div class="d-flex justify-content-center mb-4">
            <button type="button" class="btn btn-outline-success btn-lg" data-bs-toggle="modal" data-bs-target="#addPetModal">
                <i class="fas fa-plus-circle"></i> Add New Pet
            </button>
        </div>

        <!-- Existing pets section (can add dynamic content later) -->

        <div class="flex  overflow-x-auto">
            <div class="flex flex-nowrap p-4">
                <?php if (!empty($pets)): ?>
                    <?php foreach ($pets as $pet): ?>
                        <div class="w-1/4 min-w-[500px] p-4">
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="p-6">
                                    <!-- Display pet name -->
                                    <h5 class="text-lg font-semibold text-gray-800"><?php echo htmlspecialchars($pet['pet_name']); ?></h5>
                                    <!-- Display breed -->
                                    <p class="text-gray-600">Breed: <?php echo htmlspecialchars($pet['pet_breed']); ?></p>
                                    <!-- Display age -->
                                    <p class="text-gray-600">Age: <?php echo htmlspecialchars($pet['pet_age']); ?> years</p>

                                    <!-- Optional: Display pet image if available -->
                                    <?php if (!empty($pet['pet_image'])): ?>
                                        <img src="uploads/<?php echo htmlspecialchars($pet['pet_image']); ?>" alt="<?php echo htmlspecialchars($pet['pet_name']); ?>" class="w-full h-48 object-cover mt-4 mb-4">
                                    <?php endif; ?>

                                    <!-- View details and Remove buttons -->
                                    <div class="flex justify-between gap-x-8 mt-5">
                                        <button class="bg-blue-500 text-white text-sm font-semibold py- px-4 rounded hover:bg-blue-600">View Details</button>
                                        <button class="bg-red-500 text-white text-sm font-semibold py-2 px-4 rounded hover:bg-red-600">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-gray-500">No pets found. Please add some!</p>
                <?php endif; ?>
            </div>
        </div>

    </div>

    </div>

    <!-- Modal for adding pets -->
    <div id="addPetModal" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="modal-dialog bg-white rounded-lg shadow-lg max-w-screen-md w-11/12">
            <div class="modal-content w-lg">
                <!-- Modal Header -->
                <div class="modal-header flex justify-between items-center p-4 border-b border-gray-200">
                    <h5 class="text-lg font-semibold" id="addPetModalLabel">Add Pet Information</h5>
                    <button type="button" data-bs-dismiss="modal" data-bs-target="#addPetModal" class="text-gray-400 hover:text-gray-600 btn" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body p-6">
                    <form id="addPetForm" class="space-y-4">
                        <!-- First Row: Pet Name and Breed (side-by-side) -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="petName" class="block text-sm font-medium text-gray-700">Pet Name</label>
                                <input type="text" class="mt-1 block w-full h-8 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="petName" name="pet_name" required>
                            </div>
                            <div>
                                <label for="petBreed" class="block text-sm font-medium text-gray-700">Breed</label>
                                <input type="text" class="mt-1 block w-full h-8 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="petBreed" name="pet_breed" required>
                            </div>
                        </div>

                        <!-- Sex Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sex</label>
                            <div class="flex items-center space-x-4 mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" id="male" name="pet_sex" value="Male" class="text-blue-600" checked>
                                    <span class="ml-2">Male</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" id="female" name="pet_sex" value="Female" class="text-blue-600">
                                    <span class="ml-2">Female</span>
                                </label>
                            </div>
                        </div>

                        <!-- Second Row: Age and Weight (side-by-side) -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="petAge" class="block text-sm font-medium text-gray-700">Age</label>
                                <input type="number" class="mt-1 block w-full h-8 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="petAge" name="pet_age">
                            </div>
                            <div>
                                <label for="petWeight" class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                                <input type="number" class="mt-1 block w-full h-8 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="petWeight" name="pet_weight" placeholder="kg">
                            </div>
                        </div>

                        <!-- Pet Color -->
                        <div>
                            <label for="petColor" class="block text-sm font-medium text-gray-700">Color</label>
                            <input type="text" class="mt-1 block w-full h-8 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="petColor" name="pet_color">
                        </div>

                        <!-- Neutering Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Neutering Status</label>
                            <div class="flex items-center space-x-4 mt-1">
                                <label class="inline-flex items-center">
                                    <input type="radio" id="intact" name="neutering_status" value="Intact" class="text-blue-600" checked>
                                    <span class="ml-2">Intact</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" id="neutered" name="neutering_status" value="Neutered" class="text-blue-600">
                                    <span class="ml-2">Neutered</span>
                                </label>
                            </div>
                        </div>

                        <!-- Microchip -->
                        <div>
                            <label for="microchip" class="block text-sm font-medium text-gray-700">Microchip</label>
                            <input type="text" class="mt-1 block w-full h-8 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="microchip" name="microchip">
                        </div>

                        <!-- Passed Away Checkbox -->
                        <div class="flex items-center">
                            <input type="checkbox" id="passedAway" name="passed_away" class="text-blue-600">
                            <label for="passedAway" class="ml-2 text-sm font-medium text-gray-700">Passed Away</label>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes</label>
                            <textarea class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="notes" name="notes"></textarea>
                        </div>
                    </form>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer flex justify-end p-4 border-t border-gray-200">
                    <button id="closeModalButton" data-bs-toggle="modal" data-bs-target="#addPetModal" type="button" class="btn-secondary bg-gray-300 text-gray-700 hover:bg-gray-400 py-2 px-4 rounded-md">Close</button>
                    <button type="submit" form="addPetForm" class="btn-primary bg-blue-600 text-white hover:bg-blue-700 py-2 px-4 rounded-md ml-2">Add Pet</button>
                </div>

                <input type="hidden" id="userId" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
            </div>
        </div>
    </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery (for AJAX) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#addPetForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Gather form data
                var petData = {
                    user_id: $('#userId').val(),
                    pet_name: $('#petName').val(),
                    pet_breed: $('#petBreed').val(),
                    pet_sex: $('input[name="pet_sex"]:checked').val(),
                    pet_age: $('#petAge').val(),
                    pet_weight: $('#petWeight').val(),
                    pet_color: $('#petColor').val(),
                    neutering_status: $('input[name="neutering_status"]:checked').val(),
                    microchip: $('#microchip').val(),
                    passed_away: $('#passedAway').is(':checked') ? 1 : 0,
                    notes: $('#notes').val()
                };

                // Send AJAX request
                $.ajax({
                    url: 'add_pet_ajax.php', // PHP file that processes the request
                    type: 'POST',
                    data: petData,
                    success: function(response) {
                        // Close the modal
                        $('#addPetModal').modal('hide');

                        // Clear form
                        $('#addPetForm')[0].reset();

                        // Show a success message
                        alert(response);
                    },
                    error: function() {
                        alert('An error occurred while adding the pet.');
                    }
                });
            });
        });
    </script>

</body>

</html>
<script src="app.js"></script>