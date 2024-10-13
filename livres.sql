-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 26 oct. 2023 à 11:36
-- Version du serveur : 8.0.31
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `biblio_2023w36`
--

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `resume` text,
  `date_parution` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `resume`, `date_parution`) VALUES
(1, 'Motivation et autodiscipline', 'Il vous arrive souvent de laisser tomber les choses à mi-chemin ? De vous sentir démotivé, triste et même désespéré ? D\'avoir peur de commettre des erreurs ? Pas de stress : ce livre vous aidera à construire une motivation et une autodiscipline solides comme un roc. La chance est au bout de l\'effort constant.\r\nMartin Gautier vous propose de découvrir ce qui se cache derrière les mots \"autodiscipline\" et \"motivation\", deux choses indispensables pour la réussite personnelle et professionnelle. Quoi qu\'on dise, être motivé et discipliné n\'est pas une aptitude innée, mais une série des habitudes qui s\'apprennent. Chaque personne peut les développer afin de rendre sa vie plus efficace et heureuse.\r\nPendant la lecture de ce livre vous découvriez :\r\n- Comment déterminer vos véritables priorités et désirs ;\r\n- Pourquoi il est important d\'avoir une vision globale claire ;\r\n- Comment apprivoiser vos peurs ;\r\n- Quelles sont les habitudes les plus importantes pour s\'épanouir ;\r\n- Comment devenir maître de votre temps ;\r\nEt beaucoup plus encore !\r\nCet ouvrage vous propose une méthode simple et efficace qui vous permettra d\'élaborer votre plan vers la réussite. De simples exercices quotidiens vous aideront à acquérir toutes les compétences nécessaires pour réussir étape par étape.\r\nCommencez dès maintenant pour assurer un avenir exceptionnel !', '2023-01-19'),
(2, 'Le petit livre rouge', 'Dans un discours de 1962, Mao Zedong déclare que « lire une phrase du président Mao chaque jour, c’est comme rencontrer le président en personne chaque jour ». Dès lors, tous les quotidiens du pays prennent l’habitude d’accompagner chacun de leurs articles d’une citation de Mao3.\r\n\r\n\r\nLe « petit livre » de Mao, version originale (vinyle) française (1966). (95x134 mm) 352 p. 160 gr.\r\nMais rapidement se pose le problème de trouver suffisamment de citations, et aussi de ne faire aucune erreur de transcription (un directeur de journal risque dans ce cas d’être destitué de son poste)3.\r\n\r\nLe Quotidien de Tianjin élabore un premier recueil de citations extraites de discours de Mao. Le journal de l’Armée Populaire de Libération s’en procure une copie puis élabore son propre répertoire, en enrichissant celui du Quotidien de Tianjin. La pensée de Mao est progressivement organisée en chapitres (« Enquêtes et recherches », « La théorie et la pratique », « Le Parti », etc)3.\r\n\r\nÉmerge progressivement l’idée de publier ce recueil. Une première version voit le jour en 1964, avec 30 chapitres. Le ministre de la Défense Lin Biao, protégé de Mao, en rédige la préface. Ce livre de poche doit servir de guide et de source d\'inspiration à tous les membres de l\'armée. Ce premier tirage, dont environ 50 à 60 000 exemplaires furent imprimés, n\'était pas destiné à la vente mais devait servir de guide aux membres de l\'Armée populaire de libération. Le sinologue Michel Bonnin indique : « Il fallait redonner du moral à l’armée. La plupart des soldats étaient des paysans, le Petit Livre rouge devait donc être quelque chose de simple qui offre des solutions pour la vie quotidienne. C’est de l’idéologie appliquée »4.\r\n\r\nLe succès de l\'opération se traduit par la réimpression du livre dès février 1965 avec deux chapitres supplémentaires, puis quelques mois plus tard avec un 33e chapitre. Dans cette nouvelle version, la couverture blanche est remplacée par une couverture rouge écarlate, couleur qui fut ensuite conservée pour toutes les éditions ultérieures3.', '2023-09-19'),
(3, 'L\'attrape-cœurs ', 'Phénomène littéraire sans équivalent depuis les années 50, J. D. Salinger reste le plus mystérieux des écrivains contemporains, et son chef-d\'œuvre, \"L\'attrape-cœurs\", roman de l\'adolescence le plus lu du monde entier, est l\'histoire d\'une fugue, celle d\'un garçon de la bourgeoisie new-yorkaise chassé de son collège trois jours avant Noël, qui n\'ose pas rentrer chez lui et affronter ses parents. Trois jours de vagabondage et d\'aventures cocasses, sordides ou émouvantes, d\'incertitude et d\'anxiété, à la recherche de soi-même et des autres. L\'histoire éternelle d\'un gosse perdu qui cherche des raisons de vivre dans un monde hostile et corrompu.', '2022-05-24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
