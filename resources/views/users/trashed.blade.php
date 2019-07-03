@extends('layouts.app')
@section('body_class', 'skin-red-light sidebar-collapse sidebar-mini')
@section('body')
    <section class="content-header">
        <h1>
            Lixeira de usuários
        </h1>
        {{ \Breadcrumbs::render('users.trashed') }}
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            @include('users._tools_trashed')
            <div class="col-md-9">
                @include('includes.messages')
                <div class="box box-success ">

                    <div class="box-header with-border">
                        <h3 class="box-title"><span class="glyphicon glyphicon-search"></span> Pesquisar</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        {!! Form::open(['route' => 'users.trashed.search']) !!}
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('por', 'Por:')}}
                                {{ Form::select('por',[
                                    'id' => 'ID',
                                    'name' => 'Usuário',
                                    'email' => 'E-mail',
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
                        <h3 class="box-title"><span class="glyphicon glyphicon-th-list"></span> Usuários</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        @if($users->count())
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Tipo</th>
                                    <th>Deletado em</th>
                                    <th class="text-right">Opções</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center"><strong>{{$user->id}}</strong></td>

                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td >
                                            <small class="label bg-{{($user->role == "1") ? "blue" : "green"}}">{{($user->role == "1") ? "Administrador" : "Usuário"}}</small>
                                        </td>

                                        <td>{{ \Carbon\Carbon::parse( $user->deleted_at)->format('d/m/Y H:i:s')}}</td>

                                        <td class="text-right">

                                            <form action="{{ route('users.trashed.update', $user->id) }}" method="POST"
                                                  style="display: inline;"
                                                  onsubmit="return confirm('Deseja restaurar este item?');">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="PUT">

                                                <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="glyphicon glyphicon-trash"></i> Restaurar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @else
                            <h4 class="text-center">Nenhum registro encontrado</h4>
                        @endif

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div align="center">
                            {!! $users->render() !!}
                        </div>
                    </div>
                    <!-- /.box-footer-->
                </div>
            </div>
        </div>
    </section>

@endsection
