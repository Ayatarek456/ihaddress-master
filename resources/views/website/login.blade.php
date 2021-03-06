@extends('website.layouts.layout')



@section('content')
    <div class="map">
        <!-- <iframe
          src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d55306.73397503105!2d30.938824844379333!3d29.960144228369224!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1593018615850!5m2!1sen!2seg"
          width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
          tabindex="0"></iframe> -->
    </div>
    <!------------------end the map element------------------->
    <!---------------------map options ----------------------->
    <nav class="mapOptions">
        <div class="mapMenu">
            <form class="formSearch">
                <ul class='menuNav'>
                    <li><a href="#" class="iconItem"><img src="images/ih-satellite.png" alt="satellite view"></a></li>
                    <li><a href="#" class="iconItem"><img src="images/ih-crosshairs.png" alt="track ur location"></a></li>
                    <li class="searchMap">
                        <div class='form-group'>
                            <input type="text" id="searchInput" class="form-control searchInput">
                            <a href="#" class="iconItem search"><img src="images/ih-search.png" alt="search"></a>
                            <a href="#" class="iconItem cancel" style="display: none;"><img src="images/ih-cancel.png"
                                                                                            alt="search"></a>
                        </div>
                    </li>
                    <li class="setAddress" data-trigger="#navbar_main">
                        <a href="#"><img alt="logo" src="images/ih-logo.png">
                            Set your IH address </a>
                    </li>
                    <li>
                        <button class="navbar-toggler navbar-toggler-right bg-color" type="button" data-toggle="collapse"
                                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                        </button>
                        <div class="collapse navbar-collapse text-left bg-light" id="navbarResponsive">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#">About IH</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#">Developers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </form>
        </div>
        <!-----------------the offCanvas - left side bar------------------->
        <div class="mobile-offcanvas" id='navbar_main'>
            <div class="mapSideMenu">
                <div class="offcanvas-header">
                    <button class="float-right"><i class="las la-ellipsis-v"></i></button>
                </div>
                <div class="mapSideWrapper setAddressForm h-100">
                    <div class="row align-items-center">
                        <div class="col-12 p-5">
                            <div class="text-center my-5">
                                <img src="images/ih-logo.png" class="img-fluid"><br>
                                <p class="text-logo">international home address</p>
                            </div>
                            <div class="social-media"><a href="#" aria-label="facebook"><i class="fab fa-facebook-f"></i><span
                                        class="pl-2"></span>CONTINUE WITH FACEBOOK</span></a></div>
                            <div class="social-media"><a href="#" aria-label="google"><i class="fab fa-google"></i><span
                                        class="pl-2">CONTINUE WITH GMAIL</span></a></div>
                            <div class="social-media"><a href="#" aria-label="twitter"><i class="fab fa-twitter"></i><span
                                        class="pl-2">CONTINUE WITH twitter</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endsection

@push('css')
@endpush
@push('js')
@endpush
