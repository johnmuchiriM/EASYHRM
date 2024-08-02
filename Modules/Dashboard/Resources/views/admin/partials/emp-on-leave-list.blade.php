<div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">{{__('dashboard::lang.all-emp')}}
                </div>
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th>{{ __('employees::employee.employee-id') }}</th>
                            <th>{{ __('employees::employee.employee-name') }}</th>
                            <th>{{ __('employees::employee.role') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(getAllEmp() as $key => $employee)
                        <tr>
                            <td class="text-muted">{{__('dashboard::lang.hash-tag')}}{{ $employee->id }}</td>
                            <td>{{$employee->name}}</td>
                            <td> {{$employee->role->name}} </td>
                            <td class="text-center">
                                <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Details</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
   