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


CREATE TABLE `private_info_app`.`passwords_tokens` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `user_id` INT UNSIGNED NOT NULL, `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`id`)
) ENGINE = InnoDB;

ALTER TABLE `passwords_tokens`
ADD `token` VARCHAR(255) NOT NULL AFTER `user_id`;
ALTER TABLE `passwords_tokens`
ADD `checked_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `created_at`;
ALTER TABLE `passwords_tokens`
CHANGE `checked_at` `checked_at` DATETIME NULL DEFAULT NULL;
ALTER TABLE `passwords_tokens`
CHANGE `user_id` `user_id` INT(11) UNSIGNED NOT NULL;
ALTER TABLE `users`
CHANGE `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `passwords_tokens`
ADD CONSTRAINT `tokens_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;