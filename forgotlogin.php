<?php
require_once "db.php";
require_once "header.php";
?>
<div class="mainDiv">
<h1 class="startpageHeading lastChanceHeading" >Glömt lösenord</h1>
<form class="forgot-form" method="POST" >
<div>
<label for="email">E-post</label>
<input type="email" name="email" id="login_emailInput" required>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$email = htmlspecialchars($_POST['email']);


  $sql = "SELECT * FROM members WHERE email = :email";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':email', $email);

  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    /*if ($stmt->rowCount() == 0) {
        echo "Fel uppgifter";
    }*/
   

    if(isset($_POST["submit"])){
			if($stmt->rowCount() == 0){
				echo "<span class='loginPopup'>Det finns inget konto med denna E-post</span>";
				//return false;
            }
             elseif ($stmt->rowCount() == 1) {

                 $key  = uniqid(rand(1000, 34000000));
                 $email = $row['email'];
                 $subject = "Hemsson, återställning av lösenord";
                 $message = "<html><body><a href='http://fridajohansson.codes/Webbshopp_VG/newPass.php?key=$key&email=$email'>Klicka här för att återställa ditt lösenord</a><br>OBS! Länken kommer gå ut 2 timmar efter att detta mejl har levererats.<br><br>Hälsningar oss på Hemsson</body></html>";
                 $headers = 'From: noreply@fridajohansson.codes' . "\r\n" .
                'Reply-To: noreply@fridajohansson.codes' . "\r\n" .
                'Content-type:text/html;charset=UTF-8' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
                 
                 
            mail($email,$subject,$message, $headers);
                
            $sql2 = "INSERT INTO forgot_password (email, reset_key) 
            VALUES (
                        '$email',
                        '$key' 

                    )";
    
        $stmt2 = $db->prepare($sql2);

        $stmt2->execute();

        echo "Vi har skickat en återställningslänk till din mail. Glöm ej att kolla skräpposten.";
            //header("Location: http://localhost/Webbshopp_VG/index.php");

    }
	}



}


    echo "<input id='submitBtn' class='login-button' type='submit' name='submit' value='Återställ lösenord'>
    <a href= 'login.php' class='forgotPass'> Logga in</a>

</form>
</div>";

?>