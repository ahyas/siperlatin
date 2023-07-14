@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Daftar satuan barang</div>
                <div class="card-body">
                    <a href="{{route('satuan_barang.tambah')}}" class="btn btn-primary btn-sm tambah" style="margin-bottom:10px" role="button">Tambah</a>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Nama satuan</th>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                            @foreach($table as $row)
                            <tr>
                                <td>{{$row->nama_satuan}}</td>
                                <td>{{$row->keterangan}}</td>
                                <td><a href="{{route('satuan_barang.edit', ['id'=>$row->id])}}" class="btn btn-success btn-sm" role="button">Edit</a> <a href="#" class="btn btn-danger btn-sm hapus" data-id="{{$row->id}}" role="button">Delete</a></td>
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
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("body").on("click",".hapus",function(){
            if(window.confirm("Anda yakin ingin menghapus data ini?")){
                let id = $(this).data("id");
                window.location="satuan_barang/"+id+"/delete";
            }
        });
    });
</script>
@endpush
