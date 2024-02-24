    // popup
    function showPopup() {
        document.getElementById('popup').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

    // generate options for months, days, and years
    const monthNames = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    function generateOptions(selectElement, options) {
        options.forEach((option, index) => {
            const optionElement = document.createElement("option");
            optionElement.value = index + 1;
            optionElement.text = option;
            selectElement.add(optionElement);
        });
    }

    generateOptions(document.getElementById("birth-month"), monthNames);
    generateOptions(document.getElementById("birth-day"), Array.from({ length: 31 }, (_, i) => i + 1));
    generateOptions(document.getElementById("birth-year"), Array.from({ length: 125 }, (_, i) => 2024 - i));

    // navigate to my profile page
    // function goToMyProfile() {
    //     window.location.href = 'profile.html';
    // }

    // toggle password visibility
    function togglePasswordVisibility(fieldId) {
        const passwordField = document.getElementById(fieldId);
        const eyeIcon = document.querySelector(`#${fieldId} + .eye-icon`);

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeIcon.querySelector('.closed-eye').style.display = 'none';
            eyeIcon.querySelector('.open-eye').style.display = 'block';
        } else {
            passwordField.type = 'password';
            eyeIcon.querySelector('.closed-eye').style.display = 'block';
            eyeIcon.querySelector('.open-eye').style.display = 'none';
        }
    }

    // function validateAndSaveChanges() {
        // var currentPasswordField = document.getElementById("current-password");
        // var currentPasswordError = document.getElementById("current-password-error");
    
        // if (currentPasswordField.value.trim() === "") {
        //     currentPasswordError.textContent = "Cannot leave this empty";
        //     currentPasswordField.style.borderColor = "red";
        //     return;
        // } else {
        //     currentPasswordError.textContent = "";
        //     currentPasswordField.style.borderColor = "#ccc";
        // }
    
        // other validations for other fields if needed
    
        // If all validations pass, proceed to save changes
        // saveChanges();
    // }

    
    //manage my account.................

    // Add event listener to the parent element
    document.querySelector('.nav-main').addEventListener('click', (event) => {
        const target = event.target;
        const id = target.id;

        // Handle different menu items based on their IDs
        switch (id) {
        case 'tohome':
            window.location.href = '<?= ROOT ?>';
            break;
        case 'toproducts':
            window.location.href = '<?= ROOT ?>/products';
            break;
        case 'toabout':
            window.location.href = '<?= ROOT ?>/about';
            break;
        case 'tocontact':
            window.location.href = '<?= ROOT ?>/contact';
            break;
        case 'tocart':
            window.location.href = '<?= ROOT ?>/cart';
            break;
        case 'tomanage-acc':
        window.location.href = '<?= ROOT ?>/manage/manage-account';
            break;
        case 'toregister':
        window.location.href = '<?= ROOT ?>/signup';
            break;
        case 'tologin':
        window.location.href = '<?= ROOT ?>/login';
            break;
        case 'toorders':
        window.location.href = '<?= ROOT ?>/manage/orders';
            break;
        case 'towishlist':
        window.location.href = '<?= ROOT ?>/manage/wishlist';
            break;
        case 'toreviews':
        window.location.href = '<?= ROOT ?>/manage/reviews';
            break;
        case 'toreturns':
        window.location.href = '<?= ROOT ?>/manage/returns';
            break;
        default:
            break;
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        const sidebarItems = document.querySelectorAll('.sidebar-list-item');
    
        // Set initial selected item
        const initialSelectedItem = document.querySelector('.def-selected');
        initialSelectedItem.click(); // Trigger a click event on the initial item to set it as selected
    
        // Add click event listener to each sidebar item
        sidebarItems.forEach(item => {
            item.addEventListener('click', function () {
                // Remove selected class from all items
                sidebarItems.forEach(item => {
                    item.classList.remove('selected');
                });
    
                // Add selected class to the clicked item
                this.classList.add('selected');
            });
        });
    });
    