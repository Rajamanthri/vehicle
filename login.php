<?php
// Load the properties from the configuration file
$props = parse_ini_file('authorization.properties');

// Redirect the user to Auth0's login page
$auth_url = $props['oauth.auth_endpoint'] . "?response_type=code&client_id=" . $props['oauth.client_id'] .
            "&redirect_uri=" . $props['oauth.redirect_uri'] . "&scope=" . $props['oauth.scope'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <div class="div1">
        <h2>Log in</h2>
        <form method="POST" action="login_process.php">
            <label>Enter your Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label>Enter your Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label>Role:</label>
            <input type="text" id="role" name="role" placeholder="user/admin/super_admin" required>
            <span class="log"><input type="checkbox">
                <label>Remember me </label> <a href="" class="logp">Forget password?</a>
            </span><br><br>
            <input type="submit" name='submit' id="btn1" value="Login Now">

        </form>
    </div>
</body>

</html>
