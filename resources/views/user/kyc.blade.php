@extends('user.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="basic-examples">
              {{-- {{Session::get('pwd')}} --}}
                @include('user.is_kyc')

            </section>

        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('admin')}}/app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
<script src="{{asset('admin')}}/app-assets/js/scripts/tables/datatables/datatable-basic.js"></script>
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
    href="{{asset('admin')}}/app-assets/vendors/css/tables/datatable/datatables.min.css">
    <style>
        .card-portofolio {
      border: 1px solid #eee;
    }

    .category-token {
      color: #292f8d;
      font-size: 1rem;
    }

    .title-token {
      font-weight: bold;
      color: black;
    }

    .company-token {
      font-size: 1rem;
      color: #858585;
    }

    .box-kinerja {
      border: 1px solid #eee;
      padding: 0;
      margin-bottom: 2rem;
    }

    .title-kinerja {
      padding: 0.7rem 0;
      background-color: #bf2d30 !important;
      color: #fff !important;
      border-color: #bf2d30;
      font-weight: bold;
      text-align: center;
      font-size: 1.2rem;
    }

    .value-kinerja {
      padding: 1rem 0;
      font-size: 1.5rem;
      text-align: center;
      font-weight: bold;
      color: black;
    }

    .empty-report {
      text-align: center;
    }

    .empty-report > img {
      max-width: 40%;
      margin-bottom: 3rem;
      margin-top: 3rem;
    }

    .card-home-title {
      padding: 1rem 4.5rem;
    }

    .card-home-title > .title-left > h2 {
      font-size: 2.3rem;
      font-weight: 600;
      color: #000;
      margin-right: 1em;
    }

    .card-home-title > .flex-div {
      display: flex;
    }

    .card-home-title > .flex-div > .button-group > label {
      border: 1px solid #bf2d30;
      padding: 6px 12px;
      cursor: pointer;
      color: #bf2d30;
      background-color: #fff;
      transition: all 0.2s;
      border-radius: 15px;
      font-size: 1.1em;
      margin-right: 0.5em;
    }

    .card-home-title > .flex-div > .button-group > input[name="market"] {
      display: none;
    }

    .card-home-title
      > .flex-div
      > .button-group
      > input[name="market"]:checked
      + label {
      background-color: #bf2d30;
      color: #fff;
    }

    .item-portofolio-sukuk {
      border: 1px solid #dadada;
      border-radius: 5px;
      padding: 0.8em;
    }

    .flex-head {
      display: flex;
    }

    .company-sukuks {
      width: 70%;
      margin: 0;
      font-size: 0.9em;
    }

    .label-item-portofolio-sukuk {
      background: #c7971e;
      color: #fff;
      font-weight: 600;
      width: 30%;
      text-align: center;
      height: 21px;
    }

    .title-sukuk-card {
      margin-top: 0.4em;
      font-weight: 400;
      font-size: 1.1em;
      margin-bottom: 0.2em;
    }

    .sukuk-id {
      color: #000;
      font-weight: 600;
      margin-bottom: 1.7em;
    }

    .sukuk-info > h4 {
      margin: 1.2em 0;
    }

    .title-sukuk-in-table {
      width: 60%;
    }

    .title-sukuk-in-table > p {
      margin-bottom: 0.4em;
      color: #000;
    }

    .value-sukuk-in-table {
      width: 40%;
    }

    .value-sukuk-in-table > p {
      margin-bottom: 0.4em;
      text-align: right;
      color: #000;
    }

    .item-portofolio {
      border: 1px solid #d4d4d4;
      border-radius: 5px;
    }

    .head-item-portofolio,
    .info-fund-portofolio {
      padding: 0.8em;
      border-bottom: 2px solid #f4f4f4;
    }

    .head-item-portofolio > .flex-head > p {
      margin: 0;
      color: #292f8d;
      font-size: 0.9em;
      width: 70%;
    }

    .label-item-portoflio-saham {
      background: #bf2d30;
      color: #fff;
      font-weight: 600;
      width: 30%;
      text-align: center;
      height: 21px;
    }

    .head-item-portofolio > h4 {
      font-size: 1.4em;
      font-weight: 600;
    }

    .head-item-portofolio > p {
      font-size: 0.9em;
      color: #858585;
      margin: 0;
    }

    .title-intable-saham {
      width: 70%;
      color: #000;
    }

    .value-intable-saham {
      width: 30%;
      color: #000;
      font-weight: 600;
    }

    .image-item-portofolio {
      padding: 0.8em;
    }

    .image-item-portofolio > img {
      width: 100%;
      height: 200px;
    }

    .card-content-sukuk {
      padding: 2em;
    }

    .sukuk-company {
      margin-top: 2em;
    }

    .trademark-sukuk {
      margin: 0;
      font-size: 1.1em;
      color: #000;
      font-weight: 400;
    }

    .code-sukuk {
      margin: 0;
      color: #000;
      font-size: 1.1em;
      font-weight: 600;
    }

    .info-split-sukuk {
      margin: 2em 0;
    }

    .item-info-sukuk > p {
      color: #000;
      margin: 0;
      font-size: 0.9em;
    }

    .item-info-sukuk > h3 {
      font-weight: 600;
      font-size: 2.1em;
    }

    .sukuk-company > h3 {
      font-weight: 600;
      margin: 0;
    }

    .sukuk-periode-title {
      margin: 0;
      color: #000;
      font-size: 0.8em;
    }

    .sukuk-periode-date {
      font-size: 10px;
      padding: 7px;
      border-radius: 4px;
    }

    .sukuk-table {
      margin-top: 2em;
    }

    .head-sukuk {
      background: #ededed;
      border-radius: 4px;
      color: #000;
    }

    @media screen and (max-width: 600px) {
      .mbv {
        visibility: hidden;
        clear: both;
        float: left;
        margin: 10px auto 5px 20px;
        width: 28%;
        display: none;
      }

      h4{
        font-size: 1.2rem;
      }
      .title-intable-saham{
        width: 50%;
        color: #000;
      }
      .value-intable-saham {
          width: 50%;
          color: #000;
          font-weight: 600;
      }
    }

    </style>
@endsection
