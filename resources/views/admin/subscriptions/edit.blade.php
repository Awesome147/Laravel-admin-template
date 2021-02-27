@extends('admin.layouts.admin')

@section('title',__('views.subscription.subscription_edit') )

@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{ Form::open(['route'=>['admin.subscriptions.update',$data->id],'method' => 'put','class'=>'form-horizontal form-label-left']) }}

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title" >
                        {{ __('views.subscription.table_header_1') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="title" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('title')) parsley-error @endif"
                               name="title" value="{{ $data->title ?? old('title') }}" required>
                        @if($errors->has('title'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('title') as $error)
                                        <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

  
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price" >
                        {{ __('views.subscription.price') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="price" type="text" class="form-control col-md-7 col-xs-12 @if($errors->has('price')) parsley-error @endif"
                               name="price" value="{{ $data->price ?? old('price') }}" required>
                        @if($errors->has('price'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('price') as $error)
                                        <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number" >
                        {{ __('views.subscription.table_header_3') }}
                        <span class="required">*</span>
                    </label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <input id="number" type="number" class="form-control col-md-7 col-xs-12 @if($errors->has('number')) parsley-error @endif"
                               name="number" value="{{ $data->number ?? old('number') }}" required min="0" oninput="this.value = Math.abs(this.value)">
                        @if($errors->has('number'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('number') as $error)
                                        <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                       <div class="col-md-3 col-sm-3 col-xs-12">
                           {!! Form::select("type", ["day"=>'Day',"week"=>'Week',"month"=>'Month',"year"=>'Year'], $data->type ?? old('type'), ['class'=>"form-control col-md-7 col-xs-12","required"=>"required"]) !!}
                       
                        @if($errors->has('type'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('type') as $error)
                                        <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description" >
                        {{ __('views.subscription.description') }}
                        <span class="required">*</span>
                    </label>
     <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::textarea('description', $data->description ?? old('description'), ['class'=>"form-control col-md-7 col-xs-12","required"=>"required"]) !!}
                        @if($errors->has('description'))
                            <ul class="parsley-errors-list filled">
                                @foreach($errors->get('description') as $error)
                                        <li class="parsley-required">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

           

            

                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a class="btn btn-primary" href="{{ URL::previous() }}"> {{ __('views.admin.users.edit.cancel') }}</a>
                        <button type="submit" class="btn btn-success"> {{ __('views.admin.users.edit.save') }}</button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/users/edit.css')) }}
@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/users/edit.js')) }}
@endsection