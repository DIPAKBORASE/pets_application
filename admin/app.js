// Function to open the task modal
function openTaskForm() {
    const modal = document.getElementById('taskModal');
    modal.style.display = 'block';

    // Fetch pets and populate the dropdown
    fetch('fetch_pets.php')
    .then(response => response.json())
    .then(pets => {
        console.log("Pets fetched:", pets); // Log the response here
        const petSelect = document.getElementById('pet');
        petSelect.innerHTML = '<option value="" disabled selected>Select your pet</option>';
        pets.forEach(pet => {
            const option = document.createElement('option');
            option.value = pet.id;
            option.textContent = pet.pet_name;
            petSelect.appendChild(option);
        });
    })
    .catch(error => console.error('Error fetching pets:', error));
}

// Close the modal if user clicks outside of it
window.onclick = function(event) {
    const modal = document.getElementById('taskModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
};


function saveTask() {
    const petId = document.getElementById('pet').value;
    const category = document.getElementById('category').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const repeatedTimes = document.getElementById('repeatedTimes').value;
    const repeatInterval = document.getElementById('repeatInterval').value;
    const ends = document.getElementById('ends').value;
    const notification = document.getElementById('notification').checked ? 1 : 0;
    const notificationTime = document.getElementById('notificationTime').value;
    const notificationUnit = document.getElementById('notificationUnit').value;
    const notes = document.getElementById('notes').value;

    // Validation
    if (!petId) {
        alert('Please select a pet');
        return;
    }

    const taskData = {
        pet_id: petId,
        category,
        date,
        time,
        repeatedTimes,
        repeatInterval,
        ends,
        notification,
        notificationTime,
        notificationUnit,
        notes
    };

    // Send the data to your server to save the task
    fetch('save_task.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(taskData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Task saved successfully');
            // Optionally, close the modal
            document.getElementById('taskModal').style.display = 'none';
        } else {
            alert('Error saving task');
        }
    })
    .catch(error => console.error('Error:', error));
}

const wrapper = document.querySelector('.carousel__wrapper');
const slides = document.querySelectorAll('.carousel__slide');
let currentSlide = 0;

document.querySelector('.next').addEventListener('click', () => {
    currentSlide = (currentSlide + 1) % slides.length;
    updateCarousel();
});

document.querySelector('.prev').addEventListener('click', () => {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    updateCarousel();
});

function updateCarousel() {
    const slideWidth = slides[0].clientWidth;
    wrapper.style.transform = `translateX(-${slideWidth * currentSlide}px)`;
}
