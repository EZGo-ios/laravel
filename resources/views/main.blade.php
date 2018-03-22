<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials._head')
  	</head>

  	<body>
    	<div class="container">
          @include('partials._messages')          
          <div class="content">
              @yield('content')
          </div>
   		</div>
	    @include('partials._javascript')
  	</body>
</html>