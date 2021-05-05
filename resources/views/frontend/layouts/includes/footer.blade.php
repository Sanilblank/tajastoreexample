<!-- Footer Section Begin -->
<footer class="footer spad">
    <div class="container">
        @php
            $setting = DB::table('settings')->first();
        @endphp
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="{{route('index')}}"><img src="{{Storage::disk('uploads')->url($setting->footerImage)}}" alt="Tajamandi" style="max-width: 120px; max-height: 120px;"></a>
                    </div>
                    <ul>
                        <li>Address: {{$setting->address}}</li>
                        <li>Phone: {{$setting->phone}}</li>
                        <li>Email: {{$setting->email}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Useful Links</h6>
                    <ul class="mt-2">
                        {{-- <li><a href="#">FAQs</a></li> --}}
                        <li><a href="{{route('shop')}}">Visit Our Shop</a></li>
                        <li><a href="{{route('about')}}">About Our Shop</a></li>
                        <li><a href="{{route('contact')}}">Contact</a></li>
                        {{-- <li><a href="#">Secure Shopping</a></li> --}}
                        {{-- <li><a href="#">Delivery infomation</a></li> --}}
                        <li><a href="{{route('privacypolicy')}}">Privacy Policy</a></li>
                        {{-- <li><a href="#">Our Sitemap</a></li> --}}
                        {{-- <li><a href="#">Who We Are</a></li> --}}
                        {{-- <li><a href="#">Our Services</a></li> --}}
                        <li><a href="{{route('termsandconditions')}}">Terms & Conditions</a></li>
                        {{-- <li><a href="#">Innovation</a></li> --}}
                        {{-- <li><a href="#">Testimonials</a></li> --}}
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="footer__widget">
                    <h6>Find us on Social Media</h6>
                    {{-- <p>Get E-mail updates about our latest shop and special offers.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your mail">
                        <button type="submit" class="site-btn">Subscribe</button>
                    </form> --}}
                    <div class="footer__widget__social mt-2">
                        <a href="{{$setting->facebook}}" target="_blank"><i class="fa fa-facebook"></i></a>
                        <a href="{{$setting->instagram}}" target="_blank"><i class="fa fa-instagram"></i></a>
                        {{-- <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fa fa-pinterest"></i></a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer__copyright">
                    <div class="footer__copyright__text">
                        <p>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());

                            </script> All rights reserved | This template is made with <i class="fa fa-heart"
                                aria-hidden="true"></i> by <a href="https://tech.revonepal.com" target="_blank">RevoTech Nepal</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                    <div class="footer__copyright__payment"><img src="{{ asset('frontend/img/payment-item.png') }}"
                            alt=""></div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->
