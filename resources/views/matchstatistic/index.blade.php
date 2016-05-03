@extends('wd.admin.main')

@section('content')

    <div class="container top-gap">
        <ul class="nav nav-tabs sub-admin-nav" role="tablist">
            <li role="presentation" class="active">
                <a href="javascript:void(0);" aria-controls="index" role="tab" >
                    {{trans('matchStatistic.title')}}
                </a>
            </li>
            <li role="presentation">
                <a href="{{url('/matchstatistic/exception/create')}}" aria-controls="create" role="tab" >
                    {{trans('matchStatistic.newException.title')}}
                </a>
            </li>
        </ul>

        <div class="product-content table-responsive">

            <table class="table table-striped table-hover ">
                <thead>
                <tr>
                    <th>　</th>
                    <th>{{trans('matchStatistic.table.header.device')}}</th>
                    <th>{{trans('matchStatistic.table.header.systemVersion')}}</th>
                    <th>{{trans('matchStatistic.table.header.occurDate')}}</th>
                    <th>　</th>
                </tr>
                </thead>
                <tbody>
                @if (count($data['exceptions']) == 0)
                    <tr>
                        <td colspan="5" style="text-align: center">{{trans('matchStatistic.table.tableRow.empty')}}</td>
                    </tr>
                @else
                    @foreach ($data['exceptions'] as $exception)
                        <tr>
                            <td>{{$exception->id}}</td>
                            <td><strong>{{$exception->device}}</strong></td>
                            <td>{{$exception->system_version}}</td>
                            <td><span class="normal-price">{{$exception->created_at}}</span></td>
                            <td><a href="{{url('/matchstatistic/exception/'.$exception->id)}}" class="btn btn-danger btn-sm">{{trans('matchStatistic.table.tableRow.show')}}</a> </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

            <div class="page-info">
                <p><code>{{strtr(trans('matchStatistic.table.pagination'), ['@' => '16', '#' => $data['exceptions']->total()])}}</code></p>
            </div>
        </div>
        {!! $data['exceptions']->render() !!}
    </div>

@endsection