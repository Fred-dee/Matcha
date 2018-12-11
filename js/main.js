$(document).ready(function(){
	
	$("input").on("focus", function(){
		
	 	var $label = $("label[for='"+$(this).attr('id')+"']");
		$label.animate({
			fontSize: "60%",
			top: "-10%"
		}, 100);
	});
	
	$("input").on("focusout", function(){
		if ($(this).val().length == 0)
		{
			var $label = $("label[for='"+$(this).attr('id')+"']");
			$label.animate({
				fontSize: "100%",
				top: "+10%"
			}, 100);
		}
	});
});