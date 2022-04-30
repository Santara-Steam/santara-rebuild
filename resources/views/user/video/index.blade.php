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
                        @include('user.is_kyc')
                        <div class="card">
                            <div class="card-header">
                                <div class="row">

                                    <div class="col-md-9">
                                        <h1 class="card-title-member">Video Tutorial</h1>
                                    </div>
                                    <div class="col-md-3" style="margin-top: 5px;">
                                        {{-- {{session('search_query')}} --}}
                                        <form class="form-inline" method="GET" action="{{ route('results') }}">
                                            {{-- <input class="form-control mr-sm-2" type="search" name="search_query"
                                                placeholder="Search" aria-label="Search"> --}}
                                            <fieldset class="form-group">
                                                <label for="filter" style="margin-right: 20px;
                                                margin-left: -20px;
                                                font-size: 16px;
                                                font-weight: 600;">Filter</label>
                                                
                                                <select class="form-control" name="search_query" id="filter"
                                                    onchange="if(this.value != 'kosong') { this.form.submit(); }">
                                                    <option {{ session('search_query')=='' ? 'selected' : '' }}
                                                        value="">
                                                        Semua</option>
                                                    <option {{ session('search_query')=='Tutorial' ? 'selected' : '' }}
                                                        value="Tutorial">Tutorial</option>
                                                    <option {{ session('search_query')=='Equity Crowdfunding'
                                                        ? 'selected' : '' }} value="Equity Crowdfunding">Equity
                                                        Crowdfunding</option>
                                                    <option {{ session('search_query')=='Santara' ? 'selected' : '' }}
                                                        value="Santara">Santara</option>
                                                    <option {{ session('search_query')=='Penerbit' ? 'selected' : '' }}
                                                        value="Penerbit">Penerbit</option>
                                                    <option {{ session('search_query')=='Sharing Session' ? 'selected'
                                                        : '' }} value="Sharing Session">Sharing Session</option>
                                                    <option {{ session('search_query')=='Mindset' ? 'selected' : '' }}
                                                        value="Mindset">Mindset</option>
                                                </select>
                                            </fieldset>

                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body px-1 pb-3">
                                    {{-- <h3>KITA HARUS GANTI MINDSET KITA UNTUK BISNIS YANG LEBIH MILENIEAL!!</h3>
                                    <iframe width="100%" height="480" src="https://www.youtube.com/embed/MnP5MkmI9q0"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe> --}}
                                    @foreach($videoLists->items as $key => $item)
                                    <div class="row mb-3">
                                        <a href="{{ route('watch', $item->id->videoId) }}" style="display: contents">
                                            <div class="col-md-4 mt-1">
                                                <img src="{{ $item->snippet->thumbnails->medium->url }}" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div class="col-md-8 mt-1">
                                                <h5>{{ \Illuminate\Support\Str::limit($item->snippet->title, $limit =
                                                    150, $end = ' ...') }}</h5>
                                                <p class="text-muted">Published
                                                    at {{ date('d M Y', strtotime($item->snippet->publishTime)) }}</p>
                                                <p>{{ \Illuminate\Support\Str::limit($item->snippet->description, $limit
                                                    = 300, $end = ' ...') }}</p>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach

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

@endsection
@section('style')

@endsection