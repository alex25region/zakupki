<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('/css/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/datatables/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">


    <script type="text/javascript" src="{{ asset('/js/jquery-3.4.1.min.js')}}" ></script>
    <script type="text/javascript" src="{{ asset('/js/datatables/jquery.dataTables.min.js')}}" defer></script>
    <script type="text/javascript" src="{{ asset('/js/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('/js/app.js')}}"></script>

</head>
