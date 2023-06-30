@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                <p><b>Detail barang</b></p>
                    <table class="table">
                        <tr>
                            <td>
                                <h4>{{$table->kode_detail_barang}} {{$table->nama_detail_barang}}</h4>
                                <p>{{$table->nama_barang}}</p>
                                <p>{{$table->keterangan}}</p>
                            </td>
                            <td width="90px">
                                {!! QrCode::size(90)->generate($table->kode_detail_barang); !!}
                            </td>
                        </tr>
                    </table>
                    <p><b>History perawatan</b></p>
                    <table class="table">
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Lampiran</th>
                        </tr>
                        @foreach($transaksi as $row)
                        <tr>
                            <td>{{$row->tanggal}}</td>
                            <td>{{$row->keterangan}}</td>
                            <td>{{$row->nominal}}</td>
                            <td>{{$row->file_name}}</td>
                        </tr>
                        @endforeach
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
        
    });
</script>
@endpush
