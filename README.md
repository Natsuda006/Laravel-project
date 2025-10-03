# Collecta - ระบบอีคอมเมิร์ซ

Collecta เป็นระบบอีคอมเมิร์ซที่พัฒนาด้วย Laravel Framework ซึ่งมีฟีเจอร์ครบครันสำหรับการขายสินค้าออนไลน์ ระบบมีทั้งส่วนของผู้ใช้งานทั่วไปและผู้ดูแลระบบ

## ฟีเจอร์ของระบบ

### สำหรับผู้ใช้งานทั่วไป:
- ดูรายการสินค้าทั้งหมด
- ดูรายละเอียดสินค้าแต่ละชิ้น
- เพิ่มสินค้าลงในตะกร้าสินค้า
- จัดการสินค้าในตะกร้า (เพิ่ม/ลด จำนวน, ลบสินค้า)
- ดำเนินการสั่งซื้อสินค้า
- ระบบการลงทะเบียนและเข้าสู่ระบบ
- จัดการข้อมูลส่วนตัว

### สำหรับผู้ดูแลระบบ:
- จัดการสินค้า (เพิ่ม, แก้ไข, ลบ)
- ดูรายการสินค้าทั้งหมด

## เทคโนโลยีที่ใช้

- **Backend**: Laravel 12.x (PHP 8.2+)
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Breeze

## โครงสร้างฐานข้อมูล

### ตาราง Users
- id (Primary Key)
- name (ชื่อผู้ใช้)
- email (อีเมล)
- password (รหัสผ่าน)
- role (บทบาท: user/admin)
- timestamps

### ตาราง Products
- id (Primary Key)
- name (ชื่อสินค้า)
- description (รายละเอียดสินค้า)
- price (ราคา)
- image (ภาพสินค้า)
- timestamps

## การติดตั้งระบบ

1. คัดลอกโปรเจกต์:
   ```bash
   git clone <repository-url>
   cd collecta
   ```

2. ติดตั้ง PHP Dependencies:
   ```bash
   composer install
   ```

3. ติดตั้ง JavaScript Dependencies:
   ```bash
   npm install
   ```

4. สร้างไฟล์ .env:
   ```bash
   cp .env.example .env
   ```

5. สร้าง Application Key:
   ```bash
   php artisan key:generate
   ```

6. กำหนดค่าฐานข้อมูลในไฟล์ .env:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=collecta_db
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

7. ทำการ Migrate ฐานข้อมูล:
   ```bash
   php artisan migrate
   ```

8. สร้างผู้ใช้ Admin (สำหรับทดสอบ):
   ```bash
   php artisan db:seed --class=AdminUserSeeder
   ```
   ข้อมูลเข้าสู่ระบบของ Admin:
   - อีเมล: admin@example.com
   - รหัสผ่าน: password

9. สร้าง Assets:
   ```bash
   npm run build
   ```

10. รันเซิร์ฟเวอร์:
    ```bash
    php artisan serve
    ```

## การใช้งานระบบ

### สำหรับผู้ใช้งานทั่วไป:
1. เปิดเว็บเบราว์เซอร์และไปที่ `http://localhost:8000`
2. สามารถดูรายการสินค้าได้ทันที
3. หากต้องการสั่งซื้อสินค้า ต้องลงทะเบียนหรือเข้าสู่ระบบก่อน
4. เพิ่มสินค้าลงในตะกร้า และดำเนินการสั่งซื้อ

### สำหรับผู้ดูแลระบบ:
1. เข้าสู่ระบบด้วยข้อมูล Admin:
   - อีเมล: admin@example.com
   - รหัสผ่าน: password
2. ไปที่หน้ารายการสินค้า `http://localhost:8000/products`
3. คลิกปุ่ม "เพิ่มสินค้าใหม่" เพื่อเพิ่มสินค้า
4. สามารถแก้ไขหรือลบสินค้าได้จากหน้ารายการสินค้า

## โครงสร้างโปรเจกต์

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/ (ระบบ Authentication)
│   │   ├── CartController.php (ระบบตะกร้าสินค้า)
│   │   ├── ProductController.php (ระบบจัดการสินค้า)
│   │   └── ProfileController.php (ระบบโปรไฟล์)
│   └── Requests/ (การตรวจสอบข้อมูล)
├── Models/
│   ├── Product.php (Model ของสินค้า)
│   └── User.php (Model ของผู้ใช้)
├── Providers/
database/
├── migrations/ (ไฟล์สร้างฐานข้อมูล)
└── seeders/ (ข้อมูลตัวอย่าง)
resources/
├── views/
│   ├── auth/ (หน้า Authentication)
│   ├── cart/ (หน้าตะกร้าสินค้า)
│   ├── products/ (หน้าสินค้า)
│   ├── profile/ (หน้าโปรไฟล์)
│   └── layouts/ (โครงสร้างหน้าเว็บ)
└── css/
   └── app.css (สไตล์หลัก)
routes/
├── web.php (เส้นทางหลักของเว็บ)
└── auth.php (เส้นทาง Authentication)
```

## การพัฒนาต่อยอด

### เพิ่มฟีเจอร์ใหม่:
1. สร้าง Controller ใหม่ใน `app/Http/Controllers/`
2. สร้าง Model ใหม่ใน `app/Models/` (ถ้าจำเป็น)
3. สร้าง Migration ใหม่ใน `database/migrations/` (ถ้าต้องการตารางใหม่)
4. เพิ่มเส้นทางใน `routes/web.php`
5. สร้างหน้า View ใหม่ใน `resources/views/`

### ปรับปรุงฟีเจอร์เดิม:
1. แก้ไข Controller ที่ต้องการใน `app/Http/Controllers/`
2. แก้ไข View ที่ต้องการใน `resources/views/`
3. แก้ไข CSS ใน `resources/css/app.css`

## การทดสอบระบบ

รันการทดสอบด้วยคำสั่ง:
```bash
php artisan test
```

## ความช่วยเหลือเพิ่มเติม

หากพบปัญหาในการติดตั้งหรือใช้งานระบบ กรุณาติดต่อทีมพัฒนา หรือตรวจสอบปัญหาที่:
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel GitHub Issues](https://github.com/laravel/laravel/issues)

## License

โปรเจกต์นี้เป็น Open Source ภายใต้ใบอนุญาต [MIT license](https://opensource.org/licenses/MIT).
