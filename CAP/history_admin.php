<?php 
require 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://www.google.com/search?q=bootstrap+4.3&oq=BOOT&aqs=chrome.0.69i59j69i57j69i59l2j35i39j69i60l3.3349j0j4&sourceid=chrome&ie=UTF-8">
    <title>CSS</title>
</head>

<!-- History User -->
<body>
  <div class="history">
    <h1>HISTORY</h1>
  </div>
<br>

<!-- Untuk Tanggal -->
<!-- Label Kalender -->
  <div class="form-group col-md-4">
      <label for="inputState">Tanggal</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
      </select>
  </div>

<!-- Untuk Tabel -->
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">ID Pesanan</th>
        <th scope="col">ID User</th>
        <th scope="col">Nama Pemesan</th>
        <th scope="col">Tanggal Pesanan</th>
        <th scope="col">Pesanan</th>
        <th scope="col">Total Harga</th>
        <th scope="col">Status</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>
<br>
<br>
</body>

<?php
require 'includes/footer.php';
?>
</html>