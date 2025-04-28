

DROP DATABASE IF EXISTS `redbird_eats`;


CREATE DATABASE `redbird_eats`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;
USE `redbird_eats`;


CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;


CREATE TABLE `restaurants` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `image_path` VARCHAR(255),
  `map_embed` TEXT
) ENGINE=InnoDB;


CREATE TABLE `reviews` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `restaurant_id` INT NOT NULL,
  `user_id`       INT NOT NULL,
  `rating`        TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
  `comment`       TEXT,
  `created_at`    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`)       REFERENCES `users`(`id`)       ON DELETE CASCADE
) ENGINE=InnoDB;


INSERT INTO `restaurants` (`name`, `description`, `image_path`, `map_embed`) VALUES
('The Landing',
 'Grab your sides and customize a personal size pizza today! Perfect for grabbing and taking back home for lunch or dinner, or grabbing a few snacks in between classes.',
 'images/Landing',
 '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48536.68800281366!2d-88.96278241498122!3d40.50748765572967!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880b71bc0c739c7d%3A0x95e3ce6a4f83626a!2sThe%20Landing!5e0!3m2!1sen!2sus!4v1745593014175!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'),
('McAlister''s Deli',
 'This restaurant is best known for their sandwiches and potatoes, perfect for when you are looking to grab something for lunch or dinner!',
 'images/Deli',
 '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d328.18463276599397!2d-88.99253602837906!3d40.5117151788767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880b710ac4b05337%3A0x51b639a9ff9920df!2sMcAlister''s%20Deli!5e0!3m2!1sen!2sus!4v1745593461784!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'),
('Starbucks',
 'This well known brand can be found all around campus! Known for their coffees and other treats—they’re the perfect way to start any day!',
 'images/Starbucks',
 '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3033.3592025327466!2d-88.99482172398426!3d40.51155097142453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880b710405a394db%3A0xa55b0d2dc370e7aa!2sStarbucks!5e0!3m2!1sen!2sus!4v1745249083958!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'),
('Subway',
 'Customize your sandwich to have something different every day, or just stick with your favorite! A quick lunch on-the-go.',
 'images/Subway',
 '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3033.140384093119!2d-89.00194402398404!3d40.51638807142372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880b7174f3000001%3A0x7a663b687bda1851!2sSubway!5e0!3m2!1sen!2sus!4v1745420415446!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'),
('Timbers Grille',
 'A grille with classic burgers, milkshakes, fries, and cheese balls. Every month they have a special alongside a new milkshake flavor!',
 'images/Timbers',
 '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12133.471545596527!2d-88.992384!3d40.511359!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880b71eadb8109f5%3A0xf16d1bca4047eea2!2sTimbers%20Grille!5e0!3m2!1sen!2sus!4v1744644643499!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'),
('Qdoba Mexican Eats',
 'Get Mexican food fast, fresh, and casual. Perfect for whenever you get that craving for some Mexican eats.',
 'images/Qdoba',
 '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3033.352289276745!2d-88.9919405!3d40.5117038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880b71091b87a17f%3A0x7d8f36dfbdc63dd6!2s200%20N%20University%20St%2C%20Normal%2C%20IL%2061761!5e0!3m2!1sen!2sus!4v1745593190910!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>');
