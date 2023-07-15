@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                <p><b>Detail barang</b></p>
                    <table class="table">
                        <tr>
                            <td width="150px">
                            <?php
                            if(!empty($table->foto)){?>
                                                <img src="../storage/foto/{{$table->foto}}" style="width:145px" />
                                            <?php 
                                            
                                            } else { ?>
                                                <img src="../public/images/empty.png" style="width:145px" />

                                            <?php } ?>
                                             
                                <h4>{{$table->kode_detail_barang}} <br>{{$table->nama_detail_barang}}</h4>
                                <p>{{$table->keterangan}}</p>   
                            </td>
                        </tr>
                    </table>
                    <p><b>History perawatan</b></p>
                   
                    <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Lampiran</th>
                        </tr>
                        @if($count==0)
                            <tr class="table-danger" align="center">
                                <td colspan=4>Belum ada transaksi perawatan</td>
                            </tr>
                        @else
                            @foreach($transaksi as $row)
                            <tr>
                                <td>{{$row->tanggal}}</td>
                                <td>{{$row->keterangan}}</td>
                                <td><?php echo number_format((float)$row->nominal, 2, ',', '.'); ?></td>
                                <td><a href="../storage/files/{{$row->file_name}}" target="_blank">{{$row->file_name}}</a></td>
                            </tr>
                            @endforeach
                            
                        @endif
                        <tr class="table-danger">
                            <td colspan="2" align="center"><b>Total</b></td>
                            <td><b><?php echo number_format((float)$total, 2, ',', '.'); ?></b></td>
                            <td></td>
                        </tr>
                    </table>
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
        
    });
</script>
@endpush
