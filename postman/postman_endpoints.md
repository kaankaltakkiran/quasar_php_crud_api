# Postman API Endpointleri ve Örnekleri

Aşağıda, Postman ile test edebileceğiniz tüm endpointler ve örnek istekler yer almaktadır.

---

## 1. Tüm Kullanıcıları Listele (GET)

- **Yöntem:** GET
- **URL:** `http://localhost/quasar_crud_api/users.php`
- **Body:** Yok

---

## 2. Yeni Kullanıcı Ekle (POST)

- **Yöntem:** POST
- **URL:** `http://localhost/quasar_crud_api/users.php`
- **Headers:**
  - Content-Type: application/json
- **Body (raw/JSON):**

```json
{
  "name": "Ali Veli",
  "email": "ali.veli@example.com",
  "password": "123456"
}
```

---

## 3. Kullanıcı Güncelle (PUT)

- **Yöntem:** PUT
- **URL:** `http://localhost/quasar_crud_api/users.php`
- **Headers:**
  - Content-Type: application/json
- **Body (raw/JSON):**

```json
{
  "id": 1,
  "name": "Ali Veli Güncel",
  "email": "ali.veli@example.com"
}
```

---

## 4. Kullanıcı Sil (DELETE)

- **Yöntem:** DELETE
- **URL:** `http://localhost/quasar_crud_api/users.php?id=1`
- **Body:** Yok

---

## 5. (Opsiyonel) CORS Preflight (OPTIONS)

- **Yöntem:** OPTIONS
- **URL:** `http://localhost/quasar_crud_api/users.php`
- **Headers:**
  - Access-Control-Request-Method: DELETE

---

# Postman Collection (JSON)

Aşağıda, bu endpointleri içeren bir Postman Collection örneği bulabilirsin. Bunu `.json` olarak kaydedip Postman'e import edebilirsin.

```json
{
  "info": {
    "_postman_id": "crud-api-collection-001",
    "name": "Quasar PHP CRUD API",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "item": [
    {
      "name": "Tüm Kullanıcıları Listele",
      "request": {
        "method": "GET",
        "header": [],
        "url": {
          "raw": "http://localhost/quasar_crud_api/users.php",
          "protocol": "http",
          "host": ["localhost"],
          "path": ["quasar_crud_api", "users.php"]
        }
      }
    },
    {
      "name": "Yeni Kullanıcı Ekle",
      "request": {
        "method": "POST",
        "header": [{ "key": "Content-Type", "value": "application/json" }],
        "body": {
          "mode": "raw",
          "raw": "{\n  \"name\": \"Ali Veli\",\n  \"email\": \"ali.veli@example.com\",\n  \"password\": \"123456\"\n}"
        },
        "url": {
          "raw": "http://localhost/quasar_crud_api/users.php",
          "protocol": "http",
          "host": ["localhost"],
          "path": ["quasar_crud_api", "users.php"]
        }
      }
    },
    {
      "name": "Kullanıcı Güncelle",
      "request": {
        "method": "PUT",
        "header": [{ "key": "Content-Type", "value": "application/json" }],
        "body": {
          "mode": "raw",
          "raw": "{\n  \"id\": 1,\n  \"name\": \"Ali Veli Güncel\",\n  \"email\": \"ali.veli@example.com\"\n}"
        },
        "url": {
          "raw": "http://localhost/quasar_crud_api/users.php",
          "protocol": "http",
          "host": ["localhost"],
          "path": ["quasar_crud_api", "users.php"]
        }
      }
    },
    {
      "name": "Kullanıcı Sil",
      "request": {
        "method": "DELETE",
        "header": [],
        "url": {
          "raw": "http://localhost/quasar_crud_api/users.php?id=1",
          "protocol": "http",
          "host": ["localhost"],
          "path": ["quasar_crud_api", "users.php"],
          "query": [{ "key": "id", "value": "1" }]
        }
      }
    }
  ]
}
```
