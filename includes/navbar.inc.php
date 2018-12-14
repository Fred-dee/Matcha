<?php
require_once $_SERVER["DOCUMENT_ROOT"] . '/Matcha/init.php';
if (!isset($_SESSION))
    session_start();
?>
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">

    <!-- Navbar brand -->
    <?php
        if ($_SESSION["login"] != "guest")
        {
    ?>
    <a class="navbar-brand" href="#" onclick="openNav()">Profile</a>
    <a class="navbar-brand" href="./private/logout.php" style="position: absolute; right: 0px;">Logout</a>
    <?php
        }
		else
		{
			echo "<a class='navbar-brand reg-launch' href='#' >Sign Up/Register</a>";
		}
    ?>

    <!-- Collapsible content -->

</nav>
<!--/.Navbar-->
<!-- .sidenav -->
<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="container">
        <ul class="nav nav-pills " id="sidenav_tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="edit_profile_tab" data-toggle="tab" href="#edit_profile" role="tab" aria-controls="edit" aria-selected="true">Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="settings_tab" data-toggle="tab" href="#settings" role="tab" aria-controls="profile" aria-selected="false">Settings</a>
            </li>
        </ul>
        <div class="tab-content" id="profile_tab_content">
            <div class="tab-pane fade show active" id="edit_profile" role="tabpanel" aria-labelledby="edit-tab">
				<div class="profile-images-wrapper container-fluid">
					
					<div class="row">
						<div class="col-4"><img class="img-fluid rounded" alt="" src="./imgs/Fred_Profile_1.jpg"></div>
						<div class="col-4"><img class="img-fluid rounded" alt="" src="./imgs/Fred_Profile_1.jpg"></div>
						<div class="col-4"><img class="img-fluid rounded" alt="" src="./imgs/Fred_Profile_1.jpg"></div>
					</div>
					
					<div class="row">
						<div class="col-4"><img class="img-fluid rounded" alt="" src="./imgs/Fred_Profile_1.jpg"></div>
						<div class="col-4"><img class="img-fluid rounded" alt="" src="./imgs/Fred_Profile_1.jpg"></div>
						<div class="col-4"><img class="img-fluid rounded" alt="" src="./imgs/Fred_Profile_1.jpg"></div>
					</div>
				</div>
                <form action="#" method="POST" class="text-center" id="user_info_form">
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form">
                                <input type="text" id ="p_fname" name="p_fname" class="form-control" value = "<?php
                                if (isset($_SESSION["user_obj"]))
                                    echo $_SESSION["user_obj"]->get_firstName();
                                ?>"/>
                                <label for="p_fname">First Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <input type="text" id ="p_lname" name="p_lname" class="form-control" value = "<?php
                                       if (isset($_SESSION["user_obj"]))
                                           echo $_SESSION["user_obj"]->get_lastName();
                                       ?>"/>
                                <label for="p_lname">Last Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form">
                                <input type="text" id ="p_username" name="p_username" class="form-control" value = "<?php
                                       if (isset($_SESSION["user_obj"]))
                                           echo $_SESSION["user_obj"]->get_userName();
                                       ?>"/>
                                <label for="p_username">Username</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <input type="email" id ="p_email" name="p_email" class="form-control" value = "<?php
                                       if (isset($_SESSION["user_obj"]))
                                           echo $_SESSION["user_obj"]->get_email();
                                       ?>"/>
                                <label for="p_email">Email Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="md-form">
                            <textarea type="text" id ="p_bio" name="p_bio" class="form-control"><?php
                                       if (isset($_SESSION["user_obj"]))
                                           echo $_SESSION["user_obj"]->get_bio();
                                       ?></textarea>
                            <label for="p_bio">Biography:</label>
                        </div>
                    </div>
                
                       
                            <input type="submit" id ="p_submit" name="p_submit" class="form-control btn btn-elegant" />

         
                </form>
            </div>
            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

            </div>
        </div>
    </div>
</div>
<!--/ .sidenav -->
<!-- Use any element to open the sidenav -->

