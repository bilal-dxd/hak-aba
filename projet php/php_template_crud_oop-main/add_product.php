<?php

include 'components/connect.php';

// Vérifie si le cookie 'user_id' est déjà défini
if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
 // Si le cookie 'user_id' n'est pas défini, crée un nouvel identifiant unique et le stocke dans le cookie

   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_POST['add'])){
// use function filter_var to filter data in input
   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $ext = pathinfo($image, PATHINFO_EXTENSION);
   $rename = create_unique_id().'.'.$ext;
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $image_folder = 'uploaded_files/'.$rename;
   $type =  $_POST['type'];

   include_once '../product.php';
   $product = new Product();
   $product->Add($id, $name, $price, $rename, $image_tmp_name, $image_folder, $image_size,$type);


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add Product</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/header.php'; ?>

<section class="product-form">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>product info</h3>
      <p>product name <span>*</span></p>
      <input type="text" name="name" placeholder="enter product name" required maxlength="50" class="box">
      <p>product price <span>*</span></p>
      <input type="number" name="price" placeholder="enter product price" required min="0" max="9999999999" maxlength="10" class="box">
     <select name="type" >
      <option value='T-Shirt' >T-Shirt</option>
      <option value='Gants'>Gants</option>

     </select>
     
      <p>product image <span>*</span></p>
      <input type="file" name="image" required accept="image/*" class="box">
      <input type="submit" class="btn" name="add" value="add product">
   </form>
</section>






   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>