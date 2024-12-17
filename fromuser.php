<?php
session_start();
include('config.php'); // Ensure this includes the database connection

// Redirect if user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: loginuser.php");
    exit();
}

// Process the form when it's submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $nim = $_POST['nim']; 
    $services = $_POST['services'];
    $rating = $_POST['rating'];
    $message = $_POST['message'];

    // Prepare the query to insert feedback into the database
    $query = "INSERT INTO feedback (name, nim, services, rating, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssis", $name, $nim, $services, $rating, $message);

    // Execute the query
    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Feedback berhasil dikirim.";
        // Redirect back to the form after submission
        exit();
    } else {
        // Error message if insertion fails
        $error_message = "Gagal mengirim umpan balik. Silakan coba lagi.";
    }

    // Close the prepared statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Umpan Balik - Form Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .header {
            background-color: #8bc7ff;
            padding: 10px 20px;
        }

        .header .logout-btn {
            margin: 0;
        }

        .footer {
            background-color: #8bc7ff;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="m-0">Feedback From</h1>
            <button class="btn btn-danger logout-btn" onclick="window.location.href='index.php';">Log Out</button>
        </div>
    </header>

    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="fromuser.php" method="POST">
                    <?php if (isset($error_message)) { echo "<div class='alert alert-danger'>$error_message</div>"; } ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukan NIM" required>
                    </div>
                    <div class="mb-3">
                        <label for="services" class="form-label">Layanan</label>
                        <select class="form-select" id="services" name="services" required>
                            <option value="" disabled selected>Pilih Layanan</option>
                            <option value="Administrasi">Administrasi</option>
                            <option value="Akademik">Akademik</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (1-5)</label>
                        <select class="form-control" id="rating" name="rating" required>
                            <option value="" disabled selected>Pilih Rating 1-5</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Saran & Pesan</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; Layanan Kampus Di Prodi Informatika Universitas Khairun</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
