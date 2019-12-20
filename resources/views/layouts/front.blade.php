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
        <!-- PAGE CONTENT -->
        <div class="page-content">
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
