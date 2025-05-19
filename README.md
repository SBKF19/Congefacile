# Installation :
### Version 8.2 de PHP, HTML 5, CSS, Javascript et MYSQL.
Il faut récuperer le fichier conge_facile.sql dans le dossier "includes" du projet et l'importer dans my sql dans une base de données nommée "conge_facile"


# Congefacile
Congefacile est un site qui permet de faciliter la gestion des congés au sein de l'entreprise.
Il existe 3 parties : 

## La connexion

![Capture d'écran 2025-05-17 180740](https://github.com/user-attachments/assets/63e456b3-4dac-4960-b493-0ddc366cfec4)

### Il faut se connecter avec son mail et son mot de passe.
### Il faut que son compte soit activé

![image](https://github.com/user-attachments/assets/12cb2c16-4d08-4f8c-86b2-01ce750b0f52)

### En cas d'oubli on peut faire une demande réinitialisation de mot de passe

![image](https://github.com/user-attachments/assets/c272627b-f562-4324-970a-06822532c53f)

Voici l'accueil du point de vu du :

## Collaborateur
![image](https://github.com/user-attachments/assets/3acde65a-e5ee-498b-827c-827208de0794)
![image](https://github.com/user-attachments/assets/b2fa54d9-7625-47f6-9345-d9f443bc2f43)

## Manager
![image](https://github.com/user-attachments/assets/4a6a3f60-1288-4936-a6aa-15511571d7bc)
![image](https://github.com/user-attachments/assets/81c4c763-3b6d-42b5-9271-04cb2045fbe2)

# Côté collaborateur
## Nouvelle demande : 
![image](https://github.com/user-attachments/assets/c6fe0cbf-ed8a-4499-b967-56fdf2f3349d)

### Seul le type de demande et la date de congés sont obligatoires : 
![image](https://github.com/user-attachments/assets/e13f4833-e704-4e5c-bfbd-1ce376ac67d2)

### La date doit être cohérente :
![image](https://github.com/user-attachments/assets/95f15a5a-268e-4237-8958-93006f9330b2)

### Le nombre de jours de congés est dynamiquement calculé
![image](https://github.com/user-attachments/assets/268188d9-e19e-466c-94f7-c0eac2c9a0df)

### Possibilité de rajouter un commentaire
![image](https://github.com/user-attachments/assets/c0685cfc-3c0c-4ee1-8dad-8eccbf68a14f)

## Historique des demandes :
### On y voit la date à laquelle la demande a été envoyée, le type, la durée de congés, le nombre de jours et le statut : en cours, refusé, validé
![image](https://github.com/user-attachments/assets/abf1c7de-299e-44c2-9063-8293c0369a6e)

### Filtre de recherche dynamique :
![image](https://github.com/user-attachments/assets/0660b51a-5451-43da-b2f7-fb4dc0f9936d)

### détails d'une demande
![Capture d'écran 2025-05-17 182815](https://github.com/user-attachments/assets/baee3c44-9205-47d0-9753-785aa93eda6f)

### On peut modifier une demande tant que le manager ne l'a pas traitée
![image](https://github.com/user-attachments/assets/6e27f3ff-fe8e-4150-8884-914f474cb9d3)

## Mes informations :
### Le collaborateur peut voir ses infos mais pas les modifier
![image](https://github.com/user-attachments/assets/a313e773-dae0-4f86-9b1b-3e172a798817)

### Il peut changer son mot de passe, le mot de passe doit être composé de 12 caractères, il faut 1 majuscule, 1 minuscule, 1 caractère spécial et 1 chiffre.
![image](https://github.com/user-attachments/assets/eca46848-ab69-4201-b8bc-81bc829d4d29)


# Côté Manager
## Demandes en attente :
![image](https://github.com/user-attachments/assets/50ca047e-faa7-438f-a51b-221911027cfd)

### Le manager possède un filtre similaire à l'historique de demandes, sauf qu'il peut filtrer les demandes en fonction du collaborateur
![image](https://github.com/user-attachments/assets/946c383c-5e1f-4fcd-a576-6985f224e478)

## Consulter une demande : 
![image](https://github.com/user-attachments/assets/ffacff79-56b1-4438-b828-2771271609a4)
### Le manager à l'option de laisser un commentaire, ensuite il doit soit refuser soit accepter la demande.
## Historique des demandes :
### Ici, seul les demandes refusée ou validée apparaissent
![image](https://github.com/user-attachments/assets/3881a843-e910-40c0-85d6-d1ade88b359a)

## Mes informations : 
### Le manager ne peut également pas modifier ses informations ici, uniquement le mot de passe
![image](https://github.com/user-attachments/assets/93370038-e5fd-47d1-856e-447a13ec2257)

## Mon équipe : 
### Le manager peut voir tous les collaborateurs de son équipe
![image](https://github.com/user-attachments/assets/139b7cf9-7c6b-4ebd-ad96-9913e0c3e7dd)



# L'administration
## Types de demandes :
### Les administrateurs peuvent consulter tous les types de demandes de congés existant ainsi que le nombre de personnes ayant demandé ce type de congé.
![image](https://github.com/user-attachments/assets/627979e0-d8d5-45e5-b07d-931b0d192ee1)
## Ajouter un type de demande :
![image](https://github.com/user-attachments/assets/88495d23-27a5-48a3-9c7d-9a23d61b20fa)
## Modifier un type de demande : 
![image](https://github.com/user-attachments/assets/829b7bf0-07b1-4154-ae0a-fc2a5b646ea3)
### Une confirmation est nécessaire avant de supprimer un type de demande 
![image](https://github.com/user-attachments/assets/6cb97ea7-4956-414d-885b-d1b5f6a56e7f)

## Types de postes :
### Les administrateurs peuvent consulter tous les types de postes existant ainsi que le nombre de personnes affectés à ce poste.
![image](https://github.com/user-attachments/assets/05370bc0-0076-4289-8e90-c17e899d6acd)
## Ajout de postes : 
![image](https://github.com/user-attachments/assets/f861ca77-f59f-434f-8588-6e5ecefa0c1d)
## Modifier un poste : 
![Capture d'écran 2025-05-17 185814](https://github.com/user-attachments/assets/721f70ba-7cc9-453e-81d0-043632223b1d)
![Capture d'écran 2025-05-17 185819](https://github.com/user-attachments/assets/13217c6b-f349-420d-93a8-9a26288f060c)
