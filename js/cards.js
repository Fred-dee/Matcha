/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$.toggleBio = function ()
{
    $(this).parents(".card").children(".card-body-secondary").toggle("slide");
};
$.addToDom = function (data)
{
    $(".card-wrapper").append(data);
    $(".card-picture").on("click", $.toggleBio);
    $(".bio-close").on("click", $.toggleBio);

    $(".btn-like").on("click", $.likePerson);
    $(".btn-reject").on("click", $.rejectPerson);
};

$.likePerson = function ()
{
    $(this).parents(".card").animate(
            {
                left: "-=100px",
                opacity: 0.5
            },
            1000,
            function () {
                var fd = new FormData();
                fd.append("action", "likeed");
                fd.append("user", $(this).data("for"));
                fd.append("data", true);
                $(this).toggle("fade");
                $(this).remove();

                $.ajax({
                    url: "./private/loaddata.php",
                    dataType: "",
                    data: fd,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (data)
                    {
                        $.addToDom(data);

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown)
                    {

                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });

            });
};

$.rejectPerson = function ()
{
    $(this).parents(".card").animate(
            {
                left: "+=100px",
                opacity: 0.5
            },
            1000,
            function () {
                var fd = new FormData();
                fd.append("action", "rejected");
                fd.append("user", $(this).data("for"));
                fd.append("data", true);
                $(this).toggle("fade");
                $(this).remove();
                $.ajax({
                    url: "./private/loaddata.php?",
                    dataType: "",
                    data: fd,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (data)
                    {
                        $.addToDom(data);

                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown)
                    {

                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });
            });
};

$(document).ready(function () {

    $(".card-picture").on("click", $.toggleBio);
    $(".bio-close").on("click", $.toggleBio);

    $(".btn-like").on("click", $.likePerson);
    $(".btn-reject").on("click", $.rejectPerson);
});

