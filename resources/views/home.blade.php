@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <table class="table table-sm">
                    @foreach($table as $row)
                        <tr>
                            <td>{{$row->kode_detail_barang}} {{$row->nama_detail_barang}} <a href="{{route('detail_barang.index', ['id_detail_barang'=>$row->id_detail_barang])}}">Detail</a></td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
