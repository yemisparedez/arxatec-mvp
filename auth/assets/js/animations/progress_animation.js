document.addEventListener('DOMContentLoaded', function() {
    const progressBarFill = document.getElementById('progress-fill');
    progressBarFill.style.width = '0%';
    showFields(1);

    document.querySelectorAll('.step-circle').forEach(circle => {
        circle.classList.remove('active');
    });

    setTimeout(() => {
        updateProgressBar();
    }, 100); 
});

let currentStep = 1;

function nextStep(step) {
    if (validateStepFields(currentStep) && 
        (step !== 3 || 
        (document.getElementById('email-error').style.display === "none" && 
         document.getElementById('dni-error').style.display === "none" && 
         document.getElementById('dni-format-error').style.display === "none"))) {
        hideFields(currentStep);
        currentStep = step;
        updateProgressBar();
        showStep(step);
    }
}

function prevStep(step) {
    hideFields(currentStep);
    currentStep = step;

    if (step === 2) {
        resetEmailField();
        resetDniField();
    }

    updateProgressBar();
    showStep(step);
}

function updateProgressBar() {
    const progressBarFill = document.getElementById('progress-fill');
    const percentage = (currentStep / 3) * 100;

    setTimeout(() => {
        progressBarFill.style.width = `${percentage}%`;

        document.querySelectorAll('.step-circle').forEach((circle, index) => {
            if (index < currentStep) {
                circle.classList.add('active');
            } else {
                circle.classList.remove('active');
            }
        });

        const stepTexts = document.querySelectorAll('.progress-text div');
        stepTexts.forEach((text, index) => {
            if (index < currentStep) {
                text.classList.add('active-step');
                text.classList.remove('inactive-step');
            } else {
                text.classList.add('inactive-step');
                text.classList.remove('active-step');
            }
        });
    }, 100); 
}

function showStep(step) {
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('show', 'active');
    });
    document.getElementById(`step${step}`).classList.add('show', 'active');
    showFields(step);
}

function hideFields(step) {
    document.querySelectorAll(`#step${step} .fade-field`).forEach(field => {
        field.classList.remove('show-field');
    });
    document.querySelectorAll(`#step${step} .fade-button`).forEach(button => {
        button.classList.remove('show-button');
    });
}

function showFields(step) {
    document.querySelectorAll(`#step${step} .fade-field`).forEach(field => {
        setTimeout(() => {
            field.classList.add('show-field');
        }, 100);
    });
    document.querySelectorAll(`#step${step} .fade-button`).forEach(button => {
        setTimeout(() => {
            button.classList.add('show-button');
        }, 100);
    });
}

// Validation functions
function checkEmail() {
    const emailField = document.getElementById('email');
    const emailError = document.getElementById('email-error');

    const email = emailField.value;

    if (email.trim() !== "") {
        fetch(`index.php?checkEmail=${encodeURIComponent(email)}`)
            .then(response => response.json())
            .then(data => {
                if (data.email_exists) {
                    emailField.style.border = "2px solid orange";
                    emailError.style.display = "block";
                } else {
                    emailField.style.border = "";
                    emailError.style.display = "none";
                }
            })
            .catch(error => console.error("Error en la verificación del correo:", error));
    }
}

function checkDni() {
    const dniField = document.getElementById('dni');
    const dniError = document.getElementById('dni-error');

    const dni = dniField.value;

    if (dni.trim() !== "") {
        fetch(`index.php?checkDni=${encodeURIComponent(dni)}`)
            .then(response => response.json())
            .then(data => {
                if (data.dni_exists) {
                    dniField.style.border = "2px solid orange";
                    dniError.style.display = "block";
                } else {
                    dniField.style.border = "";
                    dniError.style.display = "none";
                }
            })
            .catch(error => console.error("Error en la verificación del DNI:", error));
    }
}

function validateDniFormat() {
    const dniField = document.getElementById('dni');
    const dniFormatError = document.getElementById('dni-format-error');

    const dniValue = dniField.value;
    const isValidFormat = /^\d+$/.test(dniValue);

    if (!isValidFormat) {
        dniField.style.border = "2px solid red";
        dniFormatError.style.display = "block";
    } else {
        dniField.style.border = "";
        dniFormatError.style.display = "none";
    }
}

function resetEmailField() {
    const emailField = document.getElementById('email');
    const emailError = document.getElementById('email-error');

    emailField.style.border = "";
    emailError.style.display = "none";
}

function resetDniField() {
    const dniField = document.getElementById('dni');
    const dniError = document.getElementById('dni-error');
    const dniFormatError = document.getElementById('dni-format-error');

    dniField.style.border = "";
    dniError.style.display = "none";
    dniFormatError.style.display = "none";
}

function validateStepFields(step) {
    const stepFields = document.querySelectorAll(`#step${step} .form-control`);
    let isValid = true;

    stepFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid', 'shake');
            isValid = false;

            setTimeout(() => {
                field.classList.remove('shake');
            }, 300);
        } else {
            field.classList.remove('is-invalid');
        }
    });

    return isValid;
}

function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;
    const passwordMatchError = document.getElementById('password-match-error');

    if (password !== confirmPassword) {
        document.getElementById('confirm_password').style.border = "2px solid red";
        passwordMatchError.style.display = "block";
        return false;
    } else {
        document.getElementById('confirm_password').style.border = "";
        passwordMatchError.style.display = "none";
        return true;
    }
}
