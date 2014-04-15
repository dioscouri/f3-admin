var CustomApp = function () {
    "use strict";
    
    var chartColors = ['#e5412d', '#f0ad4e', '#444', '#888','#555','#999','#bbb','#ccc','#eee'];
    
    return { init: init, chartColors: chartColors, initICheck: initICheck };
    
    function init() {
        initICheck();
        initSelect2();
        initDatepicker();
        initTimepicker();        
    }
    
    function initICheck () {
        if ($.fn.iCheck) {
            $('.icheck-input').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue',
                inheritClass: true
            }).on ('ifChanged', function (e) {
                $(e.currentTarget).trigger ('change');
            });
        }
    }
    
    function initSelect2 () {
        if ($.fn.select2) {
            $('.ui-select2').select2({ allowClear: true, placeholder: "Select..." });
            $('.ui-select2-data').each(function(){
                var el = $(this);
                var data = new Array;
                var multiple = el.attr('data-multiple');
                jQuery.merge( data, JSON.parse(el.attr('data-data')) );
                el.select2({ allowClear: true, placeholder: "Select...", data: data, multiple: multiple });
            });
            $('.ui-select2-tags').each(function(){
                var el = $(this);
                var tags_data = new Array;
                jQuery.merge( tags_data, JSON.parse(el.attr('data-tags')) );                

                el.select2({ allowClear: true, placeholder: "Select...", tokenSeparators: [",", ";"], tags: tags_data });
            });
        }
    }
    
    function initDatepicker () {
        if ($.fn.datepicker) { $('.ui-datepicker').datepicker ({ autoclose: true }); }
    }

    function initTimepicker () {
        if ($.fn.timepicker) { 
            var pickers = $('.ui-timepicker, .ui-timepicker-modal');

            pickers.each (function () {
                $(this).parent ('.input-group').addClass ('bootstrap-timepicker');

                if ($(this).is ('.ui-timepicker')) {
                    $(this).timepicker ();
                } else {
                    $(this).timepicker({ template: 'modal' });
                }   
            });     
        }
    }
    
}();

$(document).ready(function () {
    $(function () {
        CustomApp.init();
    });
    
});