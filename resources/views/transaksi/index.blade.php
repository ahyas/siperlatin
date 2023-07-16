@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Laporan transaksi perawatan barang</div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <tr>
                            <th width="150px">Kode transaksi</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                        </tr>
                            @foreach($table as $row)
                            <tr>
                                <td><?php echo sprintf('%03d', $row->kode_transaksi); ?></td>
                                <td>{{$row->keterangan}}</td>
                                <td><?php echo number_format((float)$row->nominal, 2, ',', '.'); ?></td>
                                <td>{{$row->tanggal}}</td>
                            </tr>
                            <tr >
                                <td colspan="4" style="padding-left:70px">
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

    });
</script>
@endpush
