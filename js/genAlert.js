/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * <!-- Button trigger modal-->
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCookie1">Cookies</button>
 
 <!--Modal: modalCookie-->
 <div class="modal fade top" id="modalCookie1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
 aria-hidden="true" data-backdrop="false">
 <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
 <!--Content-->
 <div class="modal-content">
 <!--Body-->
 <div class="modal-body">
 <div class="row d-flex justify-content-center align-items-center">
 
 <p class="pt-3 pr-2">We use cookies to improve your website experience</p>
 
 <a type="button" class="btn btn-primary">Learn more <i class="fa fa-book ml-1"></i></a>
 <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Ok, thanks</a>
 </div>
 </div>
 </div>
 <!--/.Content-->
 </div>
 </div>
 <!--Modal: modalCookie-->
 */
$(document).ready(function () {

    $.genAlert = function (data)
    {
        var $class;
        switch (data.status)
        {
            case "failure":
                $class = "modal-danger";
                break;
            case "success":
                $class = "modal-success";
                break;
            case "warning":
                $class = "modal-warning";
                break;
            default:
                $class = "modal-info";
                break;
                
        }
        var $string =  "<div class='modal fade top' id='modalCookie1' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'"
                + "aria-hidden = 'true' data-backdrop = 'false'>"
                +"<div class = 'modal-dialog modal-frame modal-top modal-notify "+ $class+ "' role = 'document' >"
                +"<div class = 'modal-content' >"
                +"<div class = 'modal-body' >"
                +"<div class = 'row d-flex justify-content-center align-items-center'>"
                +"<p class = 'pt-3 pr-2' > "+data.message+"</p>"
                +"<a type = 'button' class = 'btn btn-primary' > Learn more <i class = 'fa fa-book ml-1' > </i></a >"
                +"<a type = 'button' class = 'btn btn-outline-primary waves-effect' data-dismiss = 'modal' > Ok, thanks </a>"
                +"</div></div>                </div>                </div>                </div>";
        $("body").append($string);
        $(".modal").modal('toggle');
        $("#modalCookie1").modal('toggle');
    };
});


