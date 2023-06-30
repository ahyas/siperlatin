@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Daftar barang</div>
                <div class="card-body">
                    <button class="btn btn-primary btn-sm tambah" style="margin-bottom:10px">Tambah</button>
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode barang</th>
                                <th>Nama barang</th>
                                <th align="center">Jumlah barang</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($table as $row)
                            <tr>
                                <td>{{$row->kode}}</td>
                                <td>{{$row->nama}}</td>
                                <td align="center">
                                    @if($row->jumlah_detail_barang>0)
                                        {{$row->jumlah_detail_barang}}
                                    @else
                                        <span class="badge badge-pill badge-danger">Null</span>
                                    @endif
                                </td>
                                <?php if($row->jumlah_detail_barang==0){$disabled="";}else{$disabled="disabled";} ?>
                                <td align="right"><button class="btn btn-primary btn-sm edit" data-id="{{$row->id}}">Edit</button> <button class="btn btn-success btn-sm detail" data-id="{{$row->id}}">Detail</button> <button class="btn btn-danger btn-sm delete" data-id="{{$row->id}}" <?php echo $disabled; ?>>Delete</button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <p>Halaman : <b>{{ $table->currentPage() }}</b> Jumlah Data : <b>{{ $table->total() }}</b></p>
                
                    {{ $table->links() }}
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
            window.location.href = "{{route('barang.tambah_barang')}}";
        });

        $("body").on("click",".edit",function(){
            var id_barang = $(this).data("id");
            window.location.href = "barang/"+id_barang+"/edit";
        });

        $("body").on("click",".delete",function(){
            var id_barang = $(this).data("id");
            if(window.confirm("Anda yakin ingin menghapus data ini?")){
                window.location.href = "barang/"+id_barang+"/hapus";
            }
        });

        $("body").on("click",".detail",function(){
            var id_barang = $(this).data("id");
            console.log("Detail ",id_barang);
            window.location.href  ="barang/"+id_barang+"/detail";
        });
    });
</script>
@endpush
