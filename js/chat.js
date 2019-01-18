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
                $("#message_send").trigger("reset");
               
                
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
/*
 * {"Tester:Fred-Dee":["Fred-Dee",["Hello Tester!","01:02:2019:12:36:00:00","read"],"Tester",["hi Fred-Dee, Tester Here","01:02:2019:12:37:00:00","read"],["Fred-Dee",["Can I do it",1547482631,"unread"]],["Fred-Dee",["Lets see if this fixes it",1547482836,"unread"]]],"Tester:Killer":["Fred-Dee",["Hello Killer","01:02:2019:12:36:00:00","read"],"Killer",["Hey There Fred-Dee, Killer Here","01:02:2019:12:37:00:00","read"]],"Fred-Dee:Jake":["Fred-Dee",["Dude it was epic","01:02:2019:13:37:00:00","unread"],{"Fred-Dee":["Please be in the right format",1547735431,"unread"]},{"Fred-Dee":["Please be in the right format",1547735433,"unread"]},{"Fred-Dee":["Another one",1547735574,"unread"]},{"Fred-Dee":["Another one",1547735580,"unread"]},{"Fred-Dee":["Another one",1547735583,"unread"]},{"Fred-Dee":["Here is my message",1547735687,"unread"]},"Fred-Dee",["This one is lit",1547735850,"unread"],"Fred-Dee",["Will you work",1547736308,"unread"],"Fred-Dee",["Another one",1547736388,"unread"]]}
 */


