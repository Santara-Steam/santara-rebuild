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
                            <div class="card-content">
                                <div class="card-body px-1 pb-3">
                                    {{-- <h3>KITA HARUS GANTI MINDSET KITA UNTUK BISNIS YANG LEBIH MILENIEAL!!</h3>
                                    <iframe width="100%" height="480" src="https://www.youtube.com/embed/MnP5MkmI9q0"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe> --}}
                                    
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="card mb-4" style="width: 100%;border: 1px inset #c8c8cd59;">
                                                    <h1 class="card-title-member">{{ $singleVideo->items[0]->snippet->title }}</h1>
                                                    <div class="embed-responsive embed-responsive-16by9">
                                                        <iframe src="https://www.youtube.com/embed/{{ $singleVideo->items[0]->id }}" width="560" height="600" frameborder="0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                    </div>
                                                    <div class="card-body" style="">
                                                        <h5 style="font-size: 24px;
                                                        color: black;
                                                        font-weight: 500;">{{ $singleVideo->items[0]->snippet->title }}</h5>
                                                        <p class="text-secondary">Published
                                                            at {{ date('d M Y', strtotime($singleVideo->items[0]->snippet->publishedAt)) }}</p>
                                                        <p style="color: black">{{ $singleVideo->items[0]->snippet->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="container">
                                                    <div class="row">
                                                        @foreach($videoLists->items as $key => $item)
                                                            <div class="col-12">
                                                                <a href="{{ route('watch', $item->id->videoId) }}">
                                                                    <div class="card mb-4" style="border: 1px inset #c8c8cd59;">
                                                                        <img src="{{ $item->snippet->thumbnails->medium->url }}" alt="">
                                                                        <div class="card-body">
                                                                            <h5>{{ \Illuminate\Support\Str::limit($item->snippet->title, $limit = 50, $end = ' ...') }}</h5>
                                                                        </div>
                                                                        <div class="card-footer text-muted">
                                                                            Published at {{ date('d M Y', strtotime($item->snippet->publishTime)) }}
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
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

@endsection
@section('style')

@endsection