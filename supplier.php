<?php

$host	="localhost";
$user	="root";
$pass	="";
$db		="indomaret";

$koneksi	= mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){//cek koneksi
	die("Tidak bisa terkoneksi ke database");
} 

$idsupplier    = "";
$namasupplier   = "";
$alamatsupplier = "";
$notelepon      = "";
$sukses         = "";
$error          = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
} else{
  $op = "";
}

if ($op == 'delete') {
  $idsupplier = $_GET['idsupplier'];
  $sql1       = "delete from SUPPLIER_indomaret where idsupplier= '$idsupplier'";
  $q1         = mysqli_query($koneksi,$sql1);
  if ($q1) {
    $sukses = "Berhasil menghapus data";
  } else{
    $error  = "Gagal melakukan delete data";
  }
}



if ($op == 'edit')  { //proses edit data
      $idsupplier     = $_GET['idsupplier'];
      $sql1           = "select * from SUPPLIER_indomaret where idsupplier= '$idsupplier'";
      $q1             = mysqli_query($koneksi,$sql1);
      $r1             = mysqli_fetch_array($q1);
      $idsupplier     = $r1['idsupplier'];
      $namasupplier   = $r1['namasupplier'];
      $alamatsupplier = $r1['alamatsupplier'];
      $notelepon      = $r1['notelepon'];
     

      if ($idsupplier == '') {
        $error = "Data tidak ditemukan";
      }
}

if(isset($_POST['simpan'])){ //untuk create
      $idsupplier    = $_POST['idsupplier'];
      $namasupplier   = $_POST['namasupplier'];
      $alamatsupplier = $_POST['alamatsupplier'];
      $notelepon      = $_POST['notelepon'];
      
      

      if($idsupplier && $namasupplier && $alamatsupplier && $notelepon){
        if ($op == 'edit') { // untuk update
          $sql1 = "update supplier_indomaret set idsupplier = '$idsupplier',namasupplier = '$namasupplier',alamatsupplier = '$alamatsupplier',notelepon = '$notelepon' where idsupplier = '$idsupplier'";
          $q1 = mysqli_query($koneksi,$sql1);
          if($q1){
            $sukses = "Data Berhasil Di Update";
          } else{
            $error = "Data Gagal Di update";
          }
        }else{ //untuk insert
          $sql1 = "insert into supplier_indomaret(idsupplier,namasupplier,alamatsupplier,notelepon) values ('$idsupplier','$namasupplier','$alamatsupplier','$notelepon')";
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
    <title>Data Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
      .mx-auto { width:950px }
      .card { margin-top:10px }
    </style>

  </head>

  <body>
    <div class="mx-auto">

<!--untuk memasukkan data-->
    <div class="card">
  <div class="card-header">
    Create / Edit Data Supplier
  </div>
  <div class="card-body">
    <?php 
      if($error){
    ?>
      <div class="alert alert-danger" role="alert">
       <?php echo $error ?>
      </div>
    <?php 
      header("refresh:10;url=supplier.php");// 10 : detik
    }
    ?>
    <?php 
      if($sukses){
    ?>
      <div class="alert alert-success" role="alert">
       <?php echo $sukses ?>
      </div>
    <?php 
      header("refresh:5;url=supplier.php");// 5 : detik
    }
    ?>



    <form action="" method="POST">

    	<div class="mb-3 row">
    <label for="idsupplier" class="col-sm-2 col-form-label">ID SUPPLIER</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="idsupplier" name="idsupplier" value="<?php echo $idsupplier ?>">
    </div>
  </div>
      <div class="mb-3 row">
        <label for="namasupplier" class="col-sm-2 col-form-label">NAMA SUPPLIER</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="namasupplier" id="namasupplier" value="<?php echo $namasupplier ?>"/>
          </div>
          
          </div>
         <div class="mb-3 row">
        <label for="alamatsupplier" class="col-sm-2 col-form-label">ALAMAT SUPPLIER</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="alamatsupplier" id="alamatsupplier" value="<?php echo $alamatsupplier?>">
          </div>
      
          </div>
          <div class="mb-3 row">
    <label for="notelepon" class="col-sm-2 col-form-label">NO TELEPON</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="notelepon" name="notelepon" value="<?php echo $notelepon ?>">
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
    Data Supplier
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">ID SUPPLIER</th>
          <th scope="col">NAMA SUPPLIER</th>
          <th scope="col">ALAMAT SUPPLIER</th>
          <th scope="col">NO TELEPON</th>
          <th scope="col">AKSI</th>
        </tr>
        <tbody>
          <?php 
            $sql2 = "select * from supplier_indomaret order by idsupplier desc";
            $q2   = mysqli_query($koneksi,$sql2);
            $urut = 1;
            while($r2 = mysqli_fetch_array($q2))
            {
                $idsupplier    = $r2['idsupplier'];
                $namasupplier   = $r2['namasupplier'];
                $alamatsupplier = $r2['alamatsupplier'];
                $notelepon       = $r2['notelepon'];
          ?>

                <tr>
                  <th scope="row"> <?php echo $urut++ ?> </th>
                  <td scope="row"> <?php echo $idsupplier?> </td>
                  <td scope="row"> <?php echo $namasupplier ?> </td>
                  <td scope="row"> <?php echo $alamatsupplier ?> </td>                
                  <td scope="row"> <?php echo $notelepon ?> </td>

                  <td scope="row">
                    <a href="supplier.php?op=edit&idsupplier= <?php echo $idsupplier?>">
                      <button type="button" class="btn btn-warning">Edit</button></a>
                    <a href="supplier.php?op=delete&idsupplier= <?php echo $idsupplier?>" onclick="return confirm('Yakin Ingin Delete Data Supplier?')">
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

