-- Insertion des agences à partir du fichier agences.txt
INSERT INTO `agences` (`ville`) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');

-- Insertion des utilisateurs
-- Mot de passe pour tous les utilisateurs : 'password'
INSERT INTO `utilisateurs` (`nom`, `prenom`, `email`, `telephone`, `mot_de_passe`, `role`) VALUES
-- Utilisateurs par défaut pour les tests
('Admin', 'Super', 'admin@klaxon.com', '0102030405', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'admin'),
('Dupont', 'Jean', 'jean.dupont@klaxon.com', '0607080910', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
-- Utilisateurs importés depuis le fichier users.txt
('Martin', 'Alexandre', 'alexandre.martin@email.fr', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Dubois', 'Sophie', 'sophie.dubois@email.fr', '0698765432', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Bernard', 'Julien', 'julien.bernard@email.fr', '0622446688', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Moreau', 'Camille', 'camille.moreau@email.fr', '0611223344', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Lefèvre', 'Lucie', 'lucie.lefevre@email.fr', '0777889900', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Leroy', 'Thomas', 'thomas.leroy@email.fr', '0655443322', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Roux', 'Chloé', 'chloe.roux@email.fr', '0633221199', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Petit', 'Maxime', 'maxime.petit@email.fr', '0766778899', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Garnier', 'Laura', 'laura.garnier@email.fr', '0688776655', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Dupuis', 'Antoine', 'antoine.dupuis@email.fr', '0744556677', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Lefebvre', 'Emma', 'emma.lefebvre@email.fr', '0699887766', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Fontaine', 'Louis', 'louis.fontaine@email.fr', '0655667788', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Chevalier', 'Clara', 'clara.chevalier@email.fr', '0788990011', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Robin', 'Nicolas', 'nicolas.robin@email.fr', '0644332211', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Gauthier', 'Marine', 'marine.gauthier@email.fr', '0677889922', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Fournier', 'Pierre', 'pierre.fournier@email.fr', '0722334455', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Girard', 'Sarah', 'sarah.girard@email.fr', '0688665544', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Lambert', 'Hugo', 'hugo.lambert@email.fr', '0611223366', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Masson', 'Julie', 'julie.masson@email.fr', '0733445566', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur'),
('Henry', 'Arthur', 'arthur.henry@email.fr', '0666554433', '$2y$10$IcLNo6n1z62Gi0NJYI17LOtqTCmfGmz5t2sKGpK9Ip3YnWc2XL55e', 'utilisateur');

-- Insertion de quelques trajets
INSERT INTO `trajets` (`date_heure_depart`, `date_heure_arrivee`, `places_total`, `places_disponibles`, `id_utilisateur_auteur`, `id_agence_depart`, `id_agence_arrivee`) VALUES
-- Un trajet futur avec des places (Auteur: Jean Dupont, Départ: Paris, Arrivée: Lyon)
('2025-09-10 08:00:00', '2025-09-10 12:00:00', 3, 2, 2, 1, 2),
-- Un autre trajet futur (Auteur: Jean Dupont, Départ: Lille, Arrivée: Paris)
('2025-09-12 14:00:00', '2025-09-12 18:00:00', 4, 4, 2, 10, 1),
-- Un trajet complet (0 places) (Auteur: Admin, Départ: Lyon, Arrivée: Bordeaux)
('2025-09-15 09:00:00', '2025-09-15 17:00:00', 2, 0, 1, 2, 9),
-- Un trajet passé (ne doit pas s'afficher) (Auteur: Admin, Départ: Marseille, Arrivée: Paris)
('2024-08-01 10:00:00', '2024-08-01 14:00:00', 3, 3, 1, 3, 1);