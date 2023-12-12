-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Dez 2023 um 11:29
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `group2projectmealplanner`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `meal`
--

DROP TABLE IF EXISTS `meal`;
CREATE TABLE `meal` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `ingredients` varchar(255) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `preparation` longtext DEFAULT NULL,
  `rating` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `calories` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `prep_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `meal`
--

INSERT INTO `meal` (`id`, `name`, `picture`, `ingredients`, `creator`, `preparation`, `rating`, `description`, `calories`, `type`, `prep_time`) VALUES
(47, 'Vegan Curry', 'https://www.noracooks.com/wp-content/uploads/2022/08/vegan-curry-8.jpg', 'Vegetables, Coconut Milk, Spices', 'Chef Vegan', 'Prepare vegetables and spices. Cook in coconut milk until tender. Serve hot.', '4', 'Spicy curry with a mix of fresh vegetables and coconut milk.', '400', 'Vegan', '00:30:00'),
(48, 'Quinoa Salad', 'https://dudethatcookz.com/wp-content/uploads/2020/11/quinoa_roasted_veggies_5-scaled.jpg', 'Quinoa, Vegetables, Vinaigrette', 'Vegan Chef', 'Cook quinoa. Mix with fresh vegetables. Drizzle with vinaigrette. Toss and serve.', '4', 'Refreshing quinoa salad with a medley of vegetables and vinaigrette.', '350', 'Vegan', '00:35:00'),
(49, 'Caprese Salad', 'https://www.deliciousmeetshealthy.com/wp-content/uploads/2020/09/Caprese-Salad-7.jpg', 'Tomatoes, Mozzarella, Basil', 'Vegetarian Master', 'Slice tomatoes and mozzarella. Arrange on a plate. Garnish with basil. Drizzle with balsamic glaze.', '5', 'Classic caprese salad with ripe tomatoes, fresh mozzarella, and basil.', '300', 'Vegetarian', '00:10:00'),
(50, 'Vegetarian Pizza', 'https://theclevermeal.com/wp-content/uploads/2021/10/veggie-pizza-recipes_001.jpg', 'Dough, Tomato Sauce, Cheese, Vegetables', 'Pizza Chef', 'Roll out pizza dough. Spread with tomato sauce, cheese, and veggies. Bake until crust is golden brown.', '5', 'Vegetarian pizza with a crispy crust, tomato sauce, cheese, and assorted veggies.', '500', 'Vegetarian', '01:00:00'),
(51, 'Vegetable Stir Fry', 'https://www.platingsandpairings.com/wp-content/uploads/2018/08/ginger-veggie-stir-fry-16-scaled.jpg', 'Vegetables, Soy Sauce, Ginger', 'Wok Master', 'Stir-fry vegetables in a wok with soy sauce and ginger. Cook until tender-crisp. Serve hot.', '4', 'Flavorful vegetable stir fry with a blend of fresh vegetables and soy sauce.', '450', 'Vegetarian', '00:45:00'),
(52, 'Pasta Primavera', 'https://familystylefood.com/wp-content/uploads/2023/05/Pasta-Primavera-bowl.jpg', 'Pasta, Vegetables, Tomato Sauce', 'Pasta Chef', 'Cook pasta. Sauté vegetables. Mix with tomato sauce. Combine with pasta. Garnish with herbs.', '3', 'Pasta primavera with a mix of pasta, fresh vegetables, and tomato sauce.', '550', 'Vegetarian', '00:25:00'),
(53, 'Chicken Parmesan', 'https://thecozycook.com/wp-content/uploads/2022/08/Chicken-Parmesan-Recipe-1.jpg', 'Chicken, Tomato Sauce, Cheese', 'Meat Lover Chef', 'Bread chicken, fry until golden. Top with tomato sauce and cheese. Bake until cheese melts.', '5', 'Classic chicken parmesan with succulent chicken, rich tomato sauce, and melted cheese.', '700', 'Non-Vegetarian', '00:50:00'),
(54, 'Deluxe Burger', 'https://assets.epicurious.com/photos/640ae536a8da223bdbf6e85c/4:3/w_3235,h_2426,c_limit/ultimate-veggie-burger.jpg', 'Beef, Bun, Cheese, Vegetables', 'Burger Master', 'Grill beef patty. Assemble with bun, cheese, and veggies. Serve with fries.', '5', 'Deluxe burger with a juicy beef patty, cheese, and fresh vegetables.', '800', 'Non-Vegetarian', '01:00:00'),
(55, 'Salmon with Lemon-Herb Crust', 'https://thishappymommy.com/wp-content/uploads/2016/07/lemon-herb-crusted-salmon-3-1.jpg', 'Salmon, Lemon, Herbs', 'Fish Chef', 'Coat salmon with herbs. Sear in a pan. Finish in the oven. Squeeze lemon over the top.', '4', 'Salmon fillet with a flavorful lemon-herb crust.', '600', 'Non-Vegetarian', '00:45:00'),
(56, 'Beef Fillet with Red Wine Sauce', 'https://assets.farmison.com/images/recipe-detail-1380/66754-red-wine-sauce.jpg', 'Beef Fillet, Red Wine, Onions', 'Steak Master', 'Sear beef fillet. Make red wine sauce. Serve beef with sauce and caramelized onions.', '5', 'Tender beef fillet with a rich red wine sauce and caramelized onions.', '750', 'Non-Vegetarian', '00:30:00'),
(57, 'Mushroom Risotto', 'https://www.allrecipes.com/thmb/854efwMYEwilYjKr0FiF4FkwBvM=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/85389-gourmet-mushroom-risotto-DDMFS-4x3-a8a80a8deb064c6a8f15452b808a0258.jpg', 'Arborio Rice, Mushrooms, Parmesan', 'Risotto Chef', 'Sauté mushrooms and rice. Add broth gradually. Stir until creamy. Top with Parmesan.', '5', 'Creamy mushroom risotto with Arborio rice, mushrooms, and Parmesan.', '500', 'Vegetarian', '00:50:00'),
(58, 'Greek Salad', 'https://www.modernhoney.com/wp-content/uploads/2023/03/Greek-Salad-2-720x933.jpg', 'Cucumbers, Tomatoes, Feta, Olives', 'Greek Cuisine Expert', 'Chop cucumbers, tomatoes, and olives. Crumble feta on top. Drizzle with olive oil.', '4', 'Greek salad with cucumbers, tomatoes, feta, and olives.', '350', 'Vegetarian', '00:15:00'),
(59, 'Teriyaki Tofu Bowl', 'https://www.healthygffamily.com/wp-content/uploads/2018/10/2BB25CB0-4E42-433D-AA93-A0FB91828784.jpg', 'Tofu, Rice, Teriyaki Sauce, Vegetables', 'Tofu Master', 'Cube tofu. Sauté with vegetables. Pour teriyaki sauce. Serve over rice.', '4', 'Teriyaki tofu bowl with tofu, rice, and a savory teriyaki sauce.', '400', 'Vegan', '00:20:00'),
(60, 'Shrimp Scampi', 'https://www.aquastar.com/wp-content/uploads/2018/12/Lemon_Garlic_SH_Pasta-770x450.jpg', 'Shrimp, Garlic, Lemon, Pasta', 'Seafood Maestro', 'Sauté shrimp, garlic, and lemon. Toss with cooked pasta. Garnish with parsley.', '5', 'Shrimp scampi with succulent shrimp, garlic, lemon, and pasta.', '600', 'Non-Vegetarian', '00:40:00'),
(61, 'Eggplant Parmesan', 'https://familystylefood.com/wp-content/uploads/2017/10/baked-eggplant-mozzarella-familystylefood.jpg', 'Eggplant, Tomato Sauce, Mozzarella', 'Vegetarian Delight Chef', 'Bread and fry eggplant slices. Layer with tomato sauce and mozzarella. Bake until bubbly.', '5', 'Eggplant parmesan with breaded and fried eggplant slices, tomato sauce, and mozzarella.', '550', 'Vegetarian', '00:25:00');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `meal`
--
ALTER TABLE `meal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
