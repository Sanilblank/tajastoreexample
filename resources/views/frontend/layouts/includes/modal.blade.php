{{-- modal here --}}
<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content">
           <div class="modal-header">
               <h4 class="modal-title">Login with</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
              <div class="box">
                   <div class="content">
                      <div class="social">
                          <a id="google_login" class="circle google" href="{{url('auth/google')}}">
                                <i class="fa fa-google-plus"></i>
                          </a>
                          <a id="facebook_login" class="circle facebook" href="{{url('auth/facebook')}}">
                                &nbsp;&nbsp;<i class="fa fa-facebook" aria-hidden="true"></i>&nbsp;&nbsp;
                          </a>
                      </div>
                      <div class="division">
                          <div class="line l"></div>
                            <span>or</span>
                          <div class="line r"></div>
                      </div>
                      <div class="errors">
                        @if ($errors->any())
                            {{-- <div {{ $attributes }}> --}}
                                <div class="font-medium text-red-600">Whoops! Something went wrong.</div>

                                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            {{-- </div> --}}
                        @endif
                      </div>
                      <div class="form loginBox">
                          <form method="POST" action="{{route('login')}}">
                            @csrf
                            @method('POST')
                          <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                          <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                          <input class="btn btn-default btn-login" type="submit" value="Login">
                          </form>
                      </div>
                   </div>
              </div>
              <div class="box">
                  <div class="content registerBox" style="display:none;">
                   <div class="form">
                      <form method="POST" action = "{{route('register')}}">
                        @csrf
                        @method('POST')
                        <input id="name" class="form-control" type="text" placeholder="Full Name" name="name">
                        <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                        <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                        <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                        <input class="btn btn-default btn-register" type="submit" value="Create account" >
                      </form>
                      </div>
                  </div>
              </div>
              <div class="box">
                <div class="content passwordBox" style="display:none;">
                 <div class="form">
                    <form method="POST" action = "{{ route('password.email') }}">
                      @csrf
                      @method('POST')

                      <input id="email" class="form-control mb-2" type="text" placeholder="Email" name="email">

                      <input class="btn btn-default btn-password" type="submit" value="Send Password Reset Link" >
                    </form>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
              <div class="forgot login-footer">
                  <span>Looking to
                       <a href="javascript: showRegisterForm();">create an account ?</a><br>

                       @if (Route::has('password.request'))
                        <a href="javascript: showPasswordForm();">
                            Forgot Password?
                        </a>
                       @endif
                  </span>
              </div>
              <div class="forgot register-footer" style="display:none">
                   <span>Already have an account?</span>
                   <a href="javascript: showLoginForm();">Login</a>
              </div>
          </div>
        </div>
    </div>
</div>
