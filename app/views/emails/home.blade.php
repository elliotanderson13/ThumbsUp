<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">

    <title>Side Menu &ndash; Layout Examples &ndash; Pure</title>

    






<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">





<link rel="stylesheet" href="css/layouts/side-menu.css">




    

    

</head>
<body>






<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu">
        <div class="pure-menu pure-menu-open">
            <a class="pure-menu-heading" href="http://purecss.io/">Thumbs Up</a>

            <ul>
                <li><a href="profile.html">Profile</a></li>
                <li><a href="index.html">Wall</a></li>
            </ul>
        </div>
    </div>

    <div id="main">

        <div class="content">
        @yield('content')

         </div>
</div>





<script src="js/ui.js"></script>


</body>
</html>
