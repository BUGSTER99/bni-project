<?php 

    
    require 'function.php';

    if (isset($_POST["submit"])) {
        if (tambah($_POST) > 0 ) {
            echo "
            <script>
                alert ('Data berhasil ditambah');
               document.location.href = 'admin/konfigurasiUnit/". $_POST['table'] .".php'
            </script>
        ";
    }else {
        echo "
        <script>
            alert ('Data gagal ditambah');
            document.location.href = 'admin/konfigurasiUnit/". $_POST['table'] .".php'
        </script>
"; 
}
} 
?>