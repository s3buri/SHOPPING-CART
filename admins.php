<?php
$name = "";
$price = "";
@include 'config.php';

if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `product` (product_name, product_price, product_image) VALUES('$p_name', '$p_price', '$p_image')") or die('query failed');

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `product` WHERE id = $delete_id ") or die('query failed');

   if($delete_query){
      header('location:admins.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:admins.php');
      $message[] = 'product could not be deleted';
   }
}

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `product` SET product_name = '$update_p_name', product_price = '$update_p_price', product_image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      $message[] = 'product updated succesfully';
      header('location:admins.php');
   }else{
      $message[] = 'product could not be updated';
      header('location:admins.php');
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

   <style>
      .sidebar {
         width: 500px;
         height: 100%;
         position: fixed;
         left: 0;
         top: 0;
         background: #333;
         padding: 20px;
         box-sizing: border-box;
         overflow: scroll;
         margin-top: 10px;
      }

      .sidebar table {
         width: 100%;
         color: #fff;
      }

      .container {
         margin-left: 270px; /* Ensure enough space for the sidebar */
      }

      .message {
         background: #f0f0f0;
         padding: 10px;
         margin: 10px 0;
      }
   </style>
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   }
}

?>

<?php include 'header.php'; ?>

<div class="container">

<section>
   <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
      <h3>add a new product</h3>
      <input type="text" name="p_name" placeholder="enter the product name" class="box" required>
      <input type="number" name="p_price" min="0" placeholder="enter the product price" class="box" required>
      <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
      <input type="submit" value="add the product" name="add_product" class="btn">
   </form>
</section>

<div class="sidebar">
   <table>
      <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product price</th>
            <th>action</th>
         </tr>
      </thead>
      <tbody>
         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `product`");
         if(mysqli_num_rows($select_products) > 0){
            while($row = mysqli_fetch_assoc($select_products)){
         ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['product_image']; ?>" height="100" alt="food"></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['product_price']; ?>Brr</td>
            <td>
               <a href="admins.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="admins.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>
         <?php
            }
         }else{
            echo "<tr><td colspan='4' class='empty'>no product added</td></tr>";
         }
         ?>
      </tbody>
   </table>
</div>

<section class="edit-form-container">
   <?php
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `product` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>
   <form action="admins.php" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['product_image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['product_name']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['product_price']; ?>">
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the product" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>
   <?php
         }
      }
      echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
   }
   ?>
</section>

</div>

<script src="js/script.js"></script>

</body>
</html>
