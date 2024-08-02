@extends('admin.layouts.app')
@section('title',  __('attendances::lang.title'))
@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-lock icon-gradient bg-malibu-beach"> </i>
                </div>
                <div>
                    @include('admin.layouts.breadcumb')
                    <div>{{ __('attendances::lang.current-time') }} : <span class="digital-clock"></span> </div>
                </div>
            </div> 
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                </div>
            </div>    
        </div>
    </div>  
    <div class="row">
        <div class="col-md-12">
            @if($attendance)
                <div class="main-card card mx-auto mb-3 big-card" style="padding: 50px;
                width: 50%;
                border-radius: 17%;
                {{$attendance->is_logged_out == 0 && $attendance->logged_out == NULL ? 'background: #d92550;' : 'background: #3ac47d;' }}">
                    <a href="javascript:void(0)">
                        <div class="card-body">
                            <div class="append-stop-button"></div>
                            @if($attendance->is_logged_out == 0 && $attendance->logged_out == NULL)
                                <i class="fa fa-stop start-stop-btn"aria-hidden="true"></i>
                            @else
                                <i class="fa fa-play start-btn start-stop-btn" aria-hidden="true"></i>
                            @endif
                        </div>
                    </a>
                </div>  
                @else
                <div class="main-card card mx-auto mb-3 big-card" style="padding: 50px;
                width: 50%;
                border-radius: 17%;
                background: #3ac47d">
                    <a href="javascript:void(0)">
                        <div class="card-body">
                            <div class="append-stop-button"></div>
                            <i class="fa fa-play start-btn start-stop-btn" aria-hidden="true"></i>
                        </div>
                    </a>
                </div>     
            @endif
        </div>
    </div>          
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered datatables"  width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('attendances::lang.logged-in') }}</th>
                                    <th>{{ __('attendances::lang.logged-out') }}</th>
                                    <th>{{ __('attendances::lang.total-hours') }}</th>
                                    <th>{{ __('attendances::lang.working-hour') }}</th>
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
    $(function () {
        // load datatable on page load
         var loadtable = $('.datatables').DataTable({
             processing: true,
             serverSide: true,
             dataSrc :"",
                 ajax: "{{route('attendance.get')}}",
                 columns: [
                     {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                     {data: 'logged_in', name: 'logged_in'},
                     {data: 'logged_out', name: 'logged_out'},
                     {data: 'totalhours', name: 'totalhours'},
                     {data: 'working_hours', name: 'working_hours'},
                     
                 ]
         });
         $(document).on('click','.start-btn',function(){
            axios({
                method  : 'GET',
                url : "{{route('attendance.employee.loggedin')}}",
            })
            .then((res)=>{
                    if(res.data.is_logged_in == 1) {
                        swal("{{ __('attendances::lang.attendance-marked') }}", {
                                 icon: "warning",
                             }); 
                    } else {
                        $('.append-stop-button').append('<i class="fa fa-stop" style="font-size: 200px;color:white;margin-left: 29%;"aria-hidden="true"></i>');
                        $('.start-btn').remove();
                        $(".big-card").css("background","#d92550");
                        loadtable.ajax.reload();
                    }
                   
            })
            .catch((err) => {throw err});
         });

        // logged out script
         $(document).on('click','.fa-stop',function(){
             swal({
                 title: "{{ __('attendances::lang.are-you-sure-logged-out') }}",
                 text: "{{ __('attendances::lang.once-you-logged-out-not-login-again') }}",
                 icon: "warning",
                 buttons: true,
                 dangerMode: true,
                 })
                 .then((willDelete) => {
                 if (willDelete) {
                     var url = '{{ route("attendance.employee.loggedout") }}';
                     $.ajax({           
                         type:"get",
                         url: url,
                         success: function(data) {
                             console.log(data);
                             if(data == 0) {
                                 location.reload();
                            } else {
                                swal("{{ __('attendances::lang.logged-out') }}", {
                                 icon: "success",
                                }); 
                                $('.append-stop-button').append('<i class="fa fa-play start-btn" style="font-size: 200px;color:white;margin-left: 29%;"aria-hidden="true"></i>');
                                $('.fa-stop').remove();
                                $(".big-card").css("background","#3ac47d");
                                loadtable.ajax.reload();
                            }
                         },
                         error: function(data) {
                             swal("{{ __('attendances::lang.something-went-wrong') }}", {
                                 icon: "warning",
                             });
                         },
                     });
                 } else {
                     swal("{{ __('attendances::lang.keep-doing-work') }}");
                 }
             });
         });

         //code for digitial clock
         clockUpdate();
         setInterval(clockUpdate, 1000);
         function clockUpdate() {
            var customTimeZone = "{{getConfig('config_app_timestamp')}}";
            var dateObj = new Date;
            var date = new Date(dateObj.toLocaleString("en-US", {timeZone: customTimeZone}));
             
             function addZero(x) {
                 if (x < 10) {
                 return x = '0' + x;
                 } else {
                 return x;
                 }
             }

             function twentyFourHour(x) {
                 if (x > 24) {
                 return x = x - 24;
                 } else if (x == 0) {
                 return x = 24;
                 } else {
                 return x;
                 }
             }
             var h = addZero(twentyFourHour(date.getHours()));
             var m = addZero(date.getMinutes());
             var s = addZero(date.getSeconds());
             $('.digital-clock').text(h + ':' + m + ':' + s) 
         }
     });
 </script>
@endpush
@endsection 
