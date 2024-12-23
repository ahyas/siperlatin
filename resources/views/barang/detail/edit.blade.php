@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Edit barang</div>
                <div class="card-body">
                <p>Referensi barang : {{$info_barang->kode}} <b>{{$info_barang->nama}}</b></p>
                    <form method="POST" action="{{route('barang.detail.update', ['id_barang'=>$table->id_barang, 'id_detail'=>$table->id])}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NUP / Kode sub barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_barang" value="{{$table->kode}}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama sub barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_barang" value="{{$table->nama}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal perolehan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="tgl_perolehan" name="tgl_perolehan" value="{{$table->tgl_perolehan}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Harga perolehan</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="harga_perolehan" name="harga_perolehan" value="{{$table->harga_perolehan}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Satuan</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="satuan">
                                <option value="0">Pilih satuan barang</option>
                                    @foreach($satuan_barang as $row)
                                        @if($row->id == $table->id_satuan)
                                            <option value="{{$row->id}}" selected>{{$row->nama_satuan}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->nama_satuan}}</option>
                                        @endif
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ruang</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ruang">
                                <option value="0">Pilih ruang</option>
                                    @foreach($ruang as $row)
                                        @if($row->id == $table->id_ruang)
                                            <option value="{{$row->id}}" selected>{{$row->nama_ruang}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->nama_ruang}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Kondisi barang</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="kondisi_barang">
                                <option value="0">Pilih kondisi barang</option>
                                @foreach($kondisi_barang as $row)
                                    @if($row->id == $table->id_kondisi_barang)
                                        <option value="{{$row->id}}" selected>{{$row->kondisi_barang}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->kondisi_barang}}</option>
                                    @endif
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan" rows="3">{{$table->keterangan}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="foto" accept=".jpg, .jpeg, .png">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm simpan">Update</button>
                        <button type="button" class="btn btn-danger btn-sm batal" onclick="history.back()">Batal</button>
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
