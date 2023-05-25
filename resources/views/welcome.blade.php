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
      .cta {
  display: flex;
  padding: 11px 33px;
  text-decoration: none;
  font-family: 'Poppins', sans-serif;
  font-size: 25px;
  color: black;
  background: rgba(180,225,255,1);
  transition: 1s;
  box-shadow: 6px 6px 0 black;
  transform: skewX(-15deg);
  border: none;
}

.cta:focus {
  outline: none;
}

.cta:hover {
  transition: 0.5s;
  box-shadow: 10px 10px 0 #FBC638;
}

.cta .second {
  transition: 0.5s;
  margin-right: 0px;
}

.cta:hover  .second {
  transition: 0.5s;
  margin-right: 45px;
}

.span {
  transform: skewX(15deg)
}

.second {
  width: 20px;
  margin-left: 30px;
  position: relative;
  top: 12%;
}

.one {
  transition: 0.4s;
  transform: translateX(-60%);
}

.two {
  transition: 0.5s;
  transform: translateX(-30%);
}

.cta:hover .three {
  animation: color_anim 1s infinite 0.2s;
}

.cta:hover .one {
  transform: translateX(0%);
  animation: color_anim 1s infinite 0.6s;
}

.cta:hover .two {
  transform: translateX(0%);
  animation: color_anim 1s infinite 0.4s;
}

@keyframes color_anim {
  0% {
    fill:white;
  }

  50% {
    fill: #FBC638;
  }

  100% {
    fill: white;
  }
}
      /* Normal Usage */
    </style>
    <title>Dashboard</title>
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
        <a class="nav-link" href="/about">About</a>
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
        <p>Welcome to Diabetes Mellitus Diagnose Expert System, click get started if you don't have an account, or please login if you have an account.</p>
        </div>
      </div>
      <div class="col-md-6">
        <img class="d-block img-dashboard mx-auto" src="{{ asset('img/dashboard-doctor.png') }}" alt="">
      </div>
    </div>
    <a class="nav-link" href="/register">
    <button class="cta ml-auto mt-5">
      <span class="span">Get Started</span>
      <span class="second">
        <svg width="40px" height="10px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <path class="one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
            <path class="two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
            <path class="three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="black"></path>
          </g>
        </svg>
      </span> 
    </button>
  </a>
  </div>
<br>
</div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  </body>
</html>