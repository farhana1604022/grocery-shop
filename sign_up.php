
<html>
 <body>    
                        
                            <form action="#" method="POST">
							<div class="styled-input agile-styled-input-top">
								<input type="text" placeholder="Name" name="Name" required="">
							</div>
							<div class="styled-input">
								<input type="email" placeholder="E-mail" name="Email" required="">
							</div>
							<div class="styled-input">
								<input type="password" placeholder="Password" name="password" id="password1" required="">
							</div>
							<div class="styled-input">
								<input type="password" placeholder="Confirm Password" name="ConfirmPassword" id="password2" required="">
							</div>
							<input type="submit" value="Sign Up">
						</form>




</body>
</html>

<?php

$database_name="ripa1";
$con=mysqli_connect("localhost","root","",$database_name);

if(isset($_POST['Sign Up'])){
$Name=$_POST['Name'];
$password=$_POST['password'];


if($Name==''){

    echo"<script>alert('Enter your user name')</script>";
}

if($password==''){

    echo"<script>alert('Enter your password')</script>";
}



else {
    $query="insert into login(uname,pass) values('$Name,'$Password')";

 if(mysql_query($query)){

    echo"<script>alert('Inserted Successfully')</script>"
 }
}

}
?>