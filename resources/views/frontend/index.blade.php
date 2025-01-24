@extends('frontend.layouts.app')
@section('title')
    {{ 'Home' }}
@endsection
@section('content')
    <sction class="hero_section">
        <div class="container pt-75">
            <div class="row">
                <div class="col-md-5">
                    <div class="content">
                        <img src="{{ asset('assets/frontend/images/shape.svg') }}" loading="lazy" class="shape-circle"
                            alt="">
                        <h1>{{ $our_latest_program->title ?? '' }}</h1>
                        <p>{!! $our_latest_program->description ?? '' !!}</p>
                        <button class="primaryBtn me-2">View More</button>
                        <button class="secondaryBtn">About Us</button>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="banner-img">
                        <img src="{{ \App\Helpers\Helper::getImageUrl($our_latest_program->banner_image) }}"
                            class="img-fluid" loading="lazy" alt="">
                    </div>
                </div>
            </div>
            <div class="iconBox">
                <div class="imgBox">
                    <img src="{{ asset('assets/frontend/images/image-11.webp') }}" class="img-fluid" loading="lazy"
                        alt="">
                </div>
                <div class="imgBox">
                    <img src="{{ asset('assets/frontend/images/image-13.webp') }}" class="img-fluid" loading="lazy"
                        alt="">
                </div>
                <div class="imgBox">
                    <img src="{{ asset('assets/frontend/images/image-15.webp') }}" class="img-fluid" loading="lazy"
                        alt="">
                </div>
                <div class="imgBox">
                    <img src="{{ asset('assets/frontend/images/image-17.webp') }}" class="img-fluid" loading="lazy"
                        alt="">
                </div>
                <div class="imgBox">
                    <img src="{{ asset('assets/frontend/images/image-19.webp') }}" class="img-fluid" loading="lazy"
                        alt="">
                </div>
                <div class="imgBox">
                    <img src="{{ asset('assets/frontend/images/image-21.webp') }}" class="img-fluid" loading="lazy"
                        alt="">
                </div>
            </div>
            <div class="we-develop-section">
                <div class="row">
                    <div class="col-md-6">
                        <div class="lBox">
                            <img src="{{ App\Helpers\Helper::getImageUrl($digital_marketing->image) }}" loading="lazy"
                                class="img-fluid btm-img" alt="">
                            <img src="{{ App\Helpers\Helper::getImageUrl($digital_marketing->banner_image) }}"
                                loading="lazy" class="img-fluid top-img" alt="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="rBox">
                            <h5>{{ $digital_marketing->title ?? '' }}</h5>
                            <h2>{{ $digital_marketing->sub_title ?? '' }}</h2>
                            {!! $digital_marketing->description ?? '' !!}
                            <div class="icon-cont-box">
                                <img src="{{ asset('assets/frontend/images/2.1-audio-marketing.svg') }}" alt="">
                                <div class="cont">
                                    <h3>Reports & analysis</h3>
                                    <p>Natus error sit voluptatem accus antium doloremque.</p>
                                </div>
                            </div>
                            <div class="icon-cont-box">
                                <img src="{{ asset('assets/frontend/images/2.2-market-analysis.svg') }}" alt="">
                                <div class="cont">
                                    <h3>Optimization</h3>
                                    <p>Sit voluptatem accus antium doloremque laudan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </sction>
    <section class="service-section">
        <div class="container section-title">
            <h2>Our Services</h2>
        </div>
        <div class="container pt-5">
            <div class="row gy-4">
                @if (count($our_services) > 0)
                    @foreach ($our_services as $service)
                        <div class="col-lg-4 col-md-4">
                            <div class="features-item">
                                <h3><a href=""
                                        class="">{{ $service->title ?? '' }}</a><span>{{ $service->sub_title ?? '' }}</span>
                                </h3>
                                {!! $service->description ?? '' !!}
                                <div class="more-info-btn"><a href="#">More Info >></a></div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <section class="stats">
        <div class="container section-title">
            <h2>Our Work</h2>
        </div>
        <div class="container pt-5">
            <div class="row gy-4">
                @if (count($our_works) > 0)
                    @foreach ($our_works as $work)
                        <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                            <i class="bi bi-emoji-smile"></i>
                            <div class="stats-item">
                                <span data-purecounter-start="0" data-purecounter-end="{{ $work->count ?? 0 }}"
                                    data-purecounter-duration="1" class="purecounter">{{ $work->count ?? 0 }}</span>
                                <p>{{ $work->title ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <section class="service-section we-focus-section">
        <div class="container section-title">
            <h2>Industeries We Focus</h2>
        </div>
        <div class="container pt-5">
            <div class="row gy-4">
                @foreach ($industries as $industry)
                    <div class="col-lg-4 col-md-4">
                        <div class="features-item">
                            {!! $industry->description ?? '' !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
