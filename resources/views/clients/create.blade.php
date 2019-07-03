@extends('layouts.app')
@section('body_class', 'skin-red-light sidebar-collapse sidebar-mini')
@section('body')
    <section class="content-header">
        <h1>
            Clientes
        </h1>
        {{ \Breadcrumbs::render('clients.create') }}
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('clients._tools')
            <div class="col-md-9">
                @include('includes.messages')

                <h2><span class="glyphicon glyphicon-list-alt"></span> Formulário de cadastro</h2>
                {!! Form::open(['route' => 'clients.store', 'id' => 'form', 'enctype'=>'multipart/form-data']) !!}

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
                                <div class="col-md-9">
                                    <div class="form-group {{ $errors->first('user_id') ? 'has-error' : ''  }} ">
                                        {{ Form::label('user_id', 'Usuário:* ') }}
                                        {{ Form::select('user_id', $users, '',  ['class' => 'form-control', 'required', 'placeholder' => 'Selecione uma opção']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('user_id') }}</strong>
                                            </span>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->first('type') ? 'has-error' : ''  }} ">
                                        {{ Form::label('type', 'Tipo:* ') }}
                                        {{  Form::select('type',['PJ' => 'Pessoa juridica', 'PF' => 'Pessoa física'] , null,  ['class' => 'form-control', 'required',  'placeholder' => 'Selecione uma opção'])  }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('type') }}</strong>
                                            </span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->first('address') ? 'has-error' : ''  }} ">
                                        {{ Form::label('address', 'Endereço:* ') }}
                                        {{ Form::text('address', null,  ['class' => 'form-control', 'required', 'placeholder' => 'Selecione uma opção']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->first('city') ? 'has-error' : ''  }} ">
                                        {{ Form::label('city', 'Cidade:* ') }}
                                        {{ Form::text('city', null, ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->first('state') ? 'has-error' : ''  }} ">
                                        {{ Form::label('state', 'Estado:* ') }}
                                        {{ Form::text('state', null, ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->first('zipcode') ? 'has-error' : ''  }} ">
                                        {{ Form::label('zipcode', 'CEP:* ') }}
                                        {{ Form::text('zipcode', null, ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('zipcode') }}</strong>
                                            </span>

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->first('website') ? 'has-error' : ''  }} ">
                                        {{ Form::label('website', 'URL:* ') }}
                                        {{ Form::text('website', null, ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->first('email') ? 'has-error' : ''  }} ">
                                        {{ Form::label('email', 'E-mail:* ') }}
                                        {{ Form::text('email', null, ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->first('phone') ? 'has-error' : ''  }} ">
                                        {{ Form::label('phone', 'Celular:* ') }}
                                        {{ Form::text('phone', null, ['class' => 'form-control', 'required']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
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
