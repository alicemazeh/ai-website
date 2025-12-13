<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo" style="display: flex; flex-direction: column; align-items: center; text-decoration: none;">
         <img src="images/logo.png" alt="Savor Haven Logo" class="logo-img" style="width: 50px; height: 50px; margin-right: 10px;">
         <span class="logo-title" style="font-size: 1.5rem; font-weight: bold; color: #2c3e50;">Savor Haven Restaurant</span>
      </a>

      <nav class="navbar" style="flex-grow: 1; text-align: center;">
         <a href="#" onclick="startAIWaiter(); return false;" class="ai-link">AI</a>
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="menu.php">Menu</a> 
         <a href="orders.php">Orders</a>
         <a href="contact.php">Contact US</a>
      </nav>

      <div class="icons" style="display: flex; align-items: center; gap: 15px;">
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="search.php"><i class="fas fa-search"></i></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_cart_items; ?>)</span></a>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="menu-btn" class="fas fa-bars"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p class="name"><?= $fetch_profile['name']; ?></p>
         <div class="flex">
            <a href="profile.php" class="btn">profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         </div>
         <p class="account">
            <a href="login.php">login</a> or
            <a href="register.php">register</a>
         </p> 
         <?php
            }else{
         ?>
            <p class="name">please login first!</p>
            <a href="login.php" class="btn">login</a>
         <?php
          }
         ?>
      </div>

   </section>

</header>

<style>
   /* Special Style for AI Link */
.ai-link {
   font-size: 1.5rem; /* Larger font size */
   font-weight: bold;
   color: #ffffff; /* White text color */
   background: linear-gradient(45deg, #ff6b6b, #f8e71c, #4caf50); /* Gradient background */
   padding: 10px 20px; /* Padding for better spacing */
   border-radius: 25px; /* Rounded corners */
   text-decoration: none; /* Remove underline */
   box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
   transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover effect */
}

.ai-link:hover {
   transform: scale(1.1); /* Slightly enlarge on hover */
   box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3); /* Enhance shadow on hover */
   background: linear-gradient(45deg, #4caf50, #f8e71c, #ff6b6b); /* Reverse gradient on hover */
}
</style>
