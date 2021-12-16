<?php

if (!isset($_GET['aksi'])) {
?>
    <h4 style='padding-top:15px'>Produk Krisis</h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a class='btn btn-primary' href='index.php?page=product&aksi=tambah'><i class='fa fa-plus'></i> Tambah Produk</a>

            </div>

            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead class='alert-info'>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Kategori</th>
                            <th>Gambar</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Dilihat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $product = mysqli_query($conn, "SELECT * FROM product ORDER BY product_name ASC");

                        $no = 1;
                        while ($row = mysqli_fetch_array($product)) {
                            echo "<tr class='gradeX'>
                            <td>$no</td>
                            <td>$row[product_name]</td>
                            <td>$row[product_desc]</td>
                            <td>$row[product_category]</td>
                            <td><img src='img/product/$row[product_img]' style='height:100px;' alt='$row[product_img]'></td>
                            <td>$row[product_stock]</td>
                            <td>$row[product_price]</td>
                            <td>$row[product_seen]</td>
                            <td style='width:130px' class='text-right'><a class='btn' href='index.php?page=product&aksi=edit&id=$row[product_id]'><i class='fa fa-pencil-square-o'></i></a>
                                                  <a class='btn' href='index.php?page=product&aksi=hapus&id=$row[product_id]'  onclick=\"return confirm('Apakah anda Yakin Data ini Dihapus?')\"  title='Hapus Mahasiswa ini'><i class='fa fa-trash-o'></i></a>
                                                  ";
                            echo "</td>
                                 </tr>";
                            $no++;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Basic Data Tables Example -->
<?php
} elseif ($_GET['aksi'] == 'hapus') {
    mysqli_query($conn, "DELETE FROM product WHERE product_id='$_GET[id]'");
    echo "<script>window.alert('Produk Berhasil Di Hapus.');
                                window.location='index.php?page=product'</script>";
} elseif ($_GET['aksi'] == 'tambah') {
    if (isset($_POST['submit'])) {

        //cek apakah ada yang sama
        if (addProduct($_POST) > 0) {
            echo "		
                <script>
                    alert('Data Produk Berhasil Ditambahkan');
                    document.location.href = 'index.php?page=product';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data Produk Gagal Ditambahkan');
                    document.location.href = 'index.php?page=product';
                </script>
            ";
        }
    }
?>

    <h4 style='padding-top:15px'></h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Tambahkan Produk</strong></div>
            <div class="panel-body">
                <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Produk</label>
                        <div class="col-lg-4">
                            <input type="text" name="product_name" type="text" autofocus class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Deskripsi Produk</label>
                        <div class="col-lg-4">
                            <input type="text" id="product_desc" name="product_desc" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Kategori Produk</label>
                        <div class="col-lg-4">
                            <input type="number" id="product_category" name="product_category" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Stok Produk</label>
                        <div class="col-lg-4">
                            <input type="number" id="product_stock" name="product_stock" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Harga Produk</label>
                        <div class="col-lg-4">
                            <input type="number" id="product_price" name="product_price" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Gambar Produk</label>
                        <div class="col-lg-4">
                            <input type="file" id="gambar" name="gambar" class="bg-focus form-control" data-required="true">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-9 pull-right">
                            <button type="submit" name='submit' class="btn btn-info">Simpan Data</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
} elseif ($_GET['aksi'] == 'edit') {

    if (isset($_POST['update'])) {
        if (updateProduct($_POST) > 0) {
            echo "		
                    <script>
                        alert('Data Produk Berhasil Diupdate');
                        document.location.href = 'index.php?page=product';
                    </script>
                ";
        } else {
            echo "
                    <script>
                        alert('Data Produk Gagal Diupdate');
                        document.location.href = 'index.php?page=product';
                    </script>
                ";
        }
    }
    $item = mysqli_fetch_array(getItem('product', $_GET['id']));
    function selected($a, $b)
    {
        if ($a == $b) return "selected";
        else return "";
    }
?>

    <h4 style='padding-top:15px'></h4>
    <!-- Basic Data Tables Example -->
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading"><strong>Edit Produk</strong></div>
            <div class="panel-body">
                <form action='' class="form-horizontal" method="POST" data-validate="parsley" enctype='multipart/form-data'>
                    <div class="form-group">
                        <label class="col-lg-2 control-label">Nama Produk</label>
                        <div class="col-lg-4">
                            <input type="text" name="product_name" type="text" autofocus class="bg-focus form-control" data-required="true" value="<?= $item['product_name'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Deskripsi Produk</label>
                        <div class="col-lg-4">
                            <input type="text" id="product_desc" name="product_desc" class="bg-focus form-control" data-required="true" value="<?= $item['product_desc'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Kategori Produk</label>
                        <div class="col-lg-4">
                            <input type="number" id="product_category" name="product_category" class="bg-focus form-control" data-required="true" value="<?= $item['product_category'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Stok Produk</label>
                        <div class="col-lg-4">
                            <input type="number" id="product_stock" name="product_stock" class="bg-focus form-control" data-required="true" value="<?= $item['product_stock'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Harga Produk</label>
                        <div class="col-lg-4">
                            <input type="number" id="product_price" name="product_price" class="bg-focus form-control" data-required="true" value="<?= $item['product_price'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label">Gambar Produk</label>
                        <div class="col-lg-4">
                            <input type="file" id="gambar" name="gambar" class="bg-focus form-control" value="<?= $item['product_img'] ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-9 pull-right">
                            <button type="submit" name='update' class="btn btn-info">Update Data</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php }
include "footer.php";
?>