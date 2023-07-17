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

        var dataPoints = []
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"
            title:{
                text: "Top Oil Reserves"
            },
            axisY: {
                title: "Reserves(MMbbl)"
            },
            data: [{        
                type: "column",  
                showInLegend: true, 
                legendMarkerColor: "grey",
                legendText: "MMbbl = one million barrels",
                dataPoints: dataPoints,
            }]
        });

        $.ajax({
            url:"{{route('home.laporan')}}",
            type:"GET",
            dataType:"JSON",
            success:function(data){
                console.log(data);
                
                    dataPoints.push(
                        {
                            
                    );

                chart.render();
            }
        });
        
    
    });
</script>
@endpush

