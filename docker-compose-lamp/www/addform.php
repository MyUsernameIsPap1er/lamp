<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>My LAMP + Vanilla JS App</title>
        <link rel="stylesheet" href="/assets/css/style.css">
    </head>
    <body>
        <nav>
            <a href="index.php">Home</a>
            <a href="/mywebapp.php">User List</a>
        </nav>
        <h2>Add User</h2>
        <form id="addUserForm" onsubmit="event.preventDefault(); addUser();">
            <input type="text" id="name" placeholder="Name" required />
            <input type="email" id="email" placeholder="Email" required />
            <button id="addUserButton">Add User</button>
        </form>
        <script src="/assets/js/addform.js"></script>
    </body>
</html>