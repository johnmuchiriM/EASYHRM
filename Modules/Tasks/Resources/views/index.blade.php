@extends('admin.layouts.app')
@section('title', __('tasks::lang.title'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-wristwatch icon-gradient bg-deep-blue"> </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('tasks::lang.here-create-task') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{route('admin.completed.task')}}" title="{{ __('tasks::lang.role-based-completed-task') }}" class="btn create-modal mr-2 mb-2 btn-success btn-shadow">{{ __('tasks::lang.completed-task') }}</a>
                </div>
                 <div class="d-inline-block dropdown">
                    <a href="{{route('admin.task.create')}}" title="{{ __('tasks::lang.create-new-task') }}" class="btn create-modal mr-2 mb-2 btn-primary btn-shadow">{{ __('tasks::lang.create-task') }}</a>
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
                                    <th>{{ __('tasks::lang.username') }}</th>
                                    <th>{{ __('tasks::lang.task-name') }}</th>
                                    <th>{{ __('tasks::lang.project-name') }}</th>
                                    <th>{{ __('tasks::lang.task-status') }}</th>
                                    <th>{{ __('tasks::lang.duration') }}</th>
                                    <th>{{ __('tasks::lang.action') }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        // on delete click call swal
        $(document).on('click','.delete-task',function(){
            swal({
                title: "{{ __('global-lang.are-you-sure') }}",
                text: "{{ __('tasks::lang.not-recover') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    id = $(this).attr('id');
                    var url = '{{ route("admin.task.destroy", ":id") }}';
                    url = url.replace(':id',id);
                    $.ajax({           
                        type:"post",
                        url: url,
                        data: {'_token': "{{ csrf_token() }}"},
                        success: function(data) {
                            if(data == 0) {
                                swal("{{ __('tasks::lang.task-is-running') }}", {
                                    icon: "warning",
                                });
                            } else {
                                swal("{{ __('tasks::lang.task-deleted') }}", {
                                    icon: "success",
                                });
                            }
                           
                            location.reload();
                        },
                        error: function(data) {
                            swal("{{ __('global-lang.something-went-wrong') }}", {
                                icon: "warning",
                            });
                        },
                    });
                } else {
                    swal("{{ __('tasks::lang.task-not-deleted') }}");
                }
            });
        });

        $(function(){
            var loadtable = $('.datatables').DataTable({
                processing: true,
                serverSide: true,
                dataSrc: "",
                ajax: "{{route('admin.task.get')}}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    
                    {
                        data: 'username',
                        name: 'username'
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

            setInterval(function() {
                loadtable.ajax.reload();
            }, 5000);
        });
       
    </script>
@endpush
@endsection 

