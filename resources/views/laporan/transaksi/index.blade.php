@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Laporan transaksi perawatan barang</div>
                <div class="card-body">

                    <form class="form-inline" method="GET" action="{{route('laporan.transaksi.cari')}}">
                        @csrf
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="inputPassword2" class="sr-only">Password</label>
                        <input type="text" class="form-control" placeholder="Dari tanggal" name="dari_tanggal" id="dari_tanggal" value="{{ old('dari_tanggal', request()->input('dari_tanggal'))}}">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="inputPassword2" class="sr-only">Password</label>
                        <input type="text" class="form-control" placeholder="Sampai tanggal" name="sampai_tanggal" id="sampai_tanggal" value="{{ old('sampai_tanggal', request()->input('sampai_tanggal'))}}">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2" id="cari">Cari</button>
                    
                    @if(isset($dari_tgl) || isset($sampai_tgl))
                        <a href="{{route('laporan.transaksi.index')}}" class="btn btn-success mb-2" role="button" style="margin-left:15px" >Semua</a>
                        <a href="{{route('laporan.transaksi.print', ['dari_tgl'=>$dari_tgl,'sampai_tgl'=>$sampai_tgl])}}" class="btn btn-danger mb-2" role="button" target="_blank" style="margin-left:15px">Print</a>
                    @else
                        <a href="" class="btn btn-success disabled mb-2" role="button" style="margin-left:15px" disabled>Semua</a>
                    @endif
                    
                    </form>

                    
                    

                    <div class="table-responsive">
                    <table class="table table-striped table-sm">
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
                            <td colspan="2" align="center"><b>Total</b></td>
                            <td></td>
                            <td><b><?php echo number_format((float)$total, 2, ',', '.'); ?></b></td>
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
        $('#dari_tanggal').datepicker({                      
            format: 'yyyy-mm-dd',
            autoclose: true,
        }); 
        $('#sampai_tanggal').datepicker({                      
            format: 'yyyy-mm-dd',
            autoclose: true,
        }); 

        var dari_tgl = $("#dari_tanggal").val();
        var sampai_tgl = $("#sampai_tanggal").val();
        console.log(dari_tgl);
        console.log(sampai_tgl);
        
    });
</script>
@endpush
