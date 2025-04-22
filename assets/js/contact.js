document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const nameInput = document.getElementById("name");
    const messageInput = document.getElementById("message");
    const submitBtn = document.getElementById("submitBtn");

    // Function to handle form submission
    const submitForm = (event) => {
        event.preventDefault();  // Prevent default form submission

        const name = nameInput.value.trim();
        const message = messageInput.value.trim();

        // Validate inputs
        if (name === "" || message === "") {
            alert("Please fill in both your name and message.");
            return;
        }

        // Create a FormData object to send the form data via AJAX
        const formData = new FormData(form);

        // Use fetch to send the form data to api/contact.php
        fetch("api/contact.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())  // Get the response from the server
        .then(result => {
            alert(result);  // Display success or error message
            if (result.includes("successfully")) {
                // Clear form fields after submission
                nameInput.value = "";
                messageInput.value = "";
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("There was an error submitting your message.");
        });
    };

    // Listen for the submit button click
    submitBtn.addEventListener("click", submitForm);

    // Listen for Enter key press in the message textarea
    messageInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter" && !e.shiftKey) {  // Submit when Enter is pressed (not Shift + Enter)
            submitForm(e);
        }
    });
});
