<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>My LAMP + Vanilla JS App</title>
        <link rel="stylesheet" href="/assets/css/style.css?v=1">
    </head>
    <body>
        <nav>
            <a href="index.php">Home</a>
            <a href="/mywebapp.php">User List</a>
        </nav>
        <h2>Add User</h2>
        <form id="addUserForm" class="form-card" onsubmit="event.preventDefault(); addUser();">
            <div id="formMessage" class="form-message" aria-live="polite" hidden></div>
            
            <div class="field">
                <label for="name">Name</label>
                <input type="text" id="name" placeholder="Name" required />
                <small class="error-message" id="nameError" aria-live="polite"></small>
            </div>
            
            <div class="field">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Email" required />
                <small class="error-message" id="emailError" aria-live="polite"></small>
            </div>

            <button id="addUserButton" type="submit">Add User</button>
        </form>
        <script src="/assets/js/addform.js"></script>
    </body>
</html>