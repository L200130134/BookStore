
$('#konfirmasi-hapus').on('show.bs.modal', function(e) {
    $(this).find('.btn-hapus').attr('href', $(e.relatedTarget).data('href'));
});

$('#ubah-data').on('show.bs.modal', function(e) {
    $(this).find('.data-isbn').attr('value', $(e.relatedTarget).data('isbn'));
    $(this).find('.data-judul').attr('value', $(e.relatedTarget).data('judul'));
    $(this).find('.data-harga').attr('value', $(e.relatedTarget).data('harga'));
    $(this).find('.data-tglterbit').attr('value', $(e.relatedTarget).data('tglterbit'));
    $(this).find('.data-deskripsi').val($(e.relatedTarget).data('deskripsi'));
    $(this).find('.data-penulis').attr('value', $(e.relatedTarget).data('penulis'));
    $(this).find('.data-penerbit').attr('value', $(e.relatedTarget).data('penerbit'));
    $(this).find('.data-idpenerbit').attr('value', $(e.relatedTarget).data('idpenerbit'));
    $(this).find('.data-idpenulis').attr('value', $(e.relatedTarget).data('idpenulis'));
	
    $(this).find('.data-notagihan').attr('value', $(e.relatedTarget).data('notagihan'));
	
    $(this).find('.data-idpelanggan').attr('value', $(e.relatedTarget).data('idpelanggan'));
    $(this).find('.data-nama').attr('value', $(e.relatedTarget).data('nama'));
    $(this).find('.data-email').attr('value', $(e.relatedTarget).data('email'));
    $(this).find('.data-alamat').attr('value', $(e.relatedTarget).data('alamat'));
    $(this).find('.data-kota').attr('value', $(e.relatedTarget).data('kota'));
    $(this).find('.data-postalkode').attr('value', $(e.relatedTarget).data('postalkode'));
    $(this).find('.data-provinsi').attr('value', $(e.relatedTarget).data('provinsi'));
});

$('#konfirmasi-order').on('show.bs.modal', function(e) {
    $(this).find('.data-notagihan').attr('value', $(e.relatedTarget).data('notagihan'));
    $(this).find('.data-tglkirim').attr('value', $(e.relatedTarget).data('tglkirim'));
    $(this).find('.data-status').attr('value', $(e.relatedTarget).data('status'));
});

$('#statuslist li').on('click', function(){
    $('#statusorder').val($(this).text());
});
