/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $(".avatar").on("click", function () {
        var $req = $(this).data("username");
        var fd = new FormData();
        fd.append("user", $req);
        $.ajax({
            data: fd,
            url: "./private/showuser.php",
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                $(".chat-content").hide();
				$(".chat-content").html("");
                $(".profile-browse").show();
                $(".profile-browse").html(data);
                
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {

                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });
    $("span[data-toggle='chat-content']").on("click", function(){
        var $req = $(this).data("username");
        var fd = new FormData();
        fd.append("username", $req);
		fd.append("get_chat", true);
        $.ajax({
            data: fd,
            url: "./private/chatinterface.php",
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
					console.log(data);
                
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {

                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
       
    });
});
/*
			sucess: function(data)
			{
				$(".profile-browse").hide();
				$(".profile-browse").html("");
				$(".chat-content").show();
				$(".chat-content").html(data);
				console.log(data);
			},
*/


