<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>{{config('app.name','Content Management System')}} - @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
        <link rel="apple-touch-icon" href="{{asset('pages/ico/60.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('pages/ico/76.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('pages/ico/120.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('pages/ico/152.png')}}">
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">

        <meta name="base-url" content="{{ asset('/') }}">

        <link href="{{asset('plugins/pace/pace-theme-flash.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/jquery-scrollbar/jquery.scrollbar.css')}}" rel="stylesheet" type="text/css" media="screen" />
        <link href="{{asset('plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" media="screen" />
        <link href="{{asset('plugins/switchery/css/switchery.min.css')}}" rel="stylesheet" type="text/css" media="screen" />
        <link href="{{asset('plugins/mapplic/css/mapplic.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/bootstrap-datepicker/css/datepicker3.css')}}" rel="stylesheet" type="text/css" media="screen">
        <link href="{{asset('plugins/bootstrap-daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" media="screen">
        <link href="{{asset('plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('plugins/datatables-responsive/css/datatables.responsive.css')}}" rel="stylesheet" type="text/css" media="screen" />
        <link href="{{asset('pages/css/pages-icons.css')}}" rel="stylesheet" type="text/css">
        <link class="main-stylesheet" href="{{asset('pages/css/themes/modern.css')}}" rel="stylesheet" type="text/css" />
        <link class="main-stylesheet" href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{asset('css/jquery-confirm.css')}}">
        <link rel="stylesheet" href="{{ asset('validate-password/css/jquery.passwordRequirements.css') }}" />
        <link href="{{asset("plugins/bootstrap4-glyphicons/css/bootstrap-glyphicons.css")}}" rel="stylesheet" />
        {{-- inline Edit --}}
        <link rel="stylesheet" href="{{asset('plugins/bootstrap3-editable/css/bootstrap-editable.css')}}">

        <link rel="stylesheet" href="{{asset('intl-tel/build/css/intlTelInput.css')}}">
        <link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">
        <script src="{{asset('js/jquery.js')}}"></script>
        <script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script> 
        <script src="{{asset('ckeditor/ckeditor.js')}}"></script> 
        <script src="{{asset('ckeditor/config.js')}}"></script> 
        <!--<script src="{{asset('js/sorttable.js')}}"></script>--> 

        <style>
            .bg-red{
                background-color: rgb(255, 82, 111) !important;

            }
        </style>
        <style>
            @media only screen and (max-width: 800px) {
                .draggable-icon{
                    display: none !important;
                }
                /* Force table to not be like tables anymore */
                #no-more-tables table, 
                #no-more-tables thead, 
                #no-more-tables tbody, 
                #no-more-tables tfoot, 
                #no-more-tables th, 
                #no-more-tables td, 
                #no-more-tables tr { 
                    display: block; 
                }

                /* Hide table headers (but not display: none;, for accessibility) */
                #no-more-tables thead tr { 
                    position: absolute;
                    top: -9999px;
                    left: -9999px;
                }

                #no-more-tables tr { border: 1px solid #ccc; }

                #no-more-tables input select{
                    border:1px solid #ccc !important;
                }
                #no-more-tables td { 
                    /* Behave  like a "row" */
                    border: none !important;
                    border-bottom: 1px solid #eee !important; 
                    position: relative !important;
                    padding-left: 50% !important; 
                    white-space: normal !important;
                    text-align:left !important;
                }

                #no-more-tables td:before { 
                    /* Now like a table header */
                    position: absolute;
                    /* Top/left values mimic padding */
                    top: 6px;
                    left: 6px;
                    width: 45%; 
                    padding-right: 10px; 
                    white-space: nowrap;
                    text-align:left;
                    font-weight: bold;
                }

                /*
                Label the data
                */
                #no-more-tables td:before { content: attr(data-title); }
            }
            .no-sorting img{
                display: none !important;
            }
            .suggestion-list{
                position: absolute;
                background-color: #fff;
                list-style-type: none;
                padding: 0;
                box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);
                width: 100%;
                z-index: 111;
                max-height: 200px;
                overflow: auto
            }
            .suggested-item, .suggested-job-item{
                padding: 5px 5px;
                cursor: pointer;

            }
            .display_box_hover, .suggested-item:hover, .suggested-job-item:hover{
                background-color: #e8e9ea !important;
            }
            td input.qty-field, td input.qty-ord{
                text-align: center;
            }
            td input.quoted-field{
                text-align: right;
            }
            .form-control::placeholder {
                font-size: 14px;
            }
            form .row [class*="col-"]:first-child {
                padding-left: 7px !important;
            }
            /*#no-more-tables:before{
                content: url('{{asset("img/loading.gif")}}');
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                background-color: rgb(0,0,0,0.2);
                z-index: 111;
                height: 100%;
                
            }
            #no-more-tables{
                position: relative;
            }*/
            th span{
                float:right; 
            }
            th{
                cursor: pointer;
            }
            th:hover{
                outline: 1px solid #ccc;
            }
            .active-span-bg {
                background: #31ce36 !important;
            }

            .disabled-span-bg {
                background: #f25961 !important;
            }
            .span-status {
                padding: 4px 6px;
                border-radius: 4px;
                color: #FFF;
                /*    width: 70px !important;
                    display: block;*/

            }
            span.required{
                color: red;
                font-size: 16px !important;
            }
            .card-title{
                font-weight: bold !important;
                font-size: 14px !important;
            }
            ul.pagination{
                justify-content: end;
            }
        </style>
        <script>
$(function () {
    setAutoComplete();
});
$(document).ajaxStop(function () {
    $('input').attr('autocomplete', 'off');
});
function setAutoComplete() {
    $('input').attr('autocomplete', 'off');
}
        </script>
    </head>
    <body class="horizontal-menu horizontal-app-menu">
        {{View::make('header')}}
        @yield('content')
        {{View::make('footer')}}
        <!-- BEGIN VENDOR JS -->    
        <script src="{{asset('plugins/pace/pace.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/modernizr.custom.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/popper/umd/popper.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/jquery/jquery-easy.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/jquery-unveil/jquery.unveil.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/jquery-ios-list/jquery.ioslist.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/jquery-actual/jquery.actual.min.js')}}"></script>
        <script src="{{asset('plugins/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('plugins/classie/classie.js')}}"></script>
        <script src="{{asset('plugins/switchery/js/switchery.min.js')}}" type="text/javascript"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp" type="text/javascript"></script>
        <script src="{{asset('plugins/mapplic/js/hammer.min.js')}}"></script>
        <script src="{{asset('plugins/mapplic/js/jquery.mousewheel.js')}}"></script>
        <script src="{{asset('plugins/mapplic/js/mapplic.js')}}"></script>
        <script src="{{asset('plugins/jquery-metrojs/MetroJs.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/jquery-sparkline/jquery.sparkline.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/skycons/skycons.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
        <script src="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
        <script src="{{asset('plugins/jquery-datatable/media/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/jquery-datatable/media/js/dataTables.bootstrap.js')}}" type="text/javascript"></script>
        <script src="{{asset('plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js')}}" type="text/javascript"></script>
        <script type="text/javascript" src="{{asset('plugins/datatables-responsive/js/datatables.responsive.js')}}"></script>
        <script type="text/javascript" src="{{asset('plugins/datatables-responsive/js/lodash.min.js')}}"></script>
        <!-- END VENDOR JS -->
        <!-- BEGIN CORE TEMPLATE JS -->
        <script src="{{asset('pages/js/pages.min.js')}}"></script>
        <script src="{{asset('js/jquery.toaster.js')}}"></script>
        <!-- END CORE TEMPLATE JS -->
        <!-- BEGIN PAGE LEVEL JS -->
        <script src="{{asset('js/scripts.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/jquery-confirm.js')}}"></script>
        <script src="{{asset('plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
        <!--<script src="{{asset('js/form_elements.js')}}" type="text/javascript"></script>-->
        <!-- END PAGE LEVEL JS -->
        <script src="{{ asset('validate-password/js/jquery.passwordRequirements.js') }}"></script>
        <script src="{{ asset('intl-tel/build/js/intlTelInput.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

        <script src="{{asset('plugins/bootstrap3-editable/js/bootstrap-editable.min.js')}}"></script>

        <script>
$(document).ready(function () {
    // Basic
    $('.dropify').dropify();
//                CKEDITOR.replace('section'); 
    CKEDITOR.replace('section', {
        filebrowserUploadUrl: "{{route('admin.ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
});

//    var arrows = document.getElementById()(".");
//var i=0;
function callIntlTel() {
    $('.phone-field').each(function () {
        intlTelInput(this, {
            //            autoPlaceholder: "off",
            //            hiddenInput: "full_number_"+i,
            onlyCountries: ['ca'],
            utilsScript: "{{ asset('intl-tel/build/js/utils.js') }}",
        });
        //          i++;
    });
}
$(document).ready(function () {
    callIntlTel();
    $('#date_of_birth').datepicker({
        autoclose: true
    });
    $(".pr-password").passwordRequirements();
});

function deleteConfirm(formId, message) {
    $.confirm({
        theme: 'bootstrap',
        title: 'Confirm!',
        content: message,
        buttons: {
            Confirm: function () {
                $("#" + formId).submit();
            },
            Cancel: function () {

            }
        }
    });
}
function toggleSection(className, btnId) {
    $("." + className).toggle();
    $("#" + btnId).find('i').toggleClass(' fa-minus');
    $("." + className).find('input:not("[name=' + className + ']")').val('');
    $("." + className).find('textarea').val('');
    $("." + className).find('input[type=checkbox]').prop('checked', false);
    $("." + className).find('select').val(null).trigger('change');
    if ($('input[name=' + className + ']').attr('value') == "") {
        $('input[name=' + className + ']').val(1);
    } else {
        $('input[name=' + className + ']').attr('value', '');
    }
}
function removeSection(sectionId) {
    $("#" + sectionId).remove();
}
function addMore(cloneSection, cloneTo) {
    var countCloneSection = parseInt($('.' + cloneSection).last().attr('id').match(/\d+/)) + 1;
    $('#' + cloneTo + '_1').find('select').select2("destroy");
    $('#' + cloneTo + '_1').clone().attr('id', cloneTo + '_' + countCloneSection).appendTo("." + cloneTo + " .append-section");

    $('#' + cloneTo + '_' + countCloneSection).find('input').val('');
    $('#' + cloneTo + '_' + countCloneSection).find('input').each(function (index, data) {
        $('#' + cloneTo + '_' + countCloneSection + " label[for=" + data.id + "]").attr('for', data.id + "_" + countCloneSection);
        $('#' + cloneTo + '_' + countCloneSection + " #" + data.id).attr('id', data.id + "_" + countCloneSection);
    });
    $('#' + cloneTo + '_' + countCloneSection).find('select').val('');
    $('#' + cloneTo + '_' + countCloneSection).find('select').select2();
    $('#' + cloneTo + '_' + countCloneSection).find('select').each(function (index, data) {
        $('#' + cloneTo + '_' + countCloneSection + " label[for=" + data.id + "]").attr('for', data.id + "_" + countCloneSection);
        $('#' + cloneTo + '_' + countCloneSection + " #" + data.id).attr('id', data.id + "_" + countCloneSection);
    });
    $('#' + cloneTo + '_' + countCloneSection).find('textarea').val('');
    $('#' + cloneTo + '_' + countCloneSection).find('textarea').each(function (index, data) {
        $('#' + cloneTo + '_' + countCloneSection + " label[for=" + data.id + "]").attr('for', data.id + "_" + countCloneSection);
        $('#' + cloneTo + '_' + countCloneSection + " #" + data.id).attr('id', data.id + "_" + countCloneSection);
    });
    $('#' + cloneTo + '_' + countCloneSection).find('input[type=checkbox]').prop('checked', false);
    $('#' + cloneTo + '_' + countCloneSection).find('input[type=checkbox]').each(function (index, data) {
        $('#' + cloneTo + '_' + countCloneSection + " label[for=" + data.id + "]").attr('for', data.id + "_" + countCloneSection);
        $('#' + cloneTo + '_' + countCloneSection + " #" + data.id).attr('id', data.id + "_" + countCloneSection);
    });
    $('#' + cloneTo + '_1').find('select').select2();
    $("#" + cloneTo + '_' + countCloneSection).append('<button type="button" class="btn btn-small btn-danger float-right m-b-10" onClick="removeSection(\'' + cloneTo + '_' + countCloneSection + '\')"><i class="fa fa-trash"></i></button><div class="clearfix"></div>');
    $("#" + cloneTo + '_' + countCloneSection + " .invalid-feedback").text('');
    $("#" + cloneTo + '_' + countCloneSection + " .error").text('');
}

$('form').submit(function () {
    $(window).off('beforeunload');
});

$('input').not("#searchform input").change(function () {

    console.log($(this).hasClass('not-check'));
    if ($(this).hasClass('not-check')) {
        return 0;
    }
    $(window).on('beforeunload', function () {
        var c = confirm();
        if (c) {
            return true;
        } else {
            return false;
        }
    });
});
$('select').not("#searchform select").change(function () {
    if ($(this).hasClass('not-check')) {
        return 0;
    }
    $(window).on('beforeunload', function () {
        var c = confirm();
        if (c) {
            return true;
        } else {
            return false;
        }
    });
});
$.fn.capitalize = function () {

    //iterate through each of the elements passed in, `$.each()` is faster than `.each()
    $.each(this, function () {

        //split the value of this input by the spaces
        var split = this.value.split(' ');

        //iterate through each of the "words" and capitalize them
        for (var i = 0, len = split.length; i < len; i++) {
            split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);
        }

        //re-join the string and set the value of the element
        this.value = split.join(' ');
    });
    return this;
};
$('input[name="first_name"], input[name="last_name"], input[name="name"], input[name="title"]').on('keyup', function () {
    $(this).capitalize();
}).capitalize();//also capitalize the `textarea` element(s) on initialization

// inline Edit
$.fn.editable.defaults.mode = 'inline';
$(document).ready(function () {
    $('.inline-edit').editable({
        combodate: {
            minYear: 2015,
            maxYear: 2045,
            minuteStep: 1
        },
        params: function (params) {
            params.model = $(this).editable().data('model');
            params._token = "{{csrf_token()}}";
            return params;
        },
        success: function (response, newValue) {
            // notif({
            // 	msg: "<i class='fas fa-check-circle'></i> Updated Successfully",
            // 	type: "success"
            // });
            //if(response['success']) return response['msg'];
        },
        error: function (response, newValue) {
            // notif({
            // 	msg: "<b>Whoops! Something went Wrong</b> ",
            // 	type: "error"
            // });
        }
    });
});




$(document).ready(function () {
    window.displayBoxIndex = -1;
    var Navigate = function (diff) {
        displayBoxIndex += diff;
        var oBoxCollection = $(".suggestion-list li");
        if (displayBoxIndex >= oBoxCollection.length) {
            displayBoxIndex = 0;
        }
        if (displayBoxIndex < 0) {
            displayBoxIndex = oBoxCollection.length - 1;
        }
        var cssClass = "display_box_hover";
        oBoxCollection.removeClass(cssClass).eq(displayBoxIndex).addClass(cssClass);
    }
    $(document).on('keypress keyup', 'form:not(#searchform)', function (e) {
        if (e.keyCode == 13) {
            $('.display_box_hover').trigger('click');
            return false;
        }
        if (e.keyCode == 40) {
            //down arrow
            Navigate(1);
        }
        if (e.keyCode == 38) {
            //up arrow
            Navigate(-1);
        }
    });
});
$(document).on('keydown', '.decimal, .decimal-with-negative', function (event) {
    if (event.shiftKey == true) {
        /*
         * Commented because it gives issue with tabbing functionality in purchase Order
         */
//                    event.preventDefault();
    }
    var checkClass = $(this).hasClass('decimal-with-negative');

//                alert(event.keyCode);
    if ((event.keyCode >= 48 && event.keyCode <= 57) ||
            (event.keyCode >= 96 && event.keyCode <= 105) ||
            event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 16 || event.keyCode == 37 ||
            event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190 || event.keyCode == 110
            ) {

    } else {
        /*
         * Allow Negative Number
         */
        if (checkClass && (event.keyCode == 173 || event.keyCode == 109 || event.keyCode == 189)) {

        } else {
            event.preventDefault();
        }
    }


    if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190) {
        event.preventDefault();
    }
});

$(document).on('keydown', '#item-details input', function (e) {
    if (e.keyCode == 9) {
        if (e.shiftKey) {
            var $canfocus = $(':focusable');
            var index = $canfocus.index(this) - 1;
            if (index >= $canfocus.length)
                index = 0;
            $canfocus.eq(index).focus();
            e.preventDefault();
            //Focus previous input
        } else {
            //Focus next input
        }
    }

});
$(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
    $(this).closest(".select2-container").siblings('select:enabled').select2('open');
});

// steal focus during close - only capture once and stop propogation
$('select.select2').on('select2:closing', function (e) {
    $(e.target).data("select2").$selection.one('focus focusin', function (e) {
        e.stopPropagation();
    });
});

(function ($) {
    $.fn.countTo = function (options) {
        options = options || {};

        return $(this).each(function () {
            // set options for current element
            var settings = $.extend({}, $.fn.countTo.defaults, {
                from: $(this).data('from'),
                to: $(this).data('to'),
                speed: $(this).data('speed'),
                refreshInterval: $(this).data('refresh-interval'),
                decimals: $(this).data('decimals')
            }, options);

            // how many times to update the value, and how much to increment the value on each update
            var loops = Math.ceil(settings.speed / settings.refreshInterval),
                    increment = (settings.to - settings.from) / loops;

            // references & variables that will change with each update
            var self = this,
                    $self = $(this),
                    loopCount = 0,
                    value = settings.from,
                    data = $self.data('countTo') || {};

            $self.data('countTo', data);

            // if an existing interval can be found, clear it first
            if (data.interval) {
                clearInterval(data.interval);
            }
            data.interval = setInterval(updateTimer, settings.refreshInterval);

            // initialize the element with the starting value
            render(value);

            function updateTimer() {
                value += increment;
                loopCount++;

                render(value);

                if (typeof (settings.onUpdate) == 'function') {
                    settings.onUpdate.call(self, value);
                }

                if (loopCount >= loops) {
                    // remove the interval
                    $self.removeData('countTo');
                    clearInterval(data.interval);
                    value = settings.to;

                    if (typeof (settings.onComplete) == 'function') {
                        settings.onComplete.call(self, value);
                    }
                }
            }

            function render(value) {
                var formattedValue = settings.formatter.call(self, value, settings);
                $self.html(formattedValue);
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0, // the number the element should start at
        to: 0, // the number the element should end at
        speed: 1000, // how long it should take to count between the target numbers
        refreshInterval: 100, // how often the element should be updated
        decimals: 0, // the number of decimal places to show
        formatter: formatter, // handler for formatting the value before rendering
        onUpdate: null, // callback method for every time the element is updated
        onComplete: null       // callback method for when the element finishes updating
    };

    function formatter(value, settings) {
        return value.toFixed(settings.decimals);
    }
}(jQuery));

jQuery(function ($) {
    // custom formatting example
    $('.count-number').data('countToOptions', {
        formatter: function (value, options) {
            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
        }
    });

    // start all the timers
    $('.timer').each(count);

    function count(options) {
        var $this = $(this);
        options = $.extend({}, options || {}, $this.data('countToOptions') || {});
        $this.countTo(options);
    }
});

$(document).ready(function () {

    $('.counter-top').addClass('animated');

});


// datatables

$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#example thead');

    var table = $('#example').DataTable({
        "order": [[4, "desc"]],
        orderCellsTop: true,

        //searching: false,
        //lengthChange: true,
        initComplete: function () {
            var api = this.api();

            // For each column
            api
                    .columns()
                    .eq(0)
                    .each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                                );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');

                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('keyup change', function (e) {
                                    e.stopPropagation();

                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                            .column(colIdx)
                                            .search(
                                                    this.value != ''
                                                    ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                    : '',
                                                    this.value != '',
                                                    this.value == ''
                                                    )
                                            .draw();

                                    $(this)
                                            .focus()[0]
                                            .setSelectionRange(cursorPosition, cursorPosition);
                                });
                    });
        },
    });
});
function toggleSearch(sectionId, animate) {
    $("#" + sectionId).slideToggle('top');
    $(".toggler i").toggleClass('fa-chevron-down');
    $(".toggler i").toggleClass('fa-chevron-up');
    if (animate != 0) {
        $('html, body').animate({
            scrollTop: $("#" + sectionId).offset().top
        }, 2000);
    }
}
function resetForm(formId) {
//        location.load();
    window.location.href = window.location.pathname + window.location.search + window.location.hash;
    $("#" + formId)[0].reset;
    $("#" + formId).find('select').val('');
    $("#" + formId).find('select').select2();
}
$('.datepicker').datepicker({
    autoclose: true
});
$(".phonemask").mask("(999) 999-9999");
        </script>


        @yield('script')

    </body>	
</html>
