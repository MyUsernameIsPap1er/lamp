console.log('addform.js loaded');
async function addUser() {
    const name = document.querySelector('#name').value;
    const email = document.querySelector('#email').value;

    const res = await fetch('api/users', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, email })
    });

    if (res.ok) {
        loadUsers();
    } else {
        alert('Error adding user');
    }
}