<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="./styles/style.css"/>
    <title>Webshop</title>
  </head>
  <body>
    <nav class="navigation">
      <a href="index.php"><img src="./styles/images/logga.png" alt="" class="logo_header_start"/></a>
      <div class="navigation-links">
        <form class="search-form" action="search.php" method="GET">
          <input class="search-input" type="text" name="q"/>
          <button class="search-submit-btn" type="submit">Sök</button>
        </form>
        <div class="header_categories">
          <a class="navigation-link" href="lastChance.php">Sista chansen</a>
          <a class="navigation-link" href="contact.php">Kontakt</a>
                  <a class="navigation-link" href="cart.php"><svg id="header-cart" class="cart-img" height="25px" viewBox="0 -31 512.00026 512" width="25px" xmlns="http://www.w3.org/2000/svg"><path d="m164.960938 300.003906h.023437c.019531 0 .039063-.003906.058594-.003906h271.957031c6.695312 0 12.582031-4.441406 14.421875-10.878906l60-210c1.292969-4.527344.386719-9.394532-2.445313-13.152344-2.835937-3.757812-7.269531-5.96875-11.976562-5.96875h-366.632812l-10.722657-48.253906c-1.527343-6.863282-7.613281-11.746094-14.644531-11.746094h-90c-8.285156 0-15 6.714844-15 15s6.714844 15 15 15h77.96875c1.898438 8.550781 51.3125 230.917969 54.15625 243.710938-15.941406 6.929687-27.125 22.824218-27.125 41.289062 0 24.8125 20.1875 45 45 45h272c8.285156 0 15-6.714844 15-15s-6.714844-15-15-15h-272c-8.269531 0-15-6.730469-15-15 0-8.257812 6.707031-14.976562 14.960938-14.996094zm312.152343-210.003906-51.429687 180h-248.652344l-40-180zm0 0"/><path d="m150 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"/><path d="m362 405c0 24.8125 20.1875 45 45 45s45-20.1875 45-45-20.1875-45-45-45-45 20.1875-45 45zm45-15c8.269531 0 15 6.730469 15 15s-6.730469 15-15 15-15-6.730469-15-15 6.730469-15 15-15zm0 0"/></svg></a>
        </div>
        <?php

        if (isset($_SESSION["memberID"])){
          echo "<a href='memberPage.php' class='logOutBtn'>Min sida</a>";
          echo "<a href='logout.php' class='logOutBtn'>Logga ut</a>";
        }
        else {
          echo "<a href='login.php' class='logOutBtn'>Logga in</a>";
          echo "<a href='createAcc.php' class='logOutBtn'>Skapa konto</a>";

        }

        ?>
      </div>
    </nav>

    <header></header>

<?php
require_once "db.php";


  $category_list = "<div class='header-category-links'>";
  $sql = "SELECT * FROM category";
  $stmt = $db->prepare($sql);
  $stmt->execute();
  
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $sql1 = "SELECT * FROM products WHERE deleted = 0 AND stock != 0 AND category_id = :category_id";
    $stmt1 = $db->prepare($sql1);
    $stmt1->bindParam(":category_id", $category_id);
    $category_id = $row["category_id"];
    $stmt1->execute();

    if ($stmt1->rowCount() !== 0) {

      $ucCategory = ucfirst($row["category"]);
      $category_list .= "<a class='header-category-link' href='category.php?category=$category_id'>$ucCategory</a>";

    }
  }
  $category_list .= "</div>";
  echo $category_list;
  ?>