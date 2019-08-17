
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="/file/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/file/plugins/fullcalendar/fullcalendar.css" media="screen">
<link rel="stylesheet" type="text/css" href="/file/plugins/fullcalendar/fullcalendar.print.css" media="print">


<link rel="stylesheet" type="text/css" href="/file/plugins/select2/select2.css" media="screen">
<link rel="stylesheet" type="text/css" href="/file/plugins/ibutton/jquery.ibutton.css" media="screen">
<link rel="stylesheet" type="text/css" href="/file/plugins/cleditor/jquery.cleditor.css" media="screen">



<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/file/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/file/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/file/css/fonts/icomoon/style.css" media="screen">


<link rel="stylesheet" type="text/css" href="/file/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/file/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/file/css/icons/icol32.css" media="screen">


<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/file/css/demo.css" media="screen">


<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/file/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/file/jui/jquery-ui.custom.css" media="screen">


<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/file/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/file/css/themer.css" media="screen">


<link rel="stylesheet" type="text/css" href="/file/plugins/prettyphoto/css/prettyPhoto.css" media="screen">
<meta name="csrf-token" content="{{ csrf_token() }}">


<title>后台管理</title>

</head>

<body>


	<!-- Themer (Remove if not needed) -->  
	
    <!-- Themer End -->

	<!-- Header -->
	<div id="mws-header" class="clearfix">
    
    	<!-- Logo Container -->
    	<div id="mws-logo-container">
        
        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<div id="mws-logo-wrap">
            	<img src="/file/images/mws-logo.png" alt="mws admin">
			</div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
        
        	<!-- Notifications -->
        	
            <!-- Messages -->
           
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            
            	<!-- User Photo -->
            	<div id="mws-user-photo">
                	<img src="/uploads/{{session('admin_userinfo')->profile}}" alt="User Photo">
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello, {{session('admin_userinfo')->name}}
                    </div>
                    <ul>
                    	<!-- <li><a href="#">Profile</a></li>
                        <li><a href="#">Change Password</a></li> -->
                        <li><a href="/admin/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
    	<!-- Necessary markup, do not remove -->
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
        	<!-- Searchbox -->
        	<div id="mws-searchbox" class="mws-inset">
            	<form action="typography.html">
                	<input type="text" class="mws-search-input" placeholder="Search...">
                    <button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
                </form>
            </div>
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                    <li>
                        <a href="#"><i class="icon-list-2"></i> 用户管理</a>
                        <ul class="closed">
                            <li><a href="/admin/users">用户列表</a></li>
                            <li><a href="/admin/users/create">用户添加</a></li>
                            
                        </ul>
                    </li>

                    
                    <li>
                        <a href="#"><i class="icon-th-list"></i> 分类管理</a>
                        <ul class="closed">
                             <li><a href="/admin/cates">分类列表</a></li>
                            <li><a href="/admin/cates/create">分类添加</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="#"><i class="icon-user"></i> 管理员管理</a>
                        <ul class="closed">
                            <li><a href="/admin/adminuser"> 管理员列表</a></li>
                            <li><a href="/admin/adminuser/create"> 管理员添加</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-users"></i>  角色管理</a>
                        <ul class="closed">
                            <li><a href="/admin/roles"> 角色列表</a></li>
                            <li><a href="/admin/roles/create"> 角色添加</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-exclamation-sign"></i>  权限管理</a>
                        <ul class="closed">
                            <li><a href="/admin/nodes"> 权限列表</a></li>
                            <li><a href="/admin/nodes/create"> 权限添加</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-bag"></i> 商品管理</a>
                        <ul class="closed">
                            <li><a href="/admin/goods"> 商品列表</a></li>
                            <li><a href="/admin/goods/create"> 商品添加</a></li>
                        </ul>
                    </li>

                    <li> 
                        <a href="#"><i class="icon-pictures"></i>轮播图模块</a>
                        <ul class="closed" >
                        
                            <li><a href="/admin/cartoon">浏览轮播图</a></li>
                            <li><a href="/admin/cartoon/create">添加轮播图</a></li>
                            
                        </ul>
                    </li>

                    <li> 
                        <a href="#"><i class="icon-pictures"></i>友情链接模块</a>
                        <ul class="closed">
                        
                            <li><a href="/admin/link">浏览友情链接</a></li>
                            <li><a href="/admin/link/create">添加友情链接</a></li>
                            

                        </ul>
                    </li>

                    <li  class="active"> 
                        <a href="#"><i class="icon-envelope"></i>订单模块</a>
                        <ul  >
                        
                            <li><a href="/admin/order">查看订单</a></li>
                          
                            

                        </ul>
                    </li>
                </ul>
            </div>         
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Inner Container Start -->
            <div class="container">


            @if (Session::has('success'))
                <div class="mws-form-message success">
				    <ul class="alert alert-success"  style="list-style-type:none">
                         <li>{{ Session::get('success') }}</li>
                    </ul>
			    </div>
            @endif 
            @if (Session::has('error'))
                <div class="mws-form-message error" style="list-style-type:none">
				    <ul class="alert alert-danger">
                         <li>{{ Session::get('error') }}</li>
                    </ul>
			    </div>
            @endif 
           
                @section('content')
                    
                @show
                <!-- Panels End -->
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            <div id="mws-footer">
            	Copyright Your Website 2012. All Rights Reserved.
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <script src="/file/js/libs/jquery-1.8.3.min.js"></script>
    <script src="/file/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/file/js/libs/jquery.placeholder.min.js"></script>
    <script src="/file/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="/file/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/file/jui/jquery-ui.custom.min.js"></script>
    <script src="/file/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/file/plugins/fullcalendar/fullcalendar.min.js"></script>
    <script src="/file/plugins/colorpicker/colorpicker-min.js"></script>
   
   
    <!-- Core Script -->
    <script src="/file/bootstrap/js/bootstrap.min.js"></script>
    <script src="/file/js/core/mws.js"></script>


    <!-- Themer Script (Remove if not needed) -->
    <script src="/file/js/core/themer.js"></script>
 
    <!-- Demo Scripts (remove if not needed) -->
    <script src="/file/js/demo/demo.calendar.js"></script>

    <!-- <script src="/file/plugins/datatables/jquery.dataTables.min.js"></script> -->
    <script src="/file/js/demo/demo.table.js"></script>

    <script src="/file/js/demo/demo.formelements.js"></script>



    <!-- Plugin Scripts -->
    <script src="/file/plugins/select2/select2.min.js"></script>
    <script src="/file/plugins/colorpicker/colorpicker-min.js"></script>
    <script src="/file/plugins/validate/jquery.validate-min.js"></script>
    <script src="/file/plugins/ibutton/jquery.ibutton.min.js"></script>


    <!-- 模态框 -->
    <!-- <script src="/file/js/demo/demo.widget.js"></script> -->

    <!-- ajax -->
    <script>
     $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @section('js')
                    
    @show

</body>
</html>