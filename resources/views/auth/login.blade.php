
<!DOCTYPE html>
<html lang="en">
    <head>

        <script type="text/javascript" >
            function preventBack(){window.history.forward();}
            setTimeout("preventBack()", 0);
            window.onunload=function(){null};
        </script>

        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>DPWH Worker Management System</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="ThemeDesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="img/Dpwh Logo.png">

        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">

        <style>
         .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
          }
         
        </style>

    </head>


    <body class="fixed-left">
        <!-- Loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>

        <!-- Begin page -->

        <div class="account-pages mt-4">
            
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div>
                            <h5 class="font-30 text-muted mb-4">Worker Management System</h5>
                            <p class="text-muted mb-4">
                                Worker Management System is designed to help Human Resource (HR) in processing and retrieving of employee's 
                                data, records, or files in a short period. The HR personnel can 
                                easily monitor of worker's contract, schedule, attendance, salary, and end of contract/termination. 
                            </p>

                            <h5 class="font-14 text-muted mb-4">System Capabilities</h5>
                            <div>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>Workers Profiling</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>Contract Monitoring</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>Schedule Monitoring</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>Attendance Monitoring and Security</p>
                                <p><i class="mdi mdi-arrow-right text-primary mr-2"></i>Salary Monitoring</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>

                    <div class="col-lg-4">
                        <div class="card m-2">
                            <div class="card-body">
                                <div class="p-2">
                                    <div>
                                        <img class="center" src="img/Dpwh Logo.png" height="150" alt="logo">
                                    </div>
                                    <h4 class="text-center display-5">DPWH Region X District-II</h4>
                                    <p class="text-center font-weight-normal">Workers Management System for Contractual and Job Order</p>
                                </div>
                                <hr>
                                <div class="p-2">
                                    <form method="POST" action="/custom/login">
                                      @csrf
                                      <div class="form-area">
                                          <div class="row">
                                              <div class="col-lg-12">
                                                  @if ($errors->any())
                                                      <div class="alert alert-danger">
                                                          <ul>
                                                              @foreach ($errors->all() as $error)
                                                                  <li>{{ $error }}</li>
                                                              @endforeach
                                                          </ul>
                                                      </div>
                                                  @endif
                                              </div>
                                          </div>

                                        <div class="form-group row">
                                            <div class="col-12">
                                                <input type="text" class="form-control" name='idNumber' placeholder="ID Number">
                                               
                                            </div>
                                        </div>
        
                                        <div class="group">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                          
                                          </div>
        
                                        <div class="form-group text-center row m-t-20">
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>

    </body>
</html>