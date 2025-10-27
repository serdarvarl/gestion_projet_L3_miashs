# Guide de collaboration d’équipe sur Git/GitHub

## 🎯 Objectif

* Garder la branche `main` **toujours stable**.
* Centraliser le développement sur `dev`.
* Chaque modification doit passer par une **Pull Request (PR)**, suivie d’une **revue** et, si nécessaire, d’un **test CI**.
* Historique propre grâce au **Squash merge**.

---

## 🌿 Modèle de branches

main  ←  dev  ←  feature/*
```

| Branche     | Rôle                                  | Dérivée de |
| ----------- | ------------------------------------- | ---------- |
| `main`      | version stable et déployée            | —          |
| `dev`       | zone d’intégration des développements | `main`     |
| `feature/*` | tâche ou fonctionnalité spécifique    | **`dev`**  |

**Convention de nommage :**

* `feature/login-page`, `feature/api-stats`, `fix/navbar-overflow`, `chore/ci-cache`

---

## ⚙️ Routine quotidienne

1. **Fetch/Pull** pour mettre `dev` à jour.
2. Créer une **nouvelle branche feature** à partir de `dev`.
3. Coder → **commit** (petits, clairs) → **push**.
4. Ouvrir une **Pull Request (PR)** avec **base: dev** → revue → **Squash & merge**.
5. En fin de sprint : **Pull Request (PR)** avec **base: main ← compare: dev** → merge → tag/release.

---

## 💻 Étapes avec GitHub Desktop

### A) Créer une branche feature

1. Passer sur **Current Branch → dev**.
2. **New Branch → Nom :** `feature/<tâche>` → **Based on : dev**.
3. **Create → Publish branch**.
4. Modifier le code → **Commit to feature/...** → **Push origin**.

### B) Ouvrir une Pull Request (PR) (feature → dev)

* Dans GitHub Desktop : **Create Pull Request**.
* Sur GitHub : **base: dev**, **compare: feature/...**.
* Titre : `feat: <courte description>`.
* Description :

  ```
  ## Changements effectués
  - ...
  ## Méthode de test
  - ...
  ```
* Ajouter un reviewer → tests OK → **Squash and merge** → **Delete branch**.

### C) Version finale (dev → main)

* GitHub → **New Pull Request (PR)**.
* **base: main ← compare: dev**.
* Vérification → **Squash and merge**.
* (Optionnel) **Tag** : `v1.0.0`.

---

## 📏 Règles d’équipe

* **Aucun push direct sur `main`** ; tout passe par une Pull Request (PR).
* Pas de merge local manuel : utiliser uniquement les Pull Requests (PR).
* Chaque Pull Request (PR) doit être approuvée par **au moins une personne**.
* Utiliser **Squash merge** pour un historique clair.
* Limiter une Pull Request (PR) à ~400 lignes modifiées.
* Format des commits : **Conventional Commits** → `feat: ...`, `fix: ...`, `docs: ...`, etc.

---

## 🔒 Paramètres du dépôt (admin)

**Settings → Branches → Add rule**

* Pour `main` (et éventuellement `dev`) :

  * ✅ Require pull request before merging
  * ✅ Require approvals (min. 1)
  * ✅ Require status checks to pass (CI)
  * ✅ Require linear history (squash/rebase)
  * ✅ Include administrators
  * ✅ Restrict who can push (optionnel)

**Settings → General → Pull Requests (PR)**

* ✅ Automatically delete head branches

---

## 📄 Modèles Pull Request (PR) et Issue

`.github/pull_request_template.md`

```md
## Changements
- ...
## Tests
- ...
## Issue liée
Closes #<id>
```

`.github/ISSUE_TEMPLATE/bug.md`

```md
---
name: Bug
labels: bug
---
**Comportement attendu / observé**
...
**Étapes de reproduction**
1. ...
**Capture d’écran / Log**
...
```

---

## 🔧 Gestion des conflits

**Objectif :** synchroniser une branche feature avec `dev`

```
Branch → Rebase current branch onto dev
# Résoudre les conflits → Mark as resolved → Commit → Push
```

> `--force` uniquement sur ta propre branche feature ; jamais sur `dev` ou `main`.

---

## 🧹 Nettoyage

* Les branches feature sont supprimées automatiquement après merge.
* De temps en temps :

  ```
  git fetch --prune
  git remote prune origin
  ```

---

## 🚨 Erreurs fréquentes

| Problème                                              | Solution                                                      |
| ----------------------------------------------------- | ------------------------------------------------------------- |
| Pull Request (PR) fusionnée mais pas visible sur main | Mauvaise base. Crée une nouvelle PR : base=main ← compare=dev |
| Mot de passe refusé lors du push                      | Utiliser un Personal Access Token (PAT).                      |
| Message « Publish branch » au lieu de « Push origin » | Première publication de la branche : normal.                  |
| Merge local effectué sans PR                          | Éviter : toujours passer par une Pull Request (PR).           |

---

## 👋 Intégration d’un nouveau membre

1. Cloner le dépôt (GitHub Desktop).
2. **Current Branch → dev → Fetch/Pull.**
3. **New Branch → `feature/<tâche>` → Based on: dev.**
4. Coder → **Commit & Push.**
5. **Créer une Pull Request (PR)** → **base: dev** → revue et merge.

---

## 🧠 Résumé

* Les features se basent sur `dev` ; Pull Request (PR) vers `dev`.
* Version finale : Pull Request (PR) base=`main` ← compare=`dev`.
* **Squash merge** + suppression auto des branches.
* Aucun push direct sur `main`.
