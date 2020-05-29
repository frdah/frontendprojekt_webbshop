<?php

require_once "header.php";
require_once 'db.php';

$x = 0;

$startpageHeading = '<h1 class="startpageHeading">Nyinkommet</h1>';
$productContainer = '<div class="productContainer">';

$sql = "SELECT * FROM products WHERE stock != 0 AND deleted = 0 ORDER BY create_date desc LIMIT 6";
$stmt2 = $db->prepare($sql);
$stmt2->execute();

while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){

  $sql = "SELECT image FROM product_images WHERE product_id = :product_id";
  $stmt3 = $db->prepare($sql);
  $stmt3->bindParam(":product_id", $row2["id"]);
  $stmt3->execute();

  $name   = $row2['name'];        
  $price  = $row2['price'];
  $id     = $row2['id'];
  $time     = $row2['create_date'];
  $image = $stmt3->rowCount() !== 0 ? $stmt3->fetch(PDO::FETCH_ASSOC)['image'] : "";
  $img    = "images/$image";

  if(empty($image)){
    $img = "images/no-image.png";
  }


  $productContainer .= "<ul class='product-ul'> <a href='product.php?id=$id' class='product-link'>
      <li class='product-li'><img src='$img'></li>
      <li class='product-li product-li-name'><h3>$name</h3></li>
      <li class='product-li product-li-price'>$price kr</li>
      </a>
      <button class='addToCartBtn' data-id='$id' data-image='$img' data-name='$name' data-price='$price' data-stock='$row2[stock]' data-discount='0' class='addToCartBtn'>Lägg till i varukorg</button>
      </ul>";
    
    $x++;

    if ($x >= 6) {
      break;
    }
}

$productContainer .= '</div>';

echo $startpageHeading;
echo $productContainer;
require_once "footer.php";
?>

<script src="productList.js"></script>