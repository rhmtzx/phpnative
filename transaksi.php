<?php

$host ="localhost";
$user ="root";
$pass ="";
$db   ="indomaret";

$koneksi  = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){//cek koneksi
  die("Tidak bisa terkoneksi ke database");
} 

$no_transaksi    = "";
$id_pelanggan    = "";
$id_karyawan     = "";
$kode_barang     = "";
$tgl_transaksi   = "";
$total_harga     = "";
$sukses          = "";
$error           = "";

if(isset($_GET['op'])){
  $op = $_GET['op'];
} else{
  $op = "";
}

if ($op == 'delete') {
  $no_transaksi = $_GET['no_transaksi'];
  $sql1       = "delete from transaksi_indomaret where no_transaksi = '$no_transaksi'";
  $q1         = mysqli_query($koneksi,$sql1);
  if ($q1) {
    $sukses = "Berhasil Menghapus Data";
  } else{
    $error  = "Gagal Melakukan Delete Data";
  }
}



if ($op == 'edit') { //proses edit data
  $no_transaksi    = $_GET['no_transaksi'];
  $sql1            = "select * from transaksi_indomaret where no_transaksi = '$no_transaksi'";
  $q1              = mysqli_query($koneksi,$sql1);
  $r1              = mysqli_fetch_array($q1);
  $no_transaksi    = $r1['no_transaksi'];
  $id_pelanggan    = $r1['id_pelanggan'];
  $id_karyawan     = $r1['id_karyawan'];
  $kode_barang     = $r1['kode_barang'];
  $tgl_transaksi   = $r1['tgl_transaksi'];
  $total_harga     = $r1['total_harga'];

  if ($no_transaksi == '') {
    $error = "Data Tidak Ditemukan";
  }
}

if(isset($_POST['simpan'])){ //untuk create
  $no_transaksi     = $_POST['no_transaksi'];
  $id_pelanggan   = $_POST['id_pelanggan'];
  $id_karyawan = $_POST['id_karyawan'];
  $kode_barang     = $_POST['kode_barang'];
  $tgl_transaksi   = $_POST['tgl_transaksi'];
  $total_harga   = $_POST['total_harga'];


  if($no_transaksi && $id_pelanggan && $id_karyawan && $kode_barang&& $tgl_transaksi&& $total_harga){
        if ($op == 'edit') { // untuk update
          $sql1 = "update transaksi_indomaret set no_transaksi = '$no_transaksi',id_pelanggan = '$id_pelanggan',id_karyawan = '$id_karyawan',kode_barang = '$kode_barang',tgl_transaksi = '$tgl_transaksi',total_harga = '$total_harga' where no_transaksi = '$no_transaksi'";
          $q1 = mysqli_query($koneksi,$sql1);
          if($q1){
            $sukses = "Data Berhasil Di Update";
          } else{
            $error = "Data Gagal Di Update";
          }
        }else{ //untuk insert
          $sql1 = "insert into transaksi_indomaret(no_transaksi,id_pelanggan,id_karyawan,kode_barang,tgl_transaksi,total_harga) values ('$no_transaksi','$id_pelanggan','$id_karyawan','$kode_barang','$tgl_transaksi','$total_harga')";
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
      <title>Data Transaksi</title>
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
            Create / Edit Data Transaksi
          </div>
          <div class="card-body">
            <?php 
            if($error){
              ?>
              <div class="alert alert-danger" role="alert">
               <?php echo $error ?>
             </div>
             <?php 
      header("refresh:10;url=transaksi.php");// 10 : detik
    }
    ?>
    <?php 
    if($sukses){
      ?>
      <div class="alert alert-success" role="alert">
       <?php echo $sukses ?>
     </div>
     <?php 
      header("refresh:5;url=transaksi.php");// 5 : detik
    }
    ?>



    <form action="" method="POST">
      <div class="mb-3 row">
        <label for="no_transaksi" class="col-sm-2 col-form-label">NO TRANSAKSI</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="no_transaksi" id="no_transaksi" value="<?php echo $no_transaksi ?>"/>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="id_pelanggan" class="col-sm-2 col-form-label">ID PELANGGAN</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" value="<?php echo $id_pelanggan ?>">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="id_karyawan" class="col-sm-2 col-form-label">ID KARYAWAN</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="id_karyawan" name="id_karyawan" value="<?php echo $id_karyawan ?>">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="kode_barang" class="col-sm-2 col-form-label">KODE BARANG</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="kode_barang" id="kode_barang" value="<?php echo $kode_barang ?>"/> 
        </div>
      </div>
      <div class="mb-3 row">
        <label for="tgl_transaksi" class="col-sm-2 col-form-label">TGL TRANSAKSI</label>
        <div class="col-sm-10">
          <input type="text-white" class="form-control" name="tgl_transaksi" id="tgl_transaksi" value="<?php echo $tgl_transaksi?>"/>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="total_harga" class="col-sm-2 col-form-label">TOTAL HARGA</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="total_harga" id="total_harga" value="<?php echo $total_harga ?>">
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
    Data Transaksi
  </div>
  <div class="card-body">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">NO TRANSAKSI</th>
          <th scope="col">ID PELANGGAN</th>
          <th scope="col">ID KARYAWAN</th>
          <th scope="col">KODE BARANG</th>
          <th scope="col">TGL TRANSAKSI</th>
          <th scope="col">TOTAL HARGA</th>
          <th scope="col">AKSI</th>
        </tr>
        <tbody>
          <?php 
          $sql2 = "select * from transaksi_indomaret order by no_transaksi desc";
          $q2   = mysqli_query($koneksi,$sql2);
          $urut = 1;
          while($r2 = mysqli_fetch_array($q2))
          {
            $no_transaksi     = $r2['no_transaksi'];
            $id_pelanggan   = $r2['id_pelanggan'];
            $id_karyawan = $r2['id_karyawan'];
            $kode_barang     = $r2['kode_barang'];
            $tgl_transaksi   = $r2['tgl_transaksi'];
            $total_harga   = $r2['total_harga'];
            ?>

            <tr>
              <th scope="row"> <?php echo $urut++ ?> </th>
              <td scope="row"> <?php echo $no_transaksi ?> </td>
              <td scope="row"> <?php echo $id_pelanggan ?> </td>
              <td scope="row"> <?php echo $id_karyawan ?> </td>
              <td scope="row"> <?php echo $kode_barang?> </td>
              <td scope="row"> <?php echo $tgl_transaksi ?> </td>
              <td scope="row"> <?php echo $total_harga ?> </td>

              <td scope="row">
                <a href="transaksi.php?op=edit&no_transaksi= <?php echo $no_transaksi ?>">
                  <button type="button" class="btn btn-warning">Edit</button></a>
                  <a href="transaksi.php?op=delete&no_transaksi= <?php echo $no_transaksi ?>" onclick="return confirm('Yakin Ingin Delete Data Transaksi?')">
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

