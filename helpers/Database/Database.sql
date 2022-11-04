CREATE TABLE roles(
   Id_roles INT AUTO_INCREMENT,
   role TINYINT NOT NULL,
   PRIMARY KEY(Id_roles)
);

CREATE TABLE users(
   Id_users INT AUTO_INCREMENT,
   lastname VARCHAR(50)  NOT NULL,
   firstname VARCHAR(50)  NOT NULL,
   mail VARCHAR(125)  NOT NULL,
   phone VARCHAR(10) ,
   adresse VARCHAR(255) ,
   password VARCHAR(50) ,
   salaries DECIMAL(5,2)  ,
   siret VARCHAR(14) ,
   newsletter TINYINT,
   created_at DATETIME NOT NULL,
   activated_at DATETIME,
   deleted_at DATETIME,
   Id_roles INT NOT NULL,
   PRIMARY KEY(Id_users),
   FOREIGN KEY(Id_roles) REFERENCES roles(Id_roles)
);

CREATE TABLE incomes(
   Id_incomes INT AUTO_INCREMENT,
   daily_income DECIMAL(10,2)   NOT NULL,
   income_date DATETIME NOT NULL,
   Id_users INT NOT NULL,
   PRIMARY KEY(Id_incomes),
   FOREIGN KEY(Id_users) REFERENCES users(Id_users)
);

CREATE TABLE bills(
   Id_bills INT AUTO_INCREMENT,
   url VARCHAR(255)  NOT NULL,
   created_at DATETIME NOT NULL,
   state TINYINT,
   Id_users INT NOT NULL,
   PRIMARY KEY(Id_bills),
   FOREIGN KEY(Id_users) REFERENCES users(Id_users)
);

CREATE TABLE events(
   Id_events INT AUTO_INCREMENT,
   description VARCHAR(125)  NOT NULL,
   start_at DATETIME NOT NULL,
   end_at DATETIME,
   Id_users INT NOT NULL,
   PRIMARY KEY(Id_events),
   FOREIGN KEY(Id_users) REFERENCES users(Id_users)
);

CREATE TABLE todos(
   Id_todos INT AUTO_INCREMENT,
   checked TINYINT,
   description VARCHAR(125)  NOT NULL,
   created_at DATETIME NOT NULL,
   finished_at DATETIME,
   Id_users INT NOT NULL,
   PRIMARY KEY(Id_todos),
   FOREIGN KEY(Id_users) REFERENCES users(Id_users)
);