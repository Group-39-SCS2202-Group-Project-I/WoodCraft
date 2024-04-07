    // popup
    function showPopup() {
        document.getElementById('popup').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }

    //profile - birthday & gender fields
    // Define months, days, and years arrays
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var days = Array.from({ length: 31 }, (_, i) => i + 1); // Generate an array from 1 to 31
    var years = Array.from({ length: 100 }, (_, i) => new Date().getFullYear() - i); // Generate an array of the last 100 years

    // Function to generate select options
    function generateOptions(array, selectedValue) {
        var options = "";
        array.forEach(function(value) {
            var selected = (selectedValue == value) ? "selected" : "";
            options += "<option value='" + value + "' " + selected + ">" + value + "</option>";
        });
        return options;
    }

    // Populate the select fields
    document.addEventListener("DOMContentLoaded", function() {
        var monthSelect = document.getElementById("birth-month");
        var daySelect = document.getElementById("birth-day");
        var yearSelect = document.getElementById("birth-year");
    
        var birthMonth = JSON.parse(document.currentScript.dataset.birthMonth);
        var birthDay = parseInt(document.currentScript.dataset.birthDay);
        var birthYear = parseInt(document.currentScript.dataset.birthYear);
    
        // Populate month select
        monthSelect.innerHTML = "<option disabled selected>Month</option>" + generateOptions(months, birthMonth);
        
        // Populate day select
        daySelect.innerHTML = "<option disabled selected>Day</option>" + generateOptions(days, birthDay);
        
        // Populate year select
        yearSelect.innerHTML = "<option disabled selected>Year</option>" + generateOptions(years, birthYear);
    });
    


    
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