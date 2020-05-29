<?php
require_once "db.php";

$sameMail = "";
$nameErr = "";
$name = "";
$phoneErr = "";
$streetErr = "";
$cityErr = "";
$zipcodeErr = "";
$passwordErr = "";
$password2Err = "";

        $name = "";
        $phone = "";
        $street = "";
        $zipcode = "";
        $city = "";
        $email = "";
        $password = "";
        $password2 = "";



function ContainsLettersNumbers($String){

    return preg_match('/[A-Öa-ö].*[0-9]|[0-9].*[A-Öa-ö]/', $String) > 0;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

    function validatePHP () {
        if (empty($_POST["name"]) || !preg_match("/^[a-öA-Ö\s]*$/",$_POST["name"]) || strpos($_POST['name'], ' ') === false || strlen($_POST['name']) < 3 || strlen($_POST['name']) > 50) {
            $GLOBALS['nameErr'] = "Namn måste bestå av bokstäver och mellanrum";
            

            return false;
        }

        if(empty($_POST["email"]) || !preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$_POST["email"]) || strlen($_POST['email']) > 50){
            $GLOBALS['sameMail'] = "Ange giltig e-post adress";
            return false;

        }


        if (empty($_POST["phone"]) || !preg_match("/^[0-9 ()+-]+$/",$_POST["phone"]) || strlen($_POST['phone']) > 20 || strlen($_POST['phone']) < 5) {
            $GLOBALS['phoneErr'] = "Telefonnummer får endast bestå av siffror, mellan rum och -+.";
                return false;

        }
        if(empty($_POST["street"]) || !preg_match("/^[a-öA-Ö0-9\s]*$/",$_POST["street"]) || strlen($_POST['street']) > 50 || strlen($_POST['street']) < 2){
            $GLOBALS['streetErr'] = "Adressen får endast innehålla bokstäver mellanslag och siffror";
                return false;

        }
        if(empty($_POST["city"]) || !preg_match("/^[a-öA-Ö\s]*$/",$_POST["city"]) || strlen($_POST['city']) > 50 ||  strlen($_POST['city']) < 2){
            $GLOBALS['cityErr'] = "Orten får endast innehålla bokstäver och mellanslag";
            return false;

        }
        if(empty($_POST["zipcode"]) || !preg_match("/^[0-9]*$/",$_POST["zipcode"]) || strlen($_POST['zipcode']) != 5){ 
            $GLOBALS['zipcodeErr'] = "Postnummer får endast bestå av siffror, ex. 13534";
            return false;

        }

        if(empty($_POST["password"]) || !preg_match("/^[a-öA-Ö0-9]*$/",$_POST["password"]) || ContainsLettersNumbers($_POST['password']) == false || strlen($_POST['password']) < 6 || strlen($_POST['password']) > 60){
            $GLOBALS['passwordErr'] = "Lösenord måste vara minst 6 karaktärer långt och bestå av siffror och bokstäver.";
            return false;
        }

        if(empty($_POST["password2"]) || $_POST['password'] !== $_POST['password2']){
            $GLOBALS['password2Err'] = "Felaktigt lösenord.";
            return false;

        }
                return true;

    }

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    //validatePHP();
    if (validatePHP()) {
        $name = test_input($_POST['name']);
        $phone = test_input($_POST['phone']);
        $street = test_input($_POST['street']);
        $zipcode = test_input($_POST['zipcode']);
        $city = test_input($_POST['city']);
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        $password2 = test_input($_POST['password2']);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $sql1 = "SELECT * FROM members WHERE email = :email";
        $stmt1 = $db->prepare($sql1);
        $stmt1->bindParam(':email', $email);
        $stmt1->execute();
        if ($stmt1->rowCount() === 0) {
                $sql2 = "INSERT INTO `members` (`name`, `email`, `phone`, `street`, `zipcode`, `city`, `password`) 
            VALUES (
                        '$name',
                        '$email', 
                        '$phone', 
                        '$street', 
                        '$zipcode', 
                        '$city',
                        '$hashed_password'
                    )";
    
        $stmt2 = $db->prepare($sql2);
        $stmt2->execute();
        header("Location: http://fridajohansson.codes/Webbshopp_VG/login.php");

        }
        else {
            $sameMail = "Denna e-post används redan";
        }


    }



}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skapa konto</title>
    <link rel="stylesheet" href="styles/createAcc.css">
   
 </noscript>
</head>
<body>
<div class="nav">
          <a href="http://fridajohansson.codes/Webbshopp_VG"><img src="./styles/images/logga.png" alt="" class="logo_header_start"/></a>
</div>
<div class="createAcc-background-div">
<form class="createAcc-form orderForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" onsubmit="return validate()">
    <h1 class="startpageHeading" >Skapa konto</h1>

<div>
    
            <label for="name">Namn*</label>
            <input id="name" name="name"  value="<?php echo $name;?>" required>   
            <span class="namePopup hide valPopup">Ditt namn måste innehålla minst två tecken och minst ett mellanslag</span>
            <span class="valPopup"><?php echo $nameErr; ?></span> 
 
        </div>
        <div>
            <label for="email">E-post*</label>
            <input type="email" id="email" name="email" value="<?php echo $email;?>" required>
            <span class="emailPopup hide valPopup">Inte giltig epost adress</span>
            <span class="sameMail valPopup"><?php echo $sameMail; ?></span>

        </div>
        <div>
            <label for="phone">Telefon*</label>
            <input  id="phone" name="phone" value="<?php echo $phone;?>" required>
            <span class="phonePopup hide valPopup">Inte giltigt telefonnummer</span>
            <span class="valPopup"><?php echo $phoneErr; ?></span> 

        </div>
        <div>
            <label for="street">Gatuadress*</label>
            <input id="street" name="street" value="<?php echo $street;?>" required>
             <span class="streetPopup hide valPopup">Ange giltig gatuadress</span>
             <span class="sameMail valPopup"><?php echo $streetErr; ?></span>

            
        </div>
        <div>
            <label for="zipcode">Postnummer*</label>
            <input id="zipcode"  name="zipcode" value="<?php echo $zipcode;?>" required>
            <span class="zipcodePopup hide valPopup">Ange giltigt postnummer, ex 13534</span>
            <span class="sameMail valPopup"><?php echo $zipcodeErr; ?></span>


        </div>
        <div>
            <label for="city">Ort*</label>
            <input id="city" name="city" value="<?php echo $city;?>" required>
            <span class="cityPopup hide valPopup">Ange giltig ort</span>
            <span class="sameMail valPopup"><?php echo $cityErr; ?></span>


            
        </div>
        <div>
            <label for="password">Lösenord*</label>
            <input id="password" name="password" value="<?php echo $password;?>" required>
            <span class="weakPass hide valPopup">För svagt lösenord!</span>
            <span class="strongPass hide">Starkt lösenord!</span>
            <span class="okPass hide">Okej lösenord</span>
            <span class="passwordPopup hide valPopup">Lösenord måste innehålla siffror och bokstäver samt vara minst 6 tecken långt</span>
            <span class="sameMail valPopup"><?php echo $passwordErr; ?></span>


        </div>
                <div>
            <label for="password2">Bekräfta lösenord*</label>
            <input id="password2" name="password2"  required>
            <span class="password2Popup hide valPopup">felaktigt lösenord</span>
            <span class="sameMail valPopup"><?php echo $password2Err; ?></span>

        </div>
                    <input id="submitBtn" class="createAcc-button" type="submit" name="submit" value="Skapa konto">

</form>
</div>

<script src="createAcc.js"></script>
</body>
</html>



