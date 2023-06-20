@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <p>{{$table->nama}}</p>
                    
                    <button class="btn btn-primary btn-sm tambah_transaksi">Tambah</button>
                    
                    <table>
                        <tr>
                            <td>Tanggal</td>
                            <td>Keterangan</td>
                            <td>Nominal</td>
                        </tr>
                        @if($count==0)
                            <tr>
                                <td colspan=3>Belum ada transaksi perawatan</td>
                            </tr>
                        @else
                            @foreach($transaksi as $row)
                            <tr>
                                <td>{{$row->tanggal}}</td>
                                <td>{{$row->keterangan}}</td>
                                <td>{{$row->nominal}}</td>
                            </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
    console.log("Test")
    $("body").on("click",".tambah_transaksi",function(){
            window.location.href = "{{route('barang.transaksi.tambah',['kode'=>$table->kode])}}";
    });
});
</script>
@endpush
