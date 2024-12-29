@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Data kuasa pengguna barang</div>
                <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> {{session('success')}}
                    </div>
                @endif
                @if($table === null)
                    <a href="{{route('kuasa_pengguna_barang.tambah')}}" class="btn btn-primary btn-sm" role="button" style='margin-bottom:20px'>Tambah</a>
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Kuasa pengguna barang belum didefinisikan.</a>.
                    </div>
                @else
                    <div class="table-responsive">
                        <span>Nama : <b>{{$table->nama}}</b></span><br>
                        <span>NIP : <b>{{$table->nip}}</b></span><br>
                        <a href="{{route('kuasa_pengguna_barang.edit', ['id'=>$table->id])}}" class="btn btn-primary btn-sm" role="button" style="margin-top:20px">Edit</a>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
