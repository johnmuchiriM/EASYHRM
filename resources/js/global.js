$(function () {
    setTimeout(function () {
        $('.toast-top-right').fadeOut('fast');
    }, 30000); // <-- time in milliseconds

    $(document).on('click', '.close-modal', function () {
        location.reload();
    });
    // Call the dataTables jQuery plugin
    $('#dataTable').DataTable({
        responsive: true,
    });

    // Call the datetimepicker plugin
    var year = (new Date).getFullYear();
    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD',
        minDate: new Date(year, 0, 1),
        maxDate: new Date(year + 1, 11, 31),
    });
    //adding datetimepicker for DOB
    $('.dobpicker').datetimepicker({
        format: 'YYYY-MM-DD',
    });


    //tinymce editor
    if ($("#elm1").length > 0) {
        tinymce.init({
            selector: "textarea#elm1",
            content_style: ".mce-content-body {font-size:20px;font-family:Arial,sans-serif;}",
            theme: "modern",
            height: 200,
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons|sizeselect | bold italic | fontselect |  fontsizeselect",
            fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
            style_formats: [{
                    title: 'Bold text',
                    inline: 'b'
                },
                {
                    title: 'Red text',
                    inline: 'span',
                    styles: {
                        color: '#ff0000'
                    }
                },
                {
                    title: 'Red header',
                    block: 'h1',
                    styles: {
                        color: '#ff0000'
                    }
                },
                {
                    title: 'Example 1',
                    inline: 'span',
                    classes: 'example1'
                },
                {
                    title: 'Example 2',
                    inline: 'span',
                    classes: 'example2'
                },
                {
                    title: 'Table styles'
                },
                {
                    title: 'Table row 1',
                    selector: 'tr',
                    classes: 'tablerow1'
                }
            ]
        });
    }
});
//one click open close sidebar
$(document).on('click', '.hamburger--elastic', function () {
    $(this).toggleClass('is-active')
    $('.fixed-sidebar').toggleClass('closed-sidebar').toggleClass('sidebar-mobile-open');
});

$(document).on('click', '.mobile-toggle-header-nav', function () {
    $('.app-header__content').toggleClass('header-mobile-open');
});

//theme's js
$(function () {
    $('.switch-sidebar-cs-class').click(function () {
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        var clickedVal = $(this).attr('data-class');
        $("#config_color_scheme_class").val(clickedVal);
        //header color scheme
        var exisitingHeaderClass = $("#main-header").attr('class').split(' ').pop();
        $("#main-header").removeClass(exisitingHeaderClass).addClass(clickedVal);
        //sidebar color scheme
        var exisitingSidebarClass = $("#main-sidebar").attr('class').split(' ').pop();
        $("#main-sidebar").removeClass(exisitingSidebarClass).addClass(clickedVal);
    })
});

//footer fixed js
$(function () {
    //fixed footer
    $(document).on('change', '#config_is_footer_fixed', function () {
        if ($('#config_is_footer_fixed').is(":checked")) {
            $(".app-container").addClass('fixed-footer');
        } else {
            $(".app-container").removeClass('fixed-footer');
        }
    });

    //fixed sidebar
    $(document).on('change', '#config_is_sidebar_fixed', function () {
        if ($('#config_is_sidebar_fixed').is(":checked")) {
            $(".app-container").addClass('fixed-sidebar');
        } else {
            $(".app-container").removeClass('fixed-sidebar');
        }
    });

    //fixed header
    $(document).on('change', '#config_is_header_fixed', function () {
        if ($('#config_is_header_fixed').is(":checked")) {
            $(".app-container").addClass('fixed-header');
        } else {
            $(".app-container").removeClass('fixed-header');
        }
    });
});


//toot-tip
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});

//select2
$(function () {
    $('.select2-single').select2();
});

//function to clone employeement history
$(document).on('click', '.add-more', function () {
    var $tr = $(this).closest('.tr_clone');
    var $clone = $tr.clone();
    $clone.find('.copy-row').val('');
    $tr.after($clone);
    $('.dobpicker').datetimepicker({
        format: 'YYYY-MM-DD',
    });
});

//function to remove clone element
$("body").on("click", ".remove", function () {
    $(this).parents(".after-add-more").remove();
});

//Js for password confirmation
$('#password, #password_confirmation').on('keyup', function () {
    if ($('#password').val() == $('#password_confirmation').val()) {
        $('#message').html('Matched').css('color', 'green');
    } else
        $('#message').html('Not Matched').css('color', 'red');
});

//employee salary calculation
$(document).ready(function(){
    $( ".gross-salary" ).click(function() {
        var calculated_total_earning = 0;
        $("#employeeEarning .txtCal").each(function () {
            var get_textbox_earning_value = $(this).val();
            if ($.isNumeric(get_textbox_earning_value)) {
                calculated_total_earning += parseFloat(get_textbox_earning_value);
            }
        });
        var calculated_total_deduction = 0;
        $("#employeeDeduction .txtCal").each(function () {
            var get_textbox_deduction_value = $(this).val();
            if ($.isNumeric(get_textbox_deduction_value)) {
                calculated_total_deduction += parseFloat(get_textbox_deduction_value);
            }
        });

        $(".total-salary").removeClass("d-none");
        var grossSal = (calculated_total_earning -calculated_total_deduction);
        $('#gross-salary').val(grossSal);
    });
});