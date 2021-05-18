<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Tajaa Mandi:Powered by Revotech Nepal, Taja Mandi is an internet shopping initiation. A marketplace for eateries; vendors & consumers. We provide our customers with the best deals from the market. Connect with us for the best deals from around the country. Compare, click and buy.">
    <meta name="keywords" content="Taja Mandi | Groceries E-store| E-commerce">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TajaMandi | All your Home Groceries.</title>
    <link rel = "icon" href = "{{asset('frontend/img/tajamandi.png')}}"
        type = "image/x-icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css">
    <link href="{{asset('frontend/modalassets/css/login-register.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{asset('frontend/css/rating.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/algolia.css') }}">

    @stack('styles')
    <style>
        .hero__search__form{
            position: absolute;
            max-width: 92%;
        }
        .single-hero-items.set-bg{
            height:500px;
        }
        /*@media only screen and (max-width: 767px)*/
        /*    .hero__search__form {*/
        /*        width: 92%;*/
        /*}*/
        /* @media (max-width: 1200px) {
            .hero__search__form{
            position: absolute;
        }
         } */
    </style>

        <!-- Facebook Pixel Code -->
    <script type="text/javascript">
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '2888318151426386');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=2888318151426386&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body>
    @include('frontend.layouts.includes.header')

    @yield('content')

    <div id="fb-root"></div>

    @include('frontend.layouts.includes.footer')
    @include('frontend.layouts.includes.modal')

    <!-- Js Plugins -->
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
  <script src="{{asset('frontend/modalassets/js/login-register.js')}}" type="text/javascript"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
  <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
  <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
   <script src="{{ asset('frontend/js/algolia.js') }}"></script>

   <!-- modal -->
<script>

        $(document).ready(function(){
            $('#exampleModal').modal('show');


        })

</script>
    <script>
        function showPasswordForm(){
        $('.loginBox').fadeOut('fast',function(){
            $('.passwordBox').fadeIn('fast');
            $('.login-footer').fadeOut('fast',function(){
                $('.register-footer').fadeIn('fast');
            });
            $('.modal-title').html('Reset Password');
        });
        $('.error').removeClass('alert alert-danger').html('');
    }
    function showRegisterForm(){
        $('.loginBox').fadeOut('fast',function(){
            $('.registerBox').fadeIn('fast');
            $('.passwordBox').fadeOut('fast');
            $('.login-footer').fadeOut('fast',function(){
                $('.register-footer').fadeIn('fast');
            });
            $('.modal-title').html('Register');
        });
        $('.error').removeClass('alert alert-danger').html('');
    }
    function showLoginForm(){
        $('#loginModal .registerBox').fadeOut('fast',function(){
            $('.loginBox').fadeIn('fast');
            $('.passwordBox').fadeOut('fast');
            $('.register-footer').fadeOut('fast',function(){
                $('.login-footer').fadeIn('fast');
            });

            $('.modal-title').html('Login');
        });
        $('.error').removeClass('alert alert-danger').html('');
    }

    function openLoginModal(){
        showLoginForm();
        setTimeout(function(){
            $('#loginModal').modal('show');
        }, 230);
    }
    function openRegisterModal(){
        showRegisterForm();
        setTimeout(function(){
            $('#loginModal').modal('show');
        }, 230);
    }
    function openPasswordModal(){
        showPasswordForm();
        setTimeout(function(){
            $('#loginModal').modal('show');
        }, 230);
    }
    </script>

@if ($errors->has('email') || $errors->has('password') || $errors->has('name') ||$errors->has('password_confirmation'))
    <script type="text/javascript">
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');
    }, 230);
    shakeModal()
    function shakeModal(){
        $('#loginModal .modal-dialog').addClass('shake');
                setTimeout( function(){
                    $('#loginModal .modal-dialog').removeClass('shake');
        }, 2000 );
    }
    </script>
@endif
<script type="text/javascript">
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000); // 5 secs
</script>

<!-- Messenger Chat Plugin Code -->
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v10.0'
          });
        };

        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution="page_inbox"
        page_id="110315501202576">
      </div>

@stack('scripts')
</body>

</html>
