<?php
use App\Http\Controllers\ProductController;
$total = 0;
if (session()->has('user')) {
    $total = ProductController::cartItem();
}

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">E-Book</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/myorders">Orders</a>
        </li>
      </ul>
      <ul class="navbar-nav navbar-text">
        <li class="nav-item">
            <a class="nav-link" href="/cartlist">cart({{$total}})</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        @if(Session::has('user'))
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{Session::get('user')['name']}}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="/logout">Logout</a>
              <a class="dropdown-item" href="#">Profile</a>
            </div>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/register">Register</a>
          </li>
          @endif
      </ul>
      <form class="d-flex ml-5" action="/search" method="GET">
        <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

    </div>
  </div>
</nav>
