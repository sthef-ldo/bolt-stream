@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

{{-- Agrega esta sección para ocultar la sidebar --}}
@section('classes_body', 'sidebar-hidden')

@section('content')
    <p>Welcome to this beautiful admin panel.</p> <br>
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Default Card Example</h3>
                </div>
                <div class="card-body">
                    The body of the card
                </div>
                <div class="card-footer">
                    The footer of the card
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css"> 
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
