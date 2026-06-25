# Hướng dẫn đóng gói và triển khai ứng dụng trên Ubuntu VM (Docker Compose)

Tài liệu này hướng dẫn bạn cách cài đặt, cấu hình và chạy dự án PHP MVC này trên một máy ảo Ubuntu bằng Docker Compose.

---

## Bước 1: Cài đặt Docker & Docker Compose trên Ubuntu VM

Đăng nhập vào máy ảo Ubuntu của bạn qua SSH và chạy các lệnh sau để cài đặt Docker:

```bash
# 1. Cập nhật hệ thống
sudo apt update && sudo apt upgrade -y

# 2. Cài đặt Docker
sudo apt install -y docker.io

# 3. Kích hoạt và cho phép Docker tự khởi động cùng hệ thống
sudo systemctl enable --now docker

# 4. Cài đặt Docker Compose v2 (plugin tích hợp của docker)
sudo apt install -y docker-compose-v2

# 5. (Tùy chọn) Thêm user hiện tại vào nhóm docker để chạy lệnh không cần sudo
sudo usermod -aG docker $USER
# Lưu ý: Sau lệnh này, bạn cần LOGOUT và LOGIN lại SSH để có hiệu lực.
```

---

## Bước 2: Chuẩn bị Cơ sở dữ liệu (Database)

1. Trên máy tính cục bộ của bạn (đang chạy ứng dụng cũ), export cơ sở dữ liệu MySQL của dự án ra một file `.sql` (ví dụ: `Baitaplon.sql`).
2. Di chuyển file `Baitaplon.sql` này vào thư mục `db_init/` trong thư mục dự án của bạn:
   - Thư mục trên VM: `.../Baitaplon/db_init/Baitaplon.sql`

*Lưu ý: Khi MySQL container khởi động lần đầu tiên, nó sẽ tự động phát hiện file SQL này và import vào cơ sở dữ liệu.*

---

## Bước 3: Đưa mã nguồn lên Ubuntu VM

Bạn có thể đưa thư mục dự án `Baitaplon` lên Ubuntu VM bằng 2 cách:
- **Cách 1:** Sử dụng `Git` (đẩy dự án lên GitHub/GitLab từ máy cục bộ rồi chạy `git clone <repo-url>` trên VM).
- **Cách 2:** Sử dụng công cụ truyền file như `SFTP`, `SCP` hoặc `FileZilla` để upload trực tiếp thư mục `Baitaplon` lên VM.

---

## Bước 4: Khởi chạy dự án bằng Docker Compose

Di chuyển vào thư mục dự án trên Ubuntu VM và chạy lệnh:

```bash
# Di chuyển vào thư mục chứa docker-compose.yml
cd /path/to/Baitaplon

# Khởi chạy Docker Compose (tự động build và chạy nền)
docker compose up -d --build
```

Kiểm tra trạng thái các container đang chạy:
```bash
docker compose ps
```
Bạn sẽ thấy 3 container:
1. `baitaplon_web` (PHP/Apache) đang chạy trên cổng `80`
2. `baitaplon_db` (MySQL) đang chạy trên cổng `3306`
3. `baitaplon_phpmyadmin` đang chạy trên cổng `8080`

---

## Bước 5: Truy cập và Xử lý lỗi chuyển hướng (Redirect Localhost)

Dự án này sử dụng nhiều đường dẫn tuyệt đối dạng `http://localhost/Baitaplon/...` trong các file View (ví dụ: `MVC/Views/Master.php`). 
Nếu bạn truy cập trực tiếp bằng IP của máy ảo (ví dụ: `http://<VM_IP>/Baitaplon/`), các liên kết hoặc tài nguyên (CSS, JS) sẽ trỏ về `localhost` của máy bạn, dẫn đến lỗi giao diện hoặc không click được.

Dưới đây là 2 cách xử lý triệt để:

### Cách 1: Sử dụng SSH Tunneling (Khuyên dùng - Không cần sửa mã nguồn)
Thay vì truy cập bằng IP của máy ảo, bạn có thể thực hiện ánh xạ cổng (port forwarding) từ máy tính cá nhân của mình tới máy ảo qua SSH.

Mở terminal trên máy tính cá nhân của bạn (Windows PowerShell hoặc CMD) và chạy:
```bash
ssh -L 80:localhost:80 -L 8080:localhost:8080 user@<IP_MÁY_ẢO>
```
*Giữ cửa sổ terminal này luôn mở.* Giờ đây, bạn chỉ cần mở trình duyệt trên máy tính cá nhân và truy cập:
- Trang chủ dự án: `http://localhost/Baitaplon/` (hoặc `http://localhost` sẽ tự động chuyển hướng).
- Quản trị cơ sở dữ liệu phpMyAdmin: `http://localhost:8080`

Mọi thứ sẽ hoạt động trơn tru như đang chạy dưới máy cục bộ!

### Cách 2: Chuyển đổi liên kết sang đường dẫn tương đối (Sửa mã nguồn)
Nếu bạn muốn triển khai dự án công khai (cho nhiều người truy cập bằng IP/Domain của máy ảo), bạn cần sửa các đường dẫn trong code.
Hãy thay thế toàn bộ chuỗi:
- `http://localhost/Baitaplon/` bằng `/Baitaplon/` (đường dẫn tương đối) trong tất cả các file View.
- Ví dụ: `<a href="http://localhost/Baitaplon/Home">` đổi thành `<a href="/Baitaplon/Home">`.

---

## Các lệnh quản lý Docker hữu ích

- **Dừng dịch vụ:**
  ```bash
  docker compose down
  ```
- **Xóa sạch dữ liệu (bao gồm cả database để import lại từ đầu):**
  ```bash
  docker compose down -v
  ```
- **Xem logs của ứng dụng:**
  ```bash
  docker compose logs -f web
  ```
- **Xem logs của MySQL:**
  ```bash
  docker compose logs -f db
  ```
- **Chạy lệnh trực tiếp trong container PHP:**
  ```bash
  docker compose exec web bash
  ```
