<?php

$host	="localhost";
$user	="root";
$pass	="";
$db		="indomaret";

$koneksi	= mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){//cek koneksi
	die("Tidak bisa terkoneksi ke database");
} 

$id_barang     = "";
$nama_barang   = "";
$kode_jenis = "";
$harga_satuan     = "";
$jumlah_barang   = "";
$sukses         = "";
$error          = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else{
  $op = "";
}

if ($op == 'delete') {
  $id_barang = $_GET['id_barang'];
  $sql1       = "delete from barang_indomaret where id_barang = '$id_barang'";
  $q1         = mysqli_query($koneksi,$sql1);
  if ($q1) {
    $sukses = "Berhasil Menghapus Data";
  } else{
    $error  = "Gagal Melakukan Delete Data";
  }
}



if ($op == 'edit') { //proses edit data
      $id_barang      = $_GET['id_barang'];
      $sql1           = "select * from barang_indomaret where id_barang = '$id_barang'";
      $q1             = mysqli_query($koneksi,$sql1);
      $r1             = mysqli_fetch_array($q1);
      $id_barang      = $r1['id_barang'];
      $nama_barang    = $r1['nama_barang'];
      $kode_jenis     = $r1['kode_jenis'];
      $harga_satuan   = $r1['harga_satuan'];
      $jumlah_barang  = $r1['jumlah_barang'];

      if ($id_barang == '') {
        $error = "Data Tidak Ditemukan";
      }
}

if(isset($_POST['simpan'])){ //untuk create
      $id_barang     = $_POST['id_barang'];
      $nama_barang   = $_POST['nama_barang'];
      $kode_jenis = $_POST['kode_jenis'];
      $harga_satuan     = $_POST['harga_satuan'];
      $jumlah_barang   = $_POST['jumlah_barang'];
      

      if($id_barang && $nama_barang && $kode_jenis && $harga_satuan&& $jumlah_barang){
        if ($op == 'edit') { // untuk update
          $sql1 = "update barang_indomaret set id_barang = '$id_barang',nama_barang = '$nama_barang',kode_jenis = '$kode_jenis',harga_satuan = '$harga_satuan',jumlah_barang = '$jumlah_barang' where id_barang = '$id_barang'";
          $q1 = mysqli_query($koneksi,$sql1);
          if($q1){
            $sukses = "Data Berhasil Di Update";
          } else{
            $error = "Data Gagal Di Update";
          }
        }else{ //untuk insert
          $sql1 = "insert into barang_indomaret(id_barang,nama_barang,kode_jenis,harga_satuan,jumlah_barang) values ('$id_barang','$nama_barang','$kode_jenis','$harga_satuan','$jumlah_barang')";
        $q1   = mysqli_query($koneksi,$sql1);
        if($q1){
          $sukses = "Berhasil Memasukkan Data Baru";
        } else{
          $error = "Gagal Memasukkan Data Baru";
        }   

        }
        
      }else{
        $error ="Silakan Masukkan Semua Data";
      }
}


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
      .mx-auto { width:1000px }
      .card { margin-top:10px }
    </style>

  </head>

  <body>
    <div class="mx-auto">

<!--untuk memasukkan data-->
    <div class="card">
  <div class="card-header">
    Create / Edit Data Barang Indomaret
  </div>
  <div class="card-body">
    <?php 
      if($error){
    ?>
      <div class="alert alert-danger" role="alert">
       <?php echo $error ?>
      </div>
    <?php 
      header("refresh:10;url=barang.php");// 10 : detik
    }
    ?>
    <?php 
      if($sukses){
    ?>
      <div class="alert alert-success" role="alert">
       <?php echo $sukses ?>
      </div>
    <?php 
      header("refresh:5;url=barang.php");// 5 : detik
    }
    ?>



    <form action="" method="POST">
    	<div class="mb-3 row">
        <label for="id_barang" class="col-sm-2 col-form-label">ID BARANG</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="id_barang" id="id_barang" value="<?php echo $id_barang ?>">
          </div>
      </div>
      <div class="mb-3 row">
    <label for="nama_barang" class="col-sm-2 col-form-label">NAMA BARANG</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $nama_barang ?>">
    </div>
  </div>
          <div class="mb-3 row">
    <label for="kode_jenis" class="col-sm-2 col-form-label">KODE JENIS</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="kode_jenis" name="kode_jenis" value="<?php echo $kode_jenis ?>">
    </div>
  </div>
          
          <div class="mb-3 row">
        <label for="harga_satuan" class="col-sm-2 col-form-label">HARGA SATUAN</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="harga_satuan" id="harga_satuan" value="<?php echo $harga_satuan?>"/>
          </div>
      </div>

      <div class="mb-3 row">
        <label for="jumlah_barang" class="col-sm-2 col-form-label">JUMLAH BARANG</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="jumlah_barang" id="jumlah_barang" value="<?php echo $jumlah_barang?>"/>
          </div>
      


          


      
      </div>
      <div class="col-12">
        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
      </div>

    </form>
  </div>
</div>

<!--untuk mengeluarkann data-->
		 <div class="card">
  <div class="card-header text-white bg-secondary">
    Data Barang Indomaret
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID BARANG</th>
          <th scope="col">NAMA BARANG</th>
          <th scope="col">KODE BARANG</th>
          <th scope="col">HARGA SATUAN</th>
          <th scope="col">JUMLAH BARANG</th>
          <th scope="col">AKSI</th>
        </tr>
        <tbody>
          <?php 
            $sql2 = "select * from barang_indomaret order by id_barang desc";
            $q2   = mysqli_query($koneksi,$sql2);
            $urut = 1;
            while($r2 = mysqli_fetch_array($q2))
            {
                $id_barang     = $r2['id_barang'];
                $nama_barang   = $r2['nama_barang'];
                $kode_jenis    = $r2['kode_jenis'];
                $harga_satuan  = $r2['harga_satuan'];
                $jumlah_barang = $r2['jumlah_barang'];
          ?>

                <tr>
                  <th scope="row"> <?php echo $urut++ ?> </th>
                  <td scope="row"> <?php echo $id_barang ?> </td>
                  <td scope="row"> <?php echo $nama_barang ?> </td>
                  <td scope="row"> <?php echo $kode_jenis ?> </td>
                  <td scope="row"> <?php echo $harga_satuan?> </td>
                  <td scope="row"> <?php echo $jumlah_barang ?> </td>

                  <td scope="row">
                    <a href="barang.php?op=edit&id_barang= <?php echo $id_barang ?>">
                      <button type="button" class="btn btn-warning">Edit</button></a>
                    <a href="barang.php?op=delete&id_barang= <?php echo $id_barang ?>" onclick="return confirm('Yakin Ingin Delete Data Barang?')">
                      <button type="button" class="btn btn-danger">Delete</button></a>
                    
                    
                  </td>
                </tr>
                <?php
            }
          ?>
        </tbody>
      </thead>   
    </table>
  </div>
</div>


    </div>
  </body>
</html>

