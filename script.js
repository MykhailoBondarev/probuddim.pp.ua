$(document).ready(
function()
{ 

 var $page = $('html, body'); 
 var elementPos;

 $('.reviews-slider').slick({
    autoplay: true,
    autoplaySpeed: 3000,
    lazyLoad: 'ondemand',
    infinite: true,
    draggable: true
  });

$('a[href*="#"]').on('click',
	function () {
	$page.animate({
    scrollTop: $($.attr(this, 'href')).offset().top
    }, 400);
    $('a[href*="#"]').find('i').addClass('null-width');
    $(this).find('i').removeClass('null-width');    
    if ($('.close-menu').css('display')=='block')
    {
    	setTimeout(menuClose(),3000);    	
    }
    if ($(this).attr('href')=='#company')
    {    
    	$('#company').find('h3').removeAttr('animation-name');	
    	$('#company').find('h3').css('animation-name','dropDown');    	
    }
    if ($(this).attr('href')=='#services')
    {  
    	ServicesMove();  	
    }
    return false;
	})

$('.main-menu').on('click',
	function() 
	{
		$('.curtain').show();
		$('.close-menu').show();	
		$('.nav').find('.menu-list').show();
		$('.main-menu').hide();
	}
);
$('.close-menu').on('click',
	function() 
	{
		menuClose();
	}
);

function ServicesMove()
{
	$('#services h4').each(
	  function(i)
	   {
	       $(this).delay((i++) * 500).animate({ left : '0'}, 1000); 	         
	   })
	$('#services p').each(
	  function(i)
	   {
	      $(this).delay((i++) * 500).animate({ opacity : '1'}, 3000); 	         
	   })	  
}

function isScrolled()
{
	if ($(document).scrollTop() >= 50)
	{
		$('.nav').addClass('is-fixed');
		$('.page').addClass('padding-top');
	}
	else
	{
		$('.nav').removeClass('is-fixed');
		$('.page').removeClass('padding-top');	
	}	
};
$(document).scroll(
	function() 
	{		
	  isScrolled();	  
	  companyPos=$('#company').position();
	  servicesPos=$('#services').position();	
	  projectsPos=$('#projects').position(); 
	  reviewsPos=$('#reviews').position();
	  feedbackPos=$('#feedback').position();

	  if ($(document).scrollTop()>=companyPos.top && $(document).scrollTop()<servicesPos.top)
	  {	  	
    	$('a[href*="#"]').find('i').addClass('null-width');
    	$('a[href*="#company"]').find('i').removeClass('null-width');    	  	
	  }
	  if ($(document).scrollTop()>=servicesPos.top && $(document).scrollTop()<projectsPos.top)
	  {
	  	ServicesMove();
    	$('a[href*="#"]').find('i').addClass('null-width');
    	$('a[href*="#services"]').find('i').removeClass('null-width');    	  	
	  }
	  if ($(document).scrollTop()>=projectsPos.top && $(document).scrollTop()<reviewsPos.top)
	  {	  	
    	$('a[href*="#"]').find('i').addClass('null-width');
    	$('a[href*="#projects"]').find('i').removeClass('null-width');    	  	
	  }
	  if ($(document).scrollTop()>=reviewsPos.top && $(document).scrollTop()<feedbackPos.top)
	  {	  	
    	$('a[href*="#"]').find('i').addClass('null-width');
    	$('a[href*="#reviews"]').find('i').removeClass('null-width');    	  	
	  }
	  if ($(document).scrollTop()>=feedbackPos.top)
	  {	  	
    	$('a[href*="#"]').find('i').addClass('null-width');
    	$('a[href*="#feedback"]').find('i').removeClass('null-width');    	  	
	  }
	}
); 
$('.tel').mask('+38(099) 999-99-99');
});

function menuClose()
{	
	$('.close-menu').hide();
	$('.curtain').hide();	
	$('.nav').find('.menu-list').hide();
	$('.main-menu').show();		
}






