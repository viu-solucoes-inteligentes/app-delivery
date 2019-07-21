@extends('layouts.app')
@section('body_class', 'skin-red-light sidebar-collapse sidebar-mini')
@section('body')
    <section class="content-header">
        <h1>
            Orderns
        </h1>
        {{ \Breadcrumbs::render('orders.edit', $order) }}
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('orders._tools')
            <div class="col-md-9">
                @include('includes.messages')

                <h2><span class="glyphicon glyphicon-list-alt"></span> Formulário de edição</h2>
                {!! Form::model( $order,[
                    'route' => ['orders.update', 'orders' => $order->id],
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
                                <div class="col-md-9">
                                    <div class="form-group {{ $errors->first('user_id') ? 'has-error' : ''  }} ">
                                        {{ Form::label('user_id', 'Usuário:* ') }}
                                        {{ Form::select('user_id', $users, $order->user_id,  ['class' => 'form-control', 'required', 'placeholder' => 'Selecione uma opção']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('user_id') }}</strong>
                                            </span>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->first('status') ? 'has-error' : ''  }} ">
                                        {{ Form::label('status', 'Status:* ') }}
                                        {{  Form::select('status',['ON' => 'ON', 'OFF' => 'OFF'] , null,  ['class' => 'form-control', 'required',  'placeholder' => 'Selecione uma opção'])  }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->first('product_id') ? 'has-error' : ''  }} ">
                                        {{ Form::label('product_id', 'Produto:* ') }}
                                        {{ Form::select('product_id', $products, $order->product_id,  ['class' => 'form-control', 'required', 'placeholder' => 'Selecione uma opção']) }}
                                        <span class="help-block">
                                                <strong>{{ $errors->first('product_id') }}</strong>
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
