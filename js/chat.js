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
        $(".profile-browse").hide();
        $(".chat-content").show();
    })
});


