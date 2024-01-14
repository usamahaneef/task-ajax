<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$title ?? ''}}</title>
    
    <link rel="icon" type="image/png" href="{{asset('assets/img/favicon.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset('assets/plugins')}}/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/adminlte.min.css">
    <link rel="stylesheet" href="{{asset('assets/plugins')}}/toastr/toastr.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/custom.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/emojionearea/dist/emojionearea.min.css">
    @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<div class="wrapper">
    <div class="container">
        <nav class="d-flex justify-content-between py-3">
            <h4><a class="text-secondary" href=""><i class="fas fa-clipboard"></i> Tasks</a></h4>
        </nav>
    </div>

    @yield('content')
    <footer class="main-footer border-0">
        <strong>Copyright &copy; {{@date('Y')}}</strong> All rights reserved.
    </footer>
</div>
<script src="{{asset('assets/plugins')}}/jquery/jquery.min.js"></script>
<script src="{{asset('assets/plugins')}}/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('assets/plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('assets')}}/js/adminlte.min.js"></script>
<script src="{{asset('assets/plugins')}}/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script src="{{asset('assets/plugins')}}/toastr/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/emojionearea/dist/emojionearea.min.js"></script>
@stack('script')
<script>
    $(function () {
        $('.bt-switch').bootstrapSwitch();
        toastr.options = {
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "fadeIn": 300,
            "fadeOut": 1000,
            "timeOut": 5000,
            "extendedTimeOut": 1000
        }
        @if(session()->has('success'))
            toastr.success('{{session()->get('success')}}')
        @endif
        @if(session()->has('error'))
            toastr.error('{{session()->get('error')}}')
        @endif
    })

    $(function(){
        if ("{{ session()->has('modal') ?? '0'}}" == "1") {
            $("#{{session()->get('modal')}}").modal('show');
        }
    })
</script>
</body>
</html>
