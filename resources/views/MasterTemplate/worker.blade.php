<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="cache-control" content="private, max-age=0, no-cache">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <link href="{{asset('css/root.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('img/Dpwh Logo.png')}}">
    <title>DPWH Worker Management System</title>
    @yield('head')

     
    {{-- <script type="text/javascript" >
      function preventBack(){window.history.forward();}
      setTimeout("preventBack()", 0);
      window.onunload=function(){null};
    </script> --}}

  </head>

  <body>
  <div class="loading"><img src="{{asset('img/loading.gif')}}" alt="loading-img"></div>
    
    <div id="top" class="clearfix">
     
      <div class="applogo">
        <a href="/" class="logo">WMS</a>
      </div>
      
      <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
      <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>

      <ul class="top-right ">
        <li class="dropdown link">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><img src="{{asset('img/Worker ID')}}/{{Auth::user()->idPicture}}" alt="img"><b>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</b><span class="caret"></span></a>
            <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right ">
              <li>  <a href="/cpform"> Change Password</a></li>
              <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }} 
                  {{-- <i class="fa falist fa-power-off"></i> --}}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>
            </ul>
        </li>
      </ul>
    </div>

    <div class="sidebar clearfix">
      <ul class="sidebar-panel nav">
        <li class="sidetitle">MAIN</li>
        <li><a href="/myProfile"><span class="icon color7"><i class="fa fa-user"></i></span>My Profile</a></li>
        <li><a href="/myContract"><span class="icon color5"><i class="fa fa-file-text"></i></span>My Contract</a></li>
        <li><a href="/mySched"><span class="icon color5"><i class="fa fa-calendar"></i></span>My Schedule</a></li>
        <li><a href="/myDTR"><span class="icon color5"><i class="fa fa-check"></i></span>My DTR</span></a></li>
        <li><a href="/mySalary"><span class="icon color5"><i class="fa fa-money"></i></span>My Salary</a></li>
        <li><a href="/myLeave"><span class="icon color5"><i class="fa fa-fighter-jet"></i></span>My Leaves</a></li>
      </ul>
    </div>

    <div class="content">
     
      <div class="page-header">
        <h1 class="title">
            @yield('header')
        </h1>
      </div>
      <div>
          @yield('content')
      </div>
     
      <div class="row footer">
      </div>
    </div>

    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/sparkline/sparkline.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/sparkline/sparkline-plugin.js')}}"></script>
    <script src="{{asset('js/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('js/Chart.bundle.js')}}"></script>

    @yield('jsScript')

  </body>
</html>