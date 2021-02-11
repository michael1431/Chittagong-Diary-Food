<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="{{ asset('dist/employee/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('dist/employee/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}" />

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/employee/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('dist/employee/_all-skins.min.css') }}">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    textarea.form-control{
      height:40px;
    }
    .daily_log_form{
      height:40px;
      border-radius:5px
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header no-print">
    <!-- Logo -->
    <a href="{{url('/')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Employee</b> Dashboard</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              {{-- <img src="images/{{ Auth::user()->image }}" class="user-image" alt="User Image">--}}
              <span class="hidden-xs">{{ Auth::user()->name }}</span> 
            </a>
            <ul class="dropdown-menu">

              <!-- User image -->
              <li class="user-header">
                {{-- <img src="images/{{ Auth::user()->image }}" class="img-circle" alt="User Image"> --}}

                <p>
                  {{ Auth::user()->name }}
                  <small>Member since {{ Auth::user()->created_at->format('F, Y') }}</small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('dashboard-employee') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}"
                     class="btn btn-default btn-flat"
                     onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>


  <!-- Content Wrapper. Contains page content -->

  <div class="wraper ">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3 no-print">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div class="row text-center">
                <div class="col-md-1">
                  <img class="img-responsive img-circle" src="{{ asset('dist/img/cdfilogo.png') }}" alt="User profile picture" style="max-width:80px;">
                </div>
                <div class="col-md-11">
                  <h3 style="color: #36839b">{{ company_info()->company_name }}</h3>
                </div>
              </div>


              <img class="profile-user-img img-responsive img-circle" src="images/{{ Auth::user()->image }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

              {{-- <p class="text-center">{{Auth::user()->name ? Auth::user()->employee->office->designation ? Auth::user()->employee->office->designation->name: null :null }}</p> --}}

              <ul class="list-group list-group-unbordered">
                {{--<li class="list-group-item">--}}
                  {{--<b>Followers</b> <a class="pull-right">1,322</a>--}}
                {{--</li>--}}
                {{--<li class="list-group-item">--}}
                  {{--<b>Following</b> <a class="pull-right">543</a>--}}
                {{--</li>--}}
                {{--<li class="list-group-item">--}}
                  {{--<b>Friends</b> <a class="pull-right">13,287</a>--}}
                {{--</li>--}}
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>EDIT</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9" style="min-height:850px ;color: black">
          <div class="nav-tabs-custom" style="background:#b0d4f1">
            <div class="no-print">
              <ul class="nav nav-tabs">
                <li class="nav-item {{ isActive(['daily-log*']) }}">
                  <a href="{{ url('daily-log') }}" class="nav-link {{ isActive('daily-log') }}">
                    <b style="color: black">
                      Daily Log
                    </b>
                  </a>
                </li>
                <li class="nav-item {{ isActive(['daily-report*']) }}">
                  <a href="{{ url('daily-report') }}" class="nav-link {{ isActive('daily-report') }}">
                    <b style="color: black">
                      Daily Report
                    </b>
                  </a>
                </li>
                <li class="nav-item {{ isActive(['monthly-log*']) }}">
                  <a href="{{ url('monthly-log') }}" class="nav-link {{ isActive('monthly-log') }}">
                    <b style="color: black">
                      Monthly Log
                    </b>
                  </a>
                </li>
              </ul>
            </div>
            <div class="tab-content">
            @yield('content')
            <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
  <footer class="no-print" style="background-color:#ffffff;padding: 20px;height:50px">
    <div class="pull-right hidden-xs">
    </div>
   
  </footer>


</div>

<!-- jQuery 3 -->
<script src="{{ asset('dist/employee/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('dist/employee/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<!-- AdminLTE App -->
<script src="{{ asset('dist/employee/adminlte.min.js') }}"></script>
<script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>

<script src="{{ asset('js/sweetalert.min.js') }}"></script>

<script>

    $('.date-picker').datepicker({
        format:"yyyy-mm-dd"
    });

    $(document).on("click","#add_more",function () {
        var clone = $(this).closest('tr').clone(true).insertAfter( $(this).closest('tr'));
    });

    $(document).on("click","#remove",function () {
        $(this).parent().parent().remove();
    });

</script>
<script>

    /** CHECK EVERY ACTION DELETE CONFIRMATION BY SWEET ALERT **/
    $(document).on('click', '.erase', function () {
        var id = $(this).attr('data-id');
        var url=$(this).attr('data-url');
        var token = '{{csrf_token()}}';
        var $tr = $(this).closest('tr');
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this information!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: "No, cancel plz!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: url,
                        type: "post",
                        data: {id: id, _token: token},
                        dateType:'html',
                        success: function (response) {
                            swal("Deleted!", "Data has been Deleted.", "success"),
                                swal({
                                        title: "Deleted!",
                                        text: "Data has been Deleted.",
                                        type: "success"
                                    },
                                    function (isConfirm) {
                                        if (isConfirm) {
                                            $tr.find('td').fadeOut(1000, function () {
                                                $tr.remove();
                                            });
                                        }
                                    });
                        }
                    });
                } else {
                    swal("Cancelled", "Your data is safe :)", "error");
                }
            });
    });
</script>
<!-- AdminLTE for demo purposes -->
</body>
</html>
