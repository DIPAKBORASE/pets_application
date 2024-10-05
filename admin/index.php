<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <!-- font awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
        integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk="
        crossorigin="anonymous" />
    <title>Pet Care</title>
</head>

<body>
    <!-- Landing Area -->
    <section id="landing__area" class="container__center">
        <nav class="center__row">
            <h1 class="logo"><i class="fas fa-kiwi-bird"></i> PetsCare</h1>
            <ul class="center__row">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php" class="btn logout-btn">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="btn login-btn">Login</a></li>
                    <li><a href="signup.php" class="btn signup-btn">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="carousel">
    <div class="carousel__wrapper">
        <div class="carousel__slide">
            <div class="image__pet"></div>
        </div>
        <!-- Add more slides here -->
        <div class="carousel__slide">
            <div class="image__pet"></div>
        </div>
    </div>
    <button class="carousel__control prev">❮</button>
    <button class="carousel__control next">❯</button>
</div>


    </section>

    <!-- HELP  -->
    <section id="services" class="services__container">
        <h2 class="section__title">Quick Action</h2>
        <div class="services__wrapper">

            <!-- Service 1: Add Pet -->
            <div class="service__card">
                <i class="fas fa-paw service__icon"></i>
                <h3 class="service__title">Add Your Pet</h3>
                <p class="service__description">Register your pets and keep track of their details like breed, age, and more.</p>
                <a href="add_pet.php" class="service__btn">Add Pet</a>
            </div>

            <!-- Service 2: View Pets -->
            <div class="service__card">
                <i class="fas fa-list service__icon"></i>
                <h3 class="service__title">View Your Pets</h3>
                <p class="service__description">See a list of your registered pets and their details.</p>
                <a href="my_pets.php" class="service__btn">View Pets</a>
            </div>

            <!-- Service 3: Vaccination Tracker -->
            <!-- Service 3: Vaccination Tracker -->
            <div class="service__card" onclick="openTaskForm()">
                <i class="fas fa-list service__icon"></i>
                <h3 class="service__title">Create Task</h3>
                <p class="service__description">See a list of your registered pets and their details.</p>
                <button class="service__btn">Create Task</button>
            </div>

            <!-- <div class="task__card container__center" onclick="openTaskForm()">
                <i class="fas fa-tasks"></i>
                <h3>Create Task</h3>
                <p>Click here to set a new task for your pet.</p>
            </div> -->


        </div>
    </section>


    <!-- Gallery -->
    <!-- Pet Care Tips Section -->
    <section id="care-tips" class="container__center">
        <h1>Essential Pet Care Tips</h1>
        <div class="tips__cards--container center__row">
            <div class="tips__card container__center">
                <i class="fas fa-paw"></i>
                <h3>Regular Check-ups</h3>
                <p>Ensure your pets get regular check-ups to prevent and
                    catch health issues early.</p>
            </div>
            <div class="tips__card container__center">
                <i class="fas fa-bone"></i>
                <h3>Proper Nutrition</h3>
                <p>Provide your pets with a balanced and nutritious diet
                    tailored to their specific needs.</p>
            </div>
            <div class="tips__card container__center">
                <i class="fas fa-heart"></i>
                <h3>Exercise & Play</h3>
                <p>Keep your pets active to maintain their physical and
                    mental health with regular playtime.</p>
            </div>
        </div>
    </section>

    <!-- Contact -->
    <form>
        <div class="form__row">
            <input type="text" id="name">
            <label for="name">First Name</label>
        </div>
        <div class="form__row">
            <input type="text" id="last-Name">
            <label for="last-Name">Last Name</label>
        </div>
        <div class="form__row">
            <input type="email" id="email">
            <label for="email">Email</label>
        </div>
        <div class="form__row">
            <input type="number" id="phone">
            <label for="phone">Phone</label>
        </div>
        <div class="form__row">
            <textarea id="textarea" cols="30" rows="10"
                placeholder="Write your message here"></textarea>
        </div>
        <button type="submit">Send message</button>
    </form>

    <footer>
        <div class="footer__cont center__row">
            <p>2021 &copyPetsCare</p>
            <div>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
    <div id="taskModal" class="modal">
        <div class="modal-content">
            <!-- <h2>Create Task for AKIRO</h2> -->
            <form id="taskForm">
                <!-- Select Pet Dropdown -->
                <label for="pet">Select Pet</label>
                <select id="pet" name="pet">
                    <option value="" disabled selected>Select your pet</option>
                </select>
                <label for="category">Category</label>
                <input type="text" id="category" name="category" placeholder="Category">

                <label for="date">Date</label>
                <input type="date" id="date" name="date">

                <label for="time">Time</label>
                <input type="time" id="time" name="time">

                <label for="repeatedTimes">Repeated Times</label>
                <input type="number" id="repeatedTimes" name="repeatedTimes" value="1">

                <label for="repeatInterval">Repeat Interval</label>
                <select id="repeatInterval" name="repeatInterval">
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                </select>

                <label for="ends">Ends</label>
                <input type="date" id="ends" name="ends">

                <label for="notification">Enable Notification</label>
                <input type="checkbox" id="notification" name="notification">

                <label for="notificationTime">Notify Before</label>
                <input type="number" id="notificationTime" name="notificationTime" placeholder="10">

                <label for="notificationUnit">Time Unit</label>
                <select id="notificationUnit" name="notificationUnit">
                    <option value="minutes">Minutes</option>
                    <option value="hours">Hours</option>
                    <option value="days">Days</option>
                </select>

                <label for="notes">Add Note</label>
                <textarea id="notes" name="notes" placeholder="Add note"></textarea>

                <button type="button" onclick="saveTask()">Save</button>
            </form>
        </div>
    </div>

</body>

</html>
<script src="app.js"></script>