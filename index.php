<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css" />

    <!-- My CSS -->
    <link rel="stylesheet" href="style.css" />

    <title>Toserba Selamet</title>
  </head >
  <body id="home" class="backgroundyey">
    <!-- Navbar -->
    <!--PHP-->
  <?php
  require_once("sparqllib.php");
  $test = "";
  if (isset($_POST['search-Nama'])) {
    $test = $_POST['search-Nama'];
    $data = sparql_get(
      "http://localhost:3030/semweb",
      "
      PREFIX p: <http://semweb.com>
      PREFIX d: <http://semweb.com/ns/data#>

      SELECT ?Nama ?Jenis ?Keterangan ?Pengawet ?Usia ?Harga 
      WHERE
      { 
          ?s  d:Nama ?Nama ;
              d:Jenis ?Jenis;
              d:Keterangan ?Keterangan;
              d:Pengawet ?Pengawet;
              d:Usia ?Usia;
              d:Harga ?Harga;
              FILTER (regex (?Nama,  '$test', 'i') || regex (?Jenis,  '$test', 'i') || regex (?Keterangan,  '$test', 'i') || regex (?Pengawet,  '$test', 'i') || regex (?Usia,  '$test', 'i') || regex (?Harga,  '$test', 'i'))
            }"
    );
  } else {
    $data = sparql_get(
      "http://localhost:3030/semweb",
      "
      PREFIX p: <http://semweb.com>
      PREFIX d: <http://semweb.com/ns/data#>

      SELECT ?Nama ?Jenis ?Keterangan ?Pengawet ?Usia ?Harga
      WHERE
      { 
          ?s  d:Nama ?Nama ;
              d:Jenis ?Jenis;
              d:Keterangan ?Keterangan;
              d:Pengawet ?Pengawet;
              d:Usia ?Usia;
              d:Harga ?Harga;
              
      }

            "
    );
  }

  if (!isset($data)) {
    print "<p>Error: " . sparql_errno() . ": " . sparql_error() . "</p>";
  }

  ?>
    <!-- Akhir Navbar -->

    <!-- Jumbotron -->
    <section class="jumbotron text-center">
      <img src="img/Toserba.png" alt="Search" width="300" />
      <form action="" method="post" id="nameform">
      <div class="search-box">
        <input type="text" name="search-Nama" placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
      </div>
      <i class="bi bi-search"></i>
      </form>
    </section>
    <!-- Akhir Jumbotron -->

    <!-- About -->
    <section id="about">
      <div class="container footer backgroundyey">
      

        <div class="row tentang">
        <div class="col-lg-3">
          <img src="img/Logo.png" alt="About" class="img-fluid" />
        </div>
        <div class="col-lg">
          <h3>Apa itu <span>Toserba Selamet ?</span></h3>
          <p>
         Toserba Selamat adalah tempat belanja terbaik dan termurah yang ada di cipanas,ciranjang, dan di Cianjur yang telah memiliki
         pusat dan merata sehingga masyarakat dapat membeli kebutuhn pokok dengan mendapatkan harga yang pas dan fantastis murahnya
         tentu menentapkan adab kami dengan senantiasa menghormati pelanggan tercinta kami.
         </p>
        </div>
      </div>


      <!-- Rekomendasi Minuman -->
        <div class="row rekom row text-center mb-3">
          <div class="col">
            <h2>Barang Pilihan Mu!</h2>
            <br>
          </div>
        </div>
        <div class="row key">
          <div class="col-lg-3 mb-3">
            <div class="card shadow" style="width: 30rem height:30rem">
              <div class="inner">
                <img src="img/Makanan.png" class="card-img-top" alt="" />
              </div>
              <div class="card-body text-center">
                <h5 class="card-title">Makanan</h5>
                <p class="card-text"></p>
              </div>
            </div>
          </div>
         <div class="col-lg-3 mb-3">
            <div class="card shadow" style="width: 30rem height:30rem">
            </div>
          </div>
          <div class="col-lg-3 mb-3">
            <div class="card shadow" style="width: 15remwidth: 30rem height:30rem align:center">
              <div class="inner">
                <img src="img/Minuman.jpg" class="card-img-top" alt="" />
              </div>
              <div class="card-body text-center">
                <h5 class="card-title">Minuman</h5>
                <p class="card-text"></p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 mb-3">
            <div class="card shadow" style="width: 30rem height:30rem">
            </div>
          </div>
        </div>
        
      <!-- Hasil Pencarian -->

        <div class="row text-center mb-3 hasil">
          <div class="col">
            <h2>Hasil Pencarian</h2>
          </div>
        </div>
        <div class="row fs-5">
          <div class="col-md-5">
            <p>
              Menampilkan pencarian :
              <br />
            </p>
            <p>
              <span>
          <?php
          if ($test != NULL) {
            echo $test;
          } else {
            echo "Hasil Pencarian.... ";
          }
          ?></span>
            </p>
          </div>
        </div>
          
        <div class="row">

<?php $i = 0; ?>
<?php foreach ($data as $dat) : ?>
  <div class="col-md-4">
  <div class="box"> 
    <ul class="list-group list-group-flush">
          <div class="header-data"> <b>Nama :</b></div>
          <div class="item-data"><?= $dat['Nama'] ?></div>
  
          <div class="header-data"> <b>Jenis :</b></div>
          <div class="item-data"><?= $dat['Jenis'] ?></div>
        
          <div class="header-data"> <b>Keterangan :</b></div>
          <div class="item-data"><?= $dat['Keterangan'] ?></div>

          <div class="header-data"> <b>Pengawet :</b></div>
          <div class="item-data"><?= $dat['Pengawet'] ?></div>

          <div class="header-data"> <b>Usia :</b></div>
          <div class="item-data"><?= $dat['Usia'] ?></div>

          <div class="header-data"> <b>Harga :</b></div>
          <div class="item-data"><?= $dat['Harga'] ?></div>

      </ul>
    </div>
  </div>

<?php endforeach; ?>
</div>



      </div>
    </section>
    <!-- Akhir About -->

    <!-- Footer -->
    <footer class="footer text-black text-center pb-3">
      <p>Created By Andre Ganteng</p>
    </footer>
    <!-- Akhir Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>



