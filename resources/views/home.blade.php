
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div>
   <h1 class="text-center">Sistema de Estoque</h1> 
</div>

@stop

@section('content')
<div class="container-xxl d-flex justify-content-center">
    <div class="col-md-8 border bg-white rounded shadow">
        <div class="p-5 ">
            <div class="row">
                <div class="col-sm-6 p-2" style="height: 200px">
                    <button class="btn   btn-primary h-100 w-100">
                        <h3>Fazer pedido</h3>
                    </button>
                </div>
                <div class="col-sm-6 p-2" style="height: 200px">
                    <button class="btn  btn-primary  h-100 w-100">
                        <h3>Inserir Produtos</h3>
                    </button>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6 p-2" style="height: 200px">
                    <button class="btn  btn-primary  h-100 w-100">
                        <h3>Inserir Produtos</h3>
                    </button>
                </div>
                <div class="col-sm-6 p-2" style="height: 200px">
                    <button class="btn  btn-primary  h-100 w-100">
                        <h3>Relatórios</h3>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
