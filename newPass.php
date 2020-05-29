<?php
require_once "db.php";
require_once "header.php";

$passwordErr ="";
$password2Err ="";


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function ContainsLettersNumbers($String){

    return preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $String) > 0;
}

function validatePass(){
    if(empty($_POST["password"]) || !preg_match("/^[a-öA-Ö0-9\s]*$/",$_POST["password"]) || ContainsLettersNumbers($_POST['password']) == false || strlen($_POST['password']) < 6){
        $GLOBALS['password2Err'] = "Lösenord måste vara minst 6 karaktärer långt och bestå av siffror och bokstäver.";
        return false;
    }

    if(empty($_POST["password2"]) || $_POST['password'] !== $_POST['password2']){
        $GLOBALS['password2Err'] = "Felaktigt lösenord.";
        return false;

    }
    return true;

}

function validateTime ($createTime) {
    date_default_timezone_set ( 'Europe/Stockholm');

    $expire = date("Y-m-d H:i:s", strtotime('-2 hours'));
    $createDate = $createTime;
    if ($expire > $createDate){
                echo "in if $expire    $createDate";
        return false;

        
    }

    else {

        return true;
    }

}

        $mainDiv = "<div class='mainDiv'>
        <h1 class='startpageHeading lastChanceHeading' >Återställ lösenord</h1>";
                


if (isset($_GET["key"]) && isset($_GET["email"])) {
    $email = $_GET["email"];
    $key = $_GET["key"];
    $sql = "SELECT * FROM forgot_password WHERE email = :email AND reset_key = :reset_key";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':reset_key', $key);

    
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($stmt->rowCount() == 1){

        if (validateTime($row['date'])) {
        
        
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
        
                if (validatePass()){
    
                    $password = test_input($_POST['password']);
                    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    
    
                    $sql2 = "UPDATE members SET password = :password WHERE email = :email";
                    $stmt2 = $db->prepare($sql2);
                    $stmt2->bindParam(":password", $hashed_password);
                    $stmt2->bindParam(":email", $email);
                    $stmt2->execute();
    
    
    
                    $mainDiv .= "<span class='sameMail valPopup'>Ditt lösenord har nu uppdaterats</span>";
                    
                    $sql3 = "DELETE FROM forgot_password WHERE email = :email";
                    $stmt3 = $db->prepare($sql3);
                    $stmt3->bindParam(":email", $email);
                    $stmt3->execute();
    
       
        
                }
            }
        
        
            $mainDiv .= "
                <form class='forgot-form' method='POST' action='" . $_SERVER['PHP_SELF'] . "?key=$key&email=$email' onsubmit='return validate()' >
                <div>
                <label for='password'>Ange ditt nya lösenord</label>
                <input type='password' name='password' id='password' required>
                <span class='passwordPopup hide valPopup'>Lösenord måste innehålla siffror och bokstäver samt vara minst 6 tecken långt</span>
                <span class='sameMail valPopup'>$passwordErr</span>

                <label for='password'>Bekräfta nytt lösenord</label>
                <input type='password' name='password2' id='password2' required>
                <span class='password2Popup hide valPopup'>felaktigt lösenord</span>
                <span class='sameMail valPopup'> $password2Err</span>


            </div>";
            
            echo $mainDiv;

        
        
            echo "<input id='submitBtn' class='login-button' type='submit' name='submit' value='Återställ lösenord'>
                    <a href= 'login.php' class='forgotPass'> Logga in</a>

            </form>
            </div>";


        

        }
        else {
            
            $sql4 = "DELETE FROM forgot_password WHERE email = :email2 AND reset_key = :reset_key2";
            $stmt4 = $db->prepare($sql4);
            $stmt4->bindParam(':email2', $email);
            $stmt4->bindParam(':reset_key2', $key);
            $stmt4->execute();

            
            echo "<div class='mainDiv'>
            <h2 class='startpageHeading lastChanceHeading' >Din länk verkar ha gått ut.</h2><a href= 'forgotlogin.php' class='forgotPass'> Glömt lösenord?</a><br><br>
            </div>";
        }
    
    }
    else {
            echo "<div class='mainDiv'>
            <h2 class='startpageHeading lastChanceHeading' >Din länk är inte giltig</h2><a href= 'forgotlogin.php' class='forgotPass'> Glömt lösenord?</a><br><br>
            </div>";
    }


}

?>

<?php

require_once "footer.php";

?>
<script src="newPass.js"></script>