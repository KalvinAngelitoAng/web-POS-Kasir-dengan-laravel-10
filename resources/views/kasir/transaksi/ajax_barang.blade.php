<?php
if(isset($detail_barang)){
    foreach($detail_barang as $row){
        ?>

        <div class="form-group">
            <label>Harga</label>
            <input type="text" readonly="" class="form-control" value="Rp. {{ number_format($row->harga) }}" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="text" readonly="" class="form-control" value="{{ $row->stok }}" required>
        </div>

        <div class="form-group">
            <label>Qty</label>
            <input name="qty" class="form-control" type="number" placeholder="Qty ..." required="">
        </div>

        <input type="hidden" readonly="" name="id_barang" class="form-control" value="{{ $row->id }}" required>
        <input type="hidden" readonly="" name="harga" class="form-control" value="{{ $row->harga }}" required>
        <input type="hidden" readonly="" name="nama_barang" class="form-control" value="{{ $row->nama_barang }}" required>
        <input type="hidden" readonly="" name="stok" class="form-control" value="<?php echo $row->stok; ?>" required>
    <?php
    }
}
?>
