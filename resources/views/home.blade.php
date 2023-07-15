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
                <table style="width:100%" class="table table-striped">
                    @foreach($tb_barang as $row)
                    <tr>
                        <td colspan=6><span><b>{{$row->nama}}</b></span></td>
                    </tr>
                        @foreach($table as $key => $item)
                            @if($item->id_barang == $row->id)
                                @if ($key % 3 == 0)
                                    <tr>
                                @endif
                                        <td width="100px">
                                            <?php
                                        if(!empty($item->foto)){?>
                                            <img src="storage/foto/{{$item->foto}}" style="width:90px" />
                                        <?php 
                                        
                                        } else { ?>
                                            <img src="public/images/empty.png" style="width:90px" />

                                        <?php } ?>
                                        </td>
                                        <td>{{$item->kode_detail_barang}} <br>{{$item->nama_detail_barang}} <br><a href="{{route('detail_barang.index', ['id_detail_barang'=>$item->id_detail_barang])}}">Detail</a></td>

                                @if (($key + 1) % 3 == 0)
                                    </tr>
                                @endif
                            @endif
                        @endforeach
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
