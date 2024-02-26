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