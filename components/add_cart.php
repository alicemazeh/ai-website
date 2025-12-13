<?php

if (isset($_POST['add_to_cart'])) {

    if ($user_id == '') {
        header('location:login.php');
    } else {

        $pid = isset($_POST['pid']) ? htmlspecialchars($_POST['pid'], ENT_QUOTES, 'UTF-8') : '';
        $name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : '';
        $price = isset($_POST['price']) ? htmlspecialchars($_POST['price'], ENT_QUOTES, 'UTF-8') : '';
        $category = isset($_POST['category']) ? htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8') : ''; // Check if 'category' exists
        $image = isset($_POST['image']) ? htmlspecialchars($_POST['image'], ENT_QUOTES, 'UTF-8') : '';
        $ingredients = isset($_POST['ingredients']) ? htmlspecialchars($_POST['ingredients'], ENT_QUOTES, 'UTF-8') : ''; // Check if 'ingredients' exists
        $qty = isset($_POST['qty']) ? htmlspecialchars($_POST['qty'], ENT_QUOTES, 'UTF-8') : '';

        $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
        $check_cart_numbers->execute([$name, $user_id]);

        if ($check_cart_numbers->rowCount() > 0) {
            $message[] = 'already added to cart!';
        } else {
            $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
            $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
            $message[] = 'added to cart!';
        }
    }
}

?>