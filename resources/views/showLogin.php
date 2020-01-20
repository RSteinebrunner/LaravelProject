<html>
<head>
<title>Login</title>
</head>
<body>

<!-- action will point to the route -->
<form action = "doLogin" method = "POST">
    <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/> <!-- Protects against man in the middle attack -->
    <h2>Login</h2>
    <table>
    <tr>
    	<td>Username: </td>
    	<td><input type="text" name="username"/></td>
    </tr>
    <tr>
    	<td>Password: </td>
    	<td><input type="password" name="password"/></td>
    </tr>
    <tr>
    	<td colspan="2" align="center">
    	<input type = "submit" value="Login"/>
    	</td>
    </tr>   
    </table>
    <p>Don't have an account? <a href="register">Sign up</a>.</p>
</form>
</body>


</html>