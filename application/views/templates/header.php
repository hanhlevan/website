
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= $title ?></title>

    <!-- Font Awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css">
   <link href="https://fonts.googleapis.com/css?family=Cinzel" rel="stylesheet">
   <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/images/icon/icon.png') ?>" />

    <?= $css ?>
    <!-- JQuery -->
</head>

<body>

<div id="container">
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
  <a class="navbar-brand" href="#">Science Search</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
    aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
        <?php if (! $this->session->userdata("logged")): ?>
        <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="#" onclick="showLogin()">Login</a>
        </div>
        <?php else : ?>
            <div class="dropdown-menu dropdown-menu-right dropdown-default"
          aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="#" onclick="logout()">Logout</a>
        </div>
        <?php endif ?>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <!--Content-->
        <div class="modal-content">
        <!--Modal cascading tabs-->
        <div class="modal-c-tabs">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs md-tabs tabs-2 light-blue darken-3" role="tablist">
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link active" data-toggle="tab" href="#panel17" role="tab" aria-selected="true">
                <i class="fas fa-user mr-1"></i> Login</a>
            </li>
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link" data-toggle="tab" href="#panel18" role="tab" aria-selected="false">
                <i class="fas fa-user-plus mr-1"></i> Register</a>
            </li>
            </ul>

            <!-- Tab panels -->
            <div class="tab-content">
            <!--Panel 17-->
            <div class="tab-pane fade in active show" id="panel17" role="tabpanel">

                <!--Body-->
                <div class="modal-body mb-1">
                <div class="md-form form-sm">
                    <i class="fas fa-envelope prefix"></i>
                    <input type="text" class="form-control form-control-sm" id="username">
                    <label for="form2" class="">Username</label>
                </div>

                <div class="md-form form-sm">
                    <i class="fas fa-lock prefix"></i>
                    <input type="password" class="form-control form-control-sm"  id="password">
                    <label for="form3" class="">Password</label>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-info waves-effect waves-light" onclick="login()">Log in
                    <i class="fas fa-sign-in ml-1"></i>
                    </button>
                </div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                <div class="options text-center text-md-right mt-1">
                    <p>Not a member?
                    <a href="#" class="blue-text">Sign Up</a>
                    </p>
                    <p>Forgot
                    <a href="#" class="blue-text">Password?</a>
                    </p>
                </div>
                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                </div>

            </div>
            <!--/.Panel 7-->

            <!--Panel 18-->
            <div class="tab-pane fade" id="panel18" role="tabpanel">

                <!--Body-->
                <div class="modal-body">
                <div class="md-form form-sm">
                    <i class="fas fa-envelope prefix"></i>
                    <input type="text" id="rUsername" class="form-control form-control-sm">
                    <label for="form14">Your username</label>
                </div>

                <div class="md-form form-sm">
                    <i class="fas fa-lock prefix"></i>
                    <input type="password" id="rPassword" class="form-control form-control-sm">
                    <label for="form5">Your password</label>
                </div>

                <div class="md-form form-sm">
                    <i class="fas fa-lock prefix"></i>
                    <input type="password" id="rrPassword" class="form-control form-control-sm">
                    <label for="form6">Repeat password</label>
                </div>

                <div class="text-center form-sm mt-4">
                    <button class="btn btn-info waves-effect waves-light" onclick="register()">Sign up
                    <i class="fas fa-sign-in ml-1"></i>
                    </button>
                </div>

                </div>
                <!--Footer-->
                <div class="modal-footer">
                <div class="options text-right">
                    <p class="pt-1">Already have an account?
                    <a href="#" class="blue-text">Log In</a>
                    </p>
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