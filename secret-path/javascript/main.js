$(document).ready(
function()
{	

	$('.btn-admin-menu').on('click',
		function() 
		{	
			$('.admin-curtain').show();		
			$('.close-menu').show();	
			$('.admin-menu').show();			
			// $('.nav').css('height','55px');
		}
	);
	$('.close-menu').on('click',
		function() 
		{
			$('.admin-curtain').hide();
			$('.close-menu').hide();	
			$('.admin-menu').hide();	
		}
	);
	var menuLinks = $('.menu-item');
	var menuItems = $('.menu-item').find('m');
	var fullLink = location.href;
	var startPos;
	var lastPos;
	var linkParam;
	var siteUrl;
	var successMsg = $('.send-success');
	for (var i = 0; i <= fullLink.length; i++) {
		startPos = fullLink.indexOf('?');		
		lastPos = fullLink.length;
	}
	linkParam = fullLink.substr(startPos,lastPos);
	siteUrl = fullLink.substr(0,startPos);
	if (linkParam!='') {
		for (var i = 0; i <= menuLinks.length; i++) {	
			if ($(menuLinks[i]).attr('href') == linkParam) {			
				$(menuItems[i]).addClass('active');				
			} else {
				$(menuItems[i]).removeClass('active');
			}
		}
		if ( linkParam == '?sendmail=1' ) {
			$('.success-curtain').show();
			$(successMsg).show();
			setTimeout (
				function() {
					location.replace('.');			
				}, 2000
			);
		}
	}	

	$('button.new-pass').on('click',
		function()
		{
			$(this).hide();
			$(this).parent().children('form.new-pass-form').show();
		}
	);

	$('.new-pass-form').find('button').on('click',
		function()
		{			
			$('form.new-pass-form').hide();
			$('button.new-pass').show();
			// $(this).closest('form').siblings('button.new-pass').show();
		}
	);
	$('.password-box').before().on({
		mousedown: function() {	
			$(this).css('color','red');		
			$(this).children('.secret').attr('type','text');
		},
		mouseup: function() {
			$(this).css('color','#4f96f2');
			$(this).children('.secret').attr('type','password');
		}
	});
	$('.delete-user-btn').on('click',
		function()
		{
			$(this).parent().next('.deleteuser-bg').show();
		}		
	);
	$('.deleteuser-window').find('button').on('click',
		function()
		{
			$('.deleteuser-bg').hide();
		}		
	);
});