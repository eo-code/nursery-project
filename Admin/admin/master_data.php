<?php include 'header.php'; ?>

<?php
//set time zone location sesuai negara, jadikan Asia Jakarta
date_default_timezone_set('Asia/Jakarta');


$server = "localhost";
$user = "root";
$pass = "";
$database = "db_anekaindahnursery";

$conect = mysqli_connect($server, $user, $pass, $database) or die('Error Connection Network');


?>


<div id="page-wrapper">

    <div class="container-fluid">
        <!-- .row -->
        <!-- Page Heading  breadcumb-->
        <div class="row">
            <div class="col-lg-12">
                <h3>
                    Daftar Produk
                </h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- .row -->
        <div class="row">

            <!-- .col lg 12 -->
            <div class="col-lg-12">

                <!-- panel . (Pelajari cara membuat panel di bootstrap yah)-->
                <div class="panel panel-default">

                    <!-- panel heading -->
                    <div class="panel-heading">
                        <div class="col-lg-6">
                            <a href="input_produk.php" title="Input data"><button name="input" class="btn btn-primary"><i class="fa fa-plus-square-o fa-fw"></i> Input</button></a>
                        </div>
                        <div class="col-lg-6">
                            <!-- form pencarian produk -->
                            <form action="cari_produk.php" method="get" class="form-inline text-right">
                                <input type="text" class="form-control" name="qw" placeholder="Cari Produk" required>
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </form>
                            <!-- form pencarian produk -->
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <!-- /.panel heading -->

                    <!-- panel body -->
                    <div class="panel-body">

                        <!-- /.tabel responsive -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Tanaman</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Gambar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $pg = isset($_GET['pg']) ? $_GET['pg'] : "";
                                    $batas = 10; /*batas tampilan setiap halaman*/
                                    if (empty($pg)) {
                                        $posisi = 0;
                                        $pg = 1;
                                    } else {
                                        $posisi = ($pg - 1) * $batas;
                                    }
                                    /*Jika variabel $pg kosong maka akan menampilkan halaman pertama dengan batas baris 10*/

                                    // $ambildata = mysqli_query($conect, "select*from kateogri, master_data where kategori.Id_kategori=tb_brand.id_brand and tb_produk.id_kategori=tb_kategori.id_kategori and tb_produk.id_supplier=tb_supplier.id_supplier order by id_produk desc limit $posisi, $batas");
                                    $ambildata = mysqli_query($conect, "SELECT master_data.*, kategori.* FROM master_data LEFT JOIN kategori ON master_data.Id_kategori = kategori.Id_kategori ORDER BY Nama_tanaman DESC limit $posisi, $batas");
                                    $jumlah = mysqli_num_rows($ambildata);  /*mysql_num_rows untuk menghitung total baris di tabel databse*/
                                    if ($jumlah == 0) {  //jika tidak ada data
                                    ?>
                                        <tr>
                                            <td colspan="11">Tidak Terdapat Data</td>
                                        </tr>
                                        <?php
                                    } else {
                                        //jika ada data di tb_brand
                                        while ($a = mysqli_fetch_array($ambildata)) { /*mysql_fetch array untuk mengambil data di setiap field di tabel databse*/
                                        ?>
                                            <tr>
                                                <td><?php echo $posisi = $posisi + 1; ?></td>
                                                <td><?php echo $a['Nama_tanaman']; ?></td>
                                                <td><?php echo $a['Stok']; ?></td>
                                                <td>Rp <?php echo number_format($a['Harga_jual'], 2, ',', '.'); ?></td>
                                                <td><?php echo $a['Kategori']; ?></td>
                                                <td><?php echo $a['Kategori']; ?></td>
                                                <td><?php echo $a['Keterangan']; ?></td>
                                                <td><img src="../../Aplikasi/img/bg-img/gambar_tanaman/<?= $a['Kategori']; ?>/<?= $a['Gambar']; ?>" alt="" width="70px"></td>

                                                <td><a href="hapus_produk.php?id_produk=<?php echo $a['id_produk']; ?>" onclick="return confirm('Yakin akan meghapus data ini')" title="Hapus data"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o fa-fw"></i> Hapus</button></a>
                                                    <a href="edit_produk.php?id_produk=<?php echo $a['id_produk']; ?>" title="Edit data"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o fa-fw"></i> Edit</button> </a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tabel responsive -->

                        <div class="text-center">
                            <?php
                            //script paging, untuk menampikan setiap halaman
                            $jml_data = mysqli_num_rows(mysqli_query($conect, "SELECT master_data.*, kategori.* FROM master_data LEFT JOIN kategori ON master_data.Id_kategori = kategori.Id_kategori ORDER BY Nama_tanaman DESC"));
                            $JmlHalaman = ceil($jml_data / $batas); //ceil digunakan untuk pembulatan keatas
                            if ($jml_data != 0) {
                                if ($pg > 1) {
                                    $link = $pg - 1;
                                    $prev = "<a href='?pg=$link'><button name='prev' class='btn btn-primary btn-sm'>Prev</button></a> ";
                                } else {
                                    $prev = "<button name='prev' class='btn btn-default btn-sm'>Prev </button> ";
                                }
                                $nmr = '';
                                for ($i = 1; $i <= $JmlHalaman; $i++) {

                                    if ($i == $pg) {
                                        $nmr .= "<button name='prev' class='btn btn-primary btn-sm'>$i</button> ";
                                    } else {
                                        $nmr .= "<a href='?pg=$i'><button name='prev' class='btn btn-default btn-sm'>$i</button></a> ";
                                    }
                                }
                                if ($pg < $JmlHalaman) {
                                    $link = $pg + 1;
                                    $next = "<a href='?pg=$link'><button name='prev' class='btn btn-primary btn-sm'>Next</button></a> ";
                                } else {
                                    $next = "<button name='prev' class='btn btn-default btn-sm'>Next</button> ";
                                }
                                echo $prev . $nmr . $next;
                            ?>
                                <br><br>
                                <span class="text-muted">Menampilkan <?php echo $jumlah; ?> dari <?php echo $jml_data; ?> Record </span>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- /.panel body -->

                </div>
                <!-- /.panel -->

            </div>
            <!-- /.col lg 12-->

        </div>
        <!-- /.row -->


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php