#CREATE DATABASE noProject2;
USE noProject2;

DROP TABLE IF EXISTS Advertisements;
DROP TABLE IF EXISTS Categories;
DROP TABLE IF EXISTS Statuses;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Moderators;

CREATE TABLE IF NOT EXISTS Advertisements
 (Advertisement_ID smallint unsigned not null auto_increment,
 AdvTitle varchar(30) not null,
 AdvDetails varchar(50) not null,
 AdvDate date not null,
 AdvPrice decimal(7,2) unsigned not null,
 User_ID varchar(15) not null,
 Moderator_ID varchar(15),
 Category_ID varchar(3) not null,
 Status_ID varchar(2) not null,
 constraint pk_advert primary key (Advertisement_ID),
 constraint fk_user_id foreign key (User_ID) references Users(User_ID) ON DELETE RESTRICT,
 constraint fk_moderator_id foreign key (Moderator_ID) references Moderators(User_ID) ON DELETE SET NULL,
 constraint fk_category_id foreign key (Category_ID) references Categories(Category_ID) ON DELETE RESTRICT,
 constraint fk_status_id foreign key (Status_ID) references Statuses(Status_ID) ON DELETE RESTRICT
 );
 
CREATE TABLE IF NOT EXISTS Categories
 (Category_ID varchar(3) not null,
 CatName varchar(15) not null,
 constraint pk_category_id primary key (Category_ID)
 );
 
 CREATE TABLE IF NOT EXISTS Statuses
 (Status_ID varchar(2) not null,
 StatusName varchar(15) not null,
 constraint pk_status_id primary key (Status_ID)
 );
 
 CREATE TABLE IF NOT EXISTS Users
 (User_ID varchar(15) not null,
 password VARCHAR(255) NOT NULL,
 UserFirst varchar(15) not null,
 UserLast varchar(15) not null,
 constraint pk_user_id primary key (User_ID)
 );
 
 CREATE TABLE IF NOT EXISTS Moderators
 (User_ID varchar(15) not null,
 constraint fk_user_id foreign key (User_ID) references Users(User_ID) ON DELETE RESTRICT,
 constraint pk_mod_id primary key (User_ID) 
 );
 
 
 insert into Categories (Category_ID, CatName)
 values ('CAT','Cars and Trucks'),('HOU','Housing'),('ELC','Electronics'),('CCA','Child Care');
 
 insert into Statuses (Status_ID, StatusName)
 values ('PN','Pending'),('AC','Active'),('DI','Disapproved');
 
 insert into Users (User_ID, UserFirst, UserLast, password)
 values ('Jsmith','John','Smith', '$2y$10$O9AbWdnOOpeAFvGNFvULN.4.iK19JlWsxnaW2PypFcjSExmKaBKSm'),
        ('Ajackson','Ann','Jackson','$2y$10$TEI4jR4NBuqpwZsEYcvHH.5W58sU.po/ardZRnm3jcsDIW3w6jr3a'),
        ('Rkale','Rania','Kale','$2y$10$TEI4jR4NBuqpwZsEYcvHH.5W58sU.po/ardZRnm3jcsDIW3w6jr3a'),
        ('Sali','Samir','Ali','$2y$10$O9AbWdnOOpeAFvGNFvULN.4.iK19JlWsxnaW2PypFcjSExmKaBKSm');

 insert into Moderators(User_ID)
 values ('Jsmith'),('Ajackson');
 
 insert into Advertisements(AdvTitle, AdvDetails, AdvDate, AdvPrice, Category_ID, User_ID, Moderator_ID, Status_ID)
 values ('2010 Sedan Subaru' , '2010 sedan car in great shape for sale' , '2017-02-10' , 6000 , 'CAT' , 'Rkale' , 'Jsmith' , 'AC'),
 ('Nice Office Desk' , 'Nice office desk for sale' , '2017-02-15' , 50.25 , 'HOU' , 'Rkale' , 'Jsmith' , 'AC'),
 ('Smart LG TV for $200 ONLY' , 'Smart LG TV 52 inches! Really cheap!' , '2017-03-15' , 200 , 'ELC' , 'Sali' , 'Jsmith' , 'AC'),
 ('HD Tablet for $25 only' , 'Amazon Fire Tablet HD' , '2017-03-20' , 25 , 'ELC' , 'Rkale' , NULL , 'PN'),
 ('Laptop for $100' , 'Amazing HP laptop for $100' , '2017-03-20' , 100 , 'ELC' , 'Rkale' , NULL , 'PN');
 
 #Test code
 select *
 from Categories;
 
 select *
 from Statuses;
 
 select *
 from Users;
 
 select *
 from Moderators;
 
 select *
 from Advertisements;
 
 select AdvTitle, AdvDetails, AdvPrice, Moderator_ID
 from Advertisements
 where Status_ID = 'AC';
