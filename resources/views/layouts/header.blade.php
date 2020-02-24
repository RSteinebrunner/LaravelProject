<nav class="navbar navbar-expand-sm navbar-dark bg-dark sticky-top">
        <a class="navbar-brand" href="#">
        <img id="logo" style="width: 40px;" alt="Logo" src="#">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            <ul class="navbar-nav mr-auto">
              
       		<li class="nav-item"><a class="nav-link" href="login">Home</a></li> 
       		

            </ul>
            <ul class="navbar-nav">
            
			@if(Session::get('Role') == "admin")
			  
            <!-- Administrator  drop down menu -->
				<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Admin
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item"  href='manageUsers'>Manage Users</a>
                         <a class="dropdown-item"  href='profile'>My Profile</a>
                         <a class="dropdown-item"  href='portfolio'>My Portfolio</a>
                        <a class="dropdown-item"  href='jobPosting'>Job Postings</a>
                        <a class="dropdown-item"  href='adminJobPosting'>Edit Job Postings</a>
                        <a class="dropdown-item"  href='logout'>Logout</a>
                    </div>   
                 </li>
             
              @endif
              
              @if(Session::get('Role') == "user")
              <!-- User  drop down menu -->
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      User
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    	<a class="dropdown-item"  href='profile'>My Profile</a>
                    	  <a class="dropdown-item"  href='portfolio'>My Portfolio</a>
                        <a class="dropdown-item"  href='jobPosting'>Job Postings</a>
                        <a class="dropdown-item"  href='logout'>Logout</a>
                    </div>
             
                 </li>
               @endif
               
              @if(Session::get('Role')==null)
                 	<li class="nav-item"><a class="nav-link" href='register'>Sign Up</a>
                 	<li class="nav-item"><a class="nav-link" href='login'>Login</a>      
               @endif
                 
               </ul>
           </div> 
        
</nav>
