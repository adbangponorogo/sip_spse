/*
Document: app-custom.js
Author: Rustheme
Description: Write your custom code here
*/

/* --------------------------------------------
* Below is an example of function and its initialization
-------------------------------------------- */
var AppCustom = function() {
	var showAppName = function() {
		console.log( 'SIP SPSE! - Aplikasi E-Reporting Kabupaten Ponorogo' );
	};

	return {
		init: function() {
			showAppName();
		}
	}
}();

/* --------------------------------------------
* Initialize AppCustom when page loads
-------------------------------------------- */
jQuery( function() {
	AppCustom.init();
});

$(function(){
// Init page helpers (Slick Slider plugin)
App.initHelpers('slick');
App.initHelpers('notify');
});


/* --------------------------------------------
* Window Preload
-------------------------------------------- */
windowLoad();
function windowLoad(){
	var preload = "<div class='loader'><img src='../assets/uploads/logo/reload-kincir.gif'></div>";
	jQuery('body').prepend(preload);
	jQuery(window).on("load", function(){
		jQuery(".loader").fadeOut("slow", function(){
			jQuery(this).remove();
		});
	});
}

jQuery(document).ajaxStart(function(){
	var preload = "<div class='loader'><img src='../assets/uploads/logo/reload-kincir.gif'></div>";
	jQuery('body').prepend(preload);
});
jQuery(document).ajaxComplete(function(){
	jQuery(".loader").fadeOut("slow", function(){
		jQuery(this).remove();
	});
});
jQuery(".app-content").load("../dashboard/page/main");


/* --------------------------------------------
* DataTables Button Setup
-------------------------------------------- */
jQuery(".buttons-copy").removeClass(".btn-default");
jQuery(".buttons-copy").addClass(".btn-success");
jQuery(".buttons-csv").removeClass(".btn-default");
jQuery(".buttons-csv").addClass(".btn-success");
jQuery(".buttons-excel").removeClass(".btn-default");
jQuery(".buttons-excel").addClass(".btn-success");
jQuery(".buttons-pdf").removeClass(".btn-default");
jQuery(".buttons-pdf").addClass(".btn-success");
jQuery(".buttons-print").removeClass(".btn-default");
jQuery(".buttons-print").addClass(".btn-success");


