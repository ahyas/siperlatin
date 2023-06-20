@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Daftar transaksi perawatan barang</div>
                <div class="card-body">
                    <button class="btn btn-primary btn-sm tambah" style="margin-bottom:10px">Tambah</button>
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
            window.location.href = "{{route('')}}"
        });
    });
</script>
@endpush
