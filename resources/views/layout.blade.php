<!DOCTYPE html>
<html>
   <head>
      <title></title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <script src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/styles.css">
   </head>
   <body>
      <nav class="navbar navbar-default" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="#"><i>Real time group discussion using Laravel and Pusher</i></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
               <ul class="nav navbar-nav navbar-right">
               @if(Request::is('chat'))
                  <li><a id="logout" href="javascript:void(0)">Logout</a></li>
               @endIf   
               </ul>
            </div>
         </div>
      </nav>
      @yield('content')
   </body>
</html>