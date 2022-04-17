@extends('user.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12">
                                        <h1 class="card-title-member">Riwayat Aktivitas</h1>
                                    </div>                    
                                    <div class="col-xl-9 col-md-9">
                                    </div>
                                    <div class="col-xl-3 col-md-3">
                                        <select id="filter" class="form-control">
                                            <option disabled selected>Filter Status</option>
                                            {{-- <?php foreach (
                                                [
                                                    null  => 'Semua',                            
                                                    'Berhasil' => 'Berhasil',
                                                    'Gagal' => 'Gagal',
                                                    'Menunggu Pembayaran' => 'Menunggu Pembayaran',
                                                    'Menunggu Verifikasi' => 'Menunggu Verifikasi'                    
                                                ] as $key => $value
                                            ): ?>
                                                <option value="<?= $key ?>" <?= isset( $_GET['filter'] ) && $_GET['filter'] == $key ? 'selected' : '' ?>><?= $value ?></option>
                                            <?php endforeach; ?> --}}
                                        </select>
                                    </div>
                                </div>
                        
                        
                            </div>
                            <div class="card-content">
                                <div class="card-body px-1 pb-3">
                                    <div class="table-responsive">
                                        <table class="table table-hover dataTable-table" id="datatable" >
                                            <thead>
                                            <tr>
                                                <th class="border-top-0">No</th>
                                                <th class="border-top-0">Nama Aktifitas</th>
                                                <th class="border-top-0">Tanggal</th>           
                                                <th class="border-top-0">Status</th>                                            
                                                <th class="border-top-0">Aksi</th>                                                               
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 0;?>

                                                @foreach ($jour as $item)
                                                <?php $no++; ?>
                                                <tr>
                                                    <td>{{$no}}</td>
                                                    <td>{{$item->activity}}</td>
                                                    <td>{{tgl_indo(date('Y-m-d', strtotime($item->created_at)))}}</td>
                                                    <td>
                                                        @if($item->status == 'Berhasil')
                                                            <span style="color:#0E7E4A">{{$item->status}}</span>
                                                        @elseif($item->status == 'Menunggu Pembayaran' || 
                                                                $item->status == 'Menunggu Verifikasi' || 
                                                                $item->status == 'Belum Lengkap' ||
                                                                $item->status == 'Belum Pendanaan Terpenuhi')
                                                            <span style="color:#E5A037">{{$item->status}}</span>
                                                        @elseif($item->status == 'Gagal')
                                                            <span style="color:#BF2D30">{{$item->status}}</span>
                                                        @else
                                                            
                                                        @endif
                                                    </td>
                                                    <td>
                                                        -
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('public/admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('public/admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            responsive: true,
            
        });
    });
</script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="{{asset('public/admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection