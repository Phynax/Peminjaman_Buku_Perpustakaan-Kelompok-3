<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            margin-top: 10px;
            display: block;
            color: #555;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Data Buku</h2>
        <form action="proses_tambah_buku.php" method="post">
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" required>
            
            <label for="pengarang">Pengarang:</label>
            <input type="text" id="pengarang" name="pengarang" required>
            
            <label for="tahun_terbit">Tahun Terbit:</label>
            <input type="number" id="tahun_terbit" name="tahun_terbit" required>
            
            <label for="penerbit">Penerbit:</label>
            <input type="text" id="penerbit" name="penerbit" required>

            <label for="jumlah_stok">Jumlah Stok:</label>
            <input type="number" id="jumlah_stok" name="jumlah_stok" required>

            <input type="submit" value="Tambah Buku">
        </form>
    </div>
</body>
</html>
