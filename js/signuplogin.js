/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    $("#signup_submit").on("click", function ()
    {
        var inputs = $("#panelSignup").find("input");
        var FD = new FormData();
        FD.append("submit", "Register");
        for (var i = 0; i < inputs.length; i++)
        {
            //console.log(inputs[i].getAttribute("name")+": " +inputs[i].value)
            FD.append(inputs[i].getAttribute("name"), inputs[i].value);
        }

        $.ajax({
            dataType: "json",
            url: "./private/login_check.php",
            data: FD,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data)
            {
                console.log(data.status + ": " + data.message);
                //window.alert("well done: "+ JSON.parse(data));
            },
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
    } 
        });

    });
    
    $("#login_submit").on("click", function () {
        //console.log("I've been clicked");
        var inputs = $("#panelLogin").find("input");
        var FD = new FormData();
        FD.append("submit", "Login");
        //console.log(inputs);
        for (var i = 0; i < inputs.length; i++)
        {
            //console.log(inputs[i].getAttribute("name")+": " +inputs[i].value)
            FD.append(inputs[i].getAttribute("name"), inputs[i].value);
        }

        $.ajax({
            dataType: "json",
            url: "./private/login_check.php",
            data: FD,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data)
            {
                console.log(data.status);
                //window.alert("well done: "+ JSON.parse(data));
            }
        });
    });

});

