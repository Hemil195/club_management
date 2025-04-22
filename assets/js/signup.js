document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form");
    const emailInput = document.getElementById("txtEmail");
    const passwordInput = document.getElementById("txtPassword");
    const errorMessage = document.querySelectorAll(".error");
    const togglePassword = document.getElementById("togglePassword");

    // Email validation function
    const validateEmail = (email) => {
        const emailRegex = /^[a-zA-Z0-9._%+-]+@charusat\.edu\.in$/;
        return emailRegex.test(email);
    };

    // Form validation function
    const validateForm = () => {
        let isValid = true;

        // Clear previous error messages
        errorMessage.forEach(error => error.textContent = "");

        // Validate email
        if (!emailInput.value.trim()) {
            errorMessage[0].textContent = "Email is required";
            isValid = false;
        } else if (!validateEmail(emailInput.value.trim())) {
            errorMessage[0].textContent = "Email must end with @charusat.edu.in";
            isValid = false;
        }

        // Validate password
        if (!passwordInput.value.trim()) {
            errorMessage[1].textContent = "Password is required";
            isValid = false;
        } else if (passwordInput.value.length < 6) {
            errorMessage[1].textContent = "Password must be at least 6 characters long";
            isValid = false;
        }

        return isValid;
    };

    // Toggle password visibility
    togglePassword.addEventListener("click", function () {
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);
        this.textContent = type === "password" ? "👁️" : "👁️‍🗨️";  // Change icon based on state
    });

    // Sign Up button click
    document.getElementById("btnLogin").addEventListener("click", function (event) {
        event.preventDefault();  // Prevent form submission

        if (validateForm()) {
            form.submit();  // Submit form if validation passes
        } else {
            alert("Please check your E-mail and Password");
        }
    });
});
