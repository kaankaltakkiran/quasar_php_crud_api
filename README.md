<div align="center">
  <img src="https://cdn.quasar.dev/logo/svg/quasar-logo.svg" width="120" alt="Quasar Logo" />
  <h1>Quasar + PHP + MySQL CRUD API</h1>
  <p>Modern, hızlı ve güvenli tam yığın kullanıcı yönetimi uygulaması</p>
</div>

---

## 🚀 Proje Özeti

Bu proje, <b>Quasar Framework (Vue 3)</b> ile hazırlanmış modern bir frontend ve <b>PHP + MySQL</b> tabanlı bir backend API içerir. Kullanıcı ekleme, listeleme, güncelleme ve silme işlemlerini (CRUD) güvenli şekilde yapabilirsiniz. Şifreler hash'lenir, modern arayüz ve kolay kullanım sunar.

---

## 🖼️ Ekran Görüntüsü

- [Web Sitesi](https://github.com/kaankaltakkiran/Linux_notlarim/tree/main/ubuntu_kurulum_notlarim/script_notlari)

---

## 🧱 Kullanılan Teknolojiler

- ⚡️ Quasar Framework (Vue 3, Composition API, TypeScript)
- 🐘 PHP (Procedural)
- 🐬 MySQL
- 🪝 Pinia (State Management)
- 🔗 Axios (HTTP Client)

---

## 📦 Kurulum

### 1. Veritabanı

```sql
CREATE DATABASE IF NOT EXISTS crud_app;
USE crud_app;
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL
);
```

### 2. Backend (PHP)

- `users.php` dosyasını sunucunuzda çalıştırın.
- Gerekirse veritabanı bağlantı ayarlarını güncelleyin.

### 3. Frontend (Quasar)

```bash
cd quasar-crud-api
npm install
npm run dev
```

---

## 🛠️ Özellikler

- Kullanıcıları listele, ekle, güncelle, sil
- Şifreler hash'li ve güvenli
- Modern ve responsive arayüz
- Hızlı API entegrasyonu
- CORS ve hata yönetimi

---

## 📬 API Endpointleri

| İşlem    | Yöntem | URL                        | Body (varsa) |
| -------- | ------ | -------------------------- | ------------ |
| Listele  | GET    | /users.php                 | Yok          |
| Ekle     | POST   | /users.php                 | JSON         |
| Güncelle | PUT    | /users.php                 | JSON         |
| Sil      | DELETE | /users.php?id=KULLANICI_ID | Yok          |

---

## 🧑‍💻 Katkı ve Lisans

- Pull request ve katkılara açıktır.
- MIT Lisansı ile dağıtılır.

---

<div align="center">
  <b>Hazır! Modern, güvenli ve hızlı bir CRUD API uygulaması.</b>
</div>
