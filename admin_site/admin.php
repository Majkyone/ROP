<?php
  session_start();
    if(!isset($_SESSION['AdminLoginId'])){
      header("location: login.php");
  }

  include 'C:\xampp\htdocs\ROP\connect.php';

  $category = $_GET['format'] ?? null;
  if($category == 'all'){
    $category = null;
  }
 
  if($category){
    $query_products = "SELECT * FROM products WHERE category = '$category'";
  }
  else {
    $query_products = "SELECT * FROM products";
  }
  $query_categories = "SELECT * FROM categories";
 
  $products = mysqli_query($con, $query_products);
  $categories = mysqli_query($con, $query_categories);    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="style/form.css">
</head>
<body>
<div class="main-nav">
    <H1>Produkty</H1>
    <div class="right">
      <div class="nav-i">
        <a href="create.php" class="new-product btn btn-outline-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Vytvoriť produkt</a>
        <a href="orders.php" class="orders btn btn-outline-light">
          <i class="fa fa-shopping-basket" aria-hidden="true"></i>
          Objednávky</a>
        <form method="POST">
          <button class="log-out btn btn-outline-danger" name="log_out">
            <i class="fa fa-sign-out" aria-hidden="true"></i>
            LOG OUT</button>
        </form>
        <?php 
          if(isset($_POST['log_out'])){
              session_destroy();
              header("location: login.php");
          }
        ?>
      </div>
    </div>
  </div>
  
  <?php function select(){ ?>
    <button type="submit" class="btn btn-primary"></button>
  <?php } ?>

  <form class="form" method="get">
    <select name="format" class="form-select" onchange="this.form.submit()">
      <option selected disabled> Vyber kategóriu</option>
      <option value="all" > Vyber všetko</option>
      <?php foreach($categories as $i => $category){ ?>
        <option name="select" value="<?php echo $category['name'] ?>">
          <?php echo $category['name']?>
        </option>
      <?php }?>
    </select>
    <noscript><button type="submit" class="btn btn-primary">Submit</button></noscript>
  </form> 

  <table class="table">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Obrázok</th>
        <th scope="col">Názov</th>
        <th scope="col">Značka</th>
        <th scope="col">Cena</th>
        <th scope="col">Kategória</th>
        <th scope="col">Kvantita</th>
        
        <th scope="col">Funkcie</th>
      </tr>
    </thead>
    <tbody class="table-group-divider">
      <?php foreach($products as $i => $product){?>
      <tr>
        <td data-label="ID" scope="row"><?php echo $product['id_product'] ?></td>
        <td data-label="Obrázok"> <img src="<?php echo $product['image'] ?>" alt=""></td>
        <td data-label="Názov"><?php echo $product['title'] ?></td>
        <td data-label="Názov"><?php echo $product['brand'] ?></td>
        <td data-label="Cena"><?php echo number_format($product['price'],2,","," "), ' €' ?></td>
        <td data-label="kategória"><?php echo $product['category'] ?></td>
        <td data-label="Kvantita"><?php echo $product['quantity'] ?></td>
       
        <td data-label="Action">
          <a href="edit.php?id=<?php echo $product['id_product']?>" class="btn btn-sm btn-outline-success"><i class="fa fa-pencil" aria-hidden="true"></i></a>
          <form style="display: inline-block" method="post" action="delete.php">
            <input type="hidden" name="id" value="<?php echo $product['id_product']?>">
            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
          </form>
        </td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</body>
</html>