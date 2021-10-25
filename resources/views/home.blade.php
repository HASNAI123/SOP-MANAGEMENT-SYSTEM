@extends('layouts.admin')
@section('content')



<div  class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                </div>

                <div class="panel-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings1['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings1['chart_title'] }}</h3>
                            <table style="font-size: 15 px;"class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings1['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings1['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings1['data'] as $entry)
                                        <tr>
                                            @foreach($settings1['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        {{ data_get($entry, $key . '.' . $value) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings1['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
 
                        
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings3['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings3['chart_title'] }}</h3>
                            <table style="font-size: 15px;" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings3['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings3['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings3['data'] as $entry)
                                        <tr>
                                            @foreach($settings3['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                            
                                                        @endforeach
                                                    @else
                                                        {{ data_get($entry, $key . '.' . $value) }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings3['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="{{ $settings2['column_class'] }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-red" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-chart-line"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $settings2['chart_title'] }}</span>
                                    <span class="info-box-number">  {{ $userCount }}</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                </div>
            </div>
            <div class="content">
            <div class="row">
            @foreach ($list_blocks as $block)
                <div class="col-md-6">
                    <h3>{{ $block['title'] }}</h3>
                    <table style="font-size: 15px;" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>User ID</th>
                            <th>Last login at</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($block['entries'] as $entry)
                            <tr>
                                <td>{{ $entry->name }}</td>
                                <td>{{ $entry->email }}</td>
                                <td>{{ $entry->last_login_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">{{ __('No entries found') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
        </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
@endsection