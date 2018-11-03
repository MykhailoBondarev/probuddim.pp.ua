$(document).ready(
function()
{	
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
	$('.showmepass').on({
		mousedown: function() {
			$(this).next('.new-password').attr('type','text');
		},
		mouseup: function() {
			$(this).next('.new-password').attr('type','password');
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