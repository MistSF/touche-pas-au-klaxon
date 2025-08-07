-- Table pour les agences (villes)
CREATE TABLE `agences` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `ville` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table pour les utilisateurs
CREATE TABLE `utilisateurs` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nom` VARCHAR(255) NOT NULL,
  `prenom` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `telephone` VARCHAR(20) DEFAULT NULL,
  `mot_de_passe` VARCHAR(255) NOT NULL,
  `role` ENUM('utilisateur', 'admin') NOT NULL DEFAULT 'utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table pour les trajets
CREATE TABLE `trajets` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `date_heure_depart` DATETIME NOT NULL,
  `date_heure_arrivee` DATETIME NOT NULL,
  `places_total` INT NOT NULL,
  `places_disponibles` INT NOT NULL,
  `id_utilisateur_auteur` INT NOT NULL,
  `id_agence_depart` INT NOT NULL,
  `id_agence_arrivee` INT NOT NULL,
  FOREIGN KEY (`id_utilisateur_auteur`) REFERENCES `utilisateurs`(`id`),
  FOREIGN KEY (`id_agence_depart`) REFERENCES `agences`(`id`),
  FOREIGN KEY (`id_agence_arrivee`) REFERENCES `agences`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
