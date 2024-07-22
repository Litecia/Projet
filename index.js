document.addEventListener("DOMContentLoaded", function () {
    

    const loginSelect = document.getElementById('login');

    if (loginSelect) {
        loginSelect.addEventListener('change', function() {
            const selectedValue = loginSelect.value;
            switch (selectedValue) {
                case 'Visiteur':
                    // Add logic for 'Visiteur' if needed
                    break;
                case 'veterinaire':
                    window.location.href = './admin/login.php'; // Replace with the URL for veterinarians
                    break;
                case 'employés':
                    window.location.href = './admin/login.php'; // Replace with the URL for employees
                    break;
                case 'Admin':
                    window.location.href = './admin/login.php'; // Replace with the URL for administrators
                    break;
                default:
                    break;
            }
        });
    }

    

    const listAnimal = document.querySelector('.list_animal');
    let isDown = false;
    let startX;
    let scrollLeft;

    listAnimal.addEventListener('mousedown', (e) => {
        isDown = true;
        listAnimal.classList.add('active');
        startX = e.pageX - listAnimal.offsetLeft;
        scrollLeft = listAnimal.scrollLeft;
    });

    listAnimal.addEventListener('mouseleave', () => {
        isDown = false;
        listAnimal.classList.remove('active');
    });

    listAnimal.addEventListener('mouseup', () => {
        isDown = false;
        listAnimal.classList.remove('active');
    });

    listAnimal.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - listAnimal.offsetLeft;
        const walk = (x - startX) * 3; // Scroll speed
        listAnimal.scrollLeft = scrollLeft - walk;
    });

    const modify_animal = document.querySelectorAll('.modify_animal');
    const add_animal = document.querySelectorAll('.add_animal');
    const delete_animal = document.querySelectorAll('.delete_animal');
    const modify_habitat = document.querySelectorAll('.modify_habitat');
    const add_habitat = document.querySelectorAll('.add_habitat');
    const delete_habitat = document.querySelectorAll('.delete_habitat');

    
    // const sessionValue = document.querySelector('.session_value');
    const selectElement = document.getElementById('login');
    // Add event listener for change event on the select element
    if (selectElement) {

            selectOption = selectElement.value;

            if (selectOption === 'Visiteur') {
                modify_animal.forEach(function(item) {
                    item.classList.add('hide_animal_button');
                });
                add_animal.forEach(function(item) {
                    item.classList.add('hide_animal_button');
                });
                delete_animal.forEach(function(item) {
                    item.classList.add('hide_animal_button');
                });
                modify_habitat.forEach(function(item) {
                    item.classList.add('hide_habitat_button');
                });
                add_habitat.forEach(function(item) {
                    item.classList.add('hide_habitat_button');
                });
                delete_habitat.forEach(function(item) {
                    item.classList.add('hide_habitat_button');
                });
            } else {
                modify_animal.forEach(function(item) {
                    item.classList.remove('hide_animal_button');
                });
                add_animal.forEach(function(item) {
                    item.classList.remove('hide_animal_button');
                });
                delete_animal.forEach(function(item) {
                    item.classList.remove('hide_animal_button');
                });
                modify_habitat.forEach(function(item) {
                    item.classList.remove('hide_habitat_button');
                });
                add_habitat.forEach(function(item) {
                    item.classList.remove('hide_habitat_button');
                });
                delete_habitat.forEach(function(item) {
                    item.classList.remove('hide_habitat_button');
                });
            }
        
    }
    

})