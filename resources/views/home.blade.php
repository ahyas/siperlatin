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
                            <td width="100px">
                                <?php
                            if(!empty($row->foto)){?>
                                                <img src="storage/foto/{{$row->foto}}" style="width:90px" />
                                            <?php 
                                            
                                            } else { ?>
                                                <img src="public/images/empty.png" style="width:90px" />

                                            <?php } ?>
                            </td>
                            <td>{{$row->kode_detail_barang}} {{$row->nama_detail_barang}} <br><a href="{{route('detail_barang.index', ['id_detail_barang'=>$row->id_detail_barang])}}">Detail</a></td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
