@extends('user.layout.master')
@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="configuration">

                <div class="row match-height">
                    @foreach ($emiten as $item)
                    <?php 
                                $picture = explode(',',$item->pictures);
                                if(empty($picture[0])){
                                $picture[0] = 'default1.png';
                                }else{
                                    $picture[0];
                                }
                                if(empty($picture[1])){
                                    $picture[1] = 'default2.png';
                                }else{
                                    $picture[1];
                                }
                                if(empty($picture[2])){
                                    $picture[2] = 'default.png';
                                }else{
                                    $picture[2];
                                }
                                if(empty($picture[3])){
                                    $picture[3] = 'default.png';
                                }else{
                                    $picture[3];
                                }
                                if(empty($picture[4])){
                                    $picture[4] = 'default.png';
                                }else{
                                    $picture[4];
                                }
                                if(empty($picture[5])){
                                    $picture[5] = 'default.png';
                                }else{
                                    $picture[5];
                                }
                                if(empty($picture[6])){
                                    $picture[6] = 'default1.png';
                                }else{
                                    $picture[6];
                                }
                                ?>
                    <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                <img class="card-img-top img-fluid" src="{{env('PATH_WEB')}}{{$picture[0]}}"
                                    alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title" style="margin-bottom: 0px;">{{$item->trademark}}</h4>
                                    <span style="font-size: 12px;margin-bottom: 10px;">{{$item->company_name}}</span>
                                    <br>
                                    <div class="badge badge-danger">{{$item->ctg->category}}</div>
                                    <p style="margin-top: 15px;" class="card-text">{{\Illuminate\Support\Str::limit($item->business_description ?? '',220,' ...')}}</p>
                                    <p>Status : <span
                                            class="badge border-danger danger badge-border">{{$item->sts}}</span></p>
                                    @if ($item->sts == 'Pra Penawaran Saham' || $item->sts == 'Penawaran Saham')
                                    <div class="row">
                                        @if ($item->sts == 'Pra Penawaran Saham')
                                        <div class="col-6">
                                            <a href="{{url('detail-coming-soon')}}/{{$item->id}}" class="btn btn-sm btn-block btn-outline-info">Lihat Detail</a>
                                        </div>
                                        @else
                                        <div class="col-6">
                                            <a href="{{url('detail-now-playing')}}/{{$item->id}}" href="#" class="btn btn-sm btn-block btn-outline-info">Lihat Detail</a>
                                        </div>
                                        @endif
                                        <div class="col-6">
                                            <a href="{{url('edit_bisnis/')}}/{{$item->id}}" class="btn btn-sm btn-block btn-outline-warning">Edit Bisnis</a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-6">
                                        <a href="{{url('edit_bisnis/')}}/{{$item->id}}" class="btn btn-sm btn-block btn-outline-warning">Edit Bisnis</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>


            </section>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('public/admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('public/admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js"
    integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('#tabel').DataTable({
            responsive: true,
            
        });
    });
</script>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css"
    integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css"
    href="{{asset('public/admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection