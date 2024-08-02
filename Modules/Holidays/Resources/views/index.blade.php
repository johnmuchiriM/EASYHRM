@extends('admin.layouts.app')
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-phone icon-gradient bg-premium-dark">
                    </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div class="page-title-subheading">{{ __('holidays::lang.here-create-holiday') }}</div>
                </div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <button type="button" class="btn create-modal mr-2 mb-2 btn-primary btn-shadow" data-toggle="modal" data-target="#create-modal">
                        {{__('holidays::lang.create-holiday')}}
                    </button>
                </div>
            </div>    
        </div>
    </div>            
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>{{ __('holidays::lang.holiday-id') }}</th>
                                    <th>{{ __('holidays::lang.holiday-name') }}</th>
                                    <th>{{ __('holidays::lang.holiday-date') }}</th>
                                    <th>{{ __('holidays::lang.action') }} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($holiday)
                                    @foreach($holiday as $key => $holidays)
                                        <tr>
                                            <td>{{ $holidays->id }}</td>
                                            <td>{{ $holidays->name }}</td>
                                            <td>{{ formatDate($holidays->date) }}</td>
                                            <td>
                                                <a href="javascript:void(0)" id="{{$holidays->id}}" class="edit-holiday btn btn-primary">
                                                    <i class="fa fa-fw" aria-hidden="true" title="edit holiday"></i>
                                                </a>
                                                <a href="javascript:void(0)" id="{{$holidays->id}}" class="delete-holiday btn btn-danger">
                                                    <i class="fa fa-fw" aria-hidden="true" title="delete"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
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
        // on delete click call swal
        $(document).on('click','.delete-holiday',function(){
            swal({
                title: " {{__('global-lang.are-you-sure')}}",
                text: "{{ __('holidays::lang.holiday-not-recover') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    id = $(this).attr('id');
                    var url = '{{ route("holiday.delete", ":id") }}';
                    url = url.replace(':id',id);
                    $.ajax({           
                        type:"post",
                        url: url,
                        data: {'_token': "{{ csrf_token() }}"},
                        success: function(data) {
                            swal("{{ __('holidays::lang.holiday-deleted') }}", {
                                icon: "success",
                            });
                            location.reload();
                        },
                        error: function(data) {
                            swal(" {{__('global-lang.something-went-wrong')}}", {
                                icon: "warning",
                            });
                        },
                    });
                } else {
                    swal("{{ __('holidays::lang.holiday-not-deleted') }}");
                }
            });
        });
        
        // edit holiday modal code
        $(document).on('click','.edit-holiday',function(){
            id = $(this).attr('id');
            var url = '{{ route("holiday.edit", ":id") }}';
            url = url.replace(':id',id);           
            axios({
            method  : 'GET',
            url : url,
            })
            .then((res)=>{
                console.log(res.data.id);
                $('#name').val(res.data.name);
                $('#date').val(res.data.date);
                $('#holidayId').val(res.data.id);
                $("#create-modal").modal('show');
                $(".modal-title").html('Edit Holidays');
                $("#formSubmit").html('update holiday');

                   
                
            })
            .catch((err) => {throw err});
        });

        $(document).on('click','.close-modal',function(){
            location.reload();
        });
        var year = (new Date).getFullYear();
        $('.datetimepicker-create').datetimepicker({
            format:'YYYY-MM-DD',
            minDate: new Date(year, 0, 1),
            maxDate: new Date(year+1, 11, 31),
            icons: {
                date:'fa fa-calendar',
            },
        });
       
    </script>
@endpush
@endsection 
@include('holidays::component.modal')

