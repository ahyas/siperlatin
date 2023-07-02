@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Cetak QR Code</div>
                <div class="card-body">

                    <table style="width:100%">
                    @foreach($table as $key => $item)

                        @if ($key % 3 == 0)
                            <tr>
                        @endif

                        <td style="padding-bottom:15px; text-align:center">
                            <?php $url = "www.siperlatin.pta-papuabarat.go.id/detail_barang/{{$item->id_detail_barang}}"; ?>
                            {!! QrCode::size(90)->generate($url); !!}<br>
                            <span>{{ $item->kode_detail_barang }}</span><br>
                            <span>{{ $item->nama_detail_barang }}</span>
                        </td>

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
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        
    });
</script>
@endpush
