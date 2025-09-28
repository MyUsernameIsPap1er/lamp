async function loadUsers() {
    const res = await fetch('/api/users');
    const users = await res.json();

    document.querySelector('#users').innerHTML =
    users.map(u => 
        `<li>${u.id} — ${u.name} (${u.email}) [${u.status}]</li>`
    ).join('');
}

async function addUser() {
    const name = document.querySelector('#name').value;
    const email = document.querySelector('#email').value;

    const res = await fetch('/api/users', {
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


document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('#addUserForm').addEventListener('submit', (e) => { e.preventDefault(); addUser(); });
    loadUsers()
});
