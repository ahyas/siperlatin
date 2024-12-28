@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Tambah kondisi barang</div>
                <div class="card-body">
                    
                    <form method="POST" action="{{route('kondisi_barang.save')}}">
                        @csrf
                        <div class="form-group row">
                            <!--Prvious url to redirect after submission-->
                            <input type='hidden' name='previous_url' value='{{URL::previous()}}' style='width:500px'/>

                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keterangan">
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-danger btn-sm batal" onclick="history.back()">Kembali</button>
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
