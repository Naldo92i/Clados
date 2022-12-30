<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>ESTA - PANNEAU D'ADMINISTRATION</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('css/font.css')}}" />
    <link href="{{asset('backend/plugins/global/plugins.bundle.css?v=7.2.9')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/style.bundle.css?v=7.2.9')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('custom/flash.css')}}">
    <link rel="shortcut icon" href="{{asset('backend/media/logos/favicon.ico')}}" />
    <style>
        .card {
            box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12) !important;
            font-weight: 400;
        }
    </style>
    <script>(function(h,o,t,j,a,r){ h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)}; h._hjSettings={hjid:1070954,hjsv:6}; a=o.getElementsByTagName('head')[0]; r=o.createElement('script');r.async=1; r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv; a.appendChild(r); })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');</script>
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading" style="background-color: #C1C1C1 !important;">

<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>

<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-row flex-column-fluid page">
        <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center">
                    <div class="col-md-4">
                        <div class="card card-custom col-md-12 p-0">
                            <div style="background-color: black;" class="card-header justify-content-center">
                                <h1 class="text-primary font-weight-bolder mt-5 mb-2 h2 text-uppercase text-center primary-color">
                                    <u>PANNEAU D'ADMINISTRATEUR</u>
                                </h1>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="card-body">
                                    <h1 class="text-primary text-center primary-color">
                                        <span class="flaticon-user fa-3x "></span>
                                    </h1>
                                    @if (Session::has('message'))
                                        <div class="alert alert-success" role="alert">
                                            {{ Session::get('message') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div  style="text-align:center;color:#f00000;" role="alert">
                                            @foreach ($errors->all() as $error)
                                                <strong>{{ $error }}</strong>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                            <div class="input-group-prepend radius-0">
                                                <span class="input-group-text"><i class="flaticon2-mail-1"></i></span>
                                            </div>
                                            <input type="email" class="form-control form-control-lg @error('msisdn') is-invalid @enderror" placeholder="Adresse email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                            <div class="input-group-prepend radius-0">
                                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                                            </div>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe" name="password" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{route('password.request')}}" class="btn btn-link-danger font-weight-bold">Mot de passe oublié ?</a>
                                    </div>

                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-block font-weight-bolder"><i class="flaticon-logout"></i> Connexion</button>
                                    </div>

                                    <div class="separator separator-dark separator-dashed separator-border-2 mt-4 mb-4"></div>

                                    <div class="form-group">
                                        <a href="{{route('welcome')}}" class="btn btn-link-primary primary-color font-weight-bolder"><i class="primary-color flaticon2-back-1"></i> Retour sur le site</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
        <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted font-weight-bold mr-2">2022©</span>
                <a href="#" target="_blank" class="text-dark-75 font-weight-bolder">GRAPPE IT</a>
            </div>
            <div class="nav nav-dark order-1 order-md-2">
                <a href="http://unidevsofts.com" target="_blank" class="nav-link pr-3 pl-0">A propos</a>
            </div>
        </div>
    </div>
</div>







<div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
            </g>
        </svg>
    </span>
</div>



<script>var HOST_URL = "/metronic/theme/html/tools/preview";</script>
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#0BB783", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#D7F9EF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
<script src="{{asset('backend/plugins/global/plugins.bundle.js?v=7.2.9')}}"></script>
<script src="{{asset('backend/plugins/custom/prismjs/prismjs.bundle.js?v=7.2.9')}}"></script>
<script src="{{asset('backend/js/scripts.bundle.js?v=7.2.9')}}"></script>
<script src="{{asset('custom/pace.min.js')}}"></script>
@yield('js')
</body>
</html>
