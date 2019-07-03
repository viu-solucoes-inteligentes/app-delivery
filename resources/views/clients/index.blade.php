@extends('layouts.app')
@section('body_class', '')
@section('body')
    <section class="content-header">
        <h1>
            Clientes
        </h1>
        {{ \Breadcrumbs::render('clients') }}
    </section>

    <section class="content">
        <div class="row">
            @include('clients._tools')

            <div class="col-md-9">
                @include('flash::message')
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><span class="glyphicon glyphicon-search"></span> Pesquisar</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">

                        {!! Form::open(['route' => 'clients.search']) !!}
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('por', 'Por:')}}
                                {{ Form::select('por',[
                                    'id' => 'ID',
                                    'name' => 'Nome',
                                ], $search['por'], ['class'=> 'form-control', 'placeholder' => 'Selecione uma opção', 'required'])}}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('operador', 'Operador:')}}
                                {{ Form::select('operador',[
                                    '=' => 'Igual a',
                                    'like' => 'Contém a',
                                ], $search['operador'], ['class'=> 'form-control', 'placeholder' => 'Selecione uma opção', 'required'])}}
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="input-group">

                                {{ Form::text('palavra', $search['palavra'],  ['class' => 'form-control', 'placeholder'=>'Palavra-chave...', 'required']) }}
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-search"></i> Pesquisar</button>
                                </span>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title"><span class="glyphicon glyphicon-th-list"></span> Clientes</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        @if($clients->count())
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nome</th>
                                    <th>Status</th>
                                    <th width="15px">Criado em</th>
                                    <th width="150px" class="text-right">Opções</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($clients as $prod)
                                    <tr>
                                        <td class="text-center"><strong>{{$prod->id}}</strong></td>

                                        <td>{{$prod->user->name}}</td>
                                        <td>{{$prod->status}}</td>
                                        <td>{{ \Carbon\Carbon::parse( $prod->created_at)->format('d/m/Y')}}</td>

                                        <td class="text-right">
                                            <a class="btn btn-sm btn-primary"
                                               href="{{ route('clients.show', $prod->id) }}">
                                                <i class="fa fa-fw fa-th-list"></i>
                                            </a>
                                            <a class="btn btn-sm btn-success"
                                               href="{{ route('clients.edit', $prod->id) }}">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </a>
                                            {{--<form action="{{ route('clients.destroy', $prod->id) }}" method="POST"--}}
                                                  {{--style="display: inline;"--}}
                                                  {{--onsubmit="return confirm('Tem certeza que deseja apagar este registro?');">--}}
                                                {{--{{csrf_field()}}--}}
                                                {{--<input type="hidden" name="_method" value="DELETE">--}}

                                                {{--<button type="submit" class="btn btn-sm btn-danger"><i--}}
                                                            {{--class="glyphicon glyphicon-trash"></i></button>--}}
                                            {{--</form>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @else
                            <h4 class="text-center">Nenhum registro encontrado</h4>
                        @endif
                    </div>
                    <div class="box-footer">
                        <div align="center">
                            {!! $clients->links() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
