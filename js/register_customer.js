document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        let valid = true;
        const name = form.customer_name.value;
        const email = form.customer_email.value;
        const password = form.customer_pass.value;
        const contact = form.customer_contact.value;

        // Validation Name
        if (!/^[a-zA-Z ]+$/.test(name)) {
            alert("Name must contain only letters and spaces.");
            valid = false;
        }

        // Validating Email for @ashesi.edu.gh
        if (!email.endsWith('@ashesi.edu.gh')) {
            alert('The only allowed email is @ashesi.edu.gh.');
            valid = false;
        }

        // Log email value for debugging
        console.log("Email entered:", email);

        // Validating Password
        if (password.length < 8) {
            alert("Password must be at least 8 characters long.");
            valid = false;
        }

// Validating Contact
if (!/^\+?\d{10,}$/.test(contact)) {
    alert("Contact number must not be less than 10 digits.");
    valid = false;
}


        // Prevent form submission if any validation fails
        if (!valid) {
            event.preventDefault();
        }
    });
});