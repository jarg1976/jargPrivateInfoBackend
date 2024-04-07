DROP DATABASE IF EXISTS private_info_app;
CREATE DATABASE private_info_app CHARACTER SET utf8 COLLATE utf8_general_ci;
USE private_info_app;

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    adress VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    passsword VARCHAR(255) NOT NULL,
    photo TEXT NOT NULL
);

INSERT INTO `users` (`id`, `name`, `adress`, `email`, `passsword`, `photo`) VALUES (NULL, 'Jarg', 'Rua de cima', 'jar@gmail.com', '12345', 'jarg.png');
INSERT INTO `users` (`id`, `name`, `adress`, `email`, `passsword`, `photo`) VALUES (NULL, 'Adriana', 'Rua de cima 2', 'adriana@gmail.com', '12345', 'adriana.png');

ALTER TABLE `users` CHANGE `adress` `address` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE `users` CHANGE `passsword` `password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;