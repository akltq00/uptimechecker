<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uptimechecker"; /* FIXME: Veritabanı bilgileri değiştirilecek. */
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Bağlantı başarısız: " . $conn->connect_error);
}
$sql = "SELECT DATE(checked_at) as date, 
               SUM(status = 'up') / COUNT(*) * 100 as uptime
        FROM uptime_logs
        GROUP BY DATE(checked_at)";
$result = $conn->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
echo json_encode($data);
$conn->close();
?>
