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
                            <td width="150px">
                            <?php
                            if(!empty($table->foto)){?>
                                                <img src="../storage/foto/{{$table->foto}}" style="width:145px" />
                                            <?php 
                                            
                                            } else { ?>
                                                <img src="../public/images/empty.png" style="width:145px" />

                                            <?php } ?>
                            </td>
                            <td>
                                <h6>{{$table->nama_barang}}</h6>
                                <h4>{{$table->kode_detail_barang}} {{$table->nama_detail_barang}}</h4>
                                <p>{{$table->keterangan}}</p>
                            </td>
                            <td width="90px">
                                {!! QrCode::size(90)->generate($table->kode_detail_barang); !!}
                            </td>
                        </tr>
                    </table>
                    <p><b>History perawatan</b></p>
                    <button class="btn btn-primary btn-sm tambah">Tambah</button>
                    <table class="table">
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Lampiran</th>
                        </tr>
                        @if($count==0)
                            <tr class="table-danger" align="center">
                                <td colspan=4>Belum ada transaksi perawatan</td>
                            </tr>
                        @else
                            @foreach($transaksi as $row)
                            <tr>
                                <td>{{$row->tanggal}}</td>
                                <td>{{$row->keterangan}}</td>
                                <td>{{$row->nominal}}</td>
                                <td><a href="../storage/files/{{$row->file_name}}" target="_blank">{{$row->file_name}}</a></td>
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
        $("body").on("click",".tambah",function(){
            window.location.href = "{{route('transaksi.tambah')}}";
        });
    });
</script>
@endpush
