<?php
if (!Sentry::check())
{

} else {
    $user = Sentry::getUser();
    $user_id = $user->id;
    $user_name = $user->first_name.' '.$user->last_name;
    $username = $user->username;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A layout example with a side menu that hides on mobile, just like the Pure website.">
<title>With Heartfelt Thanks</title>
<style type="text/css">
@font-face 
{
    font-family: thumbs;
    src: url("{{url('css/thumbs.otf')}}");
}
body *{
    font-family: thumbs;
}
li > a:hover {
    text-decoration: none;
}
#name-search:focus ~ .suggestions{
    display: block;
}
</style>


<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.min.js"></script>
{{HTML::style('css/style.css')}}
{{HTML::style('css/main.css')}}
{{HTML::style('css/layouts/side-menu.css')}}
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
            <a class="pure-menu-heading" href="wall">with heartfelt thanks</a>

            <ul>
                @if(!Sentry::check())
                <li><a href="{{url('login')}}">Login</a></li>
                <li><a href="{{url('register')}}">Register</a></li>
                @else
                <li><a href="{{url('wall')}}">Wall</a></li>
                <li><a href='{{url("profile/$username")}}'>{{$user_name}}</a></li>
                <li><a href="{{url('settings')}}">Account Settings</a></li>
                <li><a href="{{url('logout')}}">Logout</a></li>
                <li><a href="{{url('tv')}}">TV Mode</a></li>
                <li class="menu-item-divided">
                <div class="create">
                <script type="text/javascript">

                </script>
                {{Form::open(array(
                'url'=>'thumb',
                'class'=>'pure-form pure-form-stacked left-wall'
                ))}}
                <fieldset>
                    <label for="name">With Heartfelt Thanks</label>
                    @if(Session::has('error'))
                    <input type="text" id="name-search" onBlur="javascript:unfocus()" name="name" placeholder="Name" autocomplete="off" style="border:1px solid red;" class="name" />
                    @else
                    <input type="text" id="name-search" onBlur="javascript:unfocus()" name="name" placeholder="Name" autocomplete="off" class="name" />
                    @endif
                    <div class="suggestions">
                    </div>
                    <textarea id="post" name="post" placeholder="Comment" style="width: 100%;resize: none; "></textarea>
                    <input type="text" name="tags" placeholder="Tags Separated by Commas" style="width: 100%" />
                    <input type="submit" class="pure-button pure-button-primary" value="Post" />
                </fieldset>
                {{Form::close()}}
                </div>
                </li>
                @endif
            </ul>
        </div>
    </div>

    <div id="main">

        <div class="content">
        @yield('content')

         </div>
</div>





<script src="js/ui.js"></script>
<script type="text/javascript">
function unfocus(){
    if ($('.suggestions:hover').length != 0) {$('#name-search').focus()}
    else{
        $(".suggestions").css("display", "none");
    };
};
$('.suggestions').click(function(){
    $('#name-search').val($('.suggestions div:hover span').html());
    $(".suggestions").css("display", "none");
    $('#name-search').blur();
});
$(document).ready(function(){
    

    $('#name-search').keyup(function(){
        search();
    });
    $('#name-search').focus(function(){
        $(".suggestions").css("display", "block");
    })
    
    function search() {
        var query_value = $('#name-search').val();
        if (query_value !== ''){
            $.ajax({
                type: "GET",
                url: "{{url('getnames')}}",
                data: {q: query_value},
                cache: false,
                success: function(html){
                    //alert(html);
                    $(".suggestions").html(html);
                }
            });
        } return false;
    }
});

</script>


</body>
</html>
