<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uptimechecker"; /* FIXME: Veritabanı bilgileri değiştirilecek */
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}
$url = "http://devofideas.org.tr";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_NOBODY, true);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
$status = ($httpCode >= 200 && $httpCode < 300) ? 'up' : 'down';
$stmt = $conn->prepare("INSERT INTO uptime_logs (url, status) VALUES (?, ?)");
$stmt->bind_param("ss", $url, $status);
$stmt->execute();
$stmt->close();
$conn->close();
?>
