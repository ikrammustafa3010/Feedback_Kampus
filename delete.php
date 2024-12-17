<script>
<?php
// Mulai sesi dan koneksi ke database
session_start();
include('config.php');

// Cek jika ada parameter id yang dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan id
    $query = "DELETE FROM feedback WHERE id = ?";
    
    // Siapkan statement
    if ($stmt = $conn->prepare($query)) {
        // Ikat parameter (integer untuk id)
        $stmt->bind_param("i", $id);
        
        // Eksekusi statement
        if ($stmt->execute()) {
            echo "Masukan berhasil dihapus.";
        } else {
            echo "Gagal menghapus masukan.";
        }

        // Tutup statement
        $stmt->close();
    } else {
        echo "Query gagal disiapkan.";
    }
} else {
    echo "ID tidak ditemukan.";
}

// Tutup koneksi
$conn->close();
?>
