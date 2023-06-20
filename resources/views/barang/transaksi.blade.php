@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <p>Tambah transaksi</p>
                    <a class="btn btn-danger btn-sm kembali" href="{{route('barang.view',['kode'=>$kode])}}">Kembali</a>
                    <form>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama barang</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="nama_barang" value="{{$barang->nama}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" id="sandbox-container">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tanggal" placeholder="Tanggal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="keterangan" placeholder="Keterangan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nominal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nominal" placeholder="Nominal">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
        $('#sandbox-container input').datepicker({
        });
    });
</script>
@endpush
