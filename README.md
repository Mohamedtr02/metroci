Metro-CI
Description

Metro-CI est une application permettant aux utilisateurs de payer leur ticket pour le métro d’Abidjan. Le projet se compose de deux interfaces :

Interface PHP : permet à l’utilisateur d’acheter un ticket. Chaque ticket est associé à un code unique généré automatiquement et enregistré dans un fichier .txt au format JSON.

Interface Python (GUI) : permet de valider l’accès à la gare via une interface graphique développée avec Tkinter. Une fois le code du ticket validé, il est immédiatement supprimé de la base de données pour éviter toute réutilisation.

Fonctionnalités principales

Génération automatique d’un code unique pour chaque ticket.

Sauvegarde des tickets dans un fichier JSON.

Validation des tickets à l’entrée des gares via une interface graphique Python (Tkinter).

Suppression immédiate des tickets validés pour garantir un usage unique.

Interface simple pour les utilisateurs et le personnel de validation.

Technologies utilisées

PHP : génération du code unique et stockage JSON.

Python + Tkinter : interface graphique pour validation et suppression des tickets.

JSON / TXT : stockage des tickets.

HTML/CSS : interface utilisateur minimale pour le paiement du ticket.

Installation et utilisation

Cloner le projet

git clone <URL-du-projet>


Interface PHP (achat du ticket)

Placer les fichiers PHP sur un serveur local (XAMPP, WAMP, LAMP).

Accéder à l’interface via le navigateur : http://localhost/metro-ci/.

L’utilisateur peut acheter un ticket et obtenir un code unique.

Interface Python (validation du ticket)

Installer Python 3 si nécessaire.

Installer les dépendances :

pip install tk


Exécuter le script Python pour valider les tickets :

python validate_ticket.py


Utiliser l’interface Tkinter pour saisir le code du ticket. Après validation, le code est immédiatement supprimé du fichier JSON pour empêcher toute réutilisation.

Exemple d’utilisation

L’utilisateur achète un ticket via l’interface PHP → obtient un code unique : MT-20251016-001.

À l’entrée de la gare, le personnel saisit ce code dans l’interface Python → accès validé et le code est supprimé de la base de données.

Démo en ligne

Une version démo de l’interface de paiement est disponible ici :
👉 http://metro-ci.alwaysdata.net/

Licence

Ce projet est sous licence MIT.
