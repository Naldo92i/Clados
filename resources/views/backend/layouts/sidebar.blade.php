<div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto" id="kt_aside">
    <div class="brand flex-column-auto " id="kt_brand">
        <a href="{{route('home')}}" class="brand-logo">
            <span class="text-uppercase text-white font-size-lg">
                <img src="{{asset('custom/configs/'.$configs->logo)}}" style="width: 170px" alt="">
            </span>
        </a>

        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
                        <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
                    </g>
                </svg>
            </span>
        </button>
    </div>
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="aside-menu my-4 scroll ps ps--active-y" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="height: 167px; overflow: hidden;">
            <ul class="menu-nav" style="padding: 0px !important;">
                <li class="menu-section">
                    <div class="d-flex align-items-center mb-10">
                        <div class="symbol symbol-40 symbol-light-primary mr-5">
                            <span class="symbol-label">
                                <span class="flaticon-user fa-2x primary-color"></span>
                            </span>
                        </div>

                        <div class="d-flex flex-column font-weight-bold">
                            <span class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg text-uppercase">
                                <a class="text-white mb-1 font-size-lg">Espace :</a>
                                <span class="label label-lg font-size-lg label-light-primary label-inline">{{Auth::user()->roles[0]['display_name']=='Personnel'?'Employé':Auth::user()->roles[0]['display_name']}}</span>
                            </span>
                        </div>
                    </div>
                </li>

                <div class="separator separator-dashed separator-white"></div>

                <li class="menu-item {{ Request::routeIs('home') ? ' menu-item-active' : '' }} " aria-haspopup="true" >
                    <a  href="{{route('home')}}" class="menu-link ">
                        <span class="flaticon-home menu-icon icon-lg"></span>
                        <span class="menu-text font-weight-bolder">Tableau de bord</span>
                    </a>
                </li>

                @permission('local-lire')
                <li class="menu-item {{ Request::routeIs('locaux.index') ? ' menu-item-active' : '' }}" aria-haspopup="true" >
                    <a  href="{{ route('locaux.index') }}" class="menu-link ">
                        <span class="flaticon-tabs menu-icon icon-lg"></span>
                        <span class="menu-text font-weight-bolder">Locaux</span>
                    </a>
                </li>
                @endpermission

                @permission('etagere-lire')
                <li class="menu-item" aria-haspopup="true" >
                    <a  href="{{ route('etagere.index') }}" class="menu-link">
                        <span class="flaticon2-cube-1 menu-icon icon-lg"></span>
                        <span class="menu-text font-weight-bolder">Etagères</span>
                    </a>
                </li>
                @endpermission

                @permission('niveau-lire')
                <li class="menu-item" aria-haspopup="true" >
                    <a  href="{{ route('niveau.index') }}" class="menu-link ">
                        <span class="flaticon-plus menu-icon icon-lg"></span>
                        <span class="menu-text font-weight-bolder">Niveaux</span>
                    </a>
                </li>
                @endpermission

                @permission('classeur-lire')
                <li class="menu-item" aria-haspopup="true" >
                    <a  href="{{ route('classeur.index') }}" class="menu-link ">
                        <span class="flaticon-information menu-icon icon-lg"></span>
                        <span class="menu-text font-weight-bolder">Classeurs</span>
                    </a>
                </li>
                @endpermission

                @permission('document-lire')
                <li class="menu-item" aria-haspopup="true" >
                    <a  href="{{ route('document.index') }}" class="menu-link ">
                        <span class="flaticon-information menu-icon icon-lg"></span>
                        <span class="menu-text font-weight-bolder">Documents</span>
                    </a>
                </li>
                @endpermission

                @permission('utilisateur-lire|apropos-lire|role-lire|log-lire|instruction-lire')
                <li class="menu-item  menu-item-submenu
                        {{ Request::routeIs('users.index') ? ' menu-item-open' : '' }}
                        {{ Request::routeIs('config.index') ? ' menu-item-open' : '' }}
                        {{ Request::routeIs('cities.index') ? ' menu-item-open' : '' }}
                        {{ Request::routeIs('logs.index') ? ' menu-item-open' : '' }}
                        {{ Request::routeIs('permissions.index') ? ' menu-item-open' : '' }}
                        {{ Request::routeIs('roles.index') ? ' menu-item-open' : '' }}" aria-haspopup="true"  data-menu-toggle="hover">
                        <a  href="javascript:;" class="menu-link menu-toggle">
                            <span class="flaticon-cogwheel-1 icon-lg menu-icon"></span>
                            <span class="menu-text font-weight-bolder">Paramètres</span>
                            <i class="menu-arrow"></i>
                        </a>
                    <div class="menu-submenu ">
                        <i class="menu-arrow"></i>
                        <ul class="menu-subnav">
                            
                            @permission('utilisateur-lire')
                            <li class="menu-item {{ Request::routeIs('users.index') ? ' menu-item-active' : '' }}" aria-haspopup="true" >
                                <a  href="{{route('users.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text font-weight-bolder">Utilisateurs</span>
                                </a>
                            </li>
                            @endpermission

                            @permission('config-lire')
                            <li class="menu-item {{ Request::routeIs('config.index') ? ' menu-item-active' : '' }}" aria-haspopup="true" >
                                <a  href="{{route('config.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text font-weight-bolder">Configurations</span>
                                </a>
                            </li>
                            @endpermission
                            
                            @permission('role-lire')
                            <li class="menu-item {{ Request::routeIs('roles.index') ? ' menu-item-active' : '' }}" aria-haspopup="true" >
                                <a  href="{{route('roles.index')}}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text font-weight-bolder">Rôles</span>
                                </a>
                            </li>
                            @endpermission
                            
                            @permission('log-lire')
                            <li class="menu-item {{ Request::routeIs('logs.index') ? ' menu-item-active' : '' }}" aria-haspopup="true" >
                                <a  href="{{route('logs.index')}}" class="menu-link ">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="menu-text font-weight-bolder">Logs</span>
                                </a>
                            </li>
                            @endpermission
                        </ul>
                    </div>
                </li>
                @endpermission

                @permission('profil-lire')
                <li class="menu-item  {{ Request::routeIs('profile.index') ? ' menu-item-active' : '' }}" aria-haspopup="true" >
                    <a  href="{{route('profile.index')}}" class="menu-link ">
                        <span class="flaticon-user icon-lg menu-icon"></span>
                        <span class="menu-text font-weight-bolder">Mon profil</span>
                    </a>
                </li>
                @endpermission
            </ul>
        </div>
    </div>
</div>
