<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WoodCraft</title>
</head>
<body>
    <!-- form to add user with email password repeat password and role (dropdown with 'osr','gm','sk','admin','pm') and submit button -->
    <form  method="post">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Enter email">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter password">
        <label for="confirm_password">Repeat Password</label>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat password">
        <label for="role">Role</label>
        <select name="role" id="role">
            <option value="osr">OSR</option>
            <option value="gm">GM</option>
            <option value="sk">SK</option>
            <option value="admin">Admin</option>
            <option value="pm">PM</option>
        </select>
        <input type="submit" value="Add User">
    
</body>
</html>