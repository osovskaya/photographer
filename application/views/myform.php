<html>
<head>
    <title>My Form</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php echo form_open('form'); ?>

<h5>Role</h5>
<input type="text" name="role" value="" size="50" />

<h5>name</h5>
<input type="text" name="name" value="" size="50" />

<h5>Username</h5>
<input type="text" name="username" value="" size="50" />

<h5>Password</h5>
<input type="text" name="password" value="" size="50" />

<h5>phone</h5>
<input type="text" name="phone" value="" size="15" />

<div><input type="submit" value="Submit" /></div>

</form>

</body>
</html>
