<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php'); 
    exit();
}

function ambil_data()
{
    $nama_file = 'database.txt';
    $akses_file_tambah = fopen($nama_file, 'r');
    $ambil_Data = fgets($akses_file_tambah);
    $data_to_array = unserialize($ambil_Data);
    // fclose($akses_file_tambah);
    return $data_to_array;
}

function tambah_data($nama)
{
    $nama_file = 'database.txt';
    $akses_file_tambah = fopen($nama_file, 'r');
    $ambil_Data = fgets($akses_file_tambah);
    fclose($akses_file_tambah);

    $data_to_array = unserialize($ambil_Data);
    $data_to_array[] = $nama;
    $data_serial_baru = serialize($data_to_array);
    $akses_file_tambah = fopen($nama_file, 'w');
    fwrite($akses_file_tambah, $data_serial_baru);
    // fclose($akses_file_tambah);
}

if(isset($_POST['nama'])){
    tambah_data($_POST['nama']);
    header('Location: dashboard.php');
    exit();
}

$data_tersimpan = ambil_data();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Selamat datang di Dashboard, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="logout.php">Logout</a>

    <h3>Tambah Nama:</h3>
    <form method="POST" action="">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" required>
        <button type="submit">Tambah</button>
    </form>

    <h3>Data nama yang tersimpan:</h3>
    <ul>
        <?php
        if(!empty($data_tersimpan))
        {
            foreach ($data_tersimpan as $data) {
                echo "<li>".($data). "</li>";
            }
        } else{
            echo "<li>Belum ada data nama</li>";
        }
        ?>
    </ul>
</body>
</html>
