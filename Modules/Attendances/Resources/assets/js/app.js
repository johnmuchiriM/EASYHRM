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
                 
             ]
     });
     $(document).on('click','.start-btn',function(){
        axios({
            method  : 'GET',
            url : "{{route('attendance.employee.loggedin')}}",
        })
        .then((res)=>{
            console.log(res);
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
                         swal("{{ __('attendances::lang.logged-out') }}", {
                             icon: "success",
                         }); 
                         $('.append-stop-button').append('<i class="fa fa-play start-btn" style="font-size: 200px;color:white;margin-left: 29%;"aria-hidden="true"></i>');
                         $('.fa-stop').remove();
                         $(".big-card").css("background","#3ac47d");
                         loadtable.ajax.reload();
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
         var date = new Date();
         
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
