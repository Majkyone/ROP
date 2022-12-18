USE data;

CREATE TABLE products (
    id_product INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    price FLOAT(5.2) NOT NULL,
    caption TEXT NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(2048) NOT NULL,
    quantity BIGINT NOT NULL
)Engine = Innodb;