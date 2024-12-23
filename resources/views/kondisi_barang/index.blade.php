@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Kondisi barang</div>
                <div class="card-body">
                @if (session('error'))
                <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                    <a class="btn btn-primary btn-sm" href="{{route('kondisi_barang.add')}}" role="button" style="margin-bottom:10px;">Tambah</a>

                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($table as $row)
                            <tr>
                                <td>{{$row->keterangan}}</td>
                                <td align="right"><a href="{{route('kondisi_barang.edit', ['id'=>$row->id])}}" class="btn btn-primary btn-sm" role="button">Edit</a> <button href="#" class="btn btn-danger btn-sm hapus" data-id="{{$row->id}}">Hapus</button></td>
                            </tr>
                            @endforeach
                        </tbody>
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
                window.location="kondisi_barang/"+id+"/hapus";
            }
        });
    });
</script>
@endpush