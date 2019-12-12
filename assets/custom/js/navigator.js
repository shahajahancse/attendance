
function nav_highlight(mother_id, child_id){
	$(".nav").removeClass('active');
	$("#"+mother_id).addClass('active');
	$("#"+child_id).addClass('active');
}