<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="#" onclick="openNav()">Profile</a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>

            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>

        </ul>
        <!-- Links -->

        <form class="form-inline">
            <div class="md-form my-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            </div>
            <div class="md-form my-3">
                <a href="./private/logout.php"><button class="form-control btn btn-primary">Logout</button></a>
            </div>
        </form>
    </div>
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
                <form action="./private/update.php" method="POST" class="text-center">
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form">
                                <input type="text" id ="p_fname" name="p_fname" class="form-control"/>
                                <label for="p_fname">First Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <input type="text" id ="p_lname" name="p_lname" class="form-control"/>
                                <label for="p_lname">Last Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <div class="md-form">
                                <input type="text" id ="p_username" name="p_username" class="form-control"/>
                                <label for="p_username">Username</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="md-form">
                                <input type="email" id ="p_email" name="p_email" class="form-control"/>
                                <label for="p_email">Email Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="md-form">
                            <textarea type="text" id ="p_bio" name="p_bio" class="form-control"></textarea>
                            <label for="p_bio">Biography:</label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="md-form">
                            <input type="submit" id ="p_submit" name="p_submit" class="form-control btn btn-primary" />
                            
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

            </div>
        </div>
    </div>
</div>
<!--/ .sidenav -->
<!-- Use any element to open the sidenav -->

