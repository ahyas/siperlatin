@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Sub barang</div>
                <div class="card-body">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> {{ Session::get('success') }}
                    </div>
                @endif
                <a class="btn btn-danger btn-sm" href="{{route('barang.index')}}" role="button">Kembali</a> <button class="btn btn-primary btn-sm tambah" data-id="{{$table->id}}">Tambah</button>
                    <h5 style="line-height:40px">{{$table->kode}} - {{$table->nama}}</h5>
                    <table class="table table-striped table-fixed table-sm">
                        <tr style="font-weight:bold; font-size:14px">
                            <td width="15px">No.</td>
                            <td width="100px">Foto</td>
                            <td>Kode NUP</td>
                            <td>Nama sub barang</td>
                            <td>Tanggal perolehan</td>
                            <td align="right">Harga perolehan</td>
                            <td>Satuan</td>
                            <td>Ruang</td>
                            <td>Brand</td>
                            <td>Kondisi barang</td>
                            <td></td>
                        </tr>
                        @if($info=="")
                            @php 
                                $num=1;
                            @endphp
                            @foreach($detail as $row)
                                <tr style="font-size:14px">
                                    <td>{{$num}}</td>
                                    <td>
                                        <?php
                                            if(!empty($row->foto)){?>
                                                <img src="../../storage/foto/{{$row->foto}}" style="width:90px" />
                                            <?php 
                                            
                                            } else { ?>
                                                <img src="../../public/images/empty.png" style="width:90px" />

                                            <?php } ?>
                                        </td>
                                    <td>{{$row->kode}}</td>
                                    <td>{{$row->nama}}</td>
                                    <td>{{$row->tgl_perolehan}}</td>
                                    <td align="right">{{number_format($row->harga_perolehan, 2)}}</td>
                                    <td>{{$row->nama_satuan}}</td>
                                    <td>{{$row->ruang}}</td>
                                    <td>{{$row->brand}}</td>
                                    <td>
                                        @if($row->id_kondisi_barang == 1)
                                            <span class="badge badge-success">{{$row->kondisi_barang}}</span>
                                        @elseif($row->id_kondisi_barang == 2)
                                            <span class="badge badge-warning">{{$row->kondisi_barang}}</span>
                                        @else
                                            <span class="badge badge-danger">{{$row->kondisi_barang}}</span>
                                        @endif
                                    </td>
                                    <td align="right"><a class="btn btn-primary btn-sm" href="{{route('barang.detail.edit', ['id_barang'=>$table->id, 'id_detail'=>$row->id])}}" role="button">Edit</a> <a class="btn btn-danger btn-sm" href="{{route('barang.detail.delete', ['id_barang'=>$table->id, 'id_detail'=>$row->id])}}" role="button" onclick="return confirm('Are you sure?')">Delete</a></td>
                                </tr>
                                @php
                                    $num++;
                                @endphp
                            @endforeach
                        @else
                        <tr>
                            <td colspan="8" align="center" class="table-danger">{{$info}}</td>
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
