$(document).ready(
function()
{	
	console.log(location.href);
	if ( location.href == 'http://pbd.ua/?send-email=1' ) {
		setTimeout (
			function() {
				location.href = 'http://pbd.ua';			
			}, 5000
		);
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
			$(this).css('color','black');
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