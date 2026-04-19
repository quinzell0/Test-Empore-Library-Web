# ERD Aplikasi Peminjaman Buku

Aplikasi diimplementasikan hanya untuk fitur yang diminta pengguna, tetapi rancangan database ini sudah mengakomodasi seluruh requirement termasuk approval, reject, dan pengembalian buku.

```mermaid
erDiagram
    ADMINS ||--o{ BOOK_LOANS : processes
    MEMBERS ||--o{ BOOK_LOANS : submits
    BOOKS ||--o{ BOOK_LOANS : requested_in

    ADMINS {
        bigint id PK
        string name
        string email UK
        string password
        timestamp created_at
        timestamp updated_at
    }

    MEMBERS {
        bigint id PK
        string member_code UK
        string name
        string email UK
        string phone
        text address
        string password
        timestamp created_at
        timestamp updated_at
    }

    BOOKS {
        bigint id PK
        string code UK
        string title
        year publish_year
        string author
        int stock
        timestamp created_at
        timestamp updated_at
    }

    BOOK_LOANS {
        bigint id PK
        bigint member_id FK
        bigint book_id FK
        date loan_date
        date due_date
        date returned_at
        enum status
        bigint processed_by_admin_id FK
        timestamp processed_at
        text notes
        timestamp created_at
        timestamp updated_at
    }
```

## Catatan desain
- `book_loans.status` memakai nilai `pending`, `approved`, `rejected`, `returned` agar satu tabel cukup untuk pengajuan, peminjaman aktif, dan histori pengembalian.
- `processed_by_admin_id` dan `processed_at` dipakai saat fitur approval/reject dan pengembalian diaktifkan nanti.
- `books.stock` disimpan langsung di tabel buku agar pembacaan katalog lebih sederhana dan cepat.
