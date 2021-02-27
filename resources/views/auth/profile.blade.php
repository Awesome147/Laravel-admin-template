@extends('layouts.app')

@section('page')


<!-- Pricing Cards -->
<main class="container">
  
<div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('profile') }}" autocomplete="off" class="form-horizontal">
           @csrf
                      
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Edit Profile</h4>
                <p class="card-category">User information</p>
              </div>
              <div class="card-body ">
                @if(Session::has('profilemessage'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>{{ Session::get('profilemessage')}}  </strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>  
                  @endif          
                  <div class="row">
                  <label class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-7">
                    <div class="form-group bmd-form-group ">
                      <input class="form-control @error('name') is-invalid @enderror" name="name" id="input-name" type="text" placeholder="Name" value="{{ $data->name ?? old('name') }}" required>
                                          </div>
                                           @error('name') 
                   <small class="text-danger"> {{ $message ?? '' }} </small>
                  
                   @enderror
                  </div>
               
                </div>
                  
                <div class="row">
                  <label class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-7">
                    <div class="form-group bmd-form-group">
                      <input class="form-control @error('email') is-invalid @enderror" name="email" id="input-email" type="email" placeholder="Email" value="{{ $data->email ?? old('email') }}"  readonly>
                        </div>
                             @error('email') 
                   <small class="text-danger"> {{ $message ?? '' }} </small>
                  
                   @enderror
                  </div>
                </div>
             
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('change-password') }}" class="form-horizontal">
           @csrf
                    
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Change password</h4>
                <p class="card-category">Password</p>
              </div>
              <div class="card-body ">
                  @if(Session::has('change_pass_message_error'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>{{ Session::get('change_pass_message_error')}}  </strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>  
                  @endif 
                    @if(Session::has('change_pass_message'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>{{ Session::get('change_pass_message')}}  </strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>  
                  @endif                       
                <div class="row">
                  <label class="col-sm-2 col-form-label " for="input-current-password">Current Password</label>
                  <div class="col-sm-7">
                    <div class="form-group bmd-form-group">
                      <input class="form-control @error('current_password') is-invalid @enderror" input="" type="password" name="current_password" id="input-current-password" placeholder="Current Password" value="" required>
                      @error('current_password') 
                   <small class="text-danger"> {{ $message ?? '' }} </small>
                  
                   @enderror                     
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">New Password</label>
                  <div class="col-sm-7">
                    <div class="form-group bmd-form-group">
                      <input class="form-control @error('password') is-invalid @enderror" name="password" id="input-password" type="password" placeholder="New Password" value="" required>
                      @error('password') 
                   <small class="text-danger"> {{ $message ?? '' }} </small>
                  
                   @enderror                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">Confirm New Password</label>
                  <div class="col-sm-7">
                    <div class="form-group bmd-form-group">
                      <input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="Confirm New Password" value="" required>
                     @error('password_confirmation') 
                   <small class="text-danger"> {{ $message ?? '' }} </small>
                  
                   @enderror
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">Change password<div class="ripple-container"></div></button>
              </div>
            </div>
          </form>
        </div>
      </div>


      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('delete-account') }}" autocomplete="off" class="form-horizontal">
           @csrf
                      
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">Delete Account</h4>
                <p class="card-category">Delete</p>
              </div>
              <div class="card-body ">
                      @if(Session::has('delete_account_message_error'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>{{ Session::get('delete_account_message_error')}}  </strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>  
                  @endif 
                    @if(Session::has('delete_account_message'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>{{ Session::get('delete_account_message')}}  </strong>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                      </div>  
                  @endif       
                    <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">Password</label>
                  <div class="col-sm-7">
                    <div class="form-group bmd-form-group">
                      <input class="form-control @error('password') is-invalid @enderror" name="password" id="input-password" type="password" placeholder="New Password" value="" required>
                      @error('password') 
                   <small class="text-danger"> {{ $message ?? '' }} </small>
                  
                   @enderror                      
                    </div>
                  </div>
                </div>
             
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">Delete account</button>
              </div>
            </div>
          </form>
        </div>
      </div>
  <!-- End pricing tables -->

</main>
@endsection
