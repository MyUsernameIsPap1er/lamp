console.log('mywebapp.js loaded');
async function loadUsers() {
    const list = document.querySelector('#users');
    list.innerHTML = '<li>Loading...</li>';
    try {
        const res = await fetch('api/users', { headers:
            { 'Accept': 'application/json' }
        });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        const users = await res.json();

        list.innerHTML = users.map(u => 
            `<li>${u.id} — ${u.name} (${u.email}) [${u.status ?? '-'}]</li>`
        ).join('');
    } catch (err) {
        console.error('Loading error - Users:', err);
        list.innerHTML = '<li>Error loading users</li>';
    }
}

loadUsers();