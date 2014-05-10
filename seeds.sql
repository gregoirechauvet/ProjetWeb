INSERT INTO Responsabilite(label, administrateur) VALUES
('Chef de choeur', 1),
('Choriste', 0);

INSERT INTO Utilisateur(identifiant, motdepasse, responsabilite_titre) VALUES
('Toto',			md5('azerty'), 1),
('Tata',			md5('azerty'), 1),
('Tutu',			md5('azerty'), 1),
('Titi',			md5('azerty'), 1),
('Totof',		md5('azerty'), 1),
('Machin',		md5('azerty'), 1),
('Truc',			md5('azerty'), 1),
('Bref',			md5('azerty'), 1),
('Jesaispas',	md5('azerty'), 1),
('Encore',		md5('azerty'), 2),
('Enfin',		md5('azerty'), 2),
('Toujours',	md5('azerty'), 2);

INSERT INTO Inscription(montant, annee) VALUES
(45, '2014'),
(50, '2014'),
(52, '2015');

INSERT INTO Choriste (prenom, nom, voix, ville, telephone, Utilisateur_login, Inscription_type) VALUES
('Ray',				'Charles',	'Basse',		'Grenoble',				'0612345678', 1,	1),
('Jerry',			'Kan', 		'Ténor',		'Aix-en-provence',	'0612345678', 2,	1),
('Al',				'Paccino', 	'Soprano',	'Kerpouic',				'0612345678', 3,	1),
('Marie',			'Curie', 	'Alto',		'Paris',					'0612345678', 4,	1),
('Firmin',			'Dupond',	'Basse',		'Manchester',			'0612345678', 5,	1),
('Jean-luc',		'Bidule',	'Basse',		'Oxford',				'0612345678', 6,	1),
('Jean-philippe',	'Maurice',	'Ténor',		'Narnia',				'0612345678', 7,	1),
('Samir',			'Ite',		'Soprano',	'Grenoble',				'0612345678', 8,	1),
('Sam',				'Sung', 		'Soprano',	'Grenoble',				'0612345678', 9,	1),
('Axel',				'Air', 		'Alto',		'Grenoble',				'0612345678', 10,	2),
('Kelly',			'Feller', 	'Alto',		'Grenoble',				'0612345678', 11,	2),
('Sarah',			'Courci',	'Ténor',		'Grenoble',				'0612345678', 12,	2);

INSERT INTO Evenement (type, heureDate, lieu, nom) VALUES
('Concert',		1396729574,	'Paris',			'Ouverture des Red Hot Chili Peppers'),
('Concert',		1394808581,	'San Francisco',	'Grammy Nominations Concert'),
('Concert',		1394808443,	'La Baule',			'Bal de Lan Bihoué'),
('Concert',		1394808450,	'Tokyo',			'こんにちは補正'),
('Concert',		1394808456,	'Milan',			'La foire'),
('Répétition',	1394808381,	'Bordeaux',			'La traviata'),
('Concert',		1394808477,	'Hong Kong',		'您好校正'),
('Concert',		1394808378,	'New York',			'Lac des cygnes'),
('Concert',		1394808310,	'Sydney',			'Boléro de Ravel'),
('Concert',		1394808584,	'Londres',			'Le misanthrope'),
('Répétition',	1394808600,	'Strasbourg',		'Thèmes de Rossini');

INSERT INTO Participe (idChoriste, idEvenement) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(1, 3),
(2, 3),
(3, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(6, 4),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(1, 5),
(2, 5),
(3, 5),
(4, 5),
(5, 5),
(6, 5),
(7, 6),
(8, 7),
(9, 7),
(10, 8),
(3, 9),
(11, 9),
(12, 9),
(5, 10),
(5, 11);

INSERT INTO Oeuvre (titre, auteur, partition) VALUES
('Hungarian Rhapsody',	'Franz Liszt',		'Book One'),
('Marche funèbre',		'Beethoven',		'Sonate n°4 #E'),
('Prealudio',			'Isaac Albeniz',	'Sonata'),
('Bohemian Rhapsody',	'Freddy Mercury',	'Live');

INSERT INTO Est_au_programme (Evenement_idEvenement, Oeuvre_idOeuvre) VALUES
(1, 1),
(2, 1);