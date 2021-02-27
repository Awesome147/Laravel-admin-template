@extends('admin.layouts.admin')

@section('title', __('views.subscription.title'))

@section('content')
    <div class="row">
<div class="table-responsive">
        <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>@sortablelink('Title', __('views.subscription.table_header_1'),['page' => $data->currentPage()])</th>
                <th>@sortablelink('Price',  __('views.subscription.table_header_2'),['page' => $data->currentPage()])</th>
                <th>@sortablelink('Validity', __('views.subscription.table_header_3'),['page' => $data->currentPage()])</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @if (!empty($data))
                    
              
            @foreach($data as $row)
                <tr>
                    <td>{{ $row->title }}</td>
                    <td>{{ $row->price }}</td>
                    <td>{{ $row->number }} {{ $row->type }}</td>
                   
          
                    <td>
                        <a class="btn btn-xs btn-primary" href="{{ route('admin.subscriptions.edit', [$row->id]) }}" data-toggle="tooltip" data-placement="top" data-title="{{ __('views.subscription.subscription_edit') }}">
                            <i class="fa fa-pencil"></i>
                        </a>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.subscriptions.destroy', $row->id], 'onsubmit' => 'return confirmDelete()']) !!}
    <button type="submit" name="button" class="btn btn-default btn-sm">
        <i class="fa fa-trash-o"></i>
    </button>
{!! Form::close() !!}
                      
                     
                    </td>
                </tr>
            @endforeach
              @endif
            </tbody>
        </table>
</div>
        <div class="pull-right">
            {{ $data->links() }}
        </div>
    </div>

    <script>
        function confirmDelete() {
    return confirm('Are you sure you want to delete?');
}
    </script>
@endsection
