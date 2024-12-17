<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <style>
        body {
    margin: 0;
    padding: 0;
    background: url('image/bacground.png') no-repeat center center fixed;
    background-size: cover;
    font-family: Arial, sans-serif;
    height: 100vh; /* Tinggi penuh layar */
}

.wrapper {
    width: 90%;
    max-width: 400px; /* Batas maksimum untuk elemen */
    padding: 30px;
    margin: auto;
    position: relative;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    border-radius: 15px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    text-align: center;
}

h1.text-center {
    font-family: 'Arial', sans-serif;
    font-size: 1.8rem;
    font-weight: bold;
    text-align: center;
    color: #2c3e50;
    margin: 20px 0;
    padding: 10px;
    background-color: #ecf0f1;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    line-height: 1.5;
}

.name {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 20px;
}

.form-field {
    margin-bottom: 15px;
    text-align: left;
}

.form-field span {
    margin-right: 10px;
    font-size: 16px;
}

input[type="text"], input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    outline: none;
    font-size: 14px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #0056b3;
}

.fs-6 a {
    text-decoration: none;
    color: #007bff;
}

.fs-6 a:hover {
    text-decoration: underline;
}

/* Responsif */
@media (max-width: 768px) {
    h1.text-center {
        font-size: 1.5rem;
        padding: 8px;
    }

    .wrapper {
        padding: 20px;
    }

    .form-field span {
        font-size: 14px;
    }

    input[type="text"], input[type="password"] {
        font-size: 12px;
    }

    button {
        font-size: 14px;
    }
}
    </style>
</head>
<body>  
    <h1 class="text-center">
        Sistem Feedback Untuk Layanan Kampus Di Prodi Informatika Universitas Khairun
    </h1>
    <div class="wrapper">
          <!-- Bagian logo -->
          <div class="logo">
            <img src="image/Logo Unkhair.png" alt="Logo Universitas Khairun">
        </div>
        <div class="text-center mt-4 name">
            Landing page
        </div>
        <form class="p-3 mt-3">
            <!-- Admin Login Button -->
            <button class="btn mt-3" onclick="location.href='loginadmin.php';return false;">Admin</button>
            <!-- User Login Button -->
            <button class="btn mt-3" onclick="location.href='loginuser.php';return false;">User</button>
        </form>
        <div class="text-center fs-6">
            <a href="#">
    </div>
</body>
</html>
