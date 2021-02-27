@extends('layouts.app')

@section('page')

 
<!-- Pricing Header -->
<div class="pricing-header px-3 my-4 pt-3 mx-auto text-center">
    <h1 class="display-4 mb-4">{{ __('views.subscription.title') }}</h1>
</div>

<!-- Pricing Cards -->
<main class="container">
  
  <div class="card-deck text-center mb-3">
     
    @if (!empty($data))
         @foreach ($data as $item)
            @php
                $ckeck = ApiHelper::SubscriptionPurchaseCheck($item->id);
           @endphp
            <!-- Card -->
            <div class="card shadow mb-4">
                 @if(!empty($ckeck))
                      <div class="current_plan">Current Plan</div>
                 @endif
                <div class="card-header">
                    <h4 class="m-0">{{ $item->title }}</h4>
                </div>
                
                <div class="card-body">
                    <h2 class="card-title">${{ $item->price }}<small class="text-muted">/ {{ $item->number }} {{ $item->type }}</small></h2>
                    <ul class="card-text list-unstyled mt-3 mb-4 monthly_desc">  
                        <li class="monthly_btn">{{ $item->description }}</li>
                       
                    </ul>
                    <a href="{{ url('subscription-pay') }}/{{ $item->id }}" class="btn btn-default btn-outline-primary mb-2">Pay</a>
                </div>
                <!-- End card-body -->
            </div>  
        <!-- End card -->
         @endforeach
    @else
        <b> {{ __('No ') }} {{ __('views.subscription.title') }} {{ __('Found') }}</b>
    @endif

   

   
    
    
  </div>
  <!-- End pricing tables -->

</main>
@endsection
