<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">{{__('dashboard::lang.attendance')}} {{date('F Y')}}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatables"  width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>{{__('dashboard::lang.hash-tag')}} </th>
                                    <th>{{ __('dashboard::lang.emp-id') }}</th>
                                    <th>{{ __('dashboard::lang.emp-name') }}</th>
                                    <th>{{ __('dashboard::lang.date') }}</th>
                                    <th>{{ __('dashboard::lang.login-time') }}</th>
                                    <th>{{ __('dashboard::lang.logout-time') }}</th>
                                    <th>{{ __('dashboard::lang.working-hour') }}</th>
                                    <th>{{ __('dashboard::lang.login-hours') }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function () {
        // load datatable on page load
         var loadtable = $('.datatables').DataTable({
             processing: true,
             serverSide: true,
             dataSrc :"",
                 ajax: "{{route('dashboard.attendance')}}",
                 columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'logged_in', name: 'logged_in'},
                    {data: 'logged_out', name: 'logged_out'},
                    {data: 'workingHour', name: 'workingHour'},
                    {data: 'totalhours', name: 'totalhours'},
                 ]
                });
            });
</script>
@endpush
