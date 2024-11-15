# IUT Nancy-Charlemagne BUT Informatique S3


## SAE « Développer une application web sécurisée »

> ### 🙎Contributeurs
> - [NOEL Julien](https://github.com/juliennoel22)
> - [OUDER Nathan](https://github.com/vraiSlophil)
> - [DEFOLIE Julien](https://github.com/Kwilium54)
> - [FRANOUX Noé](https://github.com/SAKIROO)

# Sujet de Développement Web

## Objectif
L'objectif de la SAE est de développer une application web utilisant une base de données, en assurant notamment la sécurité et en produisant une vidéo de démonstration en anglais. Cette SAE permet de mettre en application des connaissances et des techniques issues de la programmation web, des bases de données, de la cryptographie et de l'anglais.


## Fonctionnalités

| Fonctionnalité                                              | Statut   | Responsable(s)                                  |
|-------------------------------------------------------------|----------|-------------------------------------------------|
| 1. Affichage de la liste des spectacles                      | ✅       | - [NOEL Julien](https://github.com/juliennoel22) |
| 2. Filtrage de la liste des spectacles par date              | ✅       | - [DEFOLIE Julien](https://github.com/Kwilium54) |
| 3. Filtrage de la liste des spectacles par style de musique  | ✅       | - [DEFOLIE Julien](https://github.com/Kwilium54) |
| 4. Filtrage de la liste des spectacles par lieu              | ✅       | - [DEFOLIE Julien](https://github.com/Kwilium54) |
| 5. Affichage détaillé d’un spectacle                         | ✅       | - [NOEL Julien](https://github.com/juliennoel22) |
| 6. Affichage du détail d’une soirée                          | ✅       | - [NOEL Julien](https://github.com/juliennoel22) |
| 7. En cliquant sur un spectacle, afficher le détail de la soirée correspondante | ✅ | - [NOEL Julien](https://github.com/juliennoel22) |
| 11. Ajouter un spectacle dans sa liste de préférence        | ✅       | - [DEFOLIE Julien](https://github.com/Kwilium54) |
| 12. Afficher sa liste de préférence                         | ✅       | - [DEFOLIE Julien](https://github.com/Kwilium54) |
| 13. S’authentifier                                           | ✅       | - [Nathan OUDER](https://github.com/vraiSlophil) |
| 14. Créer un spectacle                                       | ✅       | - [Nathan OUDER](https://github.com/vraiSlophil) |
| 15. Créer une soirée                                         | ✅       | - [Nathan OUDER](https://github.com/vraiSlophil) |
| 16. Ajouter un spectacle à une soirée                        | ✅       | - [Nathan OUDER](https://github.com/vraiSlophil) |
| 20. Créer un compte staff                                    | ✅       | - [Nathan OUDER](https://github.com/vraiSlophil) |

## Contexte général :
le festival NRV, Nancy Rock Vibration

NRV.net est l’application web permettant au grand public de consulter le programme du festival de musique Nancy Rock Vibration. L’application permet principalement de consulter et parcourir le programme du festival selon différents critères. L’application doit être utilisable de manière ergonomique sur tous types de supports (ordinateurs de bureau, ordinateurs portables, tablettes, téléphones).

Le festival propose des soirées composées de deux ou trois spectacles. Chaque soirée est organisée à une date unique et dans un lieu défini. Le festival se déroule sur une période de 2 semaines et occupe chaque soir 3 à 4 lieux. Les spectacles sont par ailleurs catégorisés selon le style de musique (classic rock, blues rock, metal, chanson …). Une soirée peut bien entendu regrouper des spectacles de différents styles.

## Les principaux cas d’usages
### A. Naviguer sur NRV.net
- Afficher le programme complet : liste complète des spectacles proposés
- Afficher le programme par journée
- Afficher le programme par lieu
- Afficher le programme par styles de musique

### B. Afficher un spectacle
- Affichage détaillé d’un spectacle : titre, artiste, durées, style, description, extrait vidéo et/ou audio
- Affichage des spectacles prévus dans la même soirée
- Accès aux spectacles prévus sur le même lieu
- Accès aux spectacles du même style

### C. Alimenter le programme 
- S’authentifier en tant que membre du staff du festival
- Gérer le programme : créer des spectacles et des soirées
- Gérer le programme : modifier des spectacles et des soirées
- Gérer le programme : annuler un spectacle

### D. Expérience utilisateur
- Ajouter un spectacle dans sa liste de préférences
- Afficher sa liste de préférences

## Critères d’évaluation du projet
| Critères                | Description                                      | Poids |
|-------------------------|--------------------------------------------------|-------|
| Fonctionnalités         | Fonctionnalités implantées, opérationnelles, fiables | 30%   |
| Qualité du code         | Respect des principes de P.O., namespaces, autoload | 20%   |
| Architecture            | Accès aux données, dispatcher/action             | 20%   |
| Authentification, contrôle d’accès | Gestion sécurisée des mots de passe, authn/authz | 20%   |
| Sécurité                | Protection face aux risques d’injection          | 10%   |
