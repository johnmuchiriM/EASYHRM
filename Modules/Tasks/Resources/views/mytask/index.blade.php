@extends('admin.layouts.app')
@section('title', __('tasks::lang.title'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-hourglass icon-gradient bg-love-kiss"> </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('tasks::lang.here-you-can-see-task-list') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('task.completed.list')}}"
                        class="btn create-modal mr-2 mb-2 btn-success btn-shadow"></i>{{ __('tasks::lang.completed-task') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatables" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('tasks::lang.task-id') }}</th>
                                    <th>{{ __('tasks::lang.task-name') }}</th>
                                    <th>{{ __('tasks::lang.project-name') }}</th>
                                    <th>{{ __('tasks::lang.task-status') }}</th>
                                    <th>{{ __('tasks::lang.duration') }}{{ __('tasks::lang.in-hours') }}</th>
                                    <th>{{ __('tasks::lang.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
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
            dataSrc: "",
            ajax: "{{route('task.get')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'project-title',
                    name: 'project-title'
                },
                {
                    data: 'taskstatus',
                    name: 'taskstatus'
                },
                {
                    data: 'duration',
                    name: 'duration'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        //function to start task
        $(document).on('click', '.start-task', function () {
            let data = $(this).attr('id');
            axios({
                    method: 'GET',
                    url: "{{route('task.start')}}",
                    params: {
                        id: data
                    },
                })
                .then((res) => {
                    if (res.data.is_logged_in == 0) {
                        location.reload();
                    } else {
                        loadtable.ajax.reload();
                    }
                })
                .catch((err) => {
                    throw err
                });
        });

        //function to stop task
        $(document).on('click', '.stop-task', function () {
            let data = $(this).attr('id');
            axios({
                    method: 'GET',
                    url: "{{route('task.stop')}}",
                    params: {
                        id: data
                    },

                })
                .then((res) => {
                    loadtable.ajax.reload();
                })
                .catch((err) => {
                    throw err
                });
        });

        //function to move task to completed
        $(document).on('click', '.finish-task', function () {
            
        swal({
                title: "{{ __('tasks::lang.have-you-completed-your-task') }}",
                text: "{{ __('tasks::lang.you-can-not-work-move-to-finished') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var url = '{{ route("task.completed") }}';
                    var id  = $(this).attr('data-id');
                    $.ajax({
                        type: "post",
                        url: url,
                        data: {'_token': "{{ csrf_token() }}", 'id' : id},
                        success: function (data) {
                            console.log(data.is_logged_in);
                            if(data.is_logged_in == 0) {
                                location.reload()
                            }else{
                            swal("{{ __('tasks::lang.task-completed') }}", {
                                icon: "success",
                            });
                            loadtable.ajax.reload();
                            }
                        },
                        error: function (data) {
                            swal("{{ __('global-lang.something-went-wrong') }}", {
                                icon: "warning",
                            });
                        },
                    });
                } else {
                    swal("{{ __('tasks::lang.fix-the-bugs-and-comeback') }}");
                }
            });
        });
    });

</script>
@endpush
@endsection
