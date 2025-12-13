<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:admin_login.php');
};

if (isset($_POST['update'])) {

   $pid = $_POST['pid'];
   $pid = htmlspecialchars($pid, ENT_QUOTES, 'UTF-8');
   $name = $_POST['name'];
   $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
   $price = $_POST['price'];
   $price = htmlspecialchars($price, ENT_QUOTES, 'UTF-8');
   $category = $_POST['category'];
   $category = htmlspecialchars($category, ENT_QUOTES, 'UTF-8');
   $ingredients = $_POST['ingredients'];
   $ingredients = htmlspecialchars($ingredients, ENT_QUOTES, 'UTF-8');

   $update_product = $conn->prepare("UPDATE `products` SET name = ?, category = ?, price = ?, ingredients = ? WHERE id = ?");
   $update_product->execute([$name, $category, $price, $ingredients, $pid]);

   $message[] = 'Product updated!';

   $old_image = $_POST['old_image'];
   $image = $_FILES['image']['name'];
   $image = htmlspecialchars($image, ENT_QUOTES, 'UTF-8');
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/' . $image;

   if (!empty($image)) {
      if ($image_size > 2000000) {
         $message[] = 'Image size is too large!';
      } else {
         // Attempt to move the new image to the folder
         if (move_uploaded_file($image_tmp_name, $image_folder)) {
            // If the new image is successfully uploaded, delete the old image
            if (file_exists('../uploaded_img/' . $old_image)) {
               unlink('../uploaded_img/' . $old_image);
            }
            // Update the database with the new image name
            $update_image = $conn->prepare("UPDATE `products` SET image = ? WHERE id = ?");
            $update_image->execute([$image, $pid]);
            $message[] = 'Image updated!';
         } else {
            $message[] = 'Failed to upload the new image. Old image retained.';
         }
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php' ?>

<!-- update product section starts  -->

<section class="update-product">

   <h1 class="heading">Update Product</h1>

   <?php
   $update_id = $_GET['update'];
   $show_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $show_products->execute([$update_id]);
   if ($show_products->rowCount() > 0) {
      while ($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)) {
   ?>
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="old_image" value="<?= $fetch_products['image']; ?>">
      <img src="../uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <span>Update Name</span>
      <input type="text" required placeholder="Enter product name" name="name" maxlength="100" class="box" value="<?= $fetch_products['name']; ?>">
      <span>Update Price</span>
      <input type="number" min="0" max="9999999999" step="0.01" required placeholder="Enter product price" name="price" class="box" value="<?= $fetch_products['price']; ?>">
      <span>Update Category</span>
      <select name="category" class="box" required>
         <option selected value="<?= $fetch_products['category']; ?>"><?= $fetch_products['category']; ?></option>
         <option value="main dish">Main Dish</option>
         <option value="Appetizers">Appetizers</option>
         <option value="drinks">Drinks</option>
         <option value="desserts">Desserts</option>
      </select>
      <span>Update Ingredients</span>
      <textarea name="ingredients" class="box" required placeholder="Enter product ingredients" maxlength="500" rows="4"><?= $fetch_products['ingredients']; ?></textarea>
      <span>Update Image</span>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
      <div class="flex-btn">
         <input type="submit" value="Update" class="btn" name="update">
         <a href="products.php" class="option-btn">Go Back</a>
      </div>
   </form>
   <?php
      }
   } else {
      echo '<p class="empty">No products added yet!</p>';
   }
   ?>

</section>

<!-- update product section ends -->

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>