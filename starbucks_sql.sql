select * from consumable;

insert into consumable
values(1,'Snacks','Food');
insert into consumable
values(2,'Coffee','beverage');
insert into consumable
values(3,'Drinks','beverage');
insert into consumable
values(4,'Bakery','Food');



CREATE TABLE `starbucks`.`products` (
  `prod_id` INT NOT NULL,
  `prod_name` VARCHAR(45) NOT NULL,
  `prod_price` VARCHAR(45) NOT NULL,
  `ID_con` INT NULL,
  PRIMARY KEY (`prod_id`),
  INDEX `ID_con_idx` (`ID_con` ASC) VISIBLE,
    FOREIGN KEY (`ID_con`)
    REFERENCES `starbucks`.`consumable` (`ID_con`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

    
    
    select * from products;



insert into products 
values(1,'Madeleines','$15',1);
insert into products 
values(2,'Vanilla Almonds','$20',1);
insert into products 
values(3,'Cookies','$15',1);

insert into products 
values(4,'Cholocolate Cream Cold Brew','$50',2);
insert into products 
values(5,'Salted Caramel Cold Brew','$60',2);
insert into products 
values(6,'Vanilla Sweet Cream Cold Brew','$50',2);


insert into products 
values(7,'Star Drink','$50',3);
insert into products 
values(8,'Dragon Drink','$50',3);


insert into products 
values(9,'Plain Bagel','$25',4);
insert into products 
values(10,'Cinnamon Raisin Bagel','$35',4);
insert into products 
values(11,'Cheddar Bagel','$20',4);





