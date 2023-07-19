@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Edit transaksi</div>
                <div class="card-body">
                    <p>id transaksi {{$id_transaksi}} id detail brg {{$id_detail_barang}}</p>
                    <form method="POST" action="{{route('transaksi_perawatan.update', ['id_transaksi'=>$id_transaksi,'id_detail_barang'=>$id_detail_barang])}}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama barang</label>
                            <div class="col-sm-10">
                                <select class="form-control barang" name="barang" id="barang" readonly>
                                        <option value="{{$tb_barang->id_barang}}" selected> {{$tb_barang->nama_barang}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama sub barang</label>
                            <div class="col-sm-10">
                                <select class="form-control sub_barang" name="sub_barang" id="sub_barang" readonly>
                                    <option value="{{$tb_detail_barang->id}}" selected>{{$tb_detail_barang->kode}} - {{$tb_detail_barang->nama}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tanggal" id="tanggal" value="{{$tb_transaksi->tanggal}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="nominal" value="{{$tb_transaksi->nominal}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keterangan" value="{{$tb_transaksi->keterangan}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Lampiran (PDF)</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="lampiran" accept=".pdf">
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-danger btn-sm batal" onclick="history.back()">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        document.getElementById("sub_barang").disabled = false;

        $('#tanggal').datepicker({                      
            format: 'yyyy-mm-dd',
            autoclose: true,
        }); 

    });
</script>
@endpush
