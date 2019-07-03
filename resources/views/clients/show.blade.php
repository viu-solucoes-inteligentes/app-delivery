@extends('layouts.app')
@section('body_class', 'skin-red-light sidebar-collapse sidebar-mini')
@section('body')
    <section class="content-header">
        <h1>
            Clientes
        </h1>
        {{ \Breadcrumbs::render('clients.show', $client) }}
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('clients._tools')
            <div class="col-md-9">

                <h2><span class="glyphicon glyphicon-list-alt"></span> Detalhes </h2>
                {!! Form::model( $client,[
                    'route' => ['clients.update', 'client' => $client->id],
                    'method' => 'PUT'])
                !!}

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">
                                <i class="fa fa-fw fa-list"></i>
                                Sobre o usuário</a></li>
                        <li class=""><a href="#tab1" data-toggle="tab" aria-expanded="false"> <i
                                        class="fa fa-fw fa-sticky-note"></i> Dados pessoais </a>
                        </li>

                        <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"> <i
                                        class="fa fa-fw fa-sticky-note"></i> Outras informações </a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <div class="row">

                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <td width="50px"><strong>Nome:</strong></td>
                                            <td>{{ $client->user->name  }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50px"><strong>Email:</strong></td>
                                            <td>{{ $client->user->email  }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50px"><strong>Tipo:</strong></td>
                                            <td>{{ $client->type == "PJ" ? "Pessoa jurídica" : "Pessoa física"  }}</td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab1">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <td width="50px"><strong>Endereço:</strong></td>
                                            <td>{{ $client->address  }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50px"><strong>Cidade:</strong></td>
                                            <td>{{ $client->city  }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50px"><strong>Estado:</strong></td>
                                            <td>{{ $client->state  }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50px"><strong>Email:</strong></td>
                                            <td>{{ $client->email  }}</td>
                                        </tr>
                                        <tr>
                                            <td width="50px"><strong>URL:</strong></td>
                                            <td>{{ $client->website  }}</td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <td>{{ $client->description  }}</td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </div>
                <div class="pull-right">
                    <a href="{{ URL::previous() }}" class="btn btn-danger"><span
                                class="glyphicon glyphicon-chevron-left"></span> Voltar
                    </a>

                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-success"><span
                                class="glyphicon glyphicon-ok-sign"></span> Atualizar
                    </a>

                </div>
                <!-- /.tab-content -->
            </div>
            {!! Form::close() !!}
        </div>
    </section>

@endsection
