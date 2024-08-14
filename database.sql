CREATE TABLE uptime_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url VARCHAR(255),
    status ENUM('up', 'down'),
    checked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
