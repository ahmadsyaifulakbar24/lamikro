$(window).on('scroll', function(event) {
	var scroll = $(window).scrollTop()
	if (scroll < 10) {
		$("#navigation").removeClass("shadow")
		$("#navigation").css("transition","all 0.2s ease")
	} else {
		$("#navigation").addClass("shadow")
		$("#navigation").css("transition","all 0.2s ease")
	}
})

$('#menuSidebar').click(function(){
	$('#sidebar').css('right','0px')
	$('.overlay').show()
})
$('.overlay,.menuClose').click(function(){
	$('.overlay').hide()
	$('#sidebar').css('right','-250px')
})