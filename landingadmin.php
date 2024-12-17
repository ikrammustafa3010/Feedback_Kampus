<?php
// Mulai sesi dan koneksi ke database
session_start();
include('config.php');

// Query untuk mengambil data feedback
$query = "SELECT * FROM feedback";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        .container-fluid {
            padding-right: 0px;
            padding-left: 0px;
        }
        .p-5 {
            padding: 3.3rem!important;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <!-- Header -->
        <header class="bg-primary text-white p-4 d-flex justify-content-between align-items-center">
            <h1 class="h4">Penyajian Laporan</h1>
            <div class="d-flex align-items-center">
                <button class="btn btn-danger logout-btn" onclick="window.location.href='index.php';">Log Out</button>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h5">Daftar Masukan</h2>
                <div>
                    <!-- Input Filter dan Pencarian -->
                    <input type="text" id="searchQuery" placeholder="Cari berdasarkan nama atau kata kunci" class="form-control d-inline-block w-25">
                    <select id="filterRating" class="form-control d-inline-block w-auto ml-2">
                        <option value="">Semua Peringkat</option>
                        <option value="low">Peringkat Rendah</option>
                        <option value="high">Peringkat Tinggi</option>
                    </select>
                    <select id="filterDate" class="form-control d-inline-block w-auto ml-2">
                        <option value="">Semua Tanggal</option>
                        <option value="newest">Terbaru</option>
                        <option value="oldest">Terlama</option>
                    </select>
                </div>
            </div>

            <!-- Tabel Data -->
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Nomor</th>
                        <th>Nama Pengirim</th>
                        <th>NIM</th>
                        <th>Layanan</th>
                        <th>Peringkat</th>
                        <th>Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="feedbackTableBody">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['nim']; ?></td>
                            <td><?php echo $row['service']; ?></td> <!-- Kolom layanan -->
                            <td><?php echo $row['rating']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td>
                                <!-- Tombol hapus -->
                                <button class="btn btn-danger" onclick="deleteFeedback(<?php echo $row['id']; ?>)">Hapus</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white text-center p-4">
            &copy; Layanan Kampus Di Prodi Informatika Universitas Khairun
        </footer>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popper.js/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Fungsi untuk filter tabel
        document.addEventListener('DOMContentLoaded', function() {
            const searchQuery = document.getElementById('searchQuery');
            const filterRating = document.getElementById('filterRating');
            const filterDate = document.getElementById('filterDate');
            const tableBody = document.getElementById('feedbackTableBody');
            const rows = Array.from(tableBody.getElementsByTagName('tr'));

            // Filter data
            function filterTable() {
                const query = searchQuery.value.toLowerCase();
                const ratingFilter = filterRating.value;
                const dateFilter = filterDate.value;

                let filteredRows = rows.filter(row => {
                    const name = row.cells[1].textContent.toLowerCase();
                    const message = row.cells[5].textContent.toLowerCase();
                    const rating = parseInt(row.cells[4].textContent);

                    let matchesSearch = name.includes(query) || message.includes(query);
                    let matchesRating = ratingFilter === '' || 
                        (ratingFilter === 'low' && rating <= 2) || 
                        (ratingFilter === 'high' && rating >= 4);

                    return matchesSearch && matchesRating;
                });

                // Urutkan berdasarkan tanggal
                if (dateFilter === 'newest') {
                    filteredRows.sort((a, b) => parseInt(b.cells[0].textContent) - parseInt(a.cells[0].textContent));
                } else if (dateFilter === 'oldest') {
                    filteredRows.sort((a, b) => parseInt(a.cells[0].textContent) - parseInt(b.cells[0].textContent));
                }

                // Tampilkan hasil filter
                tableBody.innerHTML = '';
                filteredRows.forEach(row => tableBody.appendChild(row));
            }

            // Event listeners
            searchQuery.addEventListener('input', filterTable);
            filterRating.addEventListener('change', filterTable);
            filterDate.addEventListener('change', filterTable);
        });

        // Fungsi hapus data
        function deleteFeedback(id) {
            if (confirm('Apakah Anda yakin ingin menghapus masukan ini?')) {
                fetch(`delete.php?id=${id}`, { method: 'GET' })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload();
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Gagal menghapus masukan.');
                    });
            }
        }
    </script>
</body>
</html>
