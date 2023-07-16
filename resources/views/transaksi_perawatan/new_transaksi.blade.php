@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Tambah transaksi baru</div>
                <div class="card-body">
                    
                    <form method="POST" action="{{route('transaksi_perawatan.simpan', ['id_detail_barang'=>$id_detail_barang])}}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama barang</label>
                            <div class="col-sm-10">
                                <select class="form-control barang" name="barang" id="barang" readonly>
                                        <option value="{{$tb_barang->id}}"> {{$tb_barang->nama_barang}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NUP / Nama sub barang</label>
                            <div class="col-sm-10">
                                <select class="form-control sub_barang" name="sub_barang" id="sub_barang" readonly>                                    
                                    <option value="{{$tb_detail_barang->id}}">{{$tb_detail_barang->kode}} - {{$tb_detail_barang->nama}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tanggal" id="tanggal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="nominal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keterangan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Lampiran (PDF)</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="lampiran" accept=".pdf">
                            </div>
                        </div>
                        
                        <a href="{{route('transaksi_perawatan.detail',['id_detail_barang'=>$id_detail_barang])}}" class="btn btn-danger btn-sm" role="button">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-sm simpan">Simpan</button>
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
        $('#tanggal').datepicker({                      
            format: 'yyyy-mm-dd',
            autoclose: true,
        }); 
    });
</script>
@endpush
