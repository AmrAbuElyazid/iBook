<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>iBook</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <script type="text/javascript" src="{{url('/js/angular.min.js')}}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/organicfoodicons.css')}}" />
    <!-- demo styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/demo.css')}}" />
    <!-- menu styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/component.css')}}" />
    <script src="{{ asset('js/modernizr-custom.js')}}"></script>

    <script src="{{ asset('sweetalert/sweetalert.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('sweetalert/sweetalert.css') }}"></link>
    <script src="{{ asset('js/app.js') }}"></script>

</head>
<body>


    @if (Auth::check())
        <div style="width: 100%; margin-right: 0 !important;" class="container">
            <!-- Blueprint header -->
{{--             <header class="bp-header cf">
                <div class="dummy-logo">
                    <div class="dummy-icon foodicon foodicon--coconut"></div>
                    <h2 class="dummy-heading"></h2>
                </div>
            </header>
 --}}            <button class="action action--open" aria-label="Open Menu"><span class="icon icon--menu"></span></button>
            <nav id="ml-menu" class="menu">
                <button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
                <div class="menu__wrap" style="text-align: right !important;">
                    <ul data-menu="main" class="menu__level" tabindex="-1" role="menu" aria-label="All">
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="{{url('new_user')}}">ﺇﺿﺎﻓﻪ ﻋﻀﻮ ﺟﺪﻳﺪ</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="{{url('users/get')}}">إداره الاعضاء الحاليين</a></li>
                        <hr style="width: 60%">
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="{{url('upload_books')}}">ﺇﺿﺎﻓﻪ ﻛﺘﺎﺏ ﺟﺪﻳﺪ</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="{{url('all_books')}}">ﻋﺮﺽ ﻛﻞ اﻟﻜﺘﺐ اﻟﻤﺮﻓﻮﻋﻪ</a></li>
                        <li class="menu__item" role="menuitem"><a class="menu__link" href="{{url('problems')}}">عرض كل المشاكل   </a></li>
                    </ul>
                </div>
            </nav>
            <div class="content">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="/">المكتبه الرقميه</a>
                        </div>            
                    </div>
                </nav>
                <div style="margin-top: 10%">
                    @yield('content')
                </div>
            </div>
        </div>
    @else
        <div class="container">
        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}" style="margin-top: 5%">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Password</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

{{--             <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}><span style="margin-left: 15px;"> تذكرني</span>
                        </label>
                    </div>
                </div>
            </div>
 --}}
 <hr>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" style="width: 100%">
                        Login
                    </button>

                </div>
            </div>
        </form>
        </div>
    @endif
    <!-- /view -->
    <script src="{{asset('js/classie.js')}}"></script>
    <script src="{{asset('js/dummydata.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script>
    (function() {
        var menuEl = document.getElementById('ml-menu'),
            mlmenu = new MLMenu(menuEl, {
                // breadcrumbsCtrl : true, // show breadcrumbs
                // initialBreadcrumb : 'all', // initial breadcrumb text
                backCtrl : false, // show back button
                // itemsDelayInterval : 60, // delay between each menu item sliding animation
                onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
            });

        // mobile menu toggle
        var openMenuCtrl = document.querySelector('.action--open'),
            closeMenuCtrl = document.querySelector('.action--close');

        openMenuCtrl.addEventListener('click', openMenu);
        closeMenuCtrl.addEventListener('click', closeMenu);

        function openMenu() {
            classie.add(menuEl, 'menu--open');
            closeMenuCtrl.focus();
        }

        function closeMenu() {
            classie.remove(menuEl, 'menu--open');
            openMenuCtrl.focus();
        }

        // simulate grid content loading
        var gridWrapper = document.querySelector('.content');

        function loadDummyData(ev, itemName) {
            ev.preventDefault();
            closeMenu();
            gridWrapper.innerHTML = '';
            classie.add(gridWrapper, 'content--loading');
            setTimeout(function() {
                classie.remove(gridWrapper, 'content--loading');
                window.location = ev.target.href;
            }, 500);
        }
    })();
    </script>

    <!-- Scripts -->
</body>
</html>
