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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 8px 16px;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
        }

        a:hover {
            background-color: #0056b3;
        }

        h3 {
            margin-left: 20px;
            color: #555;
        }

        form {
            margin: 20px;
        }

        label {
            font-size: 16px;
            color: #333;
        }

        input[type="text"] {
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            max-width: 300px;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        ul {
            list-style-type: none;
            padding-left: 20px;
        }

        li {
            background-color: #fff;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        li:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
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
    </div>
</body>
</html>
