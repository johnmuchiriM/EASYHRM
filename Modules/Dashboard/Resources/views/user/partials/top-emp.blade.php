<div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{__('dashboard::lang.top-5-performers')}} {{date('F Y')}}
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr class="text-center">
                            <th>{{ __('dashboard::lang.hash-tag') }}</th>
                            <th>{{ __('dashboard::lang.name') }}</th>
                            <th>{{ __('employees::employee.role') }}</th>
                            <th>{{ __('dashboard::lang.working-hour') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($topEmployees as $key => $topEmployee)
                                @if($key != 4)
                                    <tr class="text-center">
                                        <td class="text-muted">{{$key+1}}</td>
                                        <td>{{$topEmployee['name']}}</td>
                                        <td>{{$topEmployee['designation']}}</td>
                                        <td>{{$topEmployee['workingHour']}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>