@extends('admin.layout.master')
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="basic-examples">
                <div class="row">
                    <div class="col-12 mb-1">
                        <h4>Welcome {{Auth::user()->trader->name}}!</h4>
                        <p>Platform Equity Crowdfunding pertama yang berizin dan diawasi Otoritas Jasa Keuangan berdasarkan Surat Keputusan Nomor: KEP-59/D.04/2019.</p>
                    </div>
                </div>

                
            </section>
        </div>
    </div>
</div>
@endsection