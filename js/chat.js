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
        $(".avatar").parent().removeClass("active");
        $(this).parent().addClass("active");
        $.ajax({
            data: fd,
            url: "./private/showuser.php",
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                $(".chat-content").hide();
                $(".chat-content").html("");
                $(".profile-browse").html("");
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
    $("span[data-toggle='chat-content']").on("click", function () {
        var $req = $(this).data("username");
        var fd = new FormData();
        $("span[data-toggle='chat-content']").parent().removeClass("active");
        $(this).parent().addClass("active");
        fd.append("username", $req);
        fd.append("get_chat", true);
        $.ajax({
            dataType: "",
            data: fd,
            url: "./private/chatinterface.php",
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {

                $(".profile-browse").hide();
                $(".profile-browse").html("");
                $(".chat-content").remove(".message");
                $(".chat-content").show();
                for (var i = 0; i < data.length; i++)
                {
                    $(".chat-content").prepend(data[i]);
                }
                console.log(data);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {

                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });

    });

    $("#message_send").on("submit", function (e) {
        e.preventDefault();
        e.stopPropagation();

        var fd = new FormData(document.getElementById("message_send"));
        fd.append("send_message", true);

        var username = $(".match.active").first()[0].firstChild.getAttribute("data-username");
        fd.append("username", username);
        $.ajax({
            dataType: "",
            url: "./private/chatinterface.php",
            processData: false,
            contentType: false,
            type: 'POST',
            data: fd,
            success: function (data)
            {
                console.log(data);
                //if (data.status != "success")
                //   $.genAlert(data, false);
                //console.log(data.status + " " + data.message);

            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {

                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });
});



