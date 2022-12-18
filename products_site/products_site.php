<?php 
    include 'C:\xampp\htdocs\ROP\connect.php';
    $search = $_GET['search'] ?? null;
    $category = $_GET['category'] ?? '';
    $price = $_GET['price'] ?? '';
    $brand = $_GET['brand'] ?? '';
    $type = $_GET['type'] ?? '';
    if($search) {
        $query_products = "SELECT * FROM products WHERE title LIKE '%$search%' OR brand LIKE '%$search%'";
    }
    elseif ($price){
        $query_products = "SELECT * FROM products WHERE category LIKE '%$category%' AND brand LIKE '%$brand%' AND type LIKE '%$type%' AND price <= '$price' ";
    } 
    else  {
        $query_products = "SELECT * FROM products WHERE category LIKE '%$category%' AND brand LIKE '%$brand%' AND type LIKE '%$type%' ORDER BY title";
    }
    $max_price = "SELECT MAX(price) FROM products";
    $query_categories = "SELECT * FROM categories";
    $query_brands = "SELECT * FROM brands ORDER BY name";
    $query_types = "SELECT * FROM types ORDER BY name";
    $min_price ="SELECT MIN(price) FROM products";

    $brands = mysqli_query($con, $query_brands);
    $types = mysqli_query($con, $query_types);
    $products = mysqli_query($con, $query_products);
    $categories = mysqli_query($con, $query_categories);
    $max = mysqli_query($con, $max_price);
    $min = mysqli_query($con, $min_price);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-shop</title>
    <link rel="stylesheet" href="/ROP/main_page/styles/header.css">
    <link rel="stylesheet" href="/ROP/products_site/style/layout.css">
    <link rel="stylesheet" href="/ROp/products_site/style/products.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar">
        <div class="logo">Logo</div>
        <a href="#" class="button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links">
            <ul>
                <li><a href="">Domov</a></li>
                <li><a href="products_site.php">Produkty</a></li>
                <li><a href="">Košík</a></li>
            </ul>
        </div>
    </nav>
    <div class="wrapper">
        <nav class="search-panel">
            <form class="fix" action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Vyhľadaj " name="search" value="<?php echo $search?>">
                    <button class="btn btn-outline-light" type="submit">Vyhľadaj</button>
                </div>
            </form>
            <!-- pridat checkbox 
            <?php foreach($categories as $i){?>
                <div>
                <a href="products_site.php?category=<?php echo $i['name'] ?> ">
                <?php echo $i['name']?>
                </a>
                </div>
            <?php }?>-->

            <form class="form" method="get">
                <fieldset onchange="this.form.submit()">
                <label>Kategória</label>
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
                    <label>Brand</label>
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
                        <label>Druh vône</label>
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
                    
                    <noscript><button type="submit" class="btn btn-primary">Submit</button></noscript>
                </fieldset>
                <fieldset onchange="this.form.submit()">
                    <label for="price">Volume (between <?php foreach ($min as $i) {echo implode("",$i);}?> and <?php foreach ($max as $i) {echo implode("",$i);}?>):</label>
                    <input type="range" name="price" min="<?php foreach ($min as $i) {echo implode("",$i);}?>" max="<?php foreach ($max as $i) {echo implode("",$i);}?>" value="<?php echo $price?>">
                    <button><a href="products_site.php">RESET</a></button>
                    <noscript><button type="submit" class="btn btn-primary">Submit</button></noscript>
                </fieldset >
            </form>             
        </nav>
        <div class="back">
            <div class="products">
            <?php $count = 0?> 
                <?php foreach($products as $i => $product){?>          
                    <div class="card-container">
                        <div class="cart">
                            <a href="/ROP/products_site/product.php?id=<?php echo $product['id_product']?>">
                                <button class="button">
                                    <div class="button-pd">
                                    <p>Otvoriť produkt</p>
                                </div>
                                </button>
                            </a>
                        </div>
                        <style>
                            .image<?php echo $count?> {
                                
                                background-image: url("/ROP/admin_site/<?php echo $product['image']?>");
                                
                            }
                         </style>
                        <div class="image<?php echo $count++?> image-content"></div>
                        <div class="full-content">
                            <div class="top-content">
                                <h2>
                                    <?php echo $product['brand']?>
                                </h2>
                                <h1>
                                <?php echo $product['title']?>
                                </h1>
                            </div>
                            <div class="paragraph">
                                <p>
                                    <?php echo $product['caption']?>
                                </p>
                            </div>
                            <div class="amount">
                                <div class="correct-val">
                                    <p>
                                        <?php echo number_format($product['price'],2,","," "), ' €'?>
                                    </p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php  }?>  
            </div>
        </div>
    </div>
</body>
</html>
<script src="/ROP/main_page/js-file/script.js"></script>