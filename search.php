<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
};

include 'components/add_cart.php';

// Handle AJAX request
if (isset($_POST['search_box']) || isset($_POST['sort_order'])) {
   $search_query = isset($_POST['search_box']) ? htmlspecialchars($_POST['search_box'], ENT_QUOTES, 'UTF-8') : '';
   $sort_order = isset($_POST['sort_order']) ? $_POST['sort_order'] : '';

   $query = "SELECT * FROM `products` WHERE `name` LIKE ? OR `category` LIKE ?";

   // Add sorting logic
   if ($sort_order === 'high_to_low') {
      $query .= " ORDER BY `price` DESC";
   } elseif ($sort_order === 'low_to_high') {
      $query .= " ORDER BY `price` ASC";
   } elseif ($sort_order === 'a_to_z') {
      $query .= " ORDER BY `name` ASC";
   }

   $stmt = $conn->prepare($query);
   $stmt->execute(['%' . $search_query . '%', '%' . $search_query . '%']);

   if ($stmt->rowCount() > 0) {
      while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
         echo '
         <div class="box">
            <img src="uploaded_img/' . $product['image'] . '" alt="' . $product['name'] . '">
            <div class="name">' . $product['name'] . '</div>
            <div class="price">$' . $product['price'] . '</div>
         </div>
         ';
      }
   } else {
      echo '<p class="empty">No products found!</p>';
   }
   exit; // Stop further execution since this is an AJAX request
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Search Page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   

</head>
<body>
   
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->
<style>
/* Center the search form */
.search-form {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px auto; /* Center the form vertically and horizontally */
    padding: 20px;
    background-color:#24d0c4; /* Optional: Light background */
    border-radius: 10px; /* Optional: Rounded corners */
    width: 100%; /* Full width */
    max-width: 600px; /* Limit the width */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Optional: Subtle shadow */
}

/* Style the search box */
.search-form .box {
    width: 200px; /* Adjust the width */
    height: 35px; /* Adjust the height */
    font-size: 14px; /* Adjust the font size */
    padding: 5px 10px; /* Add padding */
    border: 1px solid #ccc; /* Optional: Add a border */
    border-radius: 5px; /* Optional: Rounded corners */
    margin-right: 10px; /* Add spacing between the search box and dropdown */
}

/* Style the Sort By dropdown */
#sort_order {
    width: 150px; /* Adjust the width */
    height: 35px; /* Adjust the height */
    font-size: 14px; /* Adjust the font size */
    padding: 5px; /* Add padding */
    border: 2px solid #ccc; /* Optional: Add a border */
    border-radius: 5px; /* Optional: Rounded corners */
}

</style>
<!-- search form section starts  -->

<section class="search-form">
   <form method="post" action="">
      <input type="text" id="search_box" name="search_box" placeholder="Find Your Favorite meals..." class="box" onkeyup="fetchSuggestions()">
      <select id="sort_order" class="box" onchange="fetchSuggestions()">
         <option value="">Sort By</option>
         <option value="high_to_low">Price: High to Low</option>
         <option value="low_to_high">Price: Low to High</option>
         <option value="a_to_z">A to Z</option>
      </select>
   </form>
</section>

<!-- search form section ends -->

<section class="products" style="min-height: 100vh; padding-top:0;">
   <div class="box-container" id="search_results">
      <!-- Search results will be dynamically inserted here -->
   </div>
</section>

<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>
   function fetchSuggestions() {
      const searchBox = document.getElementById('search_box');
      const searchResults = document.getElementById('search_results');
      const sortOrder = document.getElementById('sort_order').value; // Get the selected sort order
      const query = searchBox.value;

      if (query.length > 0 || sortOrder) {
         const xhr = new XMLHttpRequest();
         xhr.open('POST', '', true); // Send the request to the same file
         xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
         xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
               searchResults.innerHTML = xhr.responseText;
            }
         };
         xhr.send('search_box=' + encodeURIComponent(query) + '&sort_order=' + encodeURIComponent(sortOrder));
      } else {
         searchResults.innerHTML = ''; // Clear results if the input is empty
      }
   }
</script>

</body>
</html>