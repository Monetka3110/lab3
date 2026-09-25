-- Схема БД «Бронирование рабочих мест»
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('employee','manager','admin') NOT NULL DEFAULT 'employee',
    department VARCHAR(100)
);

CREATE TABLE office_zones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    floor INT
);

CREATE TABLE workplaces (
    id INT AUTO_INCREMENT PRIMARY KEY,
    zone_id INT NOT NULL,
    number VARCHAR(20) NOT NULL,
    is_active BOOLEAN NOT NULL DEFAULT TRUE,
    FOREIGN KEY (zone_id) REFERENCES office_zones(id)
);

CREATE TABLE equipment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    workplace_id INT NOT NULL,
    type VARCHAR(50) NOT NULL,   -- монитор, док-станция, телефон...
    name VARCHAR(100),
    FOREIGN KEY (workplace_id) REFERENCES workplaces(id)
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    workplace_id INT NOT NULL,
    start_at DATETIME NOT NULL,
    end_at DATETIME NOT NULL,
    status ENUM('active','cancelled','completed') NOT NULL DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id),
    FOREIGN KEY (workplace_id) REFERENCES workplaces(id),
    INDEX idx_workplace_time (workplace_id, start_at, end_at)  -- быстрый поиск пересечений
);
