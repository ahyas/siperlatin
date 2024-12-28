@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Tambah brand / merk</div>
                <div class="card-body">
                    
                    <form method="POST" action="{{route('brand.simpan')}}">
                        @csrf
                        <!--Prvious url to redirect after submission-->
                        <input type='hidden' name='previous_url' value='{{URL::previous()}}' style='width:500px'/>
                        
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama brand</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_brand">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keterangan">
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-danger btn-sm batal" onclick="history.back()">Kembali</button>
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

    });
</script>
@endpush
