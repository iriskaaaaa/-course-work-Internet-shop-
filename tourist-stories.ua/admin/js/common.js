$(document).ready(function() {

	function fullHeight(){
		var winHeight = $(window).height();
		$('.start_s').height(winHeight);
	};
	fullHeight();
	$(window).resize(function(){
		fullHeight();
	});
    
    
	$('#like').click(function(){
          
 var sid = $(this).attr("sid");
 
 $.ajax({
  type: "POST",
  url: "/include/like.php",
  data: "id="+sid,
  dataType: "html",
  cache: false,
  success: function(data) {  
  
  if (data == 'no')
  {
    alert('Вы уже голосовали!');
  }  
   else
   {
    $("#likegoodcount").html(data);
   }

}
});
});
});