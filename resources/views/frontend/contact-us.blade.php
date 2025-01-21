@extends('frontend.layouts.app')
@section('title')
    {{ 'Contact Us' }}
@endsection
@section('content')
    <section class="contact-banner-section">
        <div class="container">
            <div class="about-content">
                <h1>Contact Us</h1>
            </div>
        </div>
    </section>
    <section class="contact-us-form">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="l-form-box">
                        <h1>Our Contacts</h5>
                            <div class="box">
                                <div class="icon-box"><i class="bi bi-globe"></i></div>
                                <div class="content-box">
                                    <h5>Address</h5>
                                    <p>{{ $data['address']->value ?? '' }}</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon-box"><i class="bi bi-envelope-check"></i></div>
                                <div class="content-box">
                                    <h5>E-Mail Address</h5>
                                    <p>{{ $data['email']->value ?? '' }}</p>
                                </div>
                            </div>
                            <div class="box">
                                <div class="icon-box"><i class="bi bi-headphones"></i></div>
                                <div class="content-box">
                                    <h5>Phone Number</h5>
                                    <p>{{ $data['phone']->value ?? '' }}</p>
                                </div>
                            </div>

                            <div class="social_link_box">
                                <h5>Follow Us</h5>
                                <button><a href="{{ $data['facebook']->value ?? '' }}" target="_blank"><i
                                            class="bi bi-facebook"></i></a></button>
                                <button><a href="{{ $data['instagram']->value ?? '' }}" target="_blank"><i
                                            class="bi bi-instagram"></i></a></button>
                                <button><a href="{{ $data['linkedin']->value ?? '' }}" target="_blank"><i
                                            class="bi bi-linkedin"></i></a></button>
                            </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('submit.contact-us') }}" method="POST">
                        @csrf
                        <div class="r-form-box">
                            <h5>Contact Us</h5>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="name"
                                    placeholder="Full Name" maxlength="50" required>
                                <label for="floatingInput">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="email"
                                    placeholder="Email" maxlength="50" required>
                                <label for="floatingInput">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="phone"
                                    placeholder="Phone Number" maxlength="14" required>
                                <label for="floatingInput">Phone Number</label>
                            </div>
                            <div class="form-floating textarea-form">
                                <textarea class="form-control textarea" placeholder="Message" name="message" id="floatingTextarea" maxlength="250"
                                    required></textarea>
                                <label for="floatingTextarea">Message</label>
                            </div>
                            <button type="submit" class="send_message"><span>Send Message</span><i
                                    class="bi bi-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
