<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>Office</h5>
                <p class="address">{{ \App\Helpers\Helper::getSupportContact()['address'] }}</p>
                <a href="#" class="email"><span>{{ \App\Helpers\Helper::getSupportContact()['email'] }}</span></a>
                <h5 class="mb-0"><a href="tel:{{ \App\Helpers\Helper::getSupportContact()['phone'] }}">{{ \App\Helpers\Helper::getSupportContact()['phone'] }}</a></h5>
            </div>
            <div class="col-md-3">
                <h5>Links</h5>
                <a href="{{ route('index')}}"><span>Home</span></a>
                <a href="{{ route('about-us')}}"><span>About Us</span></a>
                <a href="{{ route('contact-us')}}"><span>Contacts</span></a>
            </div>
            <div class="col-md-3">
                <h5>Socials</h5>
                <a href="{{ \App\Helpers\Helper::getSupportContact()['facebook_url'] }}"><span>Facebook</span></a>
                <a href="{{ \App\Helpers\Helper::getSupportContact()['instagram_url'] }}"><span>Instagram</span></a>
                <a href="{{ \App\Helpers\Helper::getSupportContact()['linkedin_url'] }}"><span>Linkedin</span></a>
            </div>
            <div class="col-md-3">
                <h5>Newsletter</h5>
                <div class="input_box">
                    <input type="email" class="form-control">
                    <button><img src="{{ asset('assets/frontend/images/arrow-icon.svg')}}" loading="lazy" alt=""></button>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"
                        checked>
                    <label class="form-check-label" for="flexCheckChecked"><span class="label">I agree to
                            the</span>
                        <a href="#"><span>Privacy Policy</span></a>
                    </label>
                </div>
            </div>
        </div>
    </div>
</footer>
