<style type="text/css">

.box {
   height:188px;
   width:220px;
   margin-right:6.6px;
   margin-left:6.6px;
   margin-bottom:6.6px;
   margin-top:200px;
   position:relative;
   float:right;
}

.box>p {
   line-height:0;
}
</style>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
    <div class="row justify-content-center" >
      <table style=" margin-left: auto; margin-right: auto;">
        <tr>
            <td width="25%" align="left"><img id="logo" src="{{asset('public/images/logo.png')}}" width="80px"></td>
            <td width="75%"> <h5 style="text-align:center;">PENGADILAN TINGGI AGAMA PAPUA BARAT</h5>
                <h6 style="text-align:center">LAPORAN TRANSAKSI PERAWATAN BARANG</h6>
                <p style="text-align:center;">Dari tanggal: {{$dari_tgl}} - Sampai tanggal: {{$sampai_tgl}}</p>
            </td>
        
        </tr>
        </table>
        <hr>

    <table class="table table-striped table-sm table-bordered" style="width:100%; font-size:13px; margin-top:15px;">
        <tr>
            <th width="150px">Kode transaksi</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Nominal</th>
        </tr>
            @foreach($table as $row)
            <tr>
                <td><?php echo sprintf('%03d', $row->kode_transaksi); ?></td>
                <td>{{$row->keterangan}}</td>
                <td>{{$row->tanggal}}</td>
                <td><?php echo number_format((float)$row->nominal, 2, ',', '.'); ?></td>
            </tr>
            <tr >
                <td colspan="4" style="padding-left:70px">
                    <span><i>Detail transaksi</i></span><br>
                    <span><b>Barang :</b> {{$row->nama_barang}}</span><br>
                    <span><b>NUP / Kode sub barang :</b> {{$row->kode_detail_barang}}</span><br>
                    <span><b>Sub barang :</b> {{$row->nama_sub_barang}}</span>
                </td>
            </tr>
            @endforeach
        <tr class="table-danger">
            <td colspan="3" align="center"><b>Total</b></td>
            <td><b><?php echo number_format((float)$total, 2, ',', '.'); ?></b></td>
        </tr>
    </table>

    <article class="box"> 
        <p>Kuasa pengguna barang</p>
        <br>
        <br>
        <br>
        <p><b>Raswin, S.H.I</b></p>
        <p>NIP. 19810415 201101 1 006</p> 
    </article>

    </div>

