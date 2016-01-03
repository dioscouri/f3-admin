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
        dropdownStaysOpenWithClick();
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
                var data = jQuery.extend({}, {
                	allowClear: true,
                	placeholder: "Select...", 
                	maximumSelectionSize: el.attr('data-maximum')
                }, el.data());
                el.select2(data);
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

        $('.icheck-toggle').each(function(){
        	
        	$(this).on( 'ifToggled', ':checkbox', function(){
        		$this = $(this);
        		var checked = $this.prop("checked");
        		var target = $this.attr( 'data-target' );
        		if (target) 
        		{
            		if( checked ) {
            			jQuery('.'+target).prop( 'checked', checked ).addClass( 'checked' );    			
            		} else {
            			jQuery('.'+target).prop( 'checked', checked ).removeClass( 'checked' );    			
            		}        			
        		}        		
        	});
        });	
    }
    
    function dropdownStaysOpenWithClick() {
    	
	    $(".dropdown-menu").on("click", "[data-stopPropagation]", function(e) {
	        e.stopPropagation();
	    });
    	
    }
}();

$(document).ready(function () {
	
	$('form[data-noprocess!="1"]').submit(function (e) {

		    $('#main').append('<div class="divMessageBox animated fadeIn fast" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="MessageBoxContainer animated fadeIn fast" id="Msg1"><div class="MessageBoxMiddle"><span class="MsgTitle">Processing... </span><br/><div id="progressbar" class="ui-progressbar ui-widget ui-widget-content ui-corner-all ui-progressbar-indeterminate" role="progressbar" aria-valuemin="0" width="100%"><div class="ui-progressbar-value ui-widget-header"><div class="ui-progressbar-overlay" style="width:100%; height:30px;"></div></div></div></div></div></div>');
		    $('#pleaseWaitDialog').modal('show');
	});
	
    $(function () {
        CustomApp.init();
    });
  //Javascript to enable link to tab
    var hash = document.location.hash;
    var prefix = "tab_";
    if (hash) {
        $('.nav-tabs a[href='+hash.replace(prefix,"")+']').tab('show');
    } 

    // Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash.replace("#", "#" + prefix);
    });
});

jQuery(window).load(function(){
    jQuery('#main').css({ minHeight: jQuery(document).outerHeight() + 100 });    
});

