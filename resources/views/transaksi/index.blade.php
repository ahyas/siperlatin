@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Daftar transaksi perawatan barang</div>
                <div class="card-body">
                    <button class="btn btn-primary btn-sm tambah" style="margin-bottom:10px">Tambah</button>
                    <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <tr>
                            <th width="150px">Kode transaksi</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>Lampiran</th>
                            <th></th>
                        </tr>
                        @foreach($table as $row)
                        <tr>
                            <td><?php echo sprintf('%03d', $row->kode_transaksi); ?></td>
                            <td>{{$row->keterangan}}</td>
                            <td><?php echo number_format((float)$row->nominal, 2, ',', '.'); ?></td>
                            <td>{{$row->tanggal}}</td>
                            <td><a href="storage/files/{{$row->file_name}}" target="_blank">{{$row->file_name}}</a></td>
                            <th><button class="btn btn-primary btn-sm edit" data-id_transaksi="{{$row->kode_transaksi}}">Edit</button> <button class="btn btn-danger btn-sm delete" data-id_transaksi="{{$row->kode_transaksi}}">Hapus</button></th>
                        </tr>
                        <tr >
                            <td colspan="6" style="padding-left:70px">
                                <span><i>Detail transaksi</i></span><br>
                                <span><b>Barang :</b> {{$row->nama_barang}}</span><br>
                                <span><b>Kode :</b> {{$row->kode_detail_barang}}</span><br>
                                <span><b>Sub barang :</b> {{$row->nama_sub_barang}}</span>
                            </td>
                        </tr>
                        @endforeach
                        <tr class="table-danger">
                            <td colspan="2" align="center"><b>Total</b></td>
                            <td><b><?php echo number_format((float)$total, 2, ',', '.'); ?></b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                    <p>Halaman : <b>{{ $table->currentPage() }}</b> Jumlah Data : <b>{{ $table->total() }}</b></p>
                
                    {{ $table->links() }}
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
        $("body").on("click",".tambah",function(){
            window.location.href = "{{route('transaksi.tambah')}}";
        });

        $("body").on("click", ".edit", function(){
            console.log($(this).data("id_transaksi"));
            var id_transaksi = $(this).data("id_transaksi");
            window.location.href = "transaksi/"+id_transaksi+"/edit";
        });

        $("body").on("click",".delete", function(){
            var id_transaksi = $(this).data("id_transaksi");
            
            if(window.confirm("Anda yakin ingin menghapus data ini?")){
                window.location.href = "transaksi/"+id_transaksi+"/delete";
            }
        });
    });
</script>
@endpush
