<?php

function message($message)
{
    echo "<script>alert('$message')</script>";
}

function addProduct($data)
{
    global $conn;
    $product_name = htmlspecialchars($data["product_name"]);
    $product_desc = htmlspecialchars($data["product_desc"]);
    $product_category = htmlspecialchars($data["product_category"]);
    $product_stock = htmlspecialchars($data["product_stock"]);
    $product_price = htmlspecialchars($data["product_price"]);

    //upload gambar
    $gambar    = upload();
    if (!$gambar) {
        return false;
    }

    //query insert data
    $query  = "INSERT INTO product
			VALUES (null, '$product_name', '$product_desc', '$product_category', '$gambar', '$product_stock', '0', '$product_price', current_timestamp)";
    mysqli_query($conn, $query);
    return (mysqli_affected_rows($conn));
}

function upload()
{

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah gambar di upload
    if ($error === 4) {
        echo "<script>
				alert ('Pilih Gambar terlebih dahulu');
			</script>";
        return 'false';
    }

    //cek apakah yang di upload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
				alert ('Yang Anda Upload Bukan Gambar');
			</script>";
        return false;
    }

    //cek jika ukuran terlalu besar 
    if ($ukuranFile > 30000000) {
        echo "<script>
				alert ('Ukuran Gambar telalu Besar');
			</script>";
        return false;
    }

    //lolos pengecekan
    //generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/product/' . $namaFileBaru);
    return $namaFileBaru;
}

function updateProduct($data)
{
    global $conn;
    $product_name = htmlspecialchars($data["product_name"]);
    $product_desc = htmlspecialchars($data["product_desc"]);
    $product_category = htmlspecialchars($data["product_category"]);
    $product_stock = htmlspecialchars($data["product_stock"]);
    $product_price = htmlspecialchars($data["product_price"]);

    //upload gambar
    $gambar    = $_FILES['gambar']['name'];
    if ($gambar == '') {
        $query  = "UPDATE product
			SET `product_name` = '$product_name', `product_desc` = '$product_desc', `product_category` = '$product_category', `product_stock` = '$product_stock', product_price = '$product_price', update_at = current_timestamp
            WHERE product_id = '$_GET[id]'";
        mysqli_query($conn, $query);
    } else {
        $nameBefore = mysqli_fetch_assoc(getItem('product', $_GET['id']))['product_img'];
        $gambar = uploadUpdate($nameBefore);
        $query  = "UPDATE product
			SET product_img = '$gambar', product_name =  '$product_name', product_desc = '$product_desc', product_category = '$product_category', product_stock = '$product_stock', product_price = '$product_price', update_at = current_timestamp
            WHERE product_id = '$_GET[id]'";
        mysqli_query($conn, $query);
    }
    return (mysqli_affected_rows($conn));
}

function getItem($tableName, $id)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM $tableName WHERE " . $tableName . "_id = '$id'");
    return $result;
}

function uploadUpdate($nameBefore)
{

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah gambar di upload
    if ($error === 4) {
        echo "<script>
				alert ('Pilih Gambar terlebih dahulu');
			</script>";
        return 'false';
    }

    //cek apakah yang di upload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
				alert ('Yang Anda Upload Bukan Gambar');
			</script>";
        return false;
    }

    //cek jika ukuran terlalu besar 
    if ($ukuranFile > 30000000) {
        echo "<script>
				alert ('Ukuran Gambar telalu Besar');
			</script>";
        return false;
    }

    //lolos pengecekan
    //generate nama file baru
    // $namaFileBaru = uniqid();
    // $namaFileBaru .= '.';
    // $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/product/' . $nameBefore);
    return $nameBefore;
}

function productCategory($data)
{
    global $conn;
    $getCategory = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM category WHERE category_id = '$data'"));
    return $getCategory["category_name"];
}
function rupiah($angka)
{
    $hasil_rupiah = number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
