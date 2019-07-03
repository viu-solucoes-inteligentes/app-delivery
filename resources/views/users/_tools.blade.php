<div class="col-md-3">

    <a href="{{ route('users.create') }}" class="btn btn-success btn-block margin-bottom btn-lg"><span
                class="glyphicon glyphicon-plus"></span> Adicionar </a>

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><span class="glyphicon glyphicon-cog"></span> Acesso rápido</h3>
            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                            class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ route('users') }}"><i class="fa fa-fw fa-list-ul"></i> Usuários
                        </a></li>
                <li><a href="{{ route('users.trashed') }}"><i class="fa fa-trash-o"></i> Lixeira
                    </a></li>

            </ul>
        </div>
    </div>

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><span class="glyphicon glyphicon-tasks"></span> Filtros</h3>

            <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                            class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="{{ route('users', 'search=role:1') }}"><i class="fa fa-circle-o text-blue"></i> Administradores</a></li>
                <li><a href="{{ route('users', 'search=role:2') }}"><i class="fa fa-circle-o text-green"></i> Usuários</a></li>
            </ul>
        </div>
        <!-- /.box-body -->
    </div>

</div>