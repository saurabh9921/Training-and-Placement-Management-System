<!DOCTYPE html>
<html>
<head>
  <title>Document</title>
  <link rel="stylesheet" href="login.css">
</head>
<body>
    <div id="container" class="container">
		<!-- FORM SECTION -->
		<div class="row">
			<!-- SIGN UP -->
			<?php
		if(isset($_POST['signup']))
		{
			$usernameSub=$password1=$password2="";
			if($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$emailSub = test_input($_POST['Email']);
				$password1 = test_input($_POST['Password']);
				$password2 = test_input($_POST['ConfirmPassword']);

				$link = mysqli_connect("localhost", "root", "");
				if (mysqli_connect_errno()) {
    				printf("Connect failed: %s\n", mysqli_connect_error());
    				exit();
				}
				if(empty($Fullname))
					array_push($error, "Please fill Fullname");
				if(empty($Email))
					array_push($error, "Please fill Email");
				if(empty($PRNno))
					array_push($error, "Please fill PRNno");	
				if(empty($password1))
					array_push($error, "Please fill password");
				if(empty($password2))
					array_push($error, "Please fill confirm password");
				if($password1 != $password2)
					echo "Password's don't match";
				else if($password1 == $password2)
				{
					mysqli_select_db($link,"test_db");
					$results=mysqli_query($link,"insert into usertable(Username,Password) values('$usernameSub','$password1')") or die("failed to connect".mysqli_connect_error());
					header('localhost: http://localhost/project/login.php');
					echo "Data Stored" ;
				}
				mysqli_close($link);
			}
		}
	?>
	<!--php end-->
			<div class="col align-items-center flex-col sign-up">
				<div class="form-wrapper align-items-center">
					<div class="form sign-up">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" placeholder="Fullname" required>
						</div>
						<div class="input-group">
							<i class='bx bx-mail-send'></i>
							<input type="email" placeholder="Email" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" placeholder="PRNno" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" placeholder="Password" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" placeholder="Confirm password" required>
						</div>
						<button type="submit">
							Sign up
						</button>
						<p>
							<span>
								Already have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign in here
							</b>
						</p>
					</div>
				</div>
			
			</div>
			<!-- END SIGN UP -->
			<!-- SIGN IN -->
			<?php
			function test_input($data)
			{
				$data=trim($data);
				$data=stripcslashes($data);
				$data=htmlspecialchars($data);
				return $data;
			}
			if(isset($_POST['login']))
			{
				session_start();
				$username=$password="";
				if($_SERVER["REQUEST_METHOD"] == "POST")
				{
					$Email = test_input($_POST['Email']);
					$PRNno = test_input($_POST['PRNno']);
					$password = test_input($_POST['Password']);
					//echo $username,"<br>";
					//echo $password,"<br>";
					//echo $PRNno;

					$link = mysqli_connect("localhost", "root", "");
					if (mysqli_connect_errno()) {
    					printf("Connect failed: %s\n", mysqli_connect_error());
    					exit();
					}
					mysqli_select_db($link,"test_db");
					$results=mysqli_query($link,"select * from usertable where Username='$username' and Password='$password'") or die("failed to connect".mysqli_connect_error());
					$row=mysqli_fetch_array($results);
					if ($row['Email'] == $Email && $row['PRNno'] == $PRNno && $row['Password'] == $password) {
						header("location: http://localhost/project/home.php");
						$_SESSION['Email'] = $Email;
						$_SESSION['mes'] = "true";
					} 
					else {
					echo "Login failed";
					}
					mysqli_close($link);
				}
			} 
		?>	
		<!--php end-->
			<div class="col align-items-center flex-col sign-in">
				<div class="form-wrapper align-items-center">
					<div class="form sign-in">
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" placeholder="Email" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-user'></i>
							<input type="text" placeholder="PRNno" required>
						</div>
						<div class="input-group">
							<i class='bx bxs-lock-alt'></i>
							<input type="password" placeholder="Password" required>
						</div>
						<button type="submit">
							Sign in
						</button>
						<p>
							<b>
								Forgot password?
							</b>
						</p>
						<p>
							<span>
								Don't have an account?
							</span>
							<b onclick="toggle()" class="pointer">
								Sign up here
							</b>
						</p>
					</div>
				</div>
				<div class="form-wrapper">
		
				</div>
			</div>
			<!-- END SIGN IN -->
		</div>
		<!-- END FORM SECTION -->
		<!-- CONTENT SECTION -->
		<div class="row content-row">
			<!-- SIGN IN CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="text sign-in">
					<h2>
						Welcome
					</h2>
	
				</div>
				<div class="img sign-in">
		
				</div>
			</div>
			<!-- END SIGN IN CONTENT -->
			<!-- SIGN UP CONTENT -->
			<div class="col align-items-center flex-col">
				<div class="img sign-up">
				
				</div>
				<div class="text sign-up">
					<h2>
						Join with us 
					</h2>
	
				</div>
			</div>
			<!-- END SIGN UP CONTENT -->
		</div>
		<!-- END CONTENT SECTION -->
	</div>
</body>
    <script>
        let container = document.getElementById('container')
         toggle = () => {
            container.classList.toggle('sign-in')
            container.classList.toggle('sign-up')
         }
    
        setTimeout(() => {
          container.classList.add('sign-in')
         }, 200)
    </script>
</html>