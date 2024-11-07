# IUT Nancy-Charlemagne BUT Informatique S3
## SAE « Développer une application web sécurisée »

# Sujet de Développement Web

## Objectif
L'objectif de la SAE est de développer une application web utilisant une base de données, en assurant notamment la sécurité et en produisant une vidéo de démonstration en anglais. Cette SAE permet de mettre en application des connaissances et des techniques issues de la programmation web, des bases de données, de la cryptographie et de l'anglais.

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

## Sujet : Projet de Développement Web
### Le rendu attendu
- Un dépôt git public contenant le code complet du projet, finalisé au plus tard le vendredi 15 novembre à 20h (date du dernier commit-push autorisé),
- L’application installée et opérationnelle sur le serveur https://webetu.iutnc.univ-lorraine.fr, rendue disponible au plus tard le lundi 18 novembre à 20h.
- Un document déposé au plus tard le vendredi 15 novembre à 20h dans l’espace Arche prévu à cet effet précisant :
  - Les noms des membres du groupe,
  - Un tableau de bord du projet indiquant la liste des fonctionnalités réalisées et les contributions de chaque membre du groupe,
  - Toutes les données utiles ou nécessaires au test de l’application, notamment les identifiants/mots de passe d’utilisateurs de test.
  - L’url du dépôt git
- Ce document doit être complété au plus tard le lundi 18 novembre avec l’URL de test de l’application sur le serveur webetu.

## Critères d’évaluation des projets
| Critères                | Description                                      | Poids |
|-------------------------|--------------------------------------------------|-------|
| Fonctionnalités         | Fonctionnalités implantées, opérationnelles, fiables | 30%   |
| Qualité du code         | Respect des principes de P.O., namespaces, autoload | 20%   |
| Architecture            | Accès aux données, dispatcher/action             | 20%   |
| Authentification, contrôle d’accès | Gestion sécurisée des mots de passe, authn/authz | 20%   |
| Sécurité                | Protection face aux risques d’injection          | 10%   |