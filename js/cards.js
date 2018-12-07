/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$.toggleBio = function ()
{
    $(this).parents(".card").children(".card-body-secondary").toggle("slide");
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
                $(this).toggle("fade");
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
                $(this).toggle("fade");
            });
};

$(document).ready(function () {

    $(".card-picture").on("click", $.toggleBio);
    $(".bio-close").on("click", $.toggleBio);

    $(".btn-like").on("click", $.likePerson);
    $(".btn-reject").on("click", $.rejectPerson);
});

