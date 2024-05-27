
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nomCategorie` varchar(150) DEFAULT NULL,
  `categorieCapture` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `clients` (
  `id_client` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `prenom` varchar(200) DEFAULT NULL,
  `nom` varchar(200) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `tel` varchar(200) DEFAULT NULL,
  `rfc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `nom` varchar(500) DEFAULT NULL,
  `route` varchar(500) DEFAULT NULL,
  `imgCapture` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `produits` (
  `id_produit` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_image` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `qtd` int(11) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `produitCapture` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` tinytext DEFAULT NULL,
  `userCapture` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `ventes` (
  `id_ventes` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  `ventesCapture` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);


ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_client`);


ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);


ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_produit`);


ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);


ALTER TABLE `categories`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `produits`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

