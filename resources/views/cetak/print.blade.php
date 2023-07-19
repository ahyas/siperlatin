<table style="width:100%">
@foreach($table as $key => $item)

    @if ($key % 3 == 0)
        <tr>
    @endif

    <td style="padding-bottom:15px; text-align:center">
        <?php $url = "www.siperlatin.pta-papuabarat.go.id/transaksi_perawatan/".$item->id_detail_barang; ?>
        <?php $qrcode = base64_encode(QrCode::format('svg')->size(90)->errorCorrection('H')->generate($url)); ?>
        <img src="data:image/png;base64, {!! $qrcode !!}"><br>
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