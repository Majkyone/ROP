LOAD DATA LOCAL INFILE 'C:/xampp/htdocs/ROP/admin_site/save_file.csv'
INTO TABLE products
    FIELDS
        TERMINATED BY '@'
        ENCLOSED BY "'"
        LINES TERMINATED BY '\n'
        IGNORE 1 ROWS(id_product, title, image, price, quantity, category, caption, description, brand, type, volume);