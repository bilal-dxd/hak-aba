<?php

   $db_name = 'mysql:host=localhost;dbname=shop_db';
   $db_user_name = 'root';
   $db_user_pass = '';
   // Création de la connexion à la base de données en utilisant la classe PDO
   $conn = new PDO($db_name, $db_user_name, $db_user_pass);

   function create_unique_id(){
      // Définir la chaîne de caractères possible pour l'identifiant unique
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      // Calculer la longueur de la chaîne de caractères
      $charactersLength = strlen($characters);
      // utilisée pour stocker l'identifiant unique généré
      $randomString = '';
      for ($i = 0; $i < 20; $i++) {
         // génère un indice aléatoire pour choisir un caractère.
          $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }

?>