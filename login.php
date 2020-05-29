<?php

require_once 'db.php';
require_once 'header.php';

?>
<div class="mainDiv">
<h1 class="startpageHeading lastChanceHeading" >Logga in</h1>
<form class="login-form" method="POST" >
<div>
<label for="email">E-post</label>
<input type="email" name="email" id="login_emailInput" required>
<span class="LoginEmailPopup hide loginValPopup">Felaktig E-post</span>
</div>
<div>
<label for="password">Lösenord</label>
<input type="password" id="login_passwordInput" name="password" required>
<span class="loginPasswordPopup hide loginValPopup">felaktigt lösenord</span>
</div>





<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$email = test_input($_POST['email']);
$password = test_input($_POST['password']);


  $sql = "SELECT * FROM members WHERE email = :email";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':email', $email);
   // $stmt->bindParam(':password', $password);

  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    if(isset($_POST["submit"])){
        
			if($stmt->rowCount() == 0){

				echo "<span class='loginPopup'>Fel e-post, försök igen</span>";
				//return false;
            }
             elseif ($stmt->rowCount() == 1) {
                $hashed_password = $row['password'];
                if (password_verify($password, $hashed_password)){

                    $_SESSION["memberID"] = $row['member_id'];
                    

                    echo "<script type='text/javascript'>
                    window.location = 'http://fridajohansson.codes/Webbshopp_VG/index.php';
                    </script>";

                    //header("Location: http://fridajohansson.codes/Webbshopp_VG/index.php");
                }
                else{
                    echo "<span class='loginPopup'>Fel lösenord, försök igen</span>";
                }

    }
	}



}


    echo "<input id='submitBtn' class='login-button' type='submit' name='submit' value='Logga in'>
    <a href= 'forgotlogin.php' class='forgotPass'> Glömt lösenord? </a>

</form>
</div>";
require_once "footer.php";
//echo "<script src='login.js'></script>";
?>


