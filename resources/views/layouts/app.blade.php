<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{asset('/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/js/gritter/css/jquery.gritter.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('/css/style-responsive.css')}}" rel="stylesheet">
    <link href="{{asset('/css/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <script src="{{asset('/js/chart-master/Chart.js')}}"></script>
    <style>
    body{
      background-image: url({{asset('images/bc3.jpg')}});
      background-size:cover;
      background-repeat:no-repeat;
      background-attachment:fixed;
    }
    .panel-custom{
      background: rgba(255,255,255,0.5);
      border-radius: 15px;
    }

    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <header class="header black-bg">
              @if(Auth::check())
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
              @endif
            <!--logo start-->
            <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
            </a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{url('settings/profile')}}">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
        </header>


        @if(Auth::check())
        <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <p class="centered"><a href="#"><img src="{{asset('/wdw.jpg')}}" class="img-circle" width="60"></a></p>
                  <h5 class="centered">{{ Auth::user()->name }} </h5>
                    
                  <li class="mt">
                      <a class="active" href="{{ url('/') }}">
                          <i class="fa fa-dashboard"></i>
                          <span>Notifikasi</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="#" >
                          <i class="fa fa-user"></i>
                          <span>Siswa</span>
                      </a>
                  </li>
                  @role('admin')
                  <li class="sub-menu">
                      <a href="{{route('kelas.index')}}" >
                          <i class="fa fa-cogs"></i>
                          <span>Kelas</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="{{route('pelajaran.index')}}" >
                          <i class="fa fa-book"></i>
                          <span>Pelajaran</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="{{route('jurusan.index')}}" >
                          <i class=" fa fa-tasks"></i>
                          <span>Jurusan</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="#" >
                          <i class="fa fa-tasks"></i>
                          <span>Nilai</span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="#" >
                          <i class="fa fa-user"></i>
                          <span>Guru</span>
                      </a>
                  </li>
                  @endrole
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
        @endif

        <br>
        <br>
        <br>
        <br>
        <br>

        @include('layouts._flash')
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{asset('/js/app.js')}}"></script>
    <!-- <script src="{{asset('/js/bootstrap.min.js')}}"></script> -->
    <script src="{{asset('/js/jquery-3.2.1.min.js')}}"></script><!-- 
    <script src="{{asset('/js/jquery.js')}}"></script>
    <script class="include" type="text/javascript" src="{{asset('/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{asset('/js/jquery.sparkline.js')}}"></script> -->


    <!--common script for all pages--><!-- 
    <script src="{{asset('/js/common-scripts.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('/js/gritter/js/jquery.gritter.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/gritter-conf.js')}}"></script> -->

    <!--script for this page--><!-- 
    <script src="{{asset('/js/sparkline-chart.js')}}"></script> -->
    <script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/custom.js')}}"></script>    

    @yield('scripts')
    
    <!-- <script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'LARANILAI',
            // (string | mandatory) the text inside the notification
            text: 'Aplikasi ini ditujukan untuk pengolahan nilai siswa',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
    </script> -->
</body>
</html>
