USE data

DELETE FROM categories;
DELETE FROM brands;
DELETE FROM types;

INSERT INTO brands VALUES
(0, 'Hugo Boss'),
(0, 'Armani'),
(0, 'Calvin Klein'),
(0, 'DIOR'),
(0, 'Yves Saint Laurent'),
(0, 'Adidas'),
(0, 'Al Haramain'),
(0, 'Bond No.9'),
(0, 'Creed'),
(0, 'David Beckham'),
(0, 'Chanel'),
(0, 'Lacoste'),
(0, 'The Library of Fragrance'),
(0, 'Xerjoff');

INSERT INTO categories VALUES
(0, 'Kolínska voda'),
(0, 'Toaletná voda'),
(0, 'Parfúmová voda'),
(0, 'Parfémy'),
(0, 'Toalenté spreje');

INSERT INTO types VALUES
(0, 'Aromatická'),
(0, 'Citrusová'),
(0, 'Cyprusová'),
(0, 'Drevitá'),
(0, 'Gurmánska'),
(0, 'Korenistá'),
(0, 'Kožená'),
(0, 'Kvetinová'),
(0, 'Orientálna'),
(0, 'Ovocná'),
(0, 'Pižmová'),
(0, 'Vodná'),
(0, 'Zelená'),
(0, 'Fougerova');

INSERT INTO volume VALUES
(0, 50),
(0, 60),
(0, 100),
(0, 120),
(0, 150),
(0, 200);