     <?php 
// berfungsi mengaktifkan session
session_start();
 
// berfungsi menghubungkan koneksi ke database
include 'koneksi.php';
 
// berfungsi menangkap data yang dikirim
$email = $_POST['email'];
$pass = md5($_POST['password']);
 
// berfungsi menyeleksi data user dengan username dan password yang sesuai
$sql = mysqli_query($conn,"SELECT * FROM tb_tamu WHERE email='$email' AND password='$pass'");
//berfungsi menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($sql);

// berfungsi mengecek apakah username dan password ada pada database
if($cek > 0){
    $data = mysqli_fetch_array($sql);
    $_SESSION['status_login']   = true;
    $_SESSION['id_tamu']        = $data['id_tamu'];
    $_SESSION['nama']           = $data['nama'];
    $_SESSION['username']       = $data['username'];
    $_SESSION['telepon']        = $data['telepon'];
    $_SESSION['email']          = $data['email'];
    $_SESSION['alamat']         = $data['alamat'];
    $_SESSION['foto']           = $data['foto']; 
 
    // lakukan kuery cek akun di tabel pelanggan di database
    $cek = mysqli_query($conn, "SELECT * FROM tb_tamu WHERE email = '".$email."' AND password = '".$pass."'");

    // Hitung akun yang terambil
    $akunyangcocok = $cek->num_rows;

    // jika 1 akun yang cocok, maka diloginkan
    if ($akunyangcocok==1)  
        { 
            //anda sudah login
            // mendapatkan akun dalam bentuk array
            $akun = $cek->fetch_assoc();
            // simpan di session pelanggan
            $_SESSION['tamu'] = $akun;
           echo '<script>alert("Anda sukses login")</script>';
            echo '<script>window.location="user/tamu/index.php"</script>';
        }
        else 
        {
            //anda gagal login
            echo '<script>alert("anda gagal login, periksa kembali akun anda")</script>';
            echo '<script>window.location="login.php"</script>';
                        
        }
    }

?>