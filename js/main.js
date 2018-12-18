$(document).ready(function () {

    $("input, textarea").on("focus", function () {

        var $label = $("label[for='" + $(this).attr('id') + "']");
        $label.animate({
            fontSize: "60%",
            top: "-15%"
        }, 100);
    });
    $("input, textarea").on("focusout", function () {
        if ($(this).val().length == 0)
        {
            var $label = $("label[for='" + $(this).attr('id') + "']");
            $label.animate({
                fontSize: "100%",
                top: "+15%"
            }, 100);
        }
    });
    $("input, textarea").each(function () {
        if ($(this).val().length != 0)
        {
            var $label = $("label[for='" + $(this).attr('id') + "']");
            $label.css({
                fontSize: "60%",
                top: "-15%"
            });
        }
    });
    $("#modalLRForm").modal('toggle');
    $(".reg-launch").on("click", function ()
    {
        $("#modalLRForm").modal('toggle');
    });
    $("#user_info_form").on("submit", function (e) {
        e.preventDefault();
        var forms = document.getElementById("user_info_form");
        var $fd = new FormData(forms);
        /* Perform validation and if the information is invalid dont propagate*/
        $.ajax({
            dataType: "json",
            url: "./private/update.php",
            data: $fd,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data)
            {
                console.log(data);
                if (data.status != "success")
                    $.genAlert(data, false);
                console.log(data.status + " " + data.message);
                //window.alert("well done: "+ JSON.parse(data));
            },
            error: function (XMLHttpRequest, textStatus, errorThrown)
            {

                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });
    $("img").on("click", function () {
        if ($(this).data("for"))
        {
            $("input[name='" + $(this).data("for") + "']").on("change", function ()
            {
                var $fd = new FormData();
                
                $fd.append('image', $(this)[0].files[0]);
                $fd.append("submit", "insert");
                $fd.append("position", $(this).attr)
                
                $.ajax({
                    dataType: "json",
                    data: $fd,
                    url: "./private/profile_pictures.php",
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (data)
                    {
                        //console.log(data);
                        if (data.status != "success")
                            $.genAlert(data, false);
                        else
                        {
                            //change the image src to the src given back in the data
                        }
                        console.log(data.status + " " + data.message);
                        //window.alert("well done: "+ JSON.parse(data));
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown)
                    {

                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });
            });
            $("input[name='" + $(this).data("for") + "']").trigger("click");
        }
    });
});