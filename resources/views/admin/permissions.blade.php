@extends('admin.layouts.admin')

@section('title', __('views.membership.title'))

@section('content')
    <div class="row">
<div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>@sortablelink('email', __('views.membership.table_header_0'),['page' => $users->currentPage()])</th>
                <th>@sortablelink('name',  __('views.membership.table_header_1'),['page' => $users->currentPage()])</th>
                <th>{{ __('views.membership.table_header_2') }}</th>
            </tr>
            </thead>
            <tbody>
                @if(!empty($data))
                @php
                    $i=1;
                @endphp
            @foreach($data as $user)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $user['email'] }}</td>
                    <td>{{ $user['name'] }}</td>
                    <td>
                       
                            @if(!empty($user['subscriptionPurchase']))
                                <table class="table table-striped table-bordered dt-responsive nowrap">
                                    <thead>
                                    <tr>
                                        <th>{{ __('views.membership.table_header_3') }}</th>
                                        <th>{{ __('views.membership.table_header_4') }}</th>
                                        <th>{{ __('views.membership.table_header_5') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($user['subscriptionPurchase'] as $result)
                                     @php
                                           $type = !empty($result['type']) ? $result['type'] : '' ;
                                                    $number = !empty($result['number']) ? $result['number'] : '' ;
                                                     $created_at = !empty($result['purchases_date']) ? $result['purchases_date'] : '' ;
                                                    if($type == "week"){
                                                        $type = "weeks";
                                                    }else if($type == "day"){
                                                        $type = "days";
                                                    }else if($type == "month"){
                                                        $type = "months";
                                                    }else{
                                                         $type = "years";
                                                    }
                                                   $d = strtotime("+".$number."  ".$type."",strtotime($created_at));
                                                    $expires =  date("F d, Y",$d); 
                                                @endphp
                                        <tr>
                                            <td style="width: 30%">{{ $result['title'] ?? ' '  }}</td>
                                            <td style="width: 10%">
                                                @if(strtotime($expires) >= strtotime(date('F d,Y')))
                                                    <span class="label label-primary">{{ __('views.membership.valid') }}</span>
                                                @else
                                                    <span class="label label-danger">{{ __('views.membership.not_valid') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                               
                                                 
                                                {{  $expires ?? ''  }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="line_30 h4">
                                    Not validated
                                </div>
                            @endif
                        
                    </td>
                </tr>
            @endforeach
            @endif
            </tbody>
        </table>
 </div>

        <div class="pull-right">
            {{ $users->links() }}
        </div>
    </div>
@endsection
