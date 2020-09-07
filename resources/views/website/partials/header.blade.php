<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#ed414e">
    <meta name="description" content="set your ih address">
    <meta property="og:site_name" content="ihaddress.Com">
    <meta property="og:url" content=" www.ihaddress.com">
    <meta property="og:image" content="images/favicon.png">
    <meta name="robots" content="index,follow,max-snippet:100">
    <meta name="googlebot" content="index,follow,max-snippet:100">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <title>IH Address</title>

    <link rel="stylesheet" href="{{asset('css')}}/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css')}}/all.min.css">
    <link rel="stylesheet" href="{{asset('css')}}/line-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css')}}/animate.css">
    <link rel="stylesheet" href="{{asset('css')}}/style-min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

@stack('css')

    <style>

        #map {
            height: 100%;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

<!-- YOUR CUSTOM CSS -->
{{--    <link href="{{asset('css/website')}}/custom.css" rel="stylesheet">--}}

</head>
