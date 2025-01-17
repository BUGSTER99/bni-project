<?php 
    
    $conn = mysqli_connect('localhost', 'root', '', 'bni_multiuser') or die(mysqli_error($conn));
    $prefix = "tbl_pmg_";
    // Query ke Database
    function query($query)
    {
        global $conn;
        $result = mysqli_query($conn,$query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }
        return $rows;
    }

    // Hapus
    function clean($id, $table){
        global $conn;
        
        mysqli_query($conn , "DELETE FROM $table WHERE id = $id");
        return mysqli_affected_rows($conn);
    } 

    function edit($data){
        global $conn;
        global $prefix;
        $table = $data['table'];
        switch ($table) {
            case 'sektor':
                $values =  "kd_sektor='".$data['kd_sektor']."',nm_sektor='".$data['nm_sektor']."',nm_dir='".$data['nm_dir']."',level_dir='".$data['level_dir']."',status='".$data['status']."'";
                break;
            // case 'divisi':
            //         $values =  "'', '".$data['kd_sektor']."', '".$data['kd_divisi']."', '".$data['nm_divisi']."','".$data['nm_gm']."','".$data['tipe_divisi']."','".$data['level_divisi']."','". $data['status'] ."'";
            //     break;
            // case 'wilayah':
            //         $values =  "'', '".$data['id_wil']."', '".$data['kd_wil']."', '".$data['nm_wil']."','".$data['nm_ceo']."','".$data['status']."'";
            //     break;
            // case 'cabang':
            //         $values =  "'', '".$data['id_wil']."', '".$data['id_cab']."', '".$data['kd_cab']."','".$data['nm_cab']."','".$data['tipe_cab_1']."','".$data['tipe_cab_2']."','". $data['status'] ."'";
            //     break;   
            // case 'sentra':
            //         $values =  "'', '".$data['id_wil']."', '".$data['id_sentra']."', '".$data['kd_sentra']."','".$data['nm_sentra']."','".$data['tipe_sentra']."','". $data['status'] ."'";
            //     break;
            // case 'perusahaan':
            //         $values =  "'', '".$data['kd_pa']."', '".$data['nm_pa']."', '".$data['nm_dir']."','".$data['status']."'";
            //         break;   
            // case 'cabangln':
            //         $values =  "'', '".$data['id_cab']."', '".$data['kd_cab']."', '".$data['nm_cab']."','".$data['status']."'";
            //         break; 

            //     default :
            //         break;
        }
        $query = "UPDATE $prefix$table SET $values WHERE id=".$data['id']."";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }



    // Tambah
    function tambah($data){
        global $conn;

        // $id = $data["id"];
        $table = $data['table'];
        switch ($table) {
            case 'sektor':
                $values =  "'', '".$data['kd_sektor']."', '".$data['nm_sektor']."', '".$data['nm_dir']."','".$data['level_dir']."','".$data['status']."'";
                break;
            case 'divisi':
                    $values =  "'', '".$data['kd_sektor']."', '".$data['kd_divisi']."', '".$data['nm_divisi']."','".$data['nm_gm']."','".$data['tipe_divisi']."','".$data['level_divisi']."','". $data['status'] ."'";
                break;
            case 'wilayah':
                    $values =  "'', '".$data['id_wil']."', '".$data['kd_wil']."', '".$data['nm_wil']."','".$data['nm_ceo']."','".$data['status']."'";
                break;
            case 'cabang':
                    $values =  "'', '".$data['id_wil']."', '".$data['id_cab']."', '".$data['kd_cab']."','".$data['nm_cab']."','".$data['tipe_cab_1']."','".$data['tipe_cab_2']."','". $data['status'] ."'";
                break;   
            case 'sentra':
                    $values =  "'', '".$data['id_wil']."', '".$data['id_sentra']."', '".$data['kd_sentra']."','".$data['nm_sentra']."','".$data['tipe_sentra']."','". $data['status'] ."'";
                break;
            case 'perusahaan':
                    $values =  "'', '".$data['kd_pa']."', '".$data['nm_pa']."', '".$data['nm_dir']."','".$data['status']."'";
                    break;   
            case 'cabangln':
                    $values =  "'', '".$data['id_cab']."', '".$data['kd_cab']."', '".$data['nm_cab']."','".$data['status']."'";
                    break; 

                default :
                    break;
        }

        $query = "INSERT INTO $table VALUES ($values)";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
    

    // login
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // CEK USER
        $cek = mysqli_query($conn , "SELECT * from users where username = '$username' and password = '$password'");
        
        // hitung jumlah baris
        $hitung = mysqli_num_rows($cek);

        if ($hitung > 0) {
            // kalau data ditemukan
            $ambildata = mysqli_fetch_array($cek);
            $role = $ambildata['role'];
            $nama = $ambildata['username'];

            if ($role == 'admin') {
              
                // kalau admin
                session_start();
                $_SESSION['log'] = 'Logged';
                $_SESSION['username'] = $ambildata['username'];
                $_SESSION['role'] = 'admin';
                header('Location: admin');
            }else {
                // kalau user
                session_start();
                $_SESSION['log'] = 'Logged';
                $_SESSION['role'] = 'user';
                $_SESSION['username'] = $ambildata['username'];
                header('Location: user');
            }

        }else {
            // kalo tidak ditemukan
            echo "<script>
                alert('Maaf Data Tidak Ditemukan');
            </script>";
        }

    };
?>