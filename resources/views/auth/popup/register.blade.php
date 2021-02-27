<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="registerModal">{{ __('Register') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
              <div class="modal-body">
              <div class="login_form">
                        <section class="login-wrapper">
                             {{ Form::open(['url' => 'register','id'=>"login"]) }}
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
                                     <input id="usernameInput" type="text" class="form-control" name="register_name" value="{{ old('register_name') }}" placeholder="Name"  autocomplete="register_name" autofocus>
                                    <i class="fa fa-user fa-lg"></i>
                                    <span class="invalid-feedback" role="alert" id="nameError">
                                        <strong></strong>
                                    </span>
                                </div>
                                <div class="user_field">
                                                   <input id="emailInput" type="email" class="form-control" name="register_email" value="{{ old('register_email') }}" placeholder="Email" required autocomplete="register_email">

                                    <i class="fa fa-envelope-o fa-lg"></i>
                                     <span class="invalid-feedback" role="alert" id="emailError">
                                <strong></strong>
                            </span>
                                </div>
                                <div class="pass_field">
                                     <input id="passwordInput" type="password" class="form-control" name="register_password" required autocomplete="new-password" placeholder="Password">
                                    <i class="fa fa-key fa-lg"></i> 
                                    <span toggle="#passwordInput" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    <!-- <div class="hide-show">
                                        <span>Show</span>
                                    </div> -->
                                </div>
                                <div class="pass_field">
                                     <input id="confirm_password" type="password" class="form-control toggle-password" name="register_password_confirmation" required autocomplete="new-password" placeholder="Confirmation Password">
                                    <i class="fa fa-key fa-lg"></i> 
                                    <span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    <span class="invalid-feedback" role="alert" id="passwordError">
                                <strong></strong>
                            </span>
                                </div>
                                
                                <div style="clear:both;"></div>
                                <!-- <div class="forgot-pwd">
                                    <a target="_blank" rel="noopener" href="http://ec2-35-175-136-108.compute-1.amazonaws.com/">Forgot
                                        Password?</a>
                                </div> -->

                                <button type="submit">SignUp</button>
                                <div class="sign-up">
                                    <label>I have an account already.</label><a href="#" class="auth_modal" style="cursor: pointer" data-toggle="modal" data-target="#loginModal">SignIn</a>
                                </div>
                            {{ Form::close() }}

                            </section>
                </div>
          
               
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
@section('scripts')
@parent

@if($errors->has('register_email') || $errors->has('register_password')  || $errors->has('register_name') )
    <script>
    $(function() {
        $('#registerModal').modal({
            show: true
        });
    });
    </script>
@endif
@endsection