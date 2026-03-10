function validateForm(formId) {
    const form = document.getElementById(formId);
    if (!form) return true;

    clearErrors(form);

    let isValid = true;

    // First Name - required, no numbers
    const firstName = form.querySelector('[name="FirstName"]');
    if (firstName) {
        if (firstName.value.trim() === '') {
            showError(firstName, 'First name is required.');
            isValid = false;
        } else if (/\d/.test(firstName.value)) {
            showError(firstName, 'First name must not contain numbers.');
            isValid = false;
        }
    }

    // Last Name - required, no numbers
    const lastName = form.querySelector('[name="LastName"]');
    if (lastName) {
        if (lastName.value.trim() === '') {
            showError(lastName, 'Last name is required.');
            isValid = false;
        } else if (/\d/.test(lastName.value)) {
            showError(lastName, 'Last name must not contain numbers.');
            isValid = false;
        }
    }

    // Address - required
    const address = form.querySelector('[name="Address"]');
    if (address) {
        if (address.value.trim() === '') {
            showError(address, 'Address is required.');
            isValid = false;
        }
    }

    // Country - required
    const country = form.querySelector('[name="country"]');
    if (country) {
        if (country.value.trim() === '') {
            showError(country, 'Country is required.');
            isValid = false;
        }
    }

    // Gender - required (radio)
    const gender = form.querySelectorAll('[name="Gender"]');
    if (gender.length > 0) {
        const genderChecked = form.querySelector('[name="Gender"]:checked');
        if (!genderChecked) {
            const genderContainer = gender[0].closest('.mb-3');
            showErrorInContainer(genderContainer, 'Please select a gender.');
            isValid = false;
        }
    }

    // Skills - at least one checked
    const skills = form.querySelectorAll('[name="skills[]"]');
    if (skills.length > 0) {
        const skillChecked = form.querySelector('[name="skills[]"]:checked');
        if (!skillChecked) {
            const skillsContainer = skills[0].closest('.mb-3');
            showErrorInContainer(skillsContainer, 'Please select at least one skill.');
            isValid = false;
        }
    }

    // Username - required
    const username = form.querySelector('[name="username"]');
    if (username) {
        if (username.value.trim() === '') {
            showError(username, 'Username is required.');
            isValid = false;
        }
    }

    // Password - required, exactly 8 chars, lowercase + digits + underscore only, no uppercase
    const password = form.querySelector('[name="password"]');
    if (password) {
        const pwd = password.value;
        if (pwd === '') {
            showError(password, 'Password is required.');
            isValid = false;
        } else if (pwd.length !== 8) {
            showError(password, 'Password must be exactly 8 characters.');
            isValid = false;
        } else if (/[A-Z]/.test(pwd)) {
            showError(password, 'Password must not contain capital letters.');
            isValid = false;
        } else if (!/^[a-z0-9_]{8}$/.test(pwd)) {
            showError(password, 'Password can only contain lowercase letters, numbers, and underscore.');
            isValid = false;
        }
    }

    return isValid;
}

function showError(input, message) {
    input.classList.add('is-invalid');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.textContent = message;
    input.parentNode.appendChild(errorDiv);
}

function showErrorInContainer(container, message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'text-danger small mt-1 validation-error';
    errorDiv.textContent = message;
    container.appendChild(errorDiv);
}

function clearErrors(form) {
    form.querySelectorAll('.is-invalid').forEach(function (el) {
        el.classList.remove('is-invalid');
    });
    form.querySelectorAll('.invalid-feedback').forEach(function (el) {
        el.remove();
    });
    form.querySelectorAll('.validation-error').forEach(function (el) {
        el.remove();
    });
}
