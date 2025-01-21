@extends('frontend.layouts.app')
@section('title')
    {{ 'Portfolio' }}
@endsection
@section('content')
    <section class="portfolio-banner-section">
        <div class="container">
            <div class="about-content">
                <h1>Portfolio</h1>
            </div>
        </div>
    </section>
    <section class="portfolio-section">
        <div class="container">
            <div class="row">
                @foreach ($module_data as $portfolio)
                    <div class="col-md-4">
                        <div class="portfolio-box">
                            <a href="#">
                                <div class="imgBox">
                                    <img src="{{ App\Helpers\Helper::getImageUrl($portfolio->image) }}" loading="lazy" class="img-fluid" alt="">
                                </div>
                                <div class="contentBox">
                                    <button><span><i class="bi bi-arrow-right"></i></span></button>
                                    <h5>{{ $portfolio->title ?? '' }}</h5>
                                    <h2>{{ $portfolio->sub_title ?? '' }}</h2>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
