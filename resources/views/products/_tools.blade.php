<div class="col-md-3">
    <a href="{{ route('products.create') }}" class="btn btn-success btn-block margin-bottom btn-lg"><span
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
                <li class="active"><a href="{{ route('products') }}"><i class="fa fa-fw fa-list-ul"></i> Produtos
                        </a></li>
                <li><a href="{{ route('products.trashed') }}"><i class="fa fa-trash-o"></i> Lixeira
                    </a></li>

            </ul>
        </div>
    </div>

</div>