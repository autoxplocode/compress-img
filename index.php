<!DOCTYPE html>
<!-- copyright AutoXploCode -->
<html>

<head>
    <title>compress gambar tidak menghilangkan kualitas gambar :autoxplocode </title>
</head>


    <h3>tipe file gif, jpg, png yang di perbolehkan</h3>
<body>
    <form action='' method='POST' enctype='multipart/form-data'>
        <input name="image_file" type="file" accept="image/*">
        <button type="submit">SUBMIT</button>
    </form>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $file_name = $_FILES["image_file"]["name"];
    $file_type = $_FILES["image_file"]["type"];
    $temp_name = $_FILES["image_file"]["tmp_name"];
    $file_size = $_FILES["image_file"]["size"];
    $error = $_FILES["image_file"]["error"];
    if (!$temp_name)
    {
        echo "ERROR: Upload File Sebelum Submit";
        exit();
    }
    function compress_image($source_url, $destination_url, $quality)
    {
        $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
        imagejpeg($image, $destination_url, $quality);
        echo "<br />"; 
        echo "[+] Berhasil Upload Gambar.";
        echo "<br />";  

    }
    if ($error > 0)
    {
        echo $error;
    }
    else if (($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
    { 
        $filename = compress_image($temp_name, "uploads/" . $file_name, 80);
                echo "<br />";  
                echo "[+] berhasil compress ukuran file gambar dari : $file_size bytes";
                echo "<br />";  
                echo "<br />";   
        $imgsize = filesize("uploads/$file_name");
                 echo "[+] Berhasil mengubah menjadi $imgsize bytes";
                 echo "<br />";  
                 echo "<br />";  
                 echo "[+] Download Gambar <img src='uploads/$file_name'>";
                 echo "<br />";  
                 echo "<br />";  
                 echo "klik kanan / tahan lalu tekan download";
    }
    else
    {
        echo "ext file jpg png gif yang di bolehkan.";
    }
} ?>
