# Analyse du Comportement Client sur une Plateforme E-commerce

Ce projet a pour objectif d'analyser le comportement des clients et les tendances de ventes sur une plateforme e-commerce française de C2C (consumer-to-consumer) spécialisée dans la mode. L'analyse est réalisée via une application web interactive qui s'appuie sur une API Flask pour les calculs statistiques.

**Source des données :** [E-Commerce Users of a French C2C Fashion Store (Kaggle)](https://www.kaggle.com/datasets/jmmvutu/ecommerce-users-of-a-french-c2c-fashion-store)

## Technologies Utilisées

- **Backend :** Python, Flask, Pandas, SciPy
- **Frontend :** HTML, CSS, JavaScript
- **Base de données :** MySQL / MariaDB (via phpMyAdmin)

---

## Guide d'Installation et de Lancement

Suivez ces étapes pour configurer et lancer le projet sur votre machine locale.

### 1. Prérequis

- **Python 3 :** Assurez-vous que Python 3 est installé sur votre système.
- **Serveur de base de données :** Un serveur comme WAMP, MAMP, XAMPP ou autre, avec **phpMyAdmin** fonctionnel.

### 2. Configuration de la Base de Données

1.  Démarrez votre serveur Apache et MySQL.
2.  Ouvrez **phpMyAdmin**.
3.  Créez une nouvelle base de données (par exemple, `datamoodbd`).
4.  Sélectionnez la base de données que vous venez de créer, puis allez dans l'onglet **Importer**.
5.  Importez le fichier `datamoodbd.sql` fourni dans le projet.

### 3. Configuration de l'Environnement Python

Ouvrez un terminal dans le répertoire racine du projet (`gestion_projet_L3_miashs`).

**a. Créez un environnement virtuel :**
```bash
python -m venv .venv
```

**b. Activez l'environnement virtuel :**

-   **Sur Windows (Invite de commandes / PowerShell) :**
    ```cmd
    .venv\Scripts\activate
    ```
-   **Sur macOS / Linux :**
    ```bash
    source .venv/bin/activate
    ```
*(Une fois activé, le nom de l'environnement `(.venv)` devrait apparaître au début de la ligne de votre terminal.)*

**c. Installez les dépendances :**
Naviguez dans le dossier `dataMood` et installez les paquets requis.
```bash
cd dataMood
pip install -r requirements.txt
cd ..
```

### 4. Lancement de l'Application

**a. Démarrez le serveur API :**
Assurez-vous que l'environnement virtuel est toujours activé.
```bash
python dataMood/exploitation_data/api_server.py
```
Le terminal devrait indiquer que le serveur est en cours d'exécution (`Running on http://127.0.0.1:5000`).

**b. Ouvrez le site web :**
Naviguez vers le dossier `dataMood/exploitation_data/web` et ouvrez le fichier `index.html` dans votre navigateur web. L'application est maintenant prête à être utilisée.
