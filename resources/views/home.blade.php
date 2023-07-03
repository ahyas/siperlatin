@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    

                    <table style="width:100%">
                    @foreach($table as $key => $item)

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
                            <td>{{$item->kode_detail_barang}} {{$item->nama_detail_barang}} <br><a href="{{route('detail_barang.index', ['id_detail_barang'=>$item->id_detail_barang])}}">Detail</a></td>

                        @if (($key + 1) % 3 == 0)
                            </tr>
                        @endif

                        @endforeach

                        @if (($key + 1) % 3 != 0)
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
