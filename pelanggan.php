<?php

$host	="localhost";
$user	="root";
$pass	="";
$db		="indomaret";

$koneksi	= mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){//cek koneksi
	die("Tidak bisa terkoneksi ke database");
} 

$id_pelanggan     = "";
$nama_pelanggan   = "";
$alamat_pelanggan = "";
$jenis_kelamin   = "";
$no_telepon      = "";
$sukses         = "";
$error          = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else{
  $op = "";
}

if ($op == 'delete') {
  $id_pelanggan = $_GET['id_pelanggan'];
  $sql1       = "delete from pelanggan_indomaret where id_pelanggan = '$id_pelanggan'";
  $q1         = mysqli_query($koneksi,$sql1);
  if ($q1) {
    $sukses = "Berhasil Menghapus Data";
  } else{
    $error  = "Gagal Melakukan Delete Data";
  }
}



if ($op == 'edit') { //proses edit data
      $id_pelanggan   = $_GET['id_pelanggan'];
      $sql1           = "select * from pelanggan_indomaret where id_pelanggan = '$id_pelanggan'";
      $q1             = mysqli_query($koneksi,$sql1);
      $r1             = mysqli_fetch_array($q1);
      $id_pelanggan     = $r1['id_pelanggan'];
      $nama_pelanggan   = $r1['nama_pelanggan'];
      $alamat_pelanggan = $r1['alamat_pelanggan'];
      $jenis_kelamin   = $r1['jenis_kelamin'];
      $no_telepon      = $r1['no_telepon'];
     

      if ($id_pelanggan == '') {
        $error = "Data Tidak Ditemukan";
      }
}

if(isset($_POST['simpan'])){ //untuk create
      $id_pelanggan     = $_POST['id_pelanggan'];
      $nama_pelanggan   = $_POST['nama_pelanggan'];
      $alamat_pelanggan = $_POST['alamat_pelanggan'];
      $jenis_kelamin   = $_POST['jenis_kelamin'];
      $no_telepon      = $_POST['no_telepon'];
      
      

      if($id_pelanggan && $nama_pelanggan && $alamat_pelanggan && $jenis_kelamin&& $no_telepon){
        if ($op == 'edit') { // untuk update
          $sql1 = "update pelanggan_indomaret set id_pelanggan = '$id_pelanggan',nama_pelanggan = '$nama_pelanggan',alamat_pelanggan = '$alamat_pelanggan',jenis_kelamin = '$jenis_kelamin',no_telepon = '$no_telepon' where id_pelanggan = '$id_pelanggan'";
          $q1 = mysqli_query($koneksi,$sql1);
          if($q1){
            $sukses = "Data Berhasil Di Update";
          } else{
            $error = "Data Gagal Di Update";
          }
        }else{ //untuk insert
          $sql1 = "insert into pelanggan_indomaret(id_pelanggan,nama_pelanggan,alamat_pelanggan,jenis_kelamin,no_telepon) values ('$id_pelanggan','$nama_pelanggan','$alamat_pelanggan','$jenis_kelamin','$no_telepon')";
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
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
      .mx-auto { width:1100px }
      .card { margin-top:10px }
    </style>

  </head>

  <body>
    <div class="mx-auto">

<!--untuk memasukkan data-->
    <div class="card">
  <div class="card-header">
    Create / Edit Data Pelanggan Indomaret
  </div>
  <div class="card-body">
    <?php 
      if($error){
    ?>
      <div class="alert alert-danger" role="alert">
       <?php echo $error ?>
      </div>
    <?php 
      header("refresh:10;url=pelanggan.php");// 10 : detik
    }
    ?>
    <?php 
      if($sukses){
    ?>
      <div class="alert alert-success" role="alert">
       <?php echo $sukses ?>
      </div>
    <?php 
      header("refresh:5;url=pelanggan.php");// 5 : detik
    }
    ?>



    <form action="" method="POST">
    	<div class="mb-3 row">
        <label for="id_pelanggan" class="col-sm-2 col-form-label">ID PELANGGAN</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" value="<?php echo $id_pelanggan ?>">
          </div>
      </div>
      <div class="mb-3 row">
    <label for="nama_pelanggan" class="col-sm-2 col-form-label">NAMA PELANGGAN</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $nama_pelanggan ?>">
    </div>
          </div>
          <div class="mb-3 row">
    <label for="alamat_pelanggan" class="col-sm-2 col-form-label">ALAMAT PELANGGAN</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="alamat_pelanggan" name="alamat_pelanggan" value="<?php echo $alamat_pelanggan ?>">
    </div>  
  </div>

          <div class="mb-3 row">
    <label for="jenis_kelamin" class="col-sm-2 col-form-label">JENIS KELAMIN</label>
    <div class="col-sm-10">
      <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
            <option value=""> - PILIH JENIS KELAMIN - </option>
            <option value="Laki-laki" <?php if($jenis_kelamin == "Laki-laki") echo "selected"?>>Laki-laki</option>
            <option value="Perempuan" <?php if($jenis_kelamin == "Perempuan") echo "selected"?>>Perempuan</option>
        </select>
    </div>
  </div>

          <div class="mb-3 row">
        <label for="no_telepon" class="col-sm-2 col-form-label">NO TELEPON</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="no_telepon" id="no_telepon" value="<?php echo $no_telepon ?>"/>
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
    Data Pelanggan Indomaret
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID PELANGGAN</th>
          <th scope="col">NAMA PELANGGAN</th>
          <th scope="col">ALAMAT PELANGGAN</th>
          <th scope="col">JENIS KELAMIN</th>
          <th scope="col">NO TELEPON</th>
          <th scope="col">AKSI</th>
        </tr>
        <tbody>
          <?php 
            $sql2 = "select * from pelanggan_indomaret order by id_pelanggan desc";
            $q2   = mysqli_query($koneksi,$sql2);
            $urut = 1;
            while($r2 = mysqli_fetch_array($q2))
            {
                $id_pelanggan     = $r2['id_pelanggan'];
                $nama_pelanggan   = $r2['nama_pelanggan'];
                $alamat_pelanggan = $r2['alamat_pelanggan'];
                $jenis_kelamin    = $r2['jenis_kelamin'];
                $no_telepon       = $r2['no_telepon'];
          ?>

                <tr>
                  <th scope="row"> <?php echo $urut++ ?> </th>
                  <td scope="row"> <?php echo $id_pelanggan ?> </td>
                  <td scope="row"> <?php echo $nama_pelanggan ?> </td>
                  <td scope="row"> <?php echo $alamat_pelanggan ?> </td>
                  <td scope="row"> <?php echo $jenis_kelamin ?> </td>
                  <td scope="row"> <?php echo $no_telepon ?> </td>

                  <td scope="row">
                    <a href="pelanggan.php?op=edit&id_pelanggan= <?php echo $id_pelanggan ?>">
                      <button type="button" class="btn btn-warning">Edit</button></a>
                    <a href="pelanggan.php?op=delete&id_pelanggan= <?php echo $id_pelanggan ?>" onclick="return confirm('Yakin Ingin Delete Data Pelanggan?')">
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

