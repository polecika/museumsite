$(document).ready(function() {
	$("#gallery li img").hover(function(){
		$('#main-img').attr('src',$(this).attr('src').replace('thumb/', ''));
	});
	var imgSwap = [];
	 $("#gallery li img").each(function(){
		imgUrl = this.src.replace('thumb/', '');
		imgSwap.push(imgUrl);
	});
	$(imgSwap).preload();
});
$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}