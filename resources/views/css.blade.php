<link href="{{ URL::asset('/') }}static/inspinia/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ URL::asset('/') }}static/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="{{ URL::asset('/') }}static/inspinia/css/animate.css" rel="stylesheet">
<link href="{{ URL::asset('/') }}static/inspinia/css/plugins/codemirror/codemirror.css" rel="stylesheet">
<link href="{{ URL::asset('/') }}static/inspinia/css/plugins/codemirror/ambiance.css" rel="stylesheet">
<link href="{{ URL::asset('/') }}static/inspinia/css/style.css" rel="stylesheet">
<link href="{{ URL::asset('/') }}static/inspinia/css/dataTables.bootstrap.css" rel="stylesheet">
<style>
    .table {
        margin-bottom: 0;
    }

    .TITLE {
        margin: 0 -15px;
        color: #fff;
        font-size: 18px;
        text-align: center;
        margin-bottom: 15px;
        padding: 10px;
    }

    .dataTable {
        margin-bottom: 10px;
    }

    .BOX {
        background: #fff;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #e5e6e7;
    }

    .BOX-20 {
        background: #fff;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #e5e6e7;
    }

    .Ckb-20 {
        width: 20px;
        height: 20px;
    }

    .Pd-10 {
        padding: 10px;
    }

    .Pd-20 {
        padding: 20px;
    }


    .Mb-10 {
        margin-bottom: 10px;
    }

    .Mb-20 {
        margin-bottom: 20px;
    }

    #side-menu {
        font-size: 14px;
    }

    .nav>li>a {
        font-weight: normal !important;
    }

    .visible-block {
        display: none !important;
    }

    @media screen and (max-width:768px) {
        .visible-block {
            display: block !important;
        }
    }

    td {
        vertical-align: middle !important;
    }

    h1,
    h2 {
        margin: 0;
    }

    input[type="checkbox"] {
        vertical-align: middle;
        margin-top: -3px;
    }

    input[type="text"],
    input[type="password"],
    textarea {
        -webkit-appearance: none;
    }

    label {
        font-weight: normal;
    }

    #table_filter {
        float: left;
    }

    #table_paginate {
        float: none;
    }

    #table_info {
        text-align: center;
        margin-bottom: 10px;
    }

    #table_wrapper {
        padding: 0;
    }

    table.dataTable {
        width: 100% !important;
    }

    ul {
        margin-top: 2px;
        margin-bottom: 2px;
        text-align: left;
    }
</style>