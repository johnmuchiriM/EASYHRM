<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="">
    <link rel="icon" href="{{getConfig('config_app_favicon_icon') ?? '' }}" type="image/gif" sizes="16x16">

    <title>404</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url('404/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="{{url('404/css/style.css')}}" rel="stylesheet">

</head>

<body>
    <div class="container text-center">
        <h1 class="head" style="margin-top:100px;"><span>404</span></h1>
        <p>{{ __('global-lang.oops-page-is-not-found') }}</p>
        <a href="{{url('/')}}" class="btn-outline"> {{__('global-lang.back-to-home')}}</a>
    </div>
</body>

</html>