@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Sub barang</div>
                <div class="card-body">
                <a class="btn btn-danger btn-sm" href="{{route('barang.index')}}" role="button">Batal</a> <button class="btn btn-primary btn-sm tambah" data-id="{{$table->id}}">Tambah</button>
                    <p style="padding-top:10px">Referensi barang: {{$table->kode}} <b>{{$table->nama}}</b></p>
                    <table class="table table-striped">
                        <tr>
                            <th width="100px">QR Code</th>
                            <th>Kode sub barang</th>
                            <th>Nama sub barang</th>
                            <th>Keterangan</th>
                            <th></th>
                        </tr>
                        @if($info=="")
                            @foreach($detail as $row)
                                <tr>
                                    <td>{!! QrCode::size(90)->generate($row->kode); !!}</td>
                                    <td>{{$row->kode}}</td>
                                    <td>{{$row->nama}}</td>
                                    <td>{{$row->keterangan}}</td>
                                    <td align="right"><a class="btn btn-primary btn-sm" href="{{route('barang.detail.edit', ['id_barang'=>$table->id, 'id_detail'=>$row->id])}}" role="button">Edit</a> <a class="btn btn-danger btn-sm" href="{{route('barang.detail.delete', ['id_barang'=>$table->id, 'id_detail'=>$row->id])}}" role="button" onclick="return confirm('Are you sure?')">Delete</a></td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="4" align="center" class="table-danger">{{$info}}</td>
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

    });
</script>
@endpush
