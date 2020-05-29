<?php
require_once "db.php";
require_once "header.php";

if (isset($_SESSION["memberID"])) {
echo "<h3 class= 'startpageHeading'>Dina beställningar</h3>";
echo "<div class='mainDiv'>";


$sql = "SELECT * FROM members WHERE member_id = :member_id";

$stmt = $db->prepare($sql);
$stmt->bindParam(':member_id', $_SESSION['memberID']);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$email = $row['email'];


$sql2 = "SELECT * FROM customers WHERE email = :email";

$stmt2 = $db->prepare($sql2);
$stmt2->bindParam(':email', $email);
$stmt2->execute();

$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

$customer_id = $row2['customer_id'];



$sql3 = "SELECT * FROM active_orders WHERE customers_id = :customer_id";

$stmt3 = $db->prepare($sql3);
$stmt3->bindParam(':customer_id', $customer_id);
$stmt3->execute();
while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {

$active_orders_id = $row3['active_orders_id'];

$sql4 = "SELECT * FROM active_orders_products WHERE active_orders_id = :active_orders_id";

$stmt4 = $db->prepare($sql4);
$stmt4->bindParam(':active_orders_id', $active_orders_id);
$stmt4->execute();
echo "<div class='memberOrder'><span class='orderNum'>Ordernummer: $active_orders_id</span><span class='memberOrderStatus'>(Pågående)</span>
";

while ($row4 = $stmt4->fetch(PDO::FETCH_ASSOC)) {
    $quantity = $row4['quantity'];
    $products_id = $row4['products_id'];
    $sql5 = "SELECT * FROM products WHERE id = :products_id";

    $stmt5 = $db->prepare($sql5);
    $stmt5->bindParam(':products_id', $products_id);


    $stmt5->execute();

    $row5 = $stmt5->fetch(PDO::FETCH_ASSOC);
    $product_id = $row5['id'];
    $productName = $row5['name'];

                $sql6 = "SELECT image FROM product_images WHERE product_id = :product_id";
            $stmt6 = $db->prepare($sql6);
            $stmt6->bindParam(":product_id", $product_id);
            //$product_id = htmlspecialchars($row2["id"]);
            $stmt6->execute();

            $image = $stmt6->rowCount() ? $stmt6->fetch(PDO::FETCH_ASSOC)["image"] : "";
            $imgUrl = "./images/$image";

            if(empty($image)){
                $imgUrl = "images/no-image.png";
              }

    echo "<div class='memberPageProduct'>
    <img class='memberPageProductImg' src='$imgUrl'>
    <span>$productName <br> $quantity st</span></div>";
    

}
$sum = $row3['sum'];
echo "<span class='memberPageSum'>Summa: $sum kr </div>";

}

/*****************************slutförda beställningar******************/
 
$sql7 = "SELECT * FROM completed_orders WHERE customers_id = :customer_id";

$stmt7 = $db->prepare($sql7);
$stmt7->bindParam(':customer_id', $customer_id);
$stmt7->execute();
while ($row7 = $stmt7->fetch(PDO::FETCH_ASSOC)) {

    $completed_orders_id = $row7['completed_orders_id'];

    $sql8 = "SELECT * FROM completed_orders_products WHERE completed_orders_id = :completed_orders_id";

    $stmt8 = $db->prepare($sql8);
    $stmt8->bindParam(':completed_orders_id', $completed_orders_id);
    $stmt8->execute();
    echo "<div class='memberOrder memberOrderCompleted'><span class='orderNum'>Ordernummer: $completed_orders_id</span><span class='memberOrderStatus'>(Slutförd)</span>
    ";

    while ($row8 = $stmt8->fetch(PDO::FETCH_ASSOC)) {
        $quantity = $row8['quantity'];
        $products_id = $row8['products_id'];
        
        $sql9 = "SELECT * FROM products WHERE id = :products_id";

        $stmt9 = $db->prepare($sql9);
        $stmt9->bindParam(':products_id', $products_id);


        $stmt9->execute();

        $row9 = $stmt9->fetch(PDO::FETCH_ASSOC);
        $product_id = $row9['id'];
        $productName = $row9['name'];

                    $sql10 = "SELECT image FROM product_images WHERE product_id = :product_id";
                $stmt10 = $db->prepare($sql10);
                $stmt10->bindParam(":product_id", $product_id);
                //$product_id = htmlspecialchars($row2["id"]);
                $stmt10->execute(); 

                $image = $stmt10->rowCount() ? $stmt10->fetch(PDO::FETCH_ASSOC)["image"] : "";
                $imgUrl = "./images/$image";

                if(empty($image)){
                    $imgUrl = "images/no-image.png";
                }

        echo "<div class='memberPageProduct'>
        <img class='memberPageProductImg' src='$imgUrl'>
        <span>$productName <br> $quantity st</span></div>";

    }


    $sum = $row7['sum'];
    echo "<span class='memberPageSum'>Summa: $sum kr </div>";

}






//***************while?*************** */







}
else {
    echo "<h3 class= 'startpageHeading'>Logga in för att visa denna sida</h3>";

}
?>

</div>

<?php
require_once "footer.php";

?>
