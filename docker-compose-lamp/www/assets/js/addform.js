console.log('addform.js loaded');

const $ = (sel) => document.querySelector(sel);

const showBanner = (type, message) => {
    const box = $('#formMessage');
    if (!box) return;

    box.hidden = false;
    box.className = `form-message ${type}`;
    box.textContent = message;

    if (type === 'success') {
        box.classList.add('fade');

        setTimeout(() => {
            box.hidden = true;
            box.classList.remove('fade');
            box.className = 'form-message';
            box.textContent = '';
        }, 3000);
    }
};  

const clearBanner = () => {
    const box = $('#formMessage');
    if (!box) return;
    box.hidden = true;
    box.className = 'form-message';
    box.textContent = '';
};

const setFieldState = (inputEl, errorEl, message) => {
    if(message) {
        inputEl.classList.remove('is-valid');
        inputEl.classList.add('is-invalid');
        if (errorEl) errorEl.textContent = message;
    } else {
        inputEl.classList.remove('is-invalid');
        inputEl.classList.add('is-valid');
        if (errorEl) errorEl.textContent = '';
    }
};

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

function validateName() {
    const nameEl = $('#name');
    const errEl = $('#nameError');
    const name = nameEl.value.trim();

    if (name.length < 2) {
        setFieldState(nameEl, errEl, 'Name must be at least 2 characters');
        return false;
    }
    setFieldState(nameEl, errEl, '');
    return true;
}

function validateEmail() {
    const emailEl = $('#email');
    const errEl = $('#emailError');
    const value = emailEl.value.trim();

    if (!emailRegex.test(value)) {
        setFieldState(emailEl, errEl, 'Invalid email format');
        return false;
    }
    setFieldState(emailEl, errEl, '');
    return true;
}

function validateForm() {
    return validateName() && validateEmail();
}

function syncButtonState() {
    const btn = $('#addUserButton');
    btn.disabled = !validateForm();
}

document.addEventListener('DOMContentLoaded', () => {
    const nameEl = $('#name');
    const emailEl = $('#email');

    nameEl.addEventListener('input', () => {
        validateName();
        syncButtonState();
        clearBanner();
    });

    emailEl.addEventListener('input', () => {
        validateEmail();
        syncButtonState();
        clearBanner();
    });

    nameEl.addEventListener('blur', validateName);
    emailEl.addEventListener('blur', validateEmail);

    syncButtonState();
});

async function addUser() {
    clearBanner();

    const form = $('#addUserForm');
    const btn = $('#addUserButton');

    if (!validateForm()) {
        form.classList.add('shake');
        setTimeout(() => form.classList.remove('shake'), 350);
        return;
    }

    const name = document.querySelector('#name').value.trim();
    const email = document.querySelector('#email').value.trim();

    const ogText = btn.textContent;
    btn.disabled = true;
    btn.textContent = 'Adding...';

    try {
        const res = await fetch('/api/users', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ name, email })
        });

        let data = null;
        const text = await res.text();
        try { data = text ? JSON.parse(text) :  null; } catch (_) {}
    
    if (!res.ok) {
        const apiMsg = (data && (data.message || data.error)) || text || `Server responded ${res.status}`;
        showBanner('error', `Error adding user: ${apiMsg}`);
        btn.disabled = false;
        btn.textContent = ogText;
        return;
    }


    showBanner('success', 'User added successfully!');
    form.reset();

    $('#name').classList.remove('is-valid', 'is-invalid');
    $('#email').classList.remove('is-valid', 'is-invalid');

    btn.disabled = false;
    btn.textContent = ogText;

    } catch (err) {
        console.error('Add user error:', err);
        showBanner('error', `Error adding user: ${err.message}`);
        btn.disabled = false;
        btn.textContent = ogText;
    }
}

window.addUser = addUser;