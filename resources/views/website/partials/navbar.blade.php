<header class="header menu_fixed">
    <div id="preloader">
        <div data-loader="circle-side"></div>
    </div><!-- /Page Preload -->
    <div id="logo">
        <a href="{{route('home')}}">
            <img src="{{asset('')}}img/logo.svg" width="150" height="36" alt="" class="logo_normal">
            <img src="{{asset('')}}img/logo_sticky.svg" width="150" height="36" alt="" class="logo_sticky">
        </a>
    </div>

    <!-- /top_menu -->
    <a href="#menu" class="btn_mobile">
        <div class="hamburger hamburger--spin" id="hamburger">
            <div class="hamburger-box">
                <div class="hamburger-inner"></div>
            </div>
        </div>
    </a>
    <nav id="menu" class="main-menu">
        <ul>
            <li><span><a href="{{route('home')}}">الرئيسية</a></span></li>
            @if(auth()->check())
                @if(auth()->user()->hasRole('admin'))
                    <li><span><a href="{{route('voyager.dashboard')}}">لوحة التحكم</a></span></li>
                @elseif(auth()->user()->hasRole('provider_owner'))
                    <li><span><a href="{{route('dashboard')}}">لوحة التحكم</a></span></li>

                @else
                    <li><span><a href="{{route('website.appointments')}}">حجوزاتي</a></span></li>
                    <li><span><a href="{{route('website.profile')}}">الصفحة الشخصية</a></span></li>

                @endif


                <li><span><a href="{{route('logout')}}"
                             onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                             id="sign-in" class="login" title="Sign In">تسجيل الخروج</a></span>
                </li>
            @else
                <li><span><a href="{{route('login')}}" id="" class="login" title="Sign In">تسجيل الدخول</a></span>
                </li>
                <li><span><a href="{{ route('register') }}">تسجيل جديد</a></span></li>
            @endif


        </ul>
    </nav>

</header>
<!-- /header -->


<form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
   @csrf
</form>
