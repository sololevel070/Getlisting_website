<!-- Header Include -->
<?php include('header.php'); ?>
<style type="text/css">
  .signup_a
      {
        color: white !important;
      }
</style>
<!-- Sign code -->
<?php

 	if (isset($_POST['submit']))
 	{
 		$name = $_POST['name'];
 		$email = $_POST['email'];
		$contact = $_POST['contact'];
    $password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

    	if ($password == $confirm_password) 
    	{
          $prevent_phone = mysqli_query($conn,"SELECT contact FROM users WHERE contact = '$contact' ");
          if (mysqli_num_rows($prevent_phone)>0) 
          {
            echo "<script>alert('Contact number already exist')</script>";
          }
          else
          {
            $query = mysqli_query($conn,"INSERT INTO users (name,email,contact,password,status) VALUES ('$name','$email','$contact','$password','1')");
            if ($query == TRUE)
            {
                header('location:login.php');
            }
            else
            {
                echo "<script>alert('Can not register')</script>";
            }
          }
      }
    	else
    	{
      		echo "<script>alert('Password is not matched')</script>";
    	}
	}
 ?>
 <title>Getlisting - Signup</title>
<form class="authen_form authen_form_login" method="POST">
	<h2>Join The Get Listing</h2>
	<input type="text" placeholder="Name" name="name" required>
	<input type="email" placeholder="Email" name="email" required>
	<input type="text" placeholder="Phone Number" name="contact" required>
	<input type="password" placeholder="Password" name="password" required>
	<input type="password" placeholder="Confirm Password" name="confirm_password" required>
	<input type="submit" value="Join" name="submit">
	<a href="login.php">Already Join</a>
</form>

<?php include('footer.php'); ?>