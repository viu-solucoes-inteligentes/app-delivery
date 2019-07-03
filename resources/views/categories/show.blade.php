@extends('layouts.app')
@section('body_class', 'skin-red-light sidebar-collapse sidebar-mini')
@section('body')
    <section class="content-header">
        <h1>
            Categoria
        </h1>
        {{ \Breadcrumbs::render('categories.show', $category) }}
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('categories._tools')
            <div class="col-md-9">

                <h2><span class="glyphicon glyphicon-list-alt"></span> Detalhes do categoria</h2>
                {!! Form::model( $category,[
                    'route' => ['categories.update', 'category' => $category->id],
                    'method' => 'PUT'])
                !!}

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">
                                <i class="fa fa-fw fa-list"></i>
                                Dados cadastrais</a></li>
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
                                            <td>{{ $category->name  }}</td>
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

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <td>{{ $category->description  }}</td>
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

                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success"><span
                                class="glyphicon glyphicon-ok-sign"></span> Atualizar
                    </a>

                </div>
                <!-- /.tab-content -->
            </div>
            {!! Form::close() !!}
        </div>
    </section>

@endsection
