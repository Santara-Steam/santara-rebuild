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

                                    <div class="col-md-8">
                                        <h1 class="card-title-member">Video Tutorial</h1>
                                    </div>
                                    <div class="col-md-4">
                                        <form class="form-inline my-2 my-lg-0" method="GET"
                                            action="{{ route('results') }}">
                                            <input class="form-control mr-sm-2" type="search" name="search_query"
                                                placeholder="Search" aria-label="Search">
                                            <button class="btn btn-outline-success my-2 my-sm-0"
                                                type="submit">Search</button>
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
                                            <div class="col-4">
                                                <img src="{{ $item->snippet->thumbnails->medium->url }}" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div class="col-8">
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