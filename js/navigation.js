
	

/*
function openNav() {
document.getElementById("mySidenav").style.width = "350px";
document.getElementById("main").style.marginLeft = "350px";


}


function closeNav() {
document.getElementById("mySidenav").style.width = "0";
document.getElementById("main").style.marginLeft = "0";

}
*/
$(document).ready(function(){
	/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
			$("#mySidenav").focusout(function(){
			console.log("I have trapped the event");
		});

	$(".sidenav-open").on("click",function()
	{
		$("#mySidenav").width(350);
		$("#main").css("marginLeft","350px");
		$("#mySidenav").focusin();
		//$("#main").style.overflowX = "none";

	});
	/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
	$(".sidenav-close").on("click", function(){
		 $("#mySidenav").width("0");
    	$("#main").css("marginLeft", "0px");
		

		$("#mySidenav").focusout();
	});
	
	
});