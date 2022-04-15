<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Smart Teaching</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-blue-400">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample" aria-controls="navbarsExample" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse bg-blue-400 justify-content-between fixed-top" id="navbarsExample">
            <a class="navbar-brand" href="{{ url('/') }}">Smart Teaching</a>
            <ul class="navbar-nav">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item justify-content-md-end">
                            <a class="nav-link" href="{{ url('/home') }}">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item justify-content-md-end">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item justify-content-md-end">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Page Content-->
<div class="container px-4 px-lg-5">
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="{{ asset('/images/app_logo.png') }}"  alt="Smart Teaching" style="width: 400px; height: 400px;" /></div>
        <div class="col-lg-5">
            <h1 class="font-weight-light" style="font-size: 40px">Smart Teaching</h1>
            <p>This is a template that is great for small businesses. It doesn't have too much fancy flare to it, but it makes a great use of the standard Bootstrap core components. Feel free to use this template for any project you want!</p>
            <a class="btn btn-primary" href="{{ route('register') }}">Get Started</a>
        </div>
    </div>
    <!-- Call to Action-->
    <div class="card text-white bg-blue-400 my-5 py-4 text-center">
        <div class="card-body"><p class="text-white m-0">We currently cover all 31 GCSE subjects for years 10 and 11. Make your teaching smarter today! </p></div>
    </div>
    <!-- Content Row-->
    <div class="row gx-4 gx-lg-5">
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">Subjects</h2>
                    <p class="card-text">All of the 31 GCSE subjects are covered including several different exam boards for better content availability. The subjects are broken down into modules and sub modules within these so that the right content can be found easily.</p>
                </div>
                <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">More Info</a></div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">Learner Type Test</h2>
                    <p class="card-text">This is a short test we suggest you take once you have created an account and logged in for the first time, this test will try to analyse your answers to certain questions and based on your responses we will suggest which learner type you may be.</p>
                </div>
                <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">More Info</a></div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">Learner Relevant Content</h2>
                    <p class="card-text">Update this section!!</p>
                </div>
                <div class="card-footer"><a class="btn btn-primary btn-sm" href="#!">More Info</a></div>
            </div>
        </div>
    </div>
</div>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container px-4 px-lg-5"><p class="m-0 text-center text-white">Copyright &copy; Smart Teaching 2022</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
