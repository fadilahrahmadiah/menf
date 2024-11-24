<?php
$host = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "menfess";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $for_name = $_POST['for_name'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages (for_name, message) VALUES ('$for_name', '$message')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pesan berhasil dikirim!');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM messages ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menfess</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Menfess - Kirim Pesan Anonim</h2>
        <div class="my-4">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="for_name" class="form-label">For:</label>
                    <input type="text" class="form-control" id="for_name" name="for_name" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message:</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
            </form>
        </div>

        <div class="mt-5">
            <h3>Pesan Terkirim:</h3>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">For: <?php echo $row['for_name']; ?></h5>
                            <p class="card-text"><?php echo nl2br($row['message']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Tidak ada pesan terkirim.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>

<style>
    body {
        background-color: #f8f9fa;
    }

    .container {
        max-width: 800px;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>

