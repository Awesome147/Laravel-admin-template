<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog login_model_popup" role="document">
        <div class="modal-content">
        {{--     <div class="modal-header">
            
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
           <div class="login_form">
        <section class="login-wrapper">
             {{ Form::open(['url' => 'login','id'=>"login"]) }}
                <div class="logo">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!$errors->isEmpty())
                            <div class="alert alert-danger" role="alert">
                                {!! $errors->first() !!}
                            </div>
                        @endif
                        <p class = "logo-word">Chromacam</p>
                </div>
                <div class="user_field">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   placeholder="{{ __('views.auth.login.input_0') }}" required autofocus>
                    <i class="fa fa-envelope-o fa-lg"></i>
                </div>
                <div class="pass_field">
                    <input id="password" type="password" class="form-control" name="password"
                                   placeholder="{{ __('views.auth.login.input_1') }}" required>
                    <i class="fa fa-key fa-lg"></i> 
                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    <!-- <div class="hide-show">
                        <span>Show</span>
                    </div> -->
                </div>
                
                <div style="clear:both;"></div>
                <div class="forgot-pwd">
                    <a target="_blank" rel="noopener" href="{{ route('password.request') }}">{{ __('views.auth.login.action_1') }}</a>
                </div>

                <button  type="submit">{{ __('views.auth.login.action_0') }}</button>

                <p class="btn-separator">
                    <span>or</span>
                </p>

                <a href="{{ route('social.redirect', ['google']) }}" id="login_google_submit" button-role="submit" type="button" class="btn btn-success btn-facebook">
                    <svg width="4mm" height="4.7625mm" viewBox="0 0 256 262" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid"><path d="M255.878 133.451c0-10.734-.871-18.567-2.756-26.69H130.55v48.448h71.947c-1.45 12.04-9.283 30.172-26.69 42.356l-.244 1.622 38.755 30.023 2.685.268c24.659-22.774 38.875-56.282 38.875-96.027" fill="#4285F4"/><path d="M130.55 261.1c35.248 0 64.839-11.605 86.453-31.622l-41.196-31.913c-11.024 7.688-25.82 13.055-45.257 13.055-34.523 0-63.824-22.773-74.269-54.25l-1.531.13-40.298 31.187-.527 1.465C35.393 231.798 79.49 261.1 130.55 261.1" fill="#34A853"/><path d="M56.281 156.37c-2.756-8.123-4.351-16.827-4.351-25.82 0-8.994 1.595-17.697 4.206-25.82l-.073-1.73L15.26 71.312l-1.335.635C5.077 89.644 0 109.517 0 130.55s5.077 40.905 13.925 58.602l42.356-32.782" fill="#FBBC05"/><path d="M130.55 50.479c24.514 0 41.05 10.589 50.479 19.438l36.844-35.974C195.245 12.91 165.798 0 130.55 0 79.49 0 35.393 29.301 13.925 71.947l42.211 32.783c10.59-31.477 39.891-54.251 74.414-54.251" fill="#EB4335"/></svg>
                    Sign In with Google
                </a>
                <!--<div class="mt-20" >
                    <button id="login_apple_submit" button-role="submit" type="button" class="up-btn mr-0 apple-sso-button full-width mb-0 up-btn-primary">
                        <svg width="3.8469mm" height="4.7625mm" version="1.1" viewBox="0 0 3.8469 4.7625" xmlns="http://www.w3.org/2000/svg">
                            <g transform="translate(-64.345 -143.35)"><path d="m65.3 148.04c-0.28391-0.17313-0.67141-0.76332-0.84045-1.2801-0.08795-0.26886-0.11025-0.42084-0.11353-0.77372-5e-3 -0.53416 0.07013-0.78453 0.32071-1.0692 0.32908-0.37386 0.80475-0.48983 1.2754-0.31094 0.28741 0.10923 0.40289 0.10558 0.79215-0.0251 0.25755-0.0864 0.3669-0.10301 0.53413-0.0809 0.27892 0.0369 0.51512 0.14539 0.6838 0.31406l0.138 0.138-0.15036 0.12394c-0.35848 0.29549-0.46412 0.84523-0.24639 1.2822 0.09783 0.19631 0.33073 0.42321 0.48834 0.47574 0.07682 0.0256-0.27148 0.68647-0.49609 0.94128-0.31615 0.35864-0.47304 0.40634-0.86417 0.26274-0.38534-0.14149-0.49243-0.14492-0.83466-0.0268-0.37222 0.12848-0.51369 0.13441-0.68687 0.0288zm0.95956-3.6652c-0.04406-0.11481 0.09887-0.49259 0.25567-0.67578 0.14967-0.17485 0.45436-0.3477 0.61294-0.3477 0.08074 0 0.08756 0.0177 0.06932 0.17944-0.0488 0.43295-0.36807 0.79774-0.77487 0.88535-0.10672 0.0229-0.14178 0.0141-0.16305-0.0413z"></path>
                            </g>
                        </svg>
                        Sign in with Apple
                    </button> 
                </div>
                 <div class="mt-20">
                                 <a href="{{ route('social.redirect', ['facebook']) }}" class="btn btn-success btn-facebook">
                                    <i class="fa fa-facebook"></i>
                                    Facebook
                                </a>
                 </div>
                  <div class="mt-20">
                                <a href="{{ route('social.redirect', ['twitter']) }}" class="btn btn-success btn-twitter">
                                    <i class="fa fa-twitter"></i>
                                    Twitter
                                </a>
                </div>-->

                <div class="sign-up">
                    <label>I don’t have an account.</label><a href="#" style="cursor: pointer" class="auth_modal"  data-toggle="modal" data-target="#registerModal">{{ __('views.auth.login.action_2') }}</a>
                </div>
             {{ Form::close() }}

            </section>
    </div>
        </div>
    </div>
</div>

@section('scripts')
@parent

@if($errors->has('email') || $errors->has('password'))
    <script>
    $(function() {
        $('#loginModal').modal({
            show: true
        });
    });
    </script>
@endif
@endsection