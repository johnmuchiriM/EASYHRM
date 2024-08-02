<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">{{__('dashboard::lang.all-emp')}} </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>{{ __('employees::employee.employee-id') }}</th>
                                <th>{{ __('employees::employee.employee-name') }}</th>
                                <th>{{ __('dashboard::lang.employee-email') }}</th>
                                <th>{{ __('employees::employee.role') }}</th>
                                <th>{{ __('dashboard::lang.details') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach(getAllEmp() as $key => $employee)
                                <tr>
                                    <td class="text-muted mt-3 pr-3">{{ $employee->id }}</td>
                                    <td>  {{$employee->name}} </td>
                                    <td>  {{$employee->email}} </td>
                                    <td>  {{$employee->role->name}} </td>
                                    <td>
                                        <a href="{{route('dashboard.employee',$employee->id)}}"><button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ __('dashboard::lang.tooltip-emp') }}">{{ __('dashboard::lang.details') }}</button></a>  
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
