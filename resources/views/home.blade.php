@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                
                <div class="table-responsive">
                @if($baris>0)
                
                    @foreach($tb_barang as $row)
                    <h5 style="padding-top:20px; padding-bottom:10px">{{$row->kode}} - {{$row->nama}}</h5>
                    
                            <table style="width:100%; margin-left:20px" class="table table-striped">
                                <tr style="font-weight:bold">
                                    <td></td>
                                    <td>NUP / Kode sub barang</td>
                                    <td>Nama sub barang</td>
                                    <td align="right">Total transaksi perawatan</d>
                                    <td></td>
                                </tr>
                                @foreach($table as $item)
                                    @if($item->id_barang == $row->id)
                                            <tr>
                                                <td width="100px">
                                                    <?php
                                                    if(!empty($item->foto)){?>
                                                        <img src="storage/foto/{{$item->foto}}" style="width:90px" />
                                                    <?php 
                                                    
                                                    } else { ?>
                                                        <img src="public/images/empty.png" style="width:90px" />

                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    {{$item->kode_detail_barang}} <br>
                                                </td>   
                                                <td>
                                                    {{$item->nama_detail_barang}}
                                                </td>
                                                <td align="right">
                                                    @php $total=0; @endphp
                                                    @foreach($tb_transaksi as $row_transaksi)
                                                    @if($row_transaksi->id_sub_barang == $item->id_detail_barang)
                                                       @php $total+=$row_transaksi->nominal; @endphp
                                                    @endif
                                                    
                                                    @endforeach
                                                    {{number_format($total, 2)}}
                                                </td>
                                                <td>
                                                    <a href="{{route('detail_barang.index', ['id_detail_barang'=>$item->id_detail_barang])}}" class="btn btn-primary btn-sm" role="button">Detail</a>
                                                </td>
                                            </tr>
                                    @endif
                                @endforeach
                            </table>
                    @endforeach
                
                @endif
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
