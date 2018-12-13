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
    

});