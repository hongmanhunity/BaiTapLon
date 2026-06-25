# Thư mục khởi tạo cơ sở dữ liệu MySQL

Thư mục này được gắn (mount) trực tiếp vào `/docker-entrypoint-initdb.d` trong container MySQL.

### Hướng dẫn sử dụng:
1. Sao chép (Copy) file cơ sở dữ liệu `.sql` của bạn vào thư mục `db_init/` này.
2. Đặt tên file bất kỳ (ví dụ: `Baitaplon.sql` hoặc `schema.sql`).
3. Khi bạn khởi chạy `docker compose up -d` lần đầu tiên, container MySQL sẽ tự động chạy file `.sql` này để import cấu trúc bảng và dữ liệu mẫu.

*Lưu ý: Nếu container MySQL đã từng khởi chạy trước đó và đã có dữ liệu trong volume `mysql_data`, quá trình tự động import này sẽ không được kích hoạt lại. Để import lại từ đầu, bạn cần xóa volume bằng lệnh: `docker compose down -v` trước khi chạy lại.*
