<?php
    session_start();
    if(!isset($_SESSION['AdminLoginId'])){
    header("location: login.php");
    }
    include 'C:\xampp\htdocs\ROP\connect.php';
    $query_categories = "SELECT * FROM categories";
    $categories = mysqli_query($con, $query_categories);
    $query_volumes = "SELECT * FROM volume ORDER BY volume";
    $query_brands = "SELECT * FROM brands ORDER BY name";
    $query_types = "SELECT * FROM types ORDER BY name";
    $brands = mysqli_query($con, $query_brands);
    $volumes = mysqli_query($con, $query_volumes);
    $types = mysqli_query($con, $query_types);
    $id = $_GET['id'] ?? null;

    if(!$id){
        header("LOCATION: admin.php");
        exit;
    }   

    $sql = "SELECT * FROM products WHERE id_product = '$id' ";
    $query = mysqli_query($con,$sql);
    $products = $query;
    foreach($products as $i => $product){
        $title = $product['title'];
        $price = $product['price'];
        $brand = $product['brand'];
        $type = $product['type'];
        $image = $product['image'];
        $category = $product['category'];
        $quantity = $product['quantity'];
        $caption = $product['caption'];
        $description = $product['description'];
        $volume = $product['volume'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $title = $_POST['title'];
        $price = $_POST['price'];
        $brand = $_POST['brand'];
        $type = $_POST['type'];
        $category = $_POST['category'];
        $quantity = $_POST['quantity'];
        $caption = $_POST['caption'];
        $description = $_POST['description'];
        $volume = $_POST['volume'];
        $imagePath = $image;
        
      
        if(!$title){
          $errors[0] = '*Zadaj nazov';
        }else{
          $errors[0] = null;
        }
        if(!$price){
            $errors[1] = '*Zadaj cenu';
        }else{
          $errors[1] = null;
        }        
        if(!$category){
          $errors[2] = '*Zadaj kategóriu';
        }else{
          $errors[2] = null;
        }
        if(!$quantity){
          $errors[3] = '*Zadaj kvantitu';
        }else{
          $errors[3] = null;
        }
        if(!$caption){
          $errors[4] = '*Zadaj titulok';
        }else{
          $errors[4] = null;
        }
        if(!$description){
          $errors[5] = '*Zadaj popis';
        }else{
          $errors[5] = null;
        }
        if(!$brand){
          $errors[6] = '*Zadaj značku';
        }else{
          $errors[6] = null;
        }
        if(!$type){
          $errors[7] = '*Zadaj druh';
        }else{
          $errors[7] = null;
        }
        if(!$volume){
          $errors[8] = '*Zadaj objem';
        }else{
          $errors[8] = null;
        }
        if(empty(implode($errors))){
          $image = $_FILES['image'] ?? null;
          if($image && $image['tmp_name']){
            if($produkt['image']){
            unlink($produkt['image']);
            }
            $imagePath = 'images/'.randomString(8).'/'.$image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
          }

          $sql = "UPDATE products SET title = '$title', brand = '$brand', type = '$type', image = '$imagePath', price = '$price', caption = '$caption', category = '$category', quantity = '$quantity', description = '$description', volume = '$volume' WHERE id_product = '$id'";
          $query = mysqli_query($con, $sql);
          $products = $query;
          header('Location: admin.php');
        }
    }
    function randomString($n){
    $characters = '0123456789abcdefghijklmnoqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for($i = 0; $i < $n; $i++){
        $index = rand(0, strlen($characters) - 1);
        $str = $str.$characters[$index];
    }
    return $str;
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Create</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style/form.css">
    <link rel="stylesheet" href="style/create.css">
</head>
<body>

  
  <div class="back-2">
     <h1><a href="admin.php"><i class="fa fa-home" aria-hidden="true"></i></a> Product: <?php echo $title?></h1>
      <form action="" method="post" enctype="multipart/form-data">
      <div class="tab">
        <div class="part-1">
          <div class="title">
            <label>Title</label>
              <input type="text" class="form-control" name="title" placeholder="<?php errors(0)?>" value="<?php echo $title?>">
          </div>
          <div class="brand">
            <label>Brand <label style="color: red;"><?php echo errors(2)??null?></label></label>
                <select name="brand" class="form-select" onchange="admin.php">
                  <option selected disabled>Vyber kategóriu</option>
                    <?php foreach($brands as $i){ ?>
                      <?php if($brand==$i['name']){?>
                  <option selected name="select" value="<?php echo $i['name'] ?>">
                          <?php echo $i['name']?>
                  </option>
                      <?php }else{?>  
                  <option name="select" value="<?php echo $i['name'] ?>">
                        <?php echo $i['name']?>
                  </option>
                      <?php }?>  
                    <?php }?>
                </select>
          </div>
          <?php if($image){?>
            <img class="update-image" src="<?php echo $image ?>" alt="obrázok sa nenašiel">
          <?php }?> 
          <div class="image">
            <label>Product Image</label>
            <br>
            <input type="file" name="image" id="img" style="display:none;"/>
            <label class="save-file" for="img"><i class="fa fa-long-arrow-down" aria-hidden="true"></i> Vložiť súbor</label>
          </div>
          <div class="price">
            <label>Price</label>
            <input type="number" step=".010" name="price" class="form-control" placeholder="<?php errors(1)?>" value="<?php echo number_format($price,2,"."," ")?>">
          </div>
          <div class="category">
            <label>Category <label style="color: red;"><?php echo errors(2)??null?></label></label>
                <select name="category" class="form-select" onchange="admin.php">
                  <option selected disabled>Vyber kategóriu</option>
                    <?php foreach($categories as $i){ ?>
                      <?php if($category==$i['name']){?>
                  <option selected name="select" value="<?php echo $i['name'] ?>">
                          <?php echo $i['name']?>
                  </option>
                      <?php }else{?>  
                  <option name="select" value="<?php echo $i['name'] ?>">
                        <?php echo $i['name']?>
                  </option>
                      <?php }?>  
                    <?php }?>
                </select>
          </div>
        </div>
        
        <div class="part-2">
          <div class="type">
            <label>Vôňa <label style="color: red;"><?php echo errors(2)??null?></label></label>
                <select name="type" class="form-select" onchange="admin.php">
                  <option selected disabled>Vyber kategóriu</option>
                    <?php foreach($types as $i){ ?>
                      <?php if($type==$i['name']){?>
                  <option selected name="select" value="<?php echo $i['name'] ?>">
                          <?php echo $i['name']?>
                  </option>
                      <?php }else{?>  
                  <option name="select" value="<?php echo $i['name'] ?>">
                        <?php echo $i['name']?>
                  </option>
                      <?php }?>  
                    <?php }?>
                </select>
          </div>
          <div class="caption">
            <label>Caption</label>
            <input step=".1" name="caption" class="form-control" placeholder="<?php errors(4)?>" value="<?php echo $caption?>">
          </div>
          <div class="description">
            <label>Description</label>
            <textarea name="description" class="form-control" placeholder="<?php errors(5)?>" value="<?php echo $description?>"><?php echo $description?></textarea>
          </div>
          <div class="quantity">
            <label>Quantity</label>
            <input step=".1" name="quantity" class="form-control" placeholder="<?php errors(3)?>" value="<?php echo $quantity?>">
          </div>
          <div class="volume">
            <label>Objem <label style="color: red;"><?php echo errors(8)??null?></label></label>
                <select name="volume" class="form-select" onchange="admin.php">
                  <option selected disabled>Vyber kategóriu</option>
                    <?php foreach($volumes as $i){ ?>
                      <?php if($volume==$i['volume']){?>
                  <option selected name="select" value="<?php echo $i['volume'] ?>">
                          <?php echo $i['volume']?>
                  </option>
                      <?php }else{?>  
                  <option name="select" value="<?php echo $i['volume'] ?>">
                        <?php echo $i['volume']?>
                  </option>
                      <?php }?>  
                    <?php }?>
                </select>
          </div>
        </div> 
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

</body>
</html>