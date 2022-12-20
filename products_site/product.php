<?php
    include 'C:\xampp\htdocs\ROP\connect.php';
    $id = $_GET['id'] ?? null;

    if(!$id){
        header("LOCATION: product_site.php");
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
        $caption = $product['caption'];
        $description = $product['description'];
        $volume = $product['volume'];
    }

    $query_random = "SELECT * FROM products WHERE brand = '$brand' AND id_product != '$id' ORDER BY RAND() LIMIT 4";
    $random_products = mysqli_query($con, $query_random);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title?></title>
    <link rel="stylesheet" href="/ROP/products_site/style/products.css">
    <link rel="stylesheet" href="/ROP/products_site/style/product.css">
</head>
<body>
    <div class="container">
        <div class="product">
            <div class="gallery">
                <img src="/ROP/admin_site/<?php echo $image?>" alt="">
            </div>
            <div class="details">
                <a href="/ROP/products_site/products_site.php?brand=<?php echo $brand?>"><h2 class="brand"><?php echo $brand?></h2></a> 
                <h1 class="name"><?php echo $title?></h1>
                <a href="/ROP/products_site/products_site.php?type=<?php echo $type?>"><h3 class="type"><?php echo $type?></h3></a>
                <h3 class="caption"><?php echo $caption?></h2>
                <div class="wrapper">
                    <h3 class="volume"><?php echo $volume, ' ml'?></h3>
                    <h2 class="price"><?php echo number_format($price,2,","," "), ' €'?></h2>
                </div>
                <div class="line"></div>
                <p><?php echo $description?></p>
                <div class="quantity">
                    <p>Množstvo</p>
                    <input type="number" value="1" min="1" max="10">
                </div>
                <a href="">
                <button>Pridať do košíka</button>
                </a>
                
            </div>
        </div>
    </div>
    <h1 class="text">Mohly by sa vám páčiť</h1>
    <div class="back">
        <div class="products">
        <?php $count = 0?> 
            <?php foreach($random_products as $i => $product){?>          
                <div class="card-container">
                    <div class="cart">
                        <a href="/ROP/products_site/product.php?id=<?php echo $product['id_product']?>">
                            <button class="button">
                                <div class="button-pd">
                                <p class="text">Otvoriť produkt</p>
                            </div>
                            </button>
                        </a>
                    </div>
                    <div class="image<?php echo $count++?> image-content">
                    <img src="" alt="">
                    </div>
                    <div class="full-content">
                        <div class="top-content">
                            <h2 class="brand">
                                <?php echo $product['brand']?>
                            </h2>
                            <h1 class="title">
                                <?php echo $product['title']?>
                            </h1>
                        </div>
                        <div class="paragraph">
                            <p class="text">
                                <?php echo $product['caption']?>
                            </p>
                        </div>
                        <div class="amount">
                            <div class="correct-val">
                                <p class="text">
                                    <?php echo number_format($product['price'],2,","," "), ' €'?>
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <?php  }?>  
        </div>
    </div>

</body>
</html>