@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Tambah sub barang</div>
                <div class="card-body">
                    <p>Referensi barang : {{$table->kode}} <b>{{$table->nama}}</b></p>
                    <form method="POST" action="{{route('barang.detail.simpan',['id_barang'=>$table->id])}}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NUP</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_barang" value="{{$kode}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama sub barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_barang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan" rows="3"></textarea>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-danger btn-sm batal" onclick="history.back()">Batal</button>
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

    });
</script>
@endpush
