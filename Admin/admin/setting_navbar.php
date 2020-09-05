<!-- Bagian Navbar / menu bagian atas dan samping-->
<nav class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><span class="fa fa-laptop"></span> Ruang Admin</a>
    </div>
    <ul class="nav navbar-nav navbar-right">
            <li class="message-preview"><a href="#"><i class="fa fa-info-circle"></i> <span class="label label-default">12</span></a></li>
            <li class="dropdown">
                <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $admin['nama_admin'];?><span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="logout.php">Logout</a></li>

                </ul>
            </li>
        </ul>
    <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav side-nav">
            <li><a href="home.php">Home</a></li>
            <li><a href="member.php">Data Member</a></li>

            <li class="dropdown">
                <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">Data Produk <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="produk.php">Daftar Produk</a></li>
                    <li><a href="brand.php">Brand / Merk</a></li>
                    <li><a href="supplier.php">Suplier</a></li>
                    <li><a href="kategori.php">Kategori Produk</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">Data Kurir <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="ongkir.php">Daftar Harga Ongkir</a></li>
                    <li><a href="kurir.php">Daftar Kurir</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a aria-expanded="false" href="#" class="dropdown-toggle" data-toggle="dropdown">Pengaturan <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="infobis.php">Informasi Bisnis</a></li>
                    <li><a href="identitas.php">Informasi SEO Website</a></li>
                    <li><a href="slider.php">Foto Slider</a></li>
                    <li><a href="admin.php">Akun Admin</a></li>
                </ul>
            </li>

        </ul>
    </div>
</nav>
<!-- Bagian Navbar / menu bagian atas dan samping-->

