<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = htmlspecialchars(trim($_POST['email']));
    $new_password = htmlspecialchars(trim($_POST['password']));
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // Update password di database
    $query = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $hashed_password, $email);
    if ($stmt->execute()) {
        $success_message = "Password Anda berhasil diubah.";
    } else {
        $error_message = "Gagal mengubah password. Silakan coba lagi.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
    <h1>Reset Password</h1>
    <?php if (isset($success_message)): ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php endif; ?>
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="form-field">
            <label for="email">Email Anda</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="form-field">
            <label for="password">Password Baru</label>
            <input type="password" name="password" id="password" placeholder="Password Baru" required>
        </div>
        <button type="submit">Reset Password</button>
    </form>
</div>
</body>
</html>
