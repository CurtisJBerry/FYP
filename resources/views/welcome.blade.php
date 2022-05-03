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

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>
@include('layouts.header')

<!-- Page Content-->
<div class="container px-4 px-lg-5">
    <!-- Heading Row-->
    <div class="row gx-4 gx-lg-5 align-items-center my-5">
        <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="{{ asset('/images/app_logo.png') }}"  alt="Smart Teaching" style="width: 400px; height: 400px;" /></div>
        <div class="col-lg-5">
            <h1 class="font-weight-light" style="font-size: 40px">Smart Teaching</h1>
            <p>We wanted to make learning a more personal experience as we understand everyone learns in different ways, through our Learner type test and monitoring your viewing history we try to make the content you see as relevant and personalised to you as possible.</p>
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
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">Learner Type Test</h2>
                    <p class="card-text">This is a short test we suggest you take once you have created an account and logged in for the first time, this test will try to analyse your answers to certain questions and based on your responses we will suggest which learner type you may be.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="card-title">Learner Relevant Content</h2>
                    <p class="card-text">Upon taking our Learner Type Test and setting this on your account, once you look into a subject you will be shown the available materials that match your learner type based on who the material is most suited to.
                        If you'd rather see all the content for a given subject, there is a toggle that will display all available materials which are listed with their tags which show who the material is most suited to.</p>
                </div>
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
