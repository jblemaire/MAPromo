/**
1 - Faire afficher pour les magasins de Gap : le nom du magasin, son type, sa catégorie, le nom et prénom du responsable
 */

SELECT m.nomMagasin, t.libType, c.libCategorie, r.nomResponsable, r.prenomResponsable
FROM magasin m
NATURAL  JOIN type t, responsable r
LEFT JOIN categorie c ON m.idCategorie = c.idCategorie
WHERE m.codeINSEEVille IN (SELECT v.codeINSEEVille FROM ville v WHERE v.nomVille = 'Gap')

/**
 2 - Faire afficher les noms et adresse des magasins de Gap de type Bar. La liste sera trié par nom croissant
 */
SELECT m.nomMagasin, m.adresse1Magasin, m.adresse2Magasin, v.cpVille, v.nomVille
FROM magasin m
NATURAL JOIN ville v
WHERE m.idType IN (SELECT t.idType FROM type t WHERE t.libType = 'Bar')
AND v.nomVille = 'Gap'
ORDER BY m.nomMagasin

/**
 3 - Faire afficher le nom des catégorie pour le type de Bar
 */
SELECT c.libCategorie
FROM categorie c
NATURAL JOIN type t
WHERE t.libType = 'Bar'
