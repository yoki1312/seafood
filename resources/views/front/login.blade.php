<!doctype html>
<html lang="en">

<head>
    <title>Login 05</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('assetLogin/css/style.css') }}">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Login Serba Serbi Seafood</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="img" style="background-image: url({{ asset('assetLogin/images/bg-1.jpg') }} );">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex text-center">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>

                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mt-3">
                                    <input name="email" type="text" class="form-control" required>
                                    <label class="form-control-placeholder" for="username">Email</label>
                                </div>
                                <div class="form-group">
                                    <input name="password" id="password-field" type="password" class="form-control"
                                        required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                                        In</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center">Not a member? <a data-toggle="tab" href="#signup">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assetLogin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assetLogin/js/popper.js') }}"></script>
    <script src="{{ asset('assetLogin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assetLogin/js/main.js') }}"></script>

</body>

</html>
