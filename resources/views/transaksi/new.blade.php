@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Tambah transaksi baru</div>
                <div class="card-body">
                    <form method="POST" action="{{route('transaksi.simpan')}}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama barang</label>
                            <div class="col-sm-10">
                                <select class="form-control barang" name="barang" id="barang">
                                    <option value="0" selected> Pilih barang</option>
                                    @foreach($tb_barang as $row)
                                        <option value="{{$row->id}}"> {{$row->nama_barang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama sub barang</label>
                            <div class="col-sm-10">
                                <select class="form-control sub_barang" name="sub_barang" id="sub_barang">
                                    <option value="0" selected> Pilih sub barang</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tanggal" id="tanggal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nominal</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="nominal">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keterangan">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Lampiran (PDF)</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="lampiran" accept=".pdf">
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
        document.getElementById("sub_barang").disabled = true;

        $('#tanggal').datepicker({                      
            format: 'yyyy-mm-dd',
            autoclose: true,
        }); 

        var select = document.getElementById('sub_barang');
        $("body").on("change",".barang", function(){
            var id_barang = $(this).val();

            var L = select.options.length - 1;
            for(var a = L; a >= 0; a--) {
                select.remove(a);
            }

            $.ajax({
                url:"{{route('transaksi.get_sub_barang')}}",
                type:"GET",
                data:{id_barang:id_barang},
                success: function(data){
                    
                    if(id_barang > 0){
                        select.disabled = false;
                        
                        for(var i = 0; i < data.length; i++){
                            var opt = document.createElement('option');
                            opt.value = data[i].id;
                            opt.innerHTML = data[i].nama;
                            select.appendChild(opt);
                        }

                    }else{
                        var opt = document.createElement('option');
                            opt.value = "0";
                            opt.innerHTML = "Pilih sub barang";
                            select.appendChild(opt);
                        select.disabled = true;
                    }
                }
            });
        })
    });
</script>
@endpush
