use dbsituation ;



CREATE TABLE Role
(
    Id INT ,
    name VARCHAR(250),
    PRIMARY KEY (Id)
)
INSERT INTO Role (name) VALUES ('admin'),('user');


CREATE TABLE User
(
    Id INT AUTO_INCREMENT,
    name VARCHAR(250),
    email VARCHAR(250),
    roleId INT ,
    PRIMARY KEY (Id),
    FOREIGN KEY (roleId) REFERENCES Role(Id)
)

select * from User