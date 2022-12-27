<?php

$host	="localhost";
$user	="root";
$pass	="";
$db		="indomaret";

$koneksi	= mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){//cek koneksi
	die("Tidak bisa terkoneksi ke database");
} 

$idkaryawan     = "";
$namakaryawan   = "";
$alamatkaryawan = "";
$notelepon      = "";
$jeniskelamin   = "";
$sukses         = "";
$error          = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else{
  $op = "";
}

if ($op == 'delete') { //proses delete data
  $idkaryawan = $_GET['idkaryawan'];
  $sql1       = "delete from karyawan_indomaret where idkaryawan = '$idkaryawan'";
  $q1         = mysqli_query($koneksi,$sql1);
  if ($q1) {
    $sukses = "Berhasil Menghapus Data";
  } else{
    $error  = "Gagal Melakukan Delete Data";
  }
}



if ($op == 'edit') { //proses edit data
      $idkaryawan             = $_GET['idkaryawan'];
      $sql1           = "select * from karyawan_indomaret where idkaryawan = '$idkaryawan'";
      $q1             = mysqli_query($koneksi,$sql1);
      $r1             = mysqli_fetch_array($q1);
      $idkaryawan     = $r1['idkaryawan'];
      $namakaryawan   = $r1['namakaryawan'];
      $alamatkaryawan = $r1['alamatkaryawan'];
      $notelepon      = $r1['notelepon'];
      $jeniskelamin   = $r1['jeniskelamin'];

      if ($idkaryawan == '') {
        $error = "Data Tidak Ditemukan";
      }
}

if(isset($_POST['simpan'])){ //untuk create
      $idkaryawan     = $_POST['idkaryawan'];
      $namakaryawan   = $_POST['namakaryawan'];
      $alamatkaryawan = $_POST['alamatkaryawan'];
      $notelepon      = $_POST['notelepon'];
      $jeniskelamin   = $_POST['jeniskelamin'];

      

      if($idkaryawan && $namakaryawan && $alamatkaryawan && $notelepon&& $jeniskelamin){
        
        if ($op == 'edit') { // untuk update
          $sql1 = "update karyawan_indomaret set idkaryawan = '$idkaryawan',namakaryawan = '$namakaryawan',alamatkaryawan = '$alamatkaryawan',notelepon = '$notelepon',jeniskelamin = '$jeniskelamin' where idkaryawan = '$idkaryawan'";
          $q1 = mysqli_query($koneksi,$sql1);
          if($q1){
            $sukses = "Data Berhasil Di Update";
          } else{
            $error = "Data Gagal Di Update";
          }

        }else{ //untuk insert
          $sql1 = "insert into karyawan_indomaret(idkaryawan,namakaryawan,alamatkaryawan,notelepon,jeniskelamin) values ('$idkaryawan','$namakaryawan','$alamatkaryawan','$notelepon','$jeniskelamin')";
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
    <title>Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
      .mx-auto { width:1050px }
      .card { margin-top:10px }
    </style>

  </head>

  <body>
    
    <div class="mx-auto">
<!--untuk memasukkan data-->
    <div class="card">
  <div class="card-header">
    Create / Edit Data Karyawan Indomaret
  </div>
  <div class="card-body">
    <?php 
      if($error){
    ?>
      <div class="alert alert-danger" role="alert">
       <?php echo $error ?>
      </div>
    <?php 
      header("refresh:10;url=index.php");// 10 : detik
    }
    ?>
    <?php 
      if($sukses){
    ?>
      <div class="alert alert-success" role="alert">
       <?php echo $sukses ?>
      </div>
    <?php 
      header("refresh:5;url=index.php");// 5 : detik
    }
    ?>



    <form action="" method="POST">
    	<div class="mb-3 row">
        <label for="idkaryawan" class="col-sm-2 col-form-label">ID KARYAWAN</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="idkaryawan" id="idkaryawan" value="<?php echo $idkaryawan ?>">
          </div>
      </div>

      <div class="mb-3 row">
    <label for="namakaryawan" class="col-sm-2 col-form-label">NAMA KARYAWAN</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="namakaryawan" name="namakaryawan" value="<?php echo $namakaryawan ?>">
    </div>
  </div>
          
        <div class="mb-3 row">
        <label for="alamatkaryawan" class="col-sm-2 col-form-label">ALAMAT KARYAWAN</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="alamatkaryawan" id="alamatkaryawan" value="<?php echo $alamatkaryawan ?>"/>
          </div></div>

          <div class="mb-3 row">
        <label for="notelepon" class="col-sm-2 col-form-label">NO TELEPON</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="notelepon" id="notelepon" value="<?php echo $notelepon ?>"/>
          </div>
      </div>

          <div class="mb-3 row">
    <label for="jeniskelamin" class="col-sm-2 col-form-label">JENIS KELAMIN</label>
    <div class="col-sm-10">
      <select class="form-control" name="jeniskelamin" id="jeniskelamin">
            <option value="">- PILIH JENIS KELAMIN -</option>
            <option value="Laki-laki" <?php if($jeniskelamin == "Laki-laki") echo "selected"?>>Laki-laki</option>
            <option value="Perempuan" <?php if($jeniskelamin == "Perempuan") echo "selected"?>>Perempuan</option>
        </select>
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
    Data Karyawan Indomaret
    </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID KARYAWAN</th>
          <th scope="col">NAMA KARYAWAN</th>
          <th scope="col">ALAMAT KARYAWAN</th>
          <th scope="col">NO TELEPON</th>
          <th scope="col">JENIS KELAMIN</th>
          <th scope="col">AKSI</th>
        </tr>
        <tbody>
          <?php 
            $sql2 = "select * from karyawan_indomaret order by idkaryawan desc";
            $q2   = mysqli_query($koneksi,$sql2);
            $urut = 1;
            while($r2 = mysqli_fetch_array($q2))
            {
                $idkaryawan     = $r2['idkaryawan'];
                $namakaryawan   = $r2['namakaryawan'];
                $alamatkaryawan = $r2['alamatkaryawan'];
                $notelepon      = $r2['notelepon'];
                $jeniskelamin   = $r2['jeniskelamin'];
          ?>

                <tr>
                  <th scope="row"> <?php echo $urut++ ?> </th>
                  <td scope="row"> <?php echo $idkaryawan ?> </td>
                  <td scope="row"> <?php echo $namakaryawan ?> </td>
                  <td scope="row"> <?php echo $alamatkaryawan ?> </td>
                  <td scope="row"> <?php echo $notelepon ?> </td>
                  <td scope="row"> <?php echo $jeniskelamin ?> </td>

                  <td scope="row">
                    <a href="index.php?op=edit&idkaryawan= <?php echo $idkaryawan ?>">
                      <button type="button" class="btn btn-warning">Edit</button></a>
                    <a href="index.php?op=delete&idkaryawan= <?php echo $idkaryawan ?>" onclick="return confirm('Yakin Ingin Delete Data Karyawan?')">
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

