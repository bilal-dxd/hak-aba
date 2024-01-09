<!doctype html>
<html lang="en">
<head>
    <?php include 'components/connect.php'; ?>
    <?php include 'components/header.php'; ?>
    <?php include '../product.php'; ?>

<link rel="stylesheet" href="css/style.css">

<title>Liste des catégories</title>
</head>
<body>
<div class="container py-2">
    <h2>Liste des catégories</h2>
    <a href="ajouter_categorie.php" class="btn btn-primary">Ajouter catégorie</a>
    <table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>#ID</th>
            <th>Libelle</th>
            <th>Description</th>
            <th>Icone</th>
            <th>Date</th>
            <th>Opérations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $product = new Product();
        $type = 'T-Shirt';
        $products = $product->selectProductByType($type);

        foreach ($products as $product) {
            echo '<tr>
                    <td>' . $product['id'] . '</td>
                    <td>' . $product['name'] . '</td>
                    <td>' . $product['price'] . '</td>
                </tr>';
        }
        ?>
        <p>hello</p>
    </tbody>
</table>
</div>

</body>
</html>