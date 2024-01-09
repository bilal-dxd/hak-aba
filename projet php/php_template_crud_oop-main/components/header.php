<?php
session_start();

include_once("connect.php");



// Check if the Log Out button is clicked _ supprimer session 
if (isset($_POST['logout'])) {
   // effacer the session and redirect to the login page
   session_destroy();
   header("Location: login.php");
   exit();
}


?>



<header class="header">

   <section class="flex">
      <div >
      <?php echo "<img src='img/logo.jpg' style='width: 80px;'>";?>
      </div>
      <nav class="navbar">
         <?php
            if( $_SESSION["role"] ==   "admin" ){
               echo "<a href='add_product.php'>add product</a>";
            }


         ?>
         <a href="category.php">Category</a>
         <a href="view_products.php">view products</a>
         <a href="orders.php">my orders</a>
         <?php
         // Compte le nombre d'articles dans le panier pour l'utilisateur actuel
         // Préparation de la requête SQL
         // Exécution de la requête avec des paramètres
         // Comptage du nombre de lignes résultantes 'row count'
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="shopping_cart.php" class="cart-btn">cart<span><?= $total_cart_items; ?></span></a>
         <a  href="../login.php" name='logout'>Log Out</a>
      </nav>

      <div id="menu-btn" class="fas fa-bars"></div>
   </section>

</header>