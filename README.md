# Gestion de Produits - Application Laravel

Une application web moderne pour la gestion de produits et de catégories, avec un design adaptatif et une API RESTful sécurisée avec Laravel Sanctum.

## Prérequis

- PHP 8.1 ou supérieur
- Composer
- MySQL ou autre base de données compatible avec Laravel
- Node.js et NPM

## Installation

### 1. Cloner le dépôt

```bash
git clone https://gitlab.com/ynnotjoh/gestion-produit.git
cd gestion-produits
```

### 2. Installer les dépendances

```bash
# Installer les dépendances PHP
composer install

# Installer les dépendances JavaScript
npm install
```

### 3. Configuration de l'environnement

```bash
# Copier le fichier d'environnement
cp .env.example .env

# Générer la clé d'application
php artisan key:generate
```

Ouvrez le fichier `.env` et configurez votre connexion à la base de données.

### 4. Préparer la base de données

```bash
# Exécuter les migrations et les seeders
php artisan migrate --seed
```

### 5. Compiler les assets

```bash
# Mode développement
npm run dev

# Ou pour la production
npm run build
```

### 6. Démarrer le serveur

```bash
php artisan serve
```

L'application est maintenant accessible à l'adresse http://localhost:8000

## Comptes de test

Les seeders créent automatiquement deux utilisateurs :

| Type        | Email              | Mot de passe | Accès                                 |
|-------------|-------------------|--------------|---------------------------------------|
| Admin       | admin@example.com  | password     | Toutes les fonctionnalités + API     |
| Utilisateur | user@example.com   | password     | Visualisation uniquement             |

## API RESTful - Guide d'utilisation

L'application fournit une API RESTful sécurisée avec Laravel Sanctum. Voici comment l'utiliser :

### 1. Authentification - Obtenir un token

Pour utiliser l'API, vous devez d'abord obtenir un token d'authentification (seuls les comptes admin peuvent utiliser l'API) :

```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"email":"admin@example.com","password":"password","device_name":"my-device"}'
```

**Réponse :**

```json
{
  "token": "1|VOTRE_TOKEN_SECRET",
  "user": {
    "id": 1,
    "name": "Admin",
    "email": "admin@example.com",
    "type": "admin"
  }
}
```

### 2. Récupérer la liste des produits

```bash
curl -X GET http://localhost:8000/api/admin/produits \
  -H "Authorization: Bearer VOTRE_TOKEN" \
  -H "Accept: application/json"
```

### 3. Créer un nouveau produit

```bash
curl -X POST http://localhost:8000/api/produits/create \
  -H "Authorization: Bearer VOTRE_TOKEN" \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "name": "Nouveau Produit",
    "description": "Description du produit",
    "price": 99.99,
    "stock_quantity": 50,
    "category_id": 1
  }'
```

### 4. Révoquer le token (déconnexion)

```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Authorization: Bearer VOTRE_TOKEN" \
  -H "Accept: application/json"
```

## Tests avec Postman

Pour tester l'API facilement avec Postman :

### Configurez votre environnement

- Créez une variable `base_url` avec la valeur `http://localhost:8000`
- Créez une variable `token` qui sera mise à jour automatiquement

### Requête d'authentification

- **Type:** POST
- **URL:** `{{base_url}}/api/login`
- **Headers:**
  ```
  Content-Type: application/json
  Accept: application/json
  ```
- **Body (raw JSON):**
  ```json
  {
      "email": "admin@example.com",
      "password": "password",
      "device_name": "postman"
  }
  ```
- **Tests script pour capturer le token:**
  ```javascript
  var jsonData = pm.response.json();
  if (jsonData.token) {
      pm.environment.set("token", jsonData.token);
  }
  ```

### Liste des produits

- **Type:** GET
- **URL:** `{{base_url}}/api/admin/produits`
- **Headers:**
  ```
  Authorization: Bearer {{token}}
  Accept: application/json
  ```

### Création d'un produit

- **Type:** POST
- **URL:** `{{base_url}}/api/produits/create`
- **Headers:**
  ```
  Authorization: Bearer {{token}}
  Content-Type: application/json
  Accept: application/json
  ```
- **Body (raw JSON):**
  ```json
  {
      "name": "Produit Test",
      "description": "Produit créé via l'API",
      "price": 149.99,
      "stock_quantity": 25,
      "category_id": 1
  }
  ```

### Déconnexion

- **Type:** POST
- **URL:** `{{base_url}}/api/logout`
- **Headers:**
  ```
  Authorization: Bearer {{token}}
  Accept: application/json
  ```

## Dépannage

### Les migrations échouent
- Vérifiez les informations de connexion à la base de données
- Assurez-vous que l'utilisateur de la base de données a les droits nécessaires

### Problèmes d'authentification API
- Vérifiez que vous utilisez un compte administrateur
- Assurez-vous d'inclure le préfixe "Bearer " avant le token
- Vérifiez que Sanctum est correctement configuré dans votre fichier `.env`

## Licence

Ce projet est sous licence MIT.

---

