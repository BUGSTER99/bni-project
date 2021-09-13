$(function(){

    $('.tambahData').on('click', function(){
        $('#formModalLabel').html('Input Sektor');
        $('.modal-footer button[type=submit]').html('Tambah');

    });


    $('.editData').on('click', function (){
        $('#formModalLabel').html('Edit Sektor');
        $('.modal-footer button[type=submit]').html('Edit');
        var position = $(this).data('id');
        if($(this).data('href') == "sektor"){
            var kd_sektor = $('.kd_sektor'+position).text();
            var nm_sektor = $('.nm_sektor'+position).text();
            var nm_dir = $('.nm_dir'+position).text();
            var level_dir = $('.level_dir'+position).text();
            var status = $('.status'+position).text();
            $('#form').attr('action','update.php');
            $('#id_sektor').text(position);
            $('#kd_sektor').val(kd_sektor);
            $('#nm_sektor').val(nm_sektor);
            $('#nm_dir').val(nm_dir);
            $('#level_dir').val(level_dir);
            $('#status').val(status);
        }
     
    });

});