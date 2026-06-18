# Inventory System API v1
Base URL: http://localhost:8000/api/v1

## Autentikasi
* **POST /register** - Mendaftarkan akun pengguna baru.
* **POST /login** - Masuk ke sistem dan mendapatkan token akses API.

## Kategori Barang
* **GET /categories** - Menarik semua daftar kategori.
* **POST /categories** - Menambahkan kategori baru.
* **GET /categories/{id}** - Melihat detail satu kategori.
* **PUT /categories/{id}** - Memperbarui nama kategori.
* **DELETE /categories/{id}** - Menghapus kategori (Khusus Admin).

## Item Barang
* **GET /items** - Menarik semua daftar item barang.
* **POST /items** - Menambahkan item barang baru.
* **GET /items/{id}** - Melihat detail satu item barang.
* **PUT /items/{id}** - Memperbarui data spesifik item.
* **DELETE /items/{id}** - Menghapus item barang (Khusus Admin).
# GET /api/v1/items

Mengambil seluruh data item.

# GET /api/v1/items?category_id={id}

Description:
Filter items berdasarkan category_id.

Parameter:
- category_id (optional)

Example:
GET /api/v1/items?category_id=1
## Review Demo
Digunakan untuk simulasi code review dua akun.