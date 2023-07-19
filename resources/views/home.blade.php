@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                <p>Selamat datang</p>
                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script type="text/javascript">
    $(document).ready(function(){

        var dataPoints = [];
        var chart = new CanvasJS.Chart("chartContainer",{
            animationEnabled: true,
            theme: "light2",
            title: {
                text: "Laporan transaksi perawatan barang"
            },
            axisY: {
                title: "Total",
                titleFontSize: 24,
                includeZero: true
            },
            data: [{
                type: "column",
                yValueFormatString: "Rp #,###",
                dataPoints: dataPoints
            }]
        });

        $.getJSON("{{route('home.laporan')}}", function(data) {  

            for (var i = 0; i < data.length; i++) {
                dataPoints.push({
                    label: data[i].nama_barang,
                    y: parseInt(data[i].nominal)
                });
            }
            chart.render();
            
        });
                
    
    });
</script>
@endpush

