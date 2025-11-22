# dataMood

Projet de visualisation de données avec Python (Flask) et JavaScript.

## Manuel d'installation et de démarrage

Suivez ces étapes pour configurer et lancer le projet sur votre machine locale.

### 1. Prérequis

Assurez-vous que Python 3 est installé sur votre système.

### 2. Installation de l'environnement virtuel

Ouvrez un terminal dans le répertoire `dataMood` et suivez les commandes ci-dessous.

**a. Créez un environnement virtuel :**
```bash
python -m venv .venv
```

**b. Activez l'environnement virtuel :**

*   **Sur Windows (Invite de commandes ou PowerShell) :**
    ```cmd
    .venv\Scripts\activate
    ```

*   **Sur macOS / Linux :**
    ```bash
    source .venv/bin/activate
    ```
    *(Une fois activé, le nom de l'environnement `(.venv)` devrait apparaître au début de la ligne de votre terminal.)*

**c. Installez les dépendances :**
```bash
pip install -r requirements.txt
```

### 3. Lancement du projet

Une fois l'environnement configuré, vous pouvez démarrer le serveur et accéder à l'application.

**a. Démarrez le serveur API :**
Assurez-vous que votre base de données (phpMyAdmin) est active, puis lancez le serveur Flask.
```bash
python exploitation_data/api_server.py
```
Le terminal devrait indiquer que le serveur est en cours d'exécution ("Running on http://...").

**b. Ouvrez le site web :**
Naviguez vers le dossier `exploitation_data/web` et ouvrez le fichier `index.html` dans votre navigateur web.

### requirements

```bash

    python -m venv .venv

    source .venv/bin/activate (Aktifleştir)


    pip install -r requirements.txt
```



blinker==1.9.0
click==8.3.0
contourpy==1.3.3
cycler==0.12.1
Flask==3.1.2
fonttools==4.60.1
itsdangerous==2.2.0
Jinja2==3.1.6
kiwisolver==1.4.9
MarkupSafe==3.0.3
matplotlib==3.10.7
numpy==2.3.4
packaging==25.0
pandas==2.3.3
pillow==12.0.0
pyparsing==3.2.5
python-dateutil==2.9.0.post0
pytz==2025.2
scipy==1.16.3
six==1.17.0
tzdata==2025.2
Werkzeug==3.1.3
