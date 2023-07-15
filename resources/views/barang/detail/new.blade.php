@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Tambah sub barang</div>
                <div class="card-body">
                    <p>Referensi barang : {{$table->kode}} <b>{{$table->nama}}</b></p>
                    <form method="POST" action="{{route('barang.detail.simpan',['id_barang'=>$table->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NUP / Kode sub barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_barang" value="{{$kode}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama sub barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_barang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal perolehan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tgl_perolehan" name="tgl_perolehan" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Harga perolehan</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="harga_perolehan" name="harga_perolehan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="satuan">
                                <option value="0">Pilih satuan barang</option>
                                    @foreach($satuan_barang as $row)
                                        <option value="{{$row->id}}">{{$row->nama_satuan}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="foto" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-danger btn-sm batal" onclick="history.back()">Batal</button>
                        <button type="submit" class="btn btn-primary btn-sm simpan">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#tgl_perolehan').datepicker({                      
            format: 'yyyy-mm-dd',
            autoclose: true,
        }); 
    });
</script>
@endpush
