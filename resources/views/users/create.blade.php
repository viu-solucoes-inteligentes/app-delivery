@extends('layouts.app')
@section('body_class', 'skin-red-light sidebar-collapse sidebar-mini')
@section('body')
    <section class="content-header">
        <h1>
            Usuários
        </h1>
        {{ \Breadcrumbs::render('users.create') }}
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('users._tools')
            <div class="col-md-9">
                @include('includes.messages')

                <h2><span class="glyphicon glyphicon-list-alt"></span> Formulário de cadastro</h2>
                {!! Form::open(['route' => 'users.store', 'id' => 'form']) !!}

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">
                                <i class="fa fa-fw fa-list"></i>
                                Dados cadastrais</a></li>

                        <li class=""><a href="#tab1" data-toggle="tab" aria-expanded="false"> <i
                                        class="fa fa-fw fa-unlock-alt"></i> Segurança </a>
                        </li>

                        <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"> <i
                                        class="fa fa-fw fa-sticky-note"></i> Outras informações </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''  }} ">
                                        {{ Form::label('name', 'Nome:* ') }}
                                        {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->first('status') ? 'has-error' : ''  }} ">
                                        {{ Form::label('role', 'Tipo:* ') }}
                                        {{  Form::select('role',['1' => 'Administrador', '2' => 'Usuário'] , null,  ['class' => 'form-control', 'required',  'placeholder' => 'Selecione uma opção'])  }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('role') }}</strong>
                                            </span>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group {{ $errors->first('email') ? 'has-error' : ''  }} ">
                                        {{ Form::label('email', 'E-mail:*') }}
                                        {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->first('password') ? 'has-error' : ''  }} ">
                                        {{ Form::label('password', 'Senha:*') }}
                                        {{ Form::password('password', ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->first('password_confirmation') ? 'has-error' : ''  }} ">
                                        {{ Form::label('password_confirmation', 'Confirmação da senha:* ') }}
                                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab2">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('descricao', 'Outras informações:') }}
                                        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /.tab-pane -->
                    </div>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-save"></i>
                        Salvar
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
