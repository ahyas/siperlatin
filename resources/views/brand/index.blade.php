@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Daftar ruangan</div>
                <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> {{session('success')}}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error!</strong> {{session('error')}}
                    </div>
                @endif
                    <a href="{{route('brand.tambah')}}" class="btn btn-primary btn-sm tambah" style="margin-bottom:10px" role="button">Tambah</a>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Nama brand</th>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                            @foreach($table as $row)
                                <tr>
                                    <td>{{$row->nama_brand}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td align="right"><a href="{{route('brand.edit', ['id'=>$row->id])}}" class="btn btn-success btn-sm" role="button">Edit</a> <a href="{{route('brand.destroy', ['id'=>$row->id])}}" onclick="return confirm('Anda yakin ingin menghapus data ini?')" class="btn btn-danger btn-sm hapus" role="button">Delete</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
