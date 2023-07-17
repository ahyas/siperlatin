@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Transaksi perawatan barang dan mesin</div>
                <div class="card-body">
                
                <div class="table-responsive">
                @if($baris>0)
                <table style="width:100%" class="table table-bordered">
                    @foreach($tb_barang as $row)
                    <tr style="font-weight:bold" class="table-primary">
                        <td>Kode barang</td>
                        <td>Nama barang</td>
                        <td align="right">Grandtotal perawatan</td>
                    </tr>
                    <tr class="table-success">
                        <td>{{$row->kode}}</td>
                        <td>{{$row->nama}}</td>
                        <td align="right">
                            @php $grand_total=0; @endphp
                            @foreach($tb_transaksi as $a)
                                @if($a->id_barang == $row->id_barang)
                                    @php $grand_total+=$a->nominal; @endphp
                                @endif
                            @endforeach
                            {{number_format($grand_total,2)}}
                        </td>
                    </tr>
                    <tr class="table-success">
                        <td colspan="3">
                            <table style="width:100%; margin-left:20px" class="table table-bordered">
                                <tr style="font-weight:bold" class="table-danger">
                                    <td></td>
                                    <td>NUP / Kode sub barang</td>
                                    <td>Nama sub barang</td>
                                    <td align="right">Subtotal perawatan</d>
                                    <td></td>
                                </tr>
                                @foreach($table as $item)
                                    @if($item->id_barang == $row->id_barang)
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
                                                    <a href="{{route('transaksi_perawatan.detail', ['id_detail_barang'=>$item->id_detail_barang])}}" class="btn btn-primary btn-sm" role="button">Detail</a>
                                                </td>
                                            </tr>
                                    @endif
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr style="font-weight:bold" class="table-light">
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </table>
                @endif
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
