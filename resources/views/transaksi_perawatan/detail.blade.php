@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
            <div class="card-header">History transaksi perawatan</div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                    <tr>
                        <td>
                            <?php
                            if(!empty($table->foto)){?>
                                <img src="../storage/foto/{{$table->foto}}" style="width:300px" />
                            <?php 
                            
                            } else { ?>
                                <img src="../public/images/empty.png" style="width:300px" />

                            <?php } ?>
                        </td>
                    </tr>
                    </table>
                </div>
                        <div style="margin-bottom:15px">
                            <span><b>Barang :</b> {{$table->nama_barang}} </span><br>
                            <span><b>NUP / Kode sub barang :</b> {{$table->kode_detail_barang}} </span><br>
                            <span><b>Sub barang :</b> {{$table->nama_detail_barang}}</span><br>
                            <span><b>Tanggal perolehan :</b> {{$table->tgl_perolehan}}</span><br>
                            <span><b>Harga perolehan :</b> {{number_format($table->harga_perolehan, 2)}}</span>
                        </div>
                    @if(Auth::check())
                    <div style="margin-bottom:15px;">          
                        <a href="{{route('transaksi_perawatan.tambah',['id_detail_barang'=>$id_detail_barang])}}" class="btn btn-primary btn-sm" role="button">Tambah</a> <a href="{{route('transaksi_perawatan.index')}}" class="btn btn-danger btn-sm" role="button">Kembali</a>
                    </div>
                    @endif
                    
                    <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <tr>
                            <th>Kode transaksi</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Lampiran</th>
                            <th></th>
                        </tr>
                        @if($count==0)
                            <tr align="center">
                                <td colspan=4>Belum ada transaksi perawatan</td>
                            </tr>
                        @else
                            @foreach($transaksi as $row)
                            <tr>
                                <td><?php echo sprintf('%03d', $row->kode_transaksi); ?></td>
                                <td>{{$row->tanggal}}</td>
                                <td>{{$row->keterangan}}</td>
                                <td><?php echo number_format((float)$row->nominal, 2, ',', '.'); ?></td>
                                <td><a href="../storage/files/{{$row->file_name}}" target="_blank">{{$row->file_name}}</a></td>
                                @if(Auth::check())
                                <td>
                                    <button class="btn btn-primary btn-sm edit" data-id_transaksi="{{$row->kode_transaksi}}" data-id_detail_barang="{{$id_detail_barang}}">Edit</button> <button class="btn btn-danger btn-sm delete" data-id_transaksi="{{$row->kode_transaksi}}" data-id_detail_barang="{{$id_detail_barang}}">Hapus</button>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            
                        @endif
                        <tr class="table-danger">
                            <td colspan="3" align="center"><b>Total</b></td>
                            <td><b><?php echo number_format((float)$total, 2, ',', '.'); ?></b></td>
                            <td></td>
                            @if(Auth::check())
                            <td></td>
                            @endif
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){

        $("body").on("click", ".edit", function(){
            console.log($(this).data("id_transaksi"));
            var id_transaksi = $(this).data("id_transaksi");
            var id_detail_barang = $(this).data("id_detail_barang");
            window.location.href = id_transaksi+"/"+id_detail_barang+"/edit";
        });

        $("body").on("click",".delete", function(){
            var id_transaksi = $(this).data("id_transaksi");
            var id_detail_barang = $(this).data("id_detail_barang");
            if(window.confirm("Anda yakin ingin menghapus data ini?")){
                window.location.href = id_transaksi+"/"+id_detail_barang+"/delete";
            }
        });
    });
</script>
@endpush
