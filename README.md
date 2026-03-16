#  Dashboard Admin ALTIMANCE

Aperçu : https://altimance.netlify.app/

## Vue d'Ensemble

Système de gestion complet pour le site ALTIMANCE avec backend Node.js, base de données SQLite et interface d'administration moderne.

##  Fonctionnalités

### Backend
-  API REST complète
-  Base de données SQLite
-  Authentification JWT
-  Protection des routes admin
-  CORS activé

### Dashboard Admin
-  Connexion sécurisée
-  Statistiques en temps réel
-  Graphiques (Chart.js)
-  Gestion des contacts
-  Gestion des candidatures
-  Modification des statuts
-  Suppression des données

### Intégration Frontend
-  Formulaires connectés à l'API
-  Validation côté client
-  Notifications de succès/erreur
-  Envoi automatique vers base de données

##  Prérequis

- Node.js (version 14 ou supérieure)
- npm (inclus avec Node.js)
- Navigateur web moderne

##  Installation

### 1. Installer les dépendances

```powershell
cd C:\Users\hp\Downloads\altimance
npm install
```

Cette commande installera :
- express
- sqlite3
- bcryptjs
- jsonwebtoken
- cors
- body-parser
- dotenv

### 2. Démarrer le serveur

```powershell
npm start
```

Ou en mode développement avec auto-reload :

```powershell
npm run dev
```

Le serveur démarrera sur `http://localhost:3000`

##  Utilisation

### Accès au Dashboard

1. Ouvrir le navigateur
2. Aller sur `http://localhost:3000/admin`
3. Se connecter avec les identifiants par défaut :
   - **Username:** admin
   - **Password:** admin123

### Sections du Dashboard

####  Tableau de Bord
- Vue d'ensemble avec 4 statistiques principales
- Graphiques circulaires pour contacts et candidatures
- Actualisation automatique toutes les 30 secondes

####  Contacts
- Liste de tous les messages reçus
- Modification des statuts (Nouveau, En cours, Traité)
- Visualisation du message complet
- Suppression des contacts

####  Candidatures
- Liste de toutes les candidatures
- Modification des statuts (En attente, Accepté, Refusé)
- Visualisation de la lettre de motivation
- Suppression des candidatures

### Depuis le Site Web

#### Formulaire de Contact (contactus.html)
1. Remplir le formulaire
2. Cliquer sur "Envoyer"
3. Le message est automatiquement enregistré dans la base de données
4. Visible immédiatement dans le dashboard admin

#### Formulaire de Candidature (careers.html)
1. Remplir le formulaire de candidature
2. Cliquer sur "Envoyer ma Candidature"
3. La candidature est enregistrée dans la base de données
4. Visible dans l'onglet "Candidatures" du dashboard

##  Structure de la Base de Données

### Table: users
- id (PRIMARY KEY)
- username
- email
- password (hashé avec bcrypt)
- role
- created_at

### Table: contacts
- id (PRIMARY KEY)
- full_name
- email
- company
- subject
- message
- status (nouveau, en_cours, traite)
- created_at

### Table: applications
- id (PRIMARY KEY)
- first_name
- last_name
- email
- phone
- position
- message
- cv_path
- status (en_attente, accepte, refuse)
- created_at

##  Sécurité

- Mots de passe hashés avec bcrypt
- Authentification par JWT
- Tokens expiration 24h
- Protection des routes admin
- Validation côté serveur

##  Fichiers Créés

### Backend
- `server.js` - Serveur Express avec API REST
- `package.json` - Dépendances npm
- `.env` - Variables d'environnement
- `altimance.db` - Base de données SQLite (créée automatiquement)

### Frontend Admin
- `login.html` - Page de connexion
- `admin.html` - Interface dashboard
- `admin.js` - Logique JavaScript du dashboard

### Intégration
- `api-integration.js` - Connecte les formulaires à l'API

##  Endpoints API

### Authentication
- `POST /api/auth/login` - Connexion
- `GET /api/auth/verify` - Vérifier le token

### Contacts
- `POST /api/contacts` - Créer un contact
- `GET /api/contacts` - Récupérer tous les contacts (admin)
- `PATCH /api/contacts/:id` - Modifier le statut
- `DELETE /api/contacts/:id` - Supprimer un contact

### Candidatures
- `POST /api/applications` - Créer une candidature
- `GET /api/applications` - Récupérer toutes les candidatures (admin)
- `PATCH /api/applications/:id` - Modifier le statut
- `DELETE /api/applications/:id` - Supprimer une candidature

### Statistiques
- `GET /api/stats` - Récupérer les statistiques (admin)

##  Configuration

### Modifier le port

Dans `.env`:
```
PORT=3000
```

### Changer le secret JWT

Dans `.env`:
```
JWT_SECRET=votre_nouveau_secret_tres_securise
```

### Créer un nouvel administrateur

1. Hasher votre mot de passe avec bcrypt
2. Ajouter dans la base de données :

```sql
INSERT INTO users (username, email, password, role) 
VALUES ('nouveauadmin', 'admin@example.com', 'hash_du_password', 'admin');
```

##  Dépannage

### Le serveur ne démarre pas
- Vérifier que Node.js est installé : `node --version`
- Vérifier que les dépendances sont installées : `npm install`
- Vérifier qu'aucun autre processus n'utilise le port 3000

### Impossible de se connecter
- Utiliser les identifiants par défaut : admin / admin123
- Vérifier que le serveur est démarré
- Ouvrir la console navigateur (F12) pour voir les erreurs

### Les formulaires n'envoient pas les données
- Vérifier que le serveur est démarré sur le port 3000
- Ouvrir la console navigateur (F12) pour voir les erreurs
- Vérifier que l'URL de l'API est correcte dans `api-integration.js`

### Erreur CORS
- Le serveur a CORS activé par défaut
- Si problème persiste, vérifier la configuration dans `server.js`

##  Exemple de Flux de Travail

1. **Utilisateur remplit le formulaire de contact**
   → Données envoyées vers `/api/contacts`
   → Enregistrement dans la base de données
   → Confirmation affichée à l'utilisateur

2. **Admin se connecte**
   → Authentification via `/api/auth/login`
   → Récupération du token JWT
   → Redirection vers le dashboard

3. **Admin consulte les contacts**
   → Requête GET `/api/contacts` avec token
   → Affichage dans le tableau
   → Possibilité de modifier le statut ou supprimer

##  Personnalisation

### Modifier les statuts disponibles

Dans `server.js`, modifier les valeurs par défaut :
```javascript
status TEXT DEFAULT 'votre_statut'
```

Dans `admin.js`, modifier les options des select :
```javascript
<option value="votre_statut">Votre Statut</option>
```

##  Améliorations Futures

- [ ] Upload de CV pour les candidatures
- [ ] Export des données en CSV/Excel
- [ ] Système d'emails automatiques
- [ ] Notifications en temps réel (WebSocket)
- [ ] Recherche et filtres avancés
- [ ] Pagination des résultats
- [ ] Gestion multi-utilisateurs avec rôles
- [ ] Logs d'activité admin

##  Licence

© 2025 ALTIMANCE - Tous droits réservés

## 👥 Support

Pour toute question ou problème :
- Email: djomatinahochristian@gmail.com
- Documentation: Ce fichier README.md

---
