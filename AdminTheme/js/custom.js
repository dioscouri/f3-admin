var CustomApp = function () {
    "use strict";
    
    var chartColors = ['#e5412d', '#f0ad4e', '#444', '#888','#555','#999','#bbb','#ccc','#eee'];
    
    return { init: init, chartColors: chartColors, initICheck: initICheck };
    
    function init() {
        initICheck();
        initSelect2();
        initDatepicker();
        initTimepicker();        
        setupCheckAll();
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
            $('.ui-select2').each(function(){
                var el = $(this);
                var multiple = el.attr('data-multiple');
                var maximumSelectionSize = el.attr('data-maximum');
                el.select2({ allowClear: true, placeholder: "Select...", multiple: multiple, maximumSelectionSize: maximumSelectionSize });
            });
            
            $('.ui-select2-data').each(function(){
                var el = $(this);
                var data = new Array;
                var multiple = el.attr('data-multiple');
                var maximumSelectionSize = el.attr('data-maximum');
                jQuery.merge( data, JSON.parse(el.attr('data-data')) );
                el.select2({ allowClear: true, placeholder: "Select...", data: data, multiple: multiple, maximumSelectionSize: maximumSelectionSize });
            });
            $('.ui-select2-tags').each(function(){
                var el = $(this);
                var tags_data = new Array;
                jQuery.merge( tags_data, JSON.parse(el.attr('data-tags')) );                
                var maximumSelectionSize = el.attr('data-maximum');
                
                el.select2({ allowClear: true, placeholder: "Select...", tokenSeparators: [",", ";"], tags: tags_data, maximumSelectionSize: maximumSelectionSize });
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
    
    function setupCheckAll() {

        $('th.checkbox-column').each(function(){
        	
        	$(this).on( 'ifToggled', ':checkbox', function(){
        		$this = $(this);
        		var  checked = $this.prop("checked");
        		
        		$( 'td.checkbox-column input.icheck-input', $this.closest( 'table' )  ).prop( 'checked', checked );
        		if( checked ) {
        			$( 'td.checkbox-column div.icheck-input', $this.closest( 'table' )  ).addClass( 'checked' );    			
        		} else {
        			$( 'td.checkbox-column div.icheck-input', $this.closest( 'table' )  ).removeClass( 'checked' );    			
        		}
        	});
        });	
    }    
}();

$(document).ready(function () {
    $(function () {
        CustomApp.init();
    });
    
});