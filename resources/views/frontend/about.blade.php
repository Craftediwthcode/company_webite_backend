@extends('frontend.layouts.app')
@section('title')
    {{ 'About Us' }}
@endsection
@section('content')
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <h1>About Us</h1>
            </div>
        </div>
    </section>
    <section class="about-image-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left_box">
                        <h5>{{ $module_data->children->title ?? '' }}</h5>
                        <h1>{{ $module_data->children->sub_title ?? '' }}</h1>
                        <p>{!! $module_data->children->description ?? '' !!}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="right_box">
                        <img src="{{ \App\Helpers\Helper::getImageUrl($module_data->children->image) }}"
                            class="img-fluid btm_img" loading="lazy" alt="">
                        <img src="{{ \App\Helpers\Helper::getImageUrl($module_data->children->banner_image) }}"
                            class="img-fluid top_img" loading="lazy" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
