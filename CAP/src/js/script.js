$(function() {
  
  $('.tampilModalTambah').on('click', function(){
    
    $('#judulModalLabel').html('Tambah Data Mahasiswa');
    $('.modal-footer button[type=submit]').html('Tambah Data');

  });

  $('.tampilModalUbah').on('click', function(){
    
    $('#judulModalLabel').html('Ubah Data Mahasiswa');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.modal-body form').attr('action', 'http://localhost/MencobaRepo/Pak%20Victor/phpmvc/public/mahasiswa/ubah')

    const id = $(this).data('id');
    
    $.ajax({
      url: 'http://localhost/MencobaRepo/Pak%20Victor/phpmvc/public/mahasiswa/getubah',
      data: {id : id},
      method: 'post',
      dataType: 'json',
      success: function(data) {
        $('#nama').val(data.nama);
        $('#nim').val(data.nim);
        $('#email').val(data.email);
        $('#jurusan').val(data.jurusan);
        $('#id').val(data.id_mhs);
      }
    });

  });

});