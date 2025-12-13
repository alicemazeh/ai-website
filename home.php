<?php
include 'components/connect.php';
session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home - AI Waiter</title>

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS -->
   <link rel="stylesheet" href="css/style.css">
   <!--<link rel="stylesheet" href="css/menu.css">-->
   

   <!-- Lottie Animation -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>
<style>



.ai-waiter-card {
      animation: slideInRight 0.6s ease;
      padding: 50px 40px;
      font-size: 1.7rem;
      border-radius: 20px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .ai-waiter-card h3 {
      font-size: 2rem;
      margin-bottom: 24px;
      color: #125ea8;
    }

    .ai-waiter-options {
      font-size: 1.7rem;
    }

    .ai-waiter-next-btn {
      font-size: 1.7rem;
      padding: 12px 30px;
    }

    @keyframes slideInRight {
      0% {
        transform: translateX(100%);
        opacity: 0;
      }
      100% {
        transform: translateX(0);
        opacity: 1;
      }
    }

    .ai-waiter-recommendations {
      animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
   .robot-section {
   display: flex;
   align-items: center;
   justify-content: space-between;
   padding: 300px;
   height: 90vh;
   gap: 50px;
   background: linear-gradient(to right, rgb(250, 249, 249), rgb(48, 182, 175), rgb(250, 249, 249));
   color: white;
}
.ai-waiter-card h3,
.ai-waiter-title {
  font-size: 5rem;
  font-weight: 700;
  color: #1976d2;
  margin-bottom: 28px;
  margin-top: 0;
  line-height: 1.4;
}


.robot-animation {
   width: 300px;
   height: 300px;
   flex-shrink: 0;
}

.robot-text-content {
   max-width: 600px;
}

.robot-title {
   font-size: 5rem;
   font-weight: bold;
   margin-bottom: 20px;
   margin-top: -70px;
}

.robot-subtext {
   font-size: 2.5rem;
   color: #222;
   line-height: 1.6;
   margin-bottom: 30px;
   font-weight: 500;
   /* background-color: rgba(255, 255, 255, 0.6); */
   padding: 20px 30px;
   border-left: 5px solid #3498db;
   border-radius: 8px;
   box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.button-container {
   margin-top: 30px;
   display: flex;
   gap: 20px;
}

.btn {
   padding: 20px 40px;
   font-size: 2rem;
   border: none;
   border-radius: 40px;
   cursor: pointer;
   font-weight: 700;
   transition: all 0.3s ease;
}

.btn-yes {
   background-color: #3498db;
   color: white;
}

.btn-no {
   background-color: #e74c3c;
   color: white;
}

.btn:hover {
   transform: scale(1.1);
}

/* AI Waiter Flow Styles */
.ai-waiter-box { background: #fff; color: #222; border-radius: 16px; box-shadow: 0 2px 12px #0002; padding: 40px 30px; max-width: 600px; margin: 0 auto; }
.ai-waiter-title { font-size: 2.2rem; font-weight: bold; margin-bottom: 20px; }
.ai-waiter-options { margin: 30px 0; display: flex; flex-wrap: wrap; gap: 20px; }
.ai-waiter-option-btn { background: #1976d2; color: #fff; border: none; border-radius: 8px; padding: 12px 28px; font-size: 2rem; cursor: pointer; transition: 0.2s; }
.ai-waiter-option-btn.selected, .ai-waiter-option-btn:hover { background: #125ea8; }
.ai-waiter-recommendations { display: flex; flex-wrap: wrap; gap: 30px; margin-top: 30px; }
.ai-waiter-card { background: #f7fafd; border-radius: 12px; box-shadow: 0 2px 8px #0001; padding: 20px; width: 250px; display: flex; flex-direction: column; align-items: center; }
.ai-waiter-card img { width: 120px; height: 120px; border-radius: 10px; object-fit: cover; }
.ai-waiter-card h4 { margin: 10px 0 5px 0; }
.ai-waiter-card p {
      font-size: 1.9rem;
      color: #444;
      font-family: 'Rubik', sans-serif;
    }
.ai-waiter-card b { color: #1976d2; }
.ai-waiter-card .order-btn { margin-top: 10px; background: #1976d2; color: #fff; border: none; border-radius: 8px; padding: 8px 18px; font-size: 1rem; cursor: pointer; }

body {
  background: #fafbfc;
}

#aiWaiterFlow {
  min-height: 80vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.ai-waiter-steps {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  gap: 40px;
  width: 100%;
}

.ai-waiter-card {
  background: #f7fafd;
  border-radius: 18px;
  box-shadow: 0 4px 24px #0001;
  padding: 36px 32px 32px 32px;
  min-width: 320px;
  max-width: 350px;
  margin: 0 auto;
  text-align: center;
  transition: box-shadow 0.2s;
}

.ai-waiter-card h3, .ai-waiter-title {
  font-size: 2rem;
  font-weight: 700;
  color: #1976d2;
  margin-bottom: 28px;
  margin-top: 0;
}

.ai-waiter-options {
  display: flex;
  flex-direction: column;
  gap: 18px;
  align-items: flex-start;
  margin-bottom: 24px;
}

.ai-waiter-option {
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 2rem;
  font-weight: 500;
  color: #222;
  cursor: pointer;
  padding: 6px 10px;
  border-radius: 8px;
  transition: background 0.15s;
}

.ai-waiter-option:hover {
  background: #e3f0fa;
}

.ai-waiter-option input[type="radio"],
.ai-waiter-option input[type="checkbox"] {
  accent-color: #1976d2;
  width: 20px;
  height: 20px;
  margin: 0;
}

.ai-waiter-next-btn, .order-btn {
  background: #1976d2;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 10px 28px;
  font-size: 1.08rem;
  font-weight: 600;
  cursor: pointer;
  margin-top: 10px;
  transition: background 0.2s;
  box-shadow: 0 2px 8px #0001;
}

.ai-waiter-next-btn:hover, .order-btn:hover {
  background: #125ea8;
}

.ai-waiter-recommendations {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
  justify-content: center;
  margin-top: 30px;
}

@media (max-width: 900px) {
  .ai-waiter-steps {
    flex-direction: column;
    align-items: center;
    gap: 24px;
  }
  .ai-waiter-card {
    min-width: 90vw;
    max-width: 98vw;
  }
}
.robot-section {
   display: flex;
   align-items: center;
   justify-content: space-between;
   padding: 300px;
   height: 90vh;
   gap: 50px;
   background: linear-gradient(to right, rgb(250, 249, 249), rgb(48, 182, 175), rgb(250, 249, 249));
   color: white;
}
.robot-section {
   display: flex;
   flex-direction: row;
   align-items: center;
   justify-content: center;
   padding: 80px 60px;
   gap: 50px;
   background: linear-gradient(to right, rgb(250, 249, 249), rgb(48, 182, 175), rgb(250, 249, 249));
   color: white;
   flex-wrap: wrap;
}

@media (max-width: 1024px) {
   .robot-section {
      flex-direction: column;
      padding: 60px 30px;
      text-align: center;
   }

   .robot-animation {
      width: 220px;
      height: 220px;
   }

   .robot-title {
      font-size: 3rem;
   }

   .robot-subtext {
      font-size: 1.6rem;
      padding: 16px 20px;
   }

   .button-container {
      justify-content: center;
      flex-wrap: wrap;
   }

   .btn {
      font-size: 1.4rem;
      padding: 12px 24px;
   }
   .popup-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 999;
}

.popup-box {
  background: #fff;
  padding: 40px;
  border-radius: 12px;
  text-align: center;
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.popup-buttons {
  display: flex;
  justify-content: space-around;
  gap: 20px;
  margin-top: 20px;
}

.btn {
  padding: 10px 20px;
  font-size: 1.6rem;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
}

.btn-yes {
  background-color: #28a745;
  color: #fff;
}

.btn-no {
  background-color: #dc3545;
  color: #fff;
}




</style>
</head>
<body>

<?php include 'components/user_header.php'; ?>

<!-- ✅ Robot Section -->
<section class="robot-section" id="robotSection">
   <div id="robotAnimation" class="robot-animation"></div>

   <div class="robot-text-content">
      <div class="robot-title">Welcome to Savor Haven </div>
      <div class="robot-subtext">Would you like personalized help from our AI Waiter?</div>
      <div class="button-container">
         <button class="btn btn-yes glow-btn" onclick="startAIWaiter()">Yes</button>
         <button class="btn btn-no glow-btn-red" onclick="window.location.href='menu.php'">No</button>
      </div>
   </div>
</section>

<!-- AI Waiter Flow (hidden by default) -->
<div id="aiWaiterFlow" style="display:none;">
   <div class="ai-waiter-steps" id="aiWaiterSteps"></div>
</div>

<!-- ✅ Category Section -->
<!-- <section class="category">
   <h1 class="title">Food Category</h1>
   <div class="box-container">

      <a href="category.php?category=fast food" class="box">
         <img src="images/cat-1.png" alt="">
         <h3>Fast Food</h3>
      </a>

      <a href="category.php?category=main dish" class="box">
         <img src="images/cat-2.png" alt="">
         <h3>Main Dishes</h3>
      </a>

      <a href="category.php?category=drinks" class="box">
         <img src="images/cat-3.png" alt="">
         <h3>Drinks</h3>
      </a>

      <a href="category.php?category=desserts" class="box">
         <img src="images/cat-4.png" alt="">
         <h3>Desserts</h3>
      </a>

   </div>
</section> -->

<!-- ✅ Products Section -->
<!-- <section class="products">
   <h1 class="title">Latest Dishes</h1>
   <div class="box-container">
      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>$</span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         } else {
            echo '<p class="empty">No products added yet!</p>';
         }
      ?>
   </div>

   <div class="more-btn">
      <a href="menu.html" class="btn">View All</a>
   </div>
</section> -->

<?php include 'components/footer.php'; ?>

<!-- Custom JS -->
<script src="js/script.js"></script>

<!-- ✅ Lottie Animation Script -->
<!-- YOUR EXISTING PHP HEADER + HTML/CSS stays the same... -->
<!-- This goes inside your current <script> tag near the bottom of home.php -->

<script>
document.addEventListener("DOMContentLoaded", function () {
   lottie.loadAnimation({
      container: document.getElementById("robotAnimation"),
      renderer: "svg",
      loop: true,
      autoplay: true,
      path: "robot.json.json"
   });
});

const params = new URLSearchParams(window.location.search);
if (params.get('startAIWaiter(') === '1') {
   startAIWaiter();
}

function startAIWaiter() {
   document.getElementById('robotSection').style.display = 'none';
   document.getElementById('aiWaiterFlow').style.display = 'block';
   showWaiterStep();
}

let waiterStep = 0;
let waiterCategory = '';
let waiterTag = '';
let waiterIngredient = '';

function showWaiterStep() {
   if (waiterStep === 0) {
      fetch('ai_waiter_api.php?action=get_categories')
         .then(res => res.json())
         .then(categories => {
            let html = `
               <div class="ai-waiter-card">
                  <h3>What are you in the mood for today?</h3>
                  <div class="ai-waiter-options">
                     ${categories.map(cat => `
                        <label class="ai-waiter-option">
                           <input type="radio" name="waiterCategory" value="${cat}">
                           ${cat.charAt(0).toUpperCase() + cat.slice(1)}
                        </label>
                     `).join('')}
                  </div>
                  <button class="ai-waiter-next-btn" onclick="waiterNextCategory()">Next</button>
               </div>
            `;
            document.getElementById('aiWaiterSteps').innerHTML = html;
         });
   }

   else if (waiterStep === 1) {
      waiterCategory = document.querySelector('input[name="waiterCategory"]:checked')?.value || waiterCategory;
      fetch('ai_waiter_api.php?action=get_tags&category=' + encodeURIComponent(waiterCategory))
         .then(res => res.json())
         .then(tags => {
            let html = `
               <div class="ai-waiter-card">
                  <h3>What kind of ${waiterCategory} would you like?</h3>
                  <div class="ai-waiter-options">
                     ${tags.map(tag => `
                        <label class="ai-waiter-option">
                           <input type="radio" name="waiterTag" value="${tag}">
                           ${tag}
                        </label>
                     `).join('')}
                  </div>
                  <button class="ai-waiter-next-btn" onclick="waiterNextTag()">Next</button>
               </div>
            `;
            document.getElementById('aiWaiterSteps').innerHTML = html;
         });
   }

   else if (waiterStep === 2) {
      waiterTag = document.querySelector('input[name="waiterTag"]:checked')?.value || waiterTag;
      fetch(`ai_waiter_api.php?action=get_ingredients&category=${encodeURIComponent(waiterCategory)}&tag=${encodeURIComponent(waiterTag)}`)
         .then(res => res.json())
         .then(ingredients => {
            if (!Array.isArray(ingredients)) {
               alert("Could not load ingredients. Try again.");
               return;
            }
            let html = `
               <div class="ai-waiter-card">
                  <h3>Choose a preferred ingredient:</h3>
                  <div class="ai-waiter-options">
                     ${ingredients.map(ing => `
                        <label class="ai-waiter-option">
                           <input type="radio" name="waiterIngredient" value="${ing}">
                           ${ing}
                        </label>
                     `).join('')}
                  </div>
                  <button class="ai-waiter-next-btn" onclick="waiterNextIngredient()">Next</button>
               </div>
            `;
            document.getElementById('aiWaiterSteps').innerHTML = html;
         });
   }

   else if (waiterStep === 3) {
      waiterIngredient = document.querySelector('input[name="waiterIngredient"]:checked')?.value || waiterIngredient;

      // 🔁 Boost ingredient weight
      fetch('ai_waiter_api.php?action=boost_weight', {
         method: 'POST',
         headers: { 'Content-Type': 'application/json' },
         body: JSON.stringify({
            category: waiterCategory,
            tag: waiterTag,
            ingredient: waiterIngredient
         })
      });

      // 🔹 Fetch price ranges
      fetch(`ai_waiter_api.php?action=get_price_ranges&category=${encodeURIComponent(waiterCategory)}&tag=${encodeURIComponent(waiterTag)}&ingredient=${encodeURIComponent(waiterIngredient)}`)
         .then(res => res.json())
         .then(ranges => {
            if (ranges.length === 1) {
               // Only one price option, skip to final step
               waiterStep = 4;
               waiterShowRecommendationsWithPrice(ranges[0]);
            } else {
               let html = `
                  <div class="ai-waiter-card">
                     <h3>What is your preferred price range?</h3>
                     <div class="ai-waiter-options">
                        ${ranges.map(range => `
                           <label class="ai-waiter-option">
                              <input type="radio" name="waiterPrice" value="${range}">
                              ${range}
                           </label>
                        `).join('')}
                     </div>
                     <button class="ai-waiter-next-btn" onclick="waiterShowRecommendations()">Show Meals</button>
                  </div>
               `;
               document.getElementById('aiWaiterSteps').innerHTML = html;
            }
         });
   }

   else if (waiterStep === 4) {
      waiterShowRecommendations();
   }
}

function waiterNextCategory() {
   if (!document.querySelector('input[name="waiterCategory"]:checked')) return alert('Please select a category!');
   waiterStep = 1;
   showWaiterStep();
}

function waiterNextTag() {
   if (!document.querySelector('input[name="waiterTag"]:checked')) return alert('Please select a tag!');
   waiterTag = document.querySelector('input[name="waiterTag"]:checked').value;

   fetch('ai_waiter_api.php?action=boost_tag', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ category: waiterCategory, tag: waiterTag })
   });

   waiterStep = 2;
   showWaiterStep();
}

function waiterNextIngredient() {
   if (!document.querySelector('input[name="waiterIngredient"]:checked')) return alert('Please select an ingredient!');
   waiterStep = 3;
   showWaiterStep();
}

function waiterShowRecommendations() {
   if (!document.querySelector('input[name="waiterPrice"]:checked')) return alert('Please select a price range!');
   const priceRange = document.querySelector('input[name="waiterPrice"]:checked').value;
   waiterShowRecommendationsWithPrice(priceRange);
}

function waiterShowRecommendationsWithPrice(priceRange) {
   const data = {
      category: waiterCategory,
      tag: waiterTag,
      ingredient: waiterIngredient,
      priceRange: priceRange
   };

   fetch('ai_waiter_api.php?action=get_recommendations', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
   })
   .then(res => res.json())
   .then(result => {
      const fallbackLevel = result.fallback_level;
      const items = result.items;

      let message = "Based on your preferences, here are the best meals:";
      if (fallbackLevel === 1) {
         message = "We couldn't match your price range exactly, but here's a great match based on your ingredient and taste!";
      } else if (fallbackLevel === 2) {
         message = "We found meals based on your category and tag, ignoring the ingredient preference.";
      } else if (fallbackLevel === 3) {
         message = "We found the closest meals based on your selected category and tag.";
      }

      let html = `
         <div style="display: flex; flex-direction: column; align-items: center;">
            <div class="ai-waiter-title" style="margin-bottom: 20px; text-align: center;">${message}</div>
            <div class="ai-waiter-recommendations">
      `;

      items.forEach(item => {
         html += `
            <div class="ai-waiter-card">
               <img src="uploaded_img/${item.image.trim()}" alt="${item.name}">
               <h4>${item.name}</h4>
               <p>${item.ingredients}</p>
               <b>$${item.price}</b>
               <form action="" method="post">
                  <input type="hidden" name="pid" value="${item.id}">
                  <input type="hidden" name="name" value="${item.name}">
                  <input type="hidden" name="price" value="${item.price}">
                  <input type="hidden" name="image" value="${item.image}">
                  <input type="hidden" name="qty" min="1" value="1">
                  <button type="submit" class="order-btn" name="add_to_cart">Order Now</button>
               </form>
            </div>`;
      });

      html += `</div></div>`;
      document.getElementById('aiWaiterSteps').innerHTML = html;
   });
}
document.addEventListener("DOMContentLoaded", function () {
   document.body.addEventListener('click', function (e) {
      if (e.target.matches('button.order-btn')) {
         e.preventDefault();
         const form = e.target.closest('form');
         const mealName = form.querySelector('input[name="name"]').value;

         if (confirm(`Are you sure you want to add "${mealName}" to your cart?`)) {
            // ✅ Add hidden input to simulate button press
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'add_to_cart';
            input.value = '1';
            form.appendChild(input);

            form.submit();
         }
      }
   });
});


</script>


</body>
</html>
