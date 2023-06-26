@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Detail barang</div>
                <div class="card-body">
                <button class="btn btn-danger btn-sm" style="margin-bottom:10px" onclick="history.back()">Batal</button> <button class="btn btn-primary btn-sm tambah" data-id="{{$table->id}}" style="margin-bottom:10px">Tambah</button>
                    <p>{{$table->kode}} <b>{{$table->nama}}</b></p>
                    <table class="table table-striped">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th></th>
                        </tr>
                        @if($info=="")
                            @foreach($detail as $row)
                                <tr>
                                    <td>{{$row->kode}}</td>
                                    <td>{{$row->nama}}</td>
                                    <td align="right"><button class="btn btn-primary btn-sm edit">Edit</button> <button class="btn btn-danger btn-sm delete">Delete</button></td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="3" align="center" class="table-danger">{{$info}}</td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $("body").on("click",".tambah",function(){
            //var id_barang = $(this).data("id");
            window.location.href = "{{route('barang.detail.tambah',['id_barang'=>$table->id])}}";
        });

        $("body").on("click",".delete",function(){
            if(window.confirm("Anda yakin ingin menghapus data ini?")){
                console.log("delete");
            }
        });
    });
</script>
@endpush
