
<!--Modal: Login / Register Form-->
<div class="modal fade" id="modalLRForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">

            <!--Modal cascading tabs-->
            <div class="modal-c-tabs">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#paneLogin" role="tab"><i class="fa fa-user mr-1"></i>
                            Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panelSignup" role="tab"><i class="fa fa-user-plus mr-1"></i>
                            Register</a>
                    </li>
                </ul>

                <!-- Tab panels -->
                <div class="tab-content">
                    <!--Panel 7-->
                    <div class="tab-pane fade in show active" id="panelLogin" role="tabpanel">

                        <!--Body-->
                        <div class="modal-body mb-1">
                            <div class="md-form form-sm mb-5">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="text" id="l_username" name="l_username" class="form-control form-control-sm validate">
                                <label data-error="wrong" data-success="right" for="l_username">Your username</label>
                            </div>

                            <div class="md-form form-sm mb-4">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" id="l_password" name = "l_password" class="form-control form-control-sm validate">
                                <label data-error="wrong" data-success="right" for="l_password">Your password</label>
                            </div>
                            <div class="text-center mt-2">
                                <button class="btn btn-info" id="login_submit">Log in <i class="fa fa-sign-in ml-1"></i></button>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <div class="options text-center text-md-right mt-1">
                                <p>Not a member? <a href="#" class="blue-text">Sign Up</a></p>
                                <p>Forgot <a href="#" class="blue-text">Password?</a></p>
                            </div>
                            <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                    <!--/.Panel 7-->

                    <!--Panel 8-->
                    <div class="tab-pane fade" id="panelSignup" role="tabpanel">

                        <!--Body-->
                        <div class="modal-body">

                            <div class="md-form form-sm mb-5">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="s_username" name="s_username" class="form-control form-control-sm validate" required>
                                <label data-error="wrong" data-success="right" for="s_username">Username</label>
                            </div>
                            <div class="md-form form-sm mb-5">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="s_fname" name="s_fname" class="form-control form-control-sm validate" required>
                                <label data-error="wrong" data-success="right" for="s_fname">First Name</label>
                            </div>
                            <div class="md-form form-sm mb-5">
                                <i class="fa fa-user prefix"></i>
                                <input type="text" id="s_lname" name="s_lname" class="form-control form-control-sm validate" required>
                                <label data-error="wrong" data-success="right" for="s_lname">Last Name</label>
                            </div>
                            <div class="md-form form-sm mb-5">
                                <i class="fa fa-envelope prefix"></i>
                                <input type="email" id="s_email" name="s_email" class="form-control form-control-sm validate" required>
                                <label data-error="wrong" data-success="right" for="s_email">Your email</label>
                            </div>

                            <div class="md-form form-sm mb-5">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" id="s_password" name="s_password" class="form-control form-control-sm validate" required>
                                <label data-error="wrong" data-success="right" for="s_password">Your password</label>
                            </div>

                            <div class="md-form form-sm mb-4">
                                <i class="fa fa-lock prefix"></i>
                                <input type="password" id="s_cpassword" name="s_cpassword" class="form-control form-control-sm validate" required>
                                <label data-error="wrong" data-success="right" for="s_cpassword">Repeat password</label>
                            </div>

                            <div class="text-center form-sm mt-2">
                                <button id="signup_submit" class="btn btn-info">Sign up <i class="fa fa-sign-in"></i></button>
                            </div>

                        </div>
                        <!--Footer-->
                        <div class="modal-footer">
                            <div class="options text-right">
                                <p class="pt-1">Already have an account? <a href="#" class="blue-text">Log In</a></p>
                            </div>
                            <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!--/.Panel 8-->
                </div>

            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: Login / Register Form-->

<div class="text-center">
    <a href="" class="btn btn-default btn-rounded my-3" data-toggle="modal" data-target="#modalLRForm">Launch
        Modal LogIn/Register</a>
</div>
