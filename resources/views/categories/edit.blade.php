@extends('layouts.app')
@section('body_class', 'skin-red-light sidebar-collapse sidebar-mini')
@section('body')
    <section class="content-header">
        <h1>
            Categoria
        </h1>
        {{ \Breadcrumbs::render('categories.edit', $category) }}
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('categories._tools')
            <div class="col-md-9">
                @include('includes.messages')

                <h2><span class="glyphicon glyphicon-list-alt"></span> Formulário de edição</h2>
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
                                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''  }} ">
                                        {{ Form::label('name', 'Categoria:') }}
                                        {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>

                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('description', 'Outras informações:') }}
                                        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </div>
                <div class="pull-right">
                    {{ Form::hidden('id') }}
                    <button type="submit" class="btn btn-success"><span
                                class="glyphicon glyphicon-ok-sign"></span> Atualizar
                    </button>

                    <a href="{{ URL::previous() }}" class="btn btn-danger"><span
                                class="glyphicon glyphicon-remove-sign"></span> Cancelar
                    </a>

                </div>
                <!-- /.tab-content -->
            </div>
            {!! Form::close() !!}
        </div>
    </section>

@endsection
