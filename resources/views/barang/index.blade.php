@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Daftar barang</div>
                <div class="card-body">
                    <a class="btn btn-primary btn-sm" href="{{route('barang.tambah_barang')}}" role="button" style="margin-bottom:10px;">Tambah</a>
                    
                    <form action="{{route('barang.pencarian')}}" method="GET">
                    <label for="kata_kunci" class="form-label">Pencarian barang</label>
                        <div class="form-row">
                            
                            <div class="col-10  ">
                                @if(Request::has('kata_kunci'))
                                    @php 
                                        $value = Request::get('kata_kunci');
                                        $disabled = '';
                                    @endphp
                                    @if($value=='')
                                        @php
                                            $disabled = 'disabled';
                                        @endphp
                                    @endif
                                @else
                                    @php 
                                        $value = '';
                                        $disabled = 'disabled';
                                    @endphp
                                @endif
                                <input type="text" class="form-control" placeholder="Masukan kata kunci" name="kata_kunci" style="margin-bottom:15px" value="{{$value}}">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-block">Cari</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-danger btn-block reset" <?php echo $disabled; ?>>Reset</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode barang</th>
                                <th>Nama barang</th>
                                <th align="center">Qty.</th>
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
                                <td align="right"> 
                                    <a class="btn btn-primary btn-sm" href="{{route('barang.edit', ['id_barang'=>$row->id])}}" role="button">Edit</a> <a class="btn btn-success btn-sm" href="{{route('barang.detail', ['id_barang'=>$row->id])}}" role="button">Detail</a> <a class="btn btn-danger btn-sm" href="{{route('barang.hapus', ['id_barang'=>$row->id])}}" role="button" <?php echo $disabled; ?>>Delete</a>
                                </td>
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
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(".reset").on("click",function(){
            console.log("reset");
            window.location = "{{route('barang.index')}}";
        });
    });
</script>
@endpush
