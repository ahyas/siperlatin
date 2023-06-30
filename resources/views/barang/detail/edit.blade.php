@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Edit barang</div>
                <div class="card-body">
                <p>Referensi barang : {{$info_barang->kode}} <b>{{$info_barang->nama}}</b></p>
                    <form method="POST" action="{{route('barang.detail.update', ['id_barang'=>$table->id_barang, 'id_detail'=>$table->id])}}">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kode sub barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_barang" value="{{$table->kode}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama sub barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_barang" value="{{$table->nama}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan" rows="3">{{$table->keterangan}}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm simpan">Update</button>
                        <button type="button" class="btn btn-danger btn-sm batal" onclick="history.back()">Batal</button>
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
