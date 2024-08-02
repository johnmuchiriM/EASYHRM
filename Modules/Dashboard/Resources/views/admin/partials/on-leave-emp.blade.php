<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">{{__('dashboard::lang.emp-on-leave')}} </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered  table-hover" id="leave-datatable" width="100%" cellspacing="0">
                        <thead>
                            <tr class=" text-center">
                                <th>{{ __('employees::employee.employee-id') }}</th>
                                <th>{{ __('employees::employee.employee-name') }}</th>
                                <th>{{ __('dashboard::lang.reason') }}</th>
                                <th>{{ __('dashboard::lang.days') }}</th>
                                <th>{{ __('employees::employee.role') }}</th>
                                <th>{{ __('dashboard::lang.status') }}</th>
                            </tr>
                        </thead>
                        <tbody class=" text-center">
                            @foreach(empOnLeaves() as $key => $vacation)
                                @isset($vacation->user->id)
                                    <tr>
                                        <td class="text-muted text-center">{{ $vacation->user->id }}</td>
                                        <td>{{$vacation->user->name}}</td>
                                        <td>
                                            {{$vacation->reason}}</td>
                                        <td>{{$vacation->days}}</td>
                                        <td>
                                            {{$vacation->user->role->name ?? ''}}
                                        </td>
                                        <td>
                                            @if ($vacation->status=='P') 
                                                <button class="btn btn-warning btn-sm" value="{{ __('vacations::lang.p') }}">{{ __('vacations::lang.pending') }}</button>
                                            @elseif ($vacation->status=='A')
                                                <button class="btn btn-success btn-sm" value="{{ __('vacations::lang.a') }}">{{ __('vacations::lang.approved') }}</button>
                                            @else
                                                <button class="btn btn-danger btn-sm" value="{{ __('vacations::lang.r') }}">{{ __('vacations::lang.reject') }}</button>
                                        @endif
                                        </td>
                                    </tr>    
                                @endisset
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#leave-datatable').DataTable();
    </script>
@endpush