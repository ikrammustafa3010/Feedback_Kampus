<?php
// lupa_password.php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Format email tidak valid.";
    } else {
        // Cek apakah email terdaftar
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt_check = $conn->prepare($query);

        if (!$stmt_check) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            // Email ditemukan, kirim link reset password statis
            $resetLink = "http://yourwebsite.com/lupa_password.php";
            $subject = "Reset Password Anda";
            $message = "Klik link berikut untuk mereset password Anda: <a href='$resetLink'>$resetLink</a>";
            $headers = "From: no-reply@yourwebsite.com\r\n";
            $headers .= "Content-type: text/html; charset=UTF-8\r\n";

            if (mail($email, $subject, $message, $headers)) {
                $success_message = "Link reset password telah dikirim ke email Anda.";
            } else {
                $error_message = "Gagal mengirim email. Silakan coba lagi.";
            }
        } else {
            // Pesan umum untuk keamanan
            $success_message = "Jika email terdaftar, Anda akan menerima tautan reset password.";
        }
        $stmt_check->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
    <h1>Lupa Password</h1>
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-field">
            <label for="email">Masukkan Email Anda</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <button type="submit">Kirim Link Reset</button>
    </form>
</div>
</body>
</html>
