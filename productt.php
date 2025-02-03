<?php

// Database connection code
@include 'config.php';

$query = "SELECT * FROM `product`";
$result = mysqli_query($conn, $query);

?>

<?php
if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND price = '$product_price' AND image = '$product_image'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'Product already added to cart';
    } else {
        $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
        $message[] = 'Product added to cart successfully';
    }
}
?>









<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/c.css">
</head>
<body>
<?php include 'header.php'; ?>
<!--CONTAINER-->
<div class="container">
  <div class="card--list">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $product_name = isset($row['product_name']) ? $row['product_name'] : 'Unknown Product';
            $product_image = isset($row['product_image']) ? $row['product_image'] : 'default_image.jpg'; 
            $product_price = isset($row['product_price']) ? $row['product_price'] : '';
    ?>
      <div class="card">
        <img src="uploaded_img/<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>" />
       <h4 class="card--title"><?php echo $product_name; ?></h4>
        <div class="card--price">
          <div class="price"><?php echo $product_price; ?> Birr</div>

          <form action="" method="post" style="display: inline;">
            <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product_price; ?>">
            <input type="hidden" name="product_image" value="<?php echo $product_image; ?>">
            <button type="submit" class="add-to-cart"  value="Add to Cart" name="add_to_cart"><i class="fa-solid fa-plus"></i></button>
           <!-- <input type="submit" class="btn" value="Add to Cart" name="add_to_cart">-->
          </form>
        </div>
      </div>
    <?php
        }
    } else {
        echo "<p>No products found.</p>";
    }
    ?>
  </div>
</div>
  <!--footer-->
  <div class="cntr">
      <div class="cntr-small">
        <div class="c1">
          <img src="image/cart.jpg" alt="" />
        </div>
        <div class="c2">
          <h1>Shop Smart, Shop Happy!</h1>
          <p>
            Discover a seamless shopping experience with our intuitive shopping
            cart website. <br />We bring convenience and joy to <br />
            your fingertips, offering a vast selection of products,<br />
            competitive prices, and hassle-free checkout. <br />
            Shop smart and elevate your shopping spree to a whole new
            <br />level of satisfaction. Get ready to fill your cart with
            happiness!
          </p>
        </div>
      </div>
    </div>
    <!--footer-->
    <footer class="footer">
      <section class="footer__content">
        <div class="footer__content--info">
          <a href="#" class="footer__content--info__logo">Evolutive Learning</a>

          <h4 class="footer__content--info__location">
            <i class="fa-solid fa-location-dot"></i> Our Store Location
          </h4>

          <h6 class="footer__content--info__address">
            Jimma Institute Of Technology
          </h6>
        </div>

        <div class="footer__content--categories">
          <h3 class="footer__content--categories__title">Top Categories</h3>

          <ul>
            <li>Shoes</li>
            <li>Clothes</li>
            <li>Smart Phone</li>
            <li>Laptop</li>
            <li>Air Pad</li>
          </ul>
        </div>

        <div class="footer__content--links">
          <h3 class="footer__content--links__title">Impotant Links</h3>

          <ul>
            <li>About Us</li>
            <li>Contact Us</li>
            <li>FAQs</li>
            <li>Latest Posts</li>
            <li>Order Track</li>
          </ul>
        </div>

        <div class="footer__content--newsletter">
          <h3 class="footer__content--newsletter__title">Newsletter</h3>

          <p class="footer__content--newsletter__para">
            Enter your email to receive our latest updates about our products
          </p>

          <form class="footer__content--newsletter__form">
            <input type="email" placeholder="Email Address" />
            <input type="submit" value="Subscribe" />
          </form>
        </div>
      </section>

      <div class="social-icon">
        <a href="#" target="_blank"><i class="fab fa-google"></i></a>
        <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="#" target="_blank"><i class="fab fa-telegram-plane"></i></a>
        <a href="#" target="_blank"><i class="fab fa-github"></i></a>
        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
      </div>
      <div class="footerf">
        <p>&copy; 2024 Your Website. All Rights Reserved.</p>
      </div>
    </footer>
<script src="js/script.js"></script>

</body>
</html>
