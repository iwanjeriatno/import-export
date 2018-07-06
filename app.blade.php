<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta id="token" name="csrf-token" value="{{ csrf_token() }}">
    <title>System</title>
    <link rel="shortcut icon" href="{{ public_path('favicon.png') }}" />

    @if(Request::Segment(4) == 'pdf' || Request::Segment(5) == 'pdf')
        <style type="text/css">
            body {
                zoom: 90%;
                font-family: Tahoma, Helvetica, sans-serif;
                font-size: 0.8em;
            }

            .content table {
                width: 100%;
                border-collapse: collapse;
            }

             .content table  tr th{
                background-color: #f1f1f1;
                color: #2a3f54;
                font-size: 1em;
                padding: 5px;
                border-color: #2a3f54;
                border-style: solid;
                border-width: 1px;
                text-align: center;
             }

             .content table  tr td{
                border-color: #2a3f54;
                border-style: solid;
                border-width: 1px;
                padding-left:10px;
             }

             header .title {
                text-align: center;
                margin: 0;
                padding: 0;
             }
             header .title h3 h2 h5 {
                padding: 0 !important;
                margin: 0 !important;
             }
             header .logo {
                    float: left;
             }
             footer {
                position: fixed;
                margin-bottom: 0px;
                bottom: 0px;
                left: 0px;
                right: 0px;
                clear: both;
                background-color: #fff;
                color: #000;
                padding: 5px;
                font-size: 0.8em;
             }

             footer .footer-left {
                float: left;
             }

             footer .float-right {
                text-align: right !important;
                float: right;
                padding-right: 0;
                margin-right: 0;
             }

        </style>
    @endif


  </head>
    <body>
    	<header>
            @if(Request::Segment(4) == 'pdf' || Request::Segment(5) == 'pdf')
                  <div class="logo">
                        <img src="{{ public_path('favicon.png') }}" style="width:120px; height: 50px; padding:0px">
                  </div>
                 <div class="title">
                       {{-- <h3 style="margin:0; color:#2a3f54">{{ Settings::app() }}</h3> --}}
                       <h2 style="margin:5px; color:#1059a8">@yield('title')</h2>
                       <h4 style="margin:0; color:#bfbfbf">{{ Settings::perusahaan() }}</h4>
                </div>
                <br><hr><br>
            @else
                <table>
                    {{-- <tr>
                        <td colspan="10" style="text-align:center">
                            <b style="color:#2a3f54;">{{ Settings::app() }}</b><br>
                        </td>
                    </tr> --}}
                    <tr>
                        <td colspan="10" style="text-align:center">
                            <b style="color:#1059a8; font-size:2em">@yield('title')</b><br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="10" style="text-align:center">
                            <b style="color:#bfbfbf;">{{ Settings::perusahaan() }}</b><br>
                        </td>
                    </tr>
                </table>
            @endif

        </header>

    	<section class="content">
            @yield('content')
        </section><br><br>

        @if(Request::Segment(4) == 'pdf' || Request::Segment(5) == 'pdf')
            <footer>
               <div class="footer-right">
                   <hr>
                    @if(Select::pegawai(Auth::user()->id)->nama_pegawai)
                        <i>Printed By {{ Select::user(Auth::user()->id)->nama_user }} / {{ \Carbon\Carbon::now('Asia/Indonesia')->format('d M Y - h:i:s') }}</i>
                    @else
                        <i>Printed By Administrator / {{ \Carbon\Carbon::now('Asia/Indonesia')->format('d M Y - h:i:s') }}</i>
                    @endif
               </div>
            </footer>
        @endif

    </body>
</html>
