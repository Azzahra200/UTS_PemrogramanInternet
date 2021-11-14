<?php

//Koneksi Database
$server = "localhost";
$user = "root";
$pass = "";
$database = "db_akademik";

$koneksi = mysqli_connect($server, $user, $pass, $database) or die (mysqli_error($koneksi));

if(isset($_POST['bsimpan'])) {
	
    if($_GET['hal'] == "Edit"){
 //data akan diedit
    $Edit = mysqli_query($koneksi, "UPDATE mahasiswa set NIM = '$_POST[tNIM]', Nama = '$_POST[tNama]', Angkatan = '$_POST[tAngkatan]', Prodi = '$_POST[tProdi]', WHERE id_mhs = '$_GET[id]'");

	if($Edit){
		echo "<script> alert('Edit data sukses!');dokument.location='index.php';</script>";
		       
	} else {
        echo "<script> alert('Edit data gagal!');dokument.location='index.php';</script>";
	}
} else {
 //data akan disimpam
}
	$simpan = mysqli_query($koneksi, "INSERT INTO mahasiswa (NIM, Nama, Angkatan, Prodi) VALUES ('$_POST[tNIM]', '$_POST[tNama]', '$_POST[tAngkatan]', '$_POST[tProdi]'),");
	if($simpan){
		echo "<script> alert('Simpan data sukses!');dokument.location='index.php';</script>";
		       
	} else {
        echo "<script> alert('Simpan data gagal!');dokument.location='index.php';</script>";
	}
}

if(isset($_GET['hal'])){
	if($_GET['hal'] == "Edit"){
		$tampil = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id_mhs = '$_GET[id]' ");
		$data = mysqli_fetch_array($tampil);
		if($data){
			$vNIM = $data['NIM'];
			$vNAMA = $data['Nama'];
			$vANGKATAN = $data['Angkatan'];
			$vPRODI = $data['Prodi'];
		}
	}
} else if ($_GET['hal'] == "Hapus"){
	// persiapan data
	$Hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mhs = '$_GET[id]'");
	if($Hapus){
		echo "<script> alert('Hapus data sukses!');dokument.location='index.php';</script>";
	} 
}

?>





<!DOCTYPE html>
<html>
<head>
	<title>Data Mahasiswa</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<h1 class="text-center">DATA MAHASISWA</h1>

<!-- Awal Card Form -->
	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    Form Input Data Mahasiswa
	  </div>
	  <div class="card-body">
	    <form method="post" action="">
	    	<div class="form-group">
	    		<label>NIM</label>
	    		<input type="text" name="tnim" value="<?=@$vNIM?>" class="form-control" placeholder="Input Nim Anda disini!" required>
	    	</div>
	    	<div class="form-group">
	    		<label>NAMA</label>
	    		<input type="text" name="tnama" value="<?=@$vNAMA?>" class="form-control" placeholder="Input Nama Anda disini!" required>
	    	</div>
	    	<div class="form-group">
	    		<label>ANGKATAN</label>
	    		<input type="text" name="tangkatan" value="<?=@$vANGKATAN?>" class="form-control"  placeholder="Input Angkatan Anda disini!" required>
	    	</div>
	    	<div class="form-group">
	    		<label>PRODI</label>
	    		<select class="form-control" name="tprodi">
	    			<option value="<?=@$vPRODI?>"><?=@$vPRODI?></option>
	    			<option value="Sistem Informasi">Sistem Informasi</option>
	    			<option value="Teknik Elektro">Teknik Elektro</option>
	    			<option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
	    			<option value="Akuntansi">Akuntansi</option>
	    			<option value="Kedokteran">Kedokteran</option>
	    			<option value="Bahasa Inggris">Bahasa Inggris</option>
	    		</select>
	    	</div>

	    	<button type="submit" class="btn btn-success mt-3" name="bsimpan" >Simpan</button>
	    	<button type="reset" class="btn btn-danger mt-3" name="breser" >Kosongkan</button>
	    </form>
	  </div>
	</div>
<!-- Akhir Card Form -->

<!-- Awal Card Tabel -->
	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
	    Daftar Mahasiswa
	  </div>
	  <div class="card-body">
	    
        <table class="table table-bordered table-striped">
        	<tr>
        		<th>NO.</th>
        		<th>NIM</th>
        		<th>NAMA</th>
        		<th>ANGKATAN</th>
        		<th>PRODI</th>
        		<th>AKSI</th>
        	</tr>
        	<?php
        	   $no = 1;
               $tampil = mysqli_query($koneksi, "SELECT * FROM mahasiswa ");
               while($data = mysqli_fetch_array($tampil)):

        	?>
        	<tr>
        		<td><?=$no++;?></td>
        		<td><?=$data['NIM']?></td>
        		<td><?=$data['Nama']?></td>
        		<td><?=$data['Angkatan']?></td>
        		<td><?=$data['Prodi']?></td>
        		<td>
        			<a href="index.php?hal=Edit&id=<?=$data['id_mhs']?>" class="btn btn-warning">Edit</a>
        			<a href="index.php?hal=Edit&id=<?=$data['id_mhs']?>" class="btn btn-danger">Hapus</a>
        		</td>
        	</tr>
        <?php endwhile; // penutup perulangan while?>
        </table>

	  </div>
	</div>
<!-- Akhir Card Tabel -->
</div>
<script type="text/javascript" src="css/bootstrap.min.js"></script>
</body>
</html>