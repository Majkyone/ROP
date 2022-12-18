USE data;

CREATE TABLE categories(
    id_category INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL
)Engine = Innodb;