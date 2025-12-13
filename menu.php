<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/add_cart.php';

// Define categories
$categories = [
    'appetizers' => 'Appetizers',
    'main dish' => 'Main Dishes',
    'drinks' => 'Drinks',
    'desserts' => 'Desserts'
];

// Get the selected category from the URL
$selected_category = isset($_GET['category']) ? $_GET['category'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Menu</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<div class="heading">
   <h3>Our Menu</h3>
   <p><a href="home.php">home</a> <span> / menu</span></p>
</div>

<?php if (!$selected_category): ?>
    <!-- Show categories first -->
    <section class="category">
        <h1 class="title">Choose a Category</h1>
        <div class="box-container">
            <?php foreach ($categories as $key => $label): ?>
                <a href="menu.php?category=<?= urlencode($key) ?>" class="box" style="text-align:center;">
                    <img src="images/cat-<?= array_search($key, array_keys($categories)) + 1 ?>.png" alt="<?= $label ?>" style="width:100px; height:100px;">
                    <h3><?= $label ?></h3>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
<?php else: ?>
    <!-- Show products for the selected category -->
    <section class="products">
        <h1 class="title"><?= htmlspecialchars($categories[$selected_category] ?? ucfirst($selected_category)) ?></h1>
        <div class="box-container">
            <?php
            try {
                $select_products = $conn->prepare("SELECT * FROM `products` WHERE category = ?");
                $select_products->execute([$selected_category]);
                if ($select_products->rowCount() > 0) {
                    while ($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <form action="" method="post" class="box">
                <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
                <input type="hidden" name="qty" value="1">
                <!-- <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a> -->
                <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
                <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="<?= $fetch_products['name']; ?>">
                <div class="name"><?= $fetch_products['name']; ?></div>
                <div class="ingredients"><?= $fetch_products['ingredients']; ?></div>
                <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
            </form>
            <?php
                    }
                } else {
                    echo '<p class="empty">No products found in this category.</p>';
                }
            } catch (PDOException $e) {
                echo '<p class="empty">Error loading products: ' . $e->getMessage() . '</p>';
            }
            ?>
        </div>
        <div style="text-align:center; margin-top:2rem;">
            <a href="menu.php" class="btn">Back to Categories</a>
        </div>
    </section>
<?php endif; ?>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>