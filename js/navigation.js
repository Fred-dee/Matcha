


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
$(document).ready(function () {
    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */


    $(".sidenav-open").on("click", function ()
    {
        $("#mySidenav").width(350);
        $(".page").css("marginLeft", "350px");
        $("#mySidenav").data("open", true).trigger("openstatechange");
        //$("#main").style.overflowX = "none";

    });
    /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
    $("#mySidenav").on("openstatechange", function () {
        if ($(this).data("open") == false)
        {
            $("#user_info_form").trigger("submit");
            $("#user_settings_form").trigger("submit");
            //console.log("I was closing");
        }

    });



    $(".sidenav-close").on("click", function () {
        $("#mySidenav").width("0");
		$(".page").css("marginLeft", "0px");
        $("#mySidenav").data("open", false).trigger("openstatechange");

    });

    $.showPage = function ($name)
    {
        $($name).slideDown("slow");
		//$($name).data("open", true);
    };

    $(".page-toggle").on("click", function (e) {
        e.preventDefault();
        var $tohide = "";
		$tohide = "#" + $(".page[data-open='true']").attr("id");
		
		if ($tohide != $(this).attr("href"))
		{
			
			$($tohide).slideUp("slow", $.showPage($(this).attr("href")));
			$($tohide).attr("data-open", false);
			$($(this).attr("href")).attr("data-open", true);
		}

    });

});