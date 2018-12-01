<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <div id ="container">
    <head>
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="{{ asset('css/home.css') }}">
      <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>-->
      @yield('style')

      <title>{{ ('Horse Braiding Scheduling') }}
      </title>
      <!-- Scripts -->
      <?php
      if (is_Object(Auth::user())) {
          $id = Auth::user()->type;
          $requestedAppts = DB::table('orders')
           ->where('orders.employeeid', Auth::user()->id)
           ->where('orders.status', 0)
           ->count();
      }
      ?>
      <script src="{{ asset('js/app.js') }}" >
      </script>

      <!-- Fonts -->
      <link rel="dns-prefetch" href="https://fonts.gstatic.com">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
      <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
            <a class="navbar-brand" href="/">
              <i class="fas fa-horse fa-lg"> </i>
              IHBO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <?php
          if (isset($id) && $id > 0) {
              ?>

                <li class="nav-item">
                  <a class="nav-link" href="/home">
                    <i class="fas fa-calendar-check fa-lg"></i>
                      <span class="badge badge-danger"><?php echo intval($requestedAppts); ?></span>
                    </i>
                    Appointments
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="/calendar">
                    <i class="fas fa-calendar-alt fa-lg"></i>
                    Calendar
                  </a>
                </li>
              <?php
          } ?>

                <li class="nav-item">
                  <a class="nav-link" href="/gallery">
                    <i class="fas fa-images fa-lg"></i>
                    Gallery
                  </a>
                </li>

              </ul>
                <ul class="navbar-nav ml-auto">
                  <!-- Authentication Links -->
                  @guest

                  <li>
                    <a class="nav-link" href="{{ route('login') }}">
                      <i class="fas fa-sign-in-alt fa-lg"></i>
                      {{ __('Login') }}
                    </a>
                  </li>
                  <li>
                    <a class="nav-link" href="{{ route('register') }}">
                      <i class="fas fa-user-plus fa-lg"></i>
                      {{ __('Register') }}
                    </a>
                  </li>
                  @else
                  <li class="nav-item">
                    <a class="nav-link" href="/schedule">
                      <i class="fas fa-external-link-square-alt fa-lg"></i>
                      Place Order
                    </a>
                  </li>
                  <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      <i class="fa fa-user-o"></i>
                      </i>

                      {{ Auth::user()->firstname." ".Auth::user()->lastname }}
                      <span class="caret">
                      </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <?php $uid = Auth::user()->id; ?>
                      <a href="/ordersummary" class="dropdown-item">View Orders</a>

                      <a href="{{action('UserController@singleEdit', $uid)}}" class="dropdown-item">Update Account
                      </a>
                  <?php if ($id > 0) {
              ?>
                    <a href="/admin" class="dropdown-item">Admin</a>
          <?php
          } ?>
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </div>
                  </li>
                  @endguest
                </ul>
            </div>
          </div>
        </nav>

        <main class="py-4">
          @yield('content')
        </main>
      </div>
      </div>
      <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
      <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    </body>
  <div id="footer">
    © 2018
    <strong>Elijah Banks, Joshua Razalan, Joseph Kovack, Adam Deisz
    </strong>
  </div>
  </div>
  <!--
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.js"></script>
      @yield('script')
  </html>
