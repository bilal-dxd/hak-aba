<?php
include_once 'database.php';


class Product {
    function view(){
        if(isset($_COOKIE['user_id'])){
            $user_id = $_COOKIE['user_id'];
        }else{
            setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
        }

        if(isset($_POST['add_to_cart'])){

        $id = create_unique_id();
        $product_id = $_POST['product_id'];
        $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);
        $qty = $_POST['qty'];
        $qty = filter_var($qty, FILTER_SANITIZE_STRING);
        
        $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");   
        $verify_cart->execute([$user_id, $product_id]);

        $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $max_cart_items->execute([$user_id]);

        if($verify_cart->rowCount() > 0){
            $warning_msg[] = 'Already added to cart!';
        }elseif($max_cart_items->rowCount() == 10){
            $warning_msg[] = 'Cart is full!';
        }else{

            $select_price = $conn->prepare("SELECT * FROM `products` WHERE id = ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id, product_id, price, qty) VALUES(?,?,?,?,?)");
            $insert_cart->execute([$id, $user_id, $product_id, $fetch_price['price'], $qty]);
            $success_msg[] = 'Added to cart!';
        }

        }
    }

    function Add($id, $name, $price, $rename, $image_tmp_name, $image_folder, $image_size,$type){
        if($image_size > 2000000){
            $warning_msg[] = 'Image size is too large!';
        }else{
            $database = new Database();
            $conn = $database->getConnection();
            $add_product = $conn->prepare("INSERT INTO `products`(id, name, price, image,type) VALUES(?,?,?,?,?)");
            $add_product->execute([$id, $name, $price, $rename,$type]);
            move_uploaded_file($image_tmp_name, $image_folder);
            $success_msg[] = 'Product added!';
        }
    }

    function selectProductByType($type) {
        $database = new Database();
        $conn = $database->getConnection();

        $select_products = $conn->prepare("SELECT * FROM `products` WHERE type = ?");
        $select_products->execute([$type]);
        $result = $select_products->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}