<div class="modal position-fixed fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mr-auto" id="exampleModalLabel">Keranjang (<span id="jumlah_keranjang" class="total-count"></span>)</h5>
        <button class="clear-cart btn btn-danger">Hapus Semua</button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="show-cart table">
          
        </table>
        <div class="text-right">Total pembayaran: Rp.<span class="total-cart"></span></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="button" id="bayarba" class="btn btn-primary" onclick="window.location.href='pembayaran.php'">Bayar Sekarang</button>
      </div>
    </div>
  </div>
</div> 

<script>
  
</script>