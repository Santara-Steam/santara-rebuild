@extends('admin.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="card-headings">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="card-header" id="heading-links">
                                <h4 class="card-title">Detail Order</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table" style="font-size: 1.32rem;font-family: Quicksand, Georgia,Times New Roman, Times, serif;
                                        font-weight: 400;color: #464855;">
                                            <tr>
                                                <td>Nama Trader</td>
                                                <td>:</td>
                                                <td class="px-1">{{ $book->trd->name}}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:10px ">Email</td>
                                                <td style="padding-top:10px ">:</td>
                                                <td class="px-1" style="padding-top:10px ">{{ $book->trd->usr->email}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:10px ">Nomor Telepon</td>
                                                <td style="padding-top:10px ">:</td>
                                                <td class="px-1" style="padding-top:10px ">{{ $book->trd->phone}}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:10px ">Penerbit</td>
                                                <td style="padding-top:10px ">:</td>
                                                <td class="px-1" style="padding-top:10px ">{{ $book->emtn->company_name}}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:10px ">Harga Per Lembar</td>
                                                <td style="padding-top:10px ">:</td>
                                                <td class="px-1" style="padding-top:10px ">{{ $book->emtn->price}}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:10px ">Jumlah Lembar</td>
                                                <td style="padding-top:10px ">:</td>
                                                <td class="px-1" style="padding-top:10px ">{{ $book->lembar_saham}}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top:10px ">Total</td>
                                                <td style="padding-top:10px ">:</td>
                                                <td class="px-1" style="padding-top:10px ">{{ $book->total_amount}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <td colspan="3">
                                                    <h4>Bukti Transfer</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">
                                                    @if($book->bukti_tranfer == '-' || $book->bukti_tranfer == null)
                                                    <img class="img-fluid" width="100px" src="{{asset('public')}}/default.png" alt="">
                                                    @else
                                                    <a class="venobox" data-gall="gallery01"
                                                        href="{{ asset('public/storage/bukti_transfer/'.$book->bukti_tranfer) }}"><img
                                                            width="80"
                                                            src="{{ asset('public/storage/bukti_transfer/'.$book->bukti_tranfer) }}"
                                                            alt="image alt" /></a>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                @if($book->bukti_tranfer == '-' || $book->bukti_tranfer == null)
                                                <td>
                                                    <div class="badge badge-warning">Bukti Transfer Belum Di Upload</div>
                                                </td>

                                                @elseif($book->bukti_tranfer != '-' && $book->isValid == 1)
                                                <td>
                                                    <div class="badge badge-primary">Bukti Transfer Terkonfirmasi</div>
                                                </td>
                                                @elseif($book->bukti_tranfer != '-' && $book->isValid == 2)
                                                <td>
                                                    <div class="badge badge-danger">Bukti Transfer Tidak Valid</div>
                                                </td>        
                                                @elseif($book->bukti_tranfer != '-' && $book->isValid == 0 || $book->bukti_tranfer != '-' && $book->isValid == 3)
                                                <td class="3">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <a data-id="{{$book->id}}" style="color: white" class="btn btn-primary form-control konfbtn">Konfirmasi</a>
                                                            <form id="konf{{$book->id}}" method="post"
                                                                action="{{url('/admin/pesan_saham/approve')}}/{{$book->id}}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </div>
                                                        <div class="col-6">
                                                            <a data-id="{{$book->id}}" style="color: white" class="btn btn-danger form-control rejcbtn">Tolak</a>
                                                            <form id="rejc{{$book->id}}" method="post"
                                                                action="{{url('/admin/pesan_saham/reject')}}/{{$book->id}}"
                                                                enctype="multipart/form-data">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                                @endif
                                            </tr>
                                        
                                        

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
<script type="text/javascript" src="{{asset('public/assets/venobox/venobox.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.all.min.js" integrity="sha512-IZ95TbsPTDl3eT5GwqTJH/14xZ2feLEGJRbII6bRKtE/HC6x3N4cHye7yyikadgAsuiddCY2+6gMntpVHL1gHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
    $('.venobox').venobox({
      framewidth: '370px', // default: ''
      titleattr: 'data-title', // default: 'title'
      numeratio: true, // default: false
      infinigall: true, // default: false
      spinner:'three-bounce',
    });
  });
</script>
<script>
    $(".konfbtn").click(function(e) {

   id = e.target.dataset.id;
   Swal.fire({
       title: "Apakah anda yakin?",
       text: "Data yang sudah anda konfirmasi tidak bisa di ubah lagi!!",
       icon: "warning",
       showCancelButton: true,
       confirmButtonText: "Ya, Konfirmasi"
   }).then(function(result) {
       if (result.value) {

           Swal.fire(
               "Terkonfirmasi!",
               "Data telah terkonfirmasi.",
               "success"
           );
           $(`#konf${id}`).submit();

       } else {

       }
   });
});
</script>
<script>
    $(".rejcbtn").click(function(e) {

   id = e.target.dataset.id;
   Swal.fire({
       title: "Apakah anda yakin?",
       text: "Data yang sudah anda tolak tidak bisa di ubah lagi!!",
       icon: "warning",
       showCancelButton: true,
       confirmButtonText: "Ya, Tolak"
   }).then(function(result) {
       if (result.value) {

           Swal.fire(
               "Ditolak!",
               "Data berhasil di Tolak.",
               "success"
           );
           $(`#rejc${id}`).submit();

       } else {

       }
   });
});
</script>
@endsection
@section('style')
<link rel="stylesheet" href="{{asset('public/assets/venobox/venobox.css')}}" type="text/css" media="screen" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-c42qTSw/wPZ3/5LBzD+Bw5f7bSF2oxou6wEb+I/lqeaKV5FDIfMvvRp772y4jcJLKuGUOpbJMdg/BTl50fJYAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.1.9/sweetalert2.min.css" integrity="sha512-cyIcYOviYhF0bHIhzXWJQ/7xnaBuIIOecYoPZBgJHQKFPo+TOBA+BY1EnTpmM8yKDU4ZdI3UGccNGCEUdfbBqw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection