/*
 * --------------------------------------------------------------------
 * Simple Scroller
 * by Siddharth S, www.ssiddharth.com, hello@ssiddharth.com
 * Version: 1.0, 05.10.2009 	
 * --------------------------------------------------------------------
 */

$(document).ready(function() 
{	 
	var index = 0;
	var images = $("#foto img");
	var mini = $("#mini img");
	var imgHeight = $(mini).attr("height");
	$(mini).slice(0,3).clone().appendTo("#mini");
	for (i=0; i<mini.length; i++)
	{
		$(mini[i]).addClass("mini-"+i);
		$(images[i]).addClass("image-"+i);
	}
	
	$("#next").click(sift);
	show(index);
	setInterval(sift, 8000);
	
	function sift()
	{
		if (index<(mini.length-1)){index+=1 ; }
		else {index=0}
		show (index);
	}
	
	function show(num)
	{
		$(images).fadeOut(400);
		$(".image-"+num).stop().fadeIn(400);
		var scrollPos = (num+1)*imgHeight;
		$("#mini").stop().animate({scrollTop: scrollPos}, 400);		
		console.log(scrollPos, "img.image-"+num);
	}
});