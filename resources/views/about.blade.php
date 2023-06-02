<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
      .bg-body{
        background: rgb(180,225,255);
        background: linear-gradient(90deg, rgba(180,225,255,1) 0%, rgba(0,140,198,0.3086484593837535) 0%, rgba(217,213,213,1) 100%);
      }
      .img-dashboard{
        width: 20rem;
        background-blend-mode: normal;
      }
      /* Normal Usage */
    </style>
    <title>About</title>
  </head>
  <body class="bg-body" >

    <nav class="container mt-0 mt-lg-4 navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="#">DM Diagnose XS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="/about">About</a>
      </li>
     @auth
     <li class="nav-item">
      <li class="nav-item">
        <a href="#" class="nav-link" data-toggle="modal" data-target="#exampleModal">Logout</a>
      </li>
    </li>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Sure wanna logout?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </div>
     @endauth
     @guest
     <li class="nav-item">
      <a href="/login" class="nav-link">Login</a>
    </li>
     @endguest
     
    </ul>
  </div>
</nav>

<div class="container d-flex align-items-center mt-3 mt-lg-5">
  <div class="d-block">
    <div class="row">
      <div class="col-md-6 d-flex justify-content-center align-items-center">
        <div class="d-block">
          <h4 style="font-size: 3em">Diabetes Mellitus Diagnose <small style="font-size: 0.6em">Expert System</small></h4><br>
        <p style="text-align: justify;">Diabetes Mellitus is an expert system to diagnose Diabetes Mellitus by scoring your HbA1C, Blood Sugar During, Blood Sugar Fasting, and Tolerance Glucose test. DM-XS will give you the score of test result by Fuzzy Tsukamoto method. Be aware, you must consult with a doctor, and don't expecting the result of this system is 100% true, because this system still need complex datasets and more knowledge based. But we hopes this system helps you!</p>
        </div>
      </div>
      <div class="col-md-6">
        <img class="d-block img-dashboard mx-auto" src="{{ asset('img/dashboard-doctor.png') }}" alt="">
      </div>
    </div>
  </div>
<br>
</div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
</html>