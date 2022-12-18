USE data;

CREATE TABLE admin(
    id_admin INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    admin_name VARCHAR(255) NOT NULL,
    admin_password VARCHAR(255) NOT NULL
)Engine = Innodb;