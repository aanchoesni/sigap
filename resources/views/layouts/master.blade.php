<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <meta name="description" content="Profile Alumni Unesa">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>SIGAP</title>

        {{-- {!! Html::style("", array('type'=>'image/x-icon', 'rel'=>'shortcut icon')) !!} --}}
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" href="{!! asset('backend/css/theme-default.css') !!}">
        <link rel="stylesheet" href="{!! asset('backend/js/sw/dist/sweetalert.css') !!}">
        <!-- EOF CSS INCLUDE -->
        @yield('assets')
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-top-fixed">

            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar page-sidebar-fixed scroll">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="{{URL::to('/')}}">SIGAP</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <div class="profile">
                            <div class="profile-data">
                                <div class="profile-data-name">{{Auth::user()->name}}</div>
                                <div class="profile-data-title">{{Auth::user()->role}}</div>
                            </div>
                        </div>
                    </li>
                    <li class="xn-title">Menu</li>
                    {{-- @if(Auth::user()->role == 'admin') --}}
                      @include('layouts.navigations.admin')
                    {{-- @endif
                    @if(Auth::user()->role == 'laman')
                      @include('layouts.navigations.laman')
                    @endif --}}
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->

            <!-- PAGE CONTENT -->
            <div class="page-content">
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
                    </li>
                    <!-- END SIGN OUT -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb push-down-0">
                    @yield('breadcrumbs')
                </ul>
                <!-- END BREADCRUMB -->

                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">

                    <div class="row">
                        <div class="col-md-12">
                            @include('layouts.partials.alert')
                            @include('layouts.partials.validation')
                            @yield('content')
                        </div>
                    </div>

                </div>
                <!-- END PAGE CONTENT WRAPPER -->
            </div>
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Apakah Anda yakin ingin keluar dari halaman admin?</p>
                        <p>Pilih Batal jika Anda tidak ingin meninggalkan halaman admin. Pilih Keluar untuk keluar halaman admin.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" class="btn btn-success btn-lg">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            <button class="btn btn-default btn-lg mb-control-close">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{!!asset('backend/audio/alert.mp3') !!}" preload="auto"></audio>
        <audio id="audio-alert" src="{!!asset('backend/audio/fail.mp3') !!}" preload="auto"></audio>
        <!-- END PRELOADS -->

    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{!!asset('backend/js/plugins/jquery/jquery.min.js') !!}"></script>
        <script type="text/javascript" src="{!!asset('backend/js/plugins/jquery/jquery-ui.min.js') !!}"></script>
        <script type="text/javascript" src="{!!asset('backend/js/plugins/bootstrap/bootstrap.min.js') !!}"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
        <script type="text/javascript" src="{!!asset('backend/js/plugins/icheck/icheck.min.js') !!}"></script>
        <script type="text/javascript" src="{!!asset('backend/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js') !!}"></script>
        @yield('script')
        <!-- END THIS PAGE PLUGINS-->

        <script type="text/javascript" src="{!!asset('backend/js/plugins.js') !!}"></script>
        <script type="text/javascript" src="{!!asset('backend/js/actions.js') !!}"></script>
        <script type="text/javascript" src="{!!asset('backend/js/sw/dist/sweetalert.min.js') !!}"></script>
        @include('sweet::alert')
        @yield('scriptbottom')
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->
    </body>
</html>
