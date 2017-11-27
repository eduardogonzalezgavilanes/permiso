@extends('layouts.app')
@section('contenido')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">

    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>Modulo de provincias</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/yellow.css">

    <!-- toastr notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        .panel-heading {
            padding: 0;
        }
        .panel-heading ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .panel-heading li {
            float: left;
            border-right:1px solid #bbb;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }
        .panel-heading li:last-child:hover {
            background-color: #ccc;
        }
        .panel-heading li:last-child {
            border-right: none;
        }
        .panel-heading li a:hover {
            text-decoration: none;
        }

        .table.table-bordered tbody td {
            vertical-align: baseline;
        }
        /* icheck checkboxes */
        .iradio_flat-yellow {
            background: url(https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/yellow.png) no-repeat;
        }
    </style>

</head>

<body>
    <div class="col-md-8 col-md-offset-2">
        <h2 class="text-center">Modulo de provincias</h2>
        <br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul>
                    <li><i class="fa fa-file-text-o"></i> Provincias</li>
                    <li> <a href="#" class="add-modal btn btn-primary ">  <span class="   glyphicon glyphicon-floppy-saved">Agregar</span></a></li>
                </ul>
            </div>

            <div class="panel-body">

           
                    <table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
                        <thead>
                            <tr>
                                <th valign="middle">ID</th>
                                <th>Codigo provincia</th>
                                <th>Nombre provincia</th>
                                <th>Nombre pais</th>
                                <th>Ultima Modificación</th>
                                <th>Operaciones</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr class="item{{$post->id}}">
                                    <td>{{$post->id}}</td>
                                    <td>{{$post->CodigoProvincias}}</td>
                                   <td>{{$post->NombreProvincias}}</td>
                                    <td>{{$post->NombrePais}}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <button class="show-modal btn btn-success" data-id="{{$post->id}}" data-codigoprovincias="{{$post->CodigoProvincias}}" data-nombreprovincias="{{$post->NombreProvincias}}" data-nombrepais="{{$post->NombrePais}}">
                                        <span class="glyphicon glyphicon-eye-open"></span> Mostrar</button>
                                        <button class="edit-modal btn btn-info" data-id="{{$post->id}}" data-codigoprovincias="{{$post->CodigoProvincias}}" data-nombreprovincias="{{$post->NombreProvincias}}" data-nombrepais="{{$post->NombrePais}}"  data-idpais="{{$post->idpais}}">
                                        <span class="glyphicon glyphicon-edit"></span> Editar</button>
                                        <button class="delete-modal btn btn-danger" data-id="{{$post->id}}" data-codigoprovincias="{{$post->CodigoProvincias}}" data-nombreprovincias="{{$post->NombreProvincias}}" data-nombrepais="{{$post->NombrePais}}">
                                        <span class="glyphicon glyphicon-trash"></span> Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div><!-- /.panel-body -->
        </div><!-- /.panel panel-default -->
    </div><!-- /.col-md-8 -->

    <!-- Modal form to add a post -->
    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                       <div class="form-group">
                            <label class="control-label col-sm-2" for="pais">Pais que pertenece:</label>
                                                        <div class="col-sm-10">
                            <select id="nombrepais_add" class="form-control">
                                  @foreach($paises as $pai)
                                    <option value="{{$pai->id}}">{{$pai->NombrePais}}</option>
                                  @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="codigo">Codigo Provincia:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="codigoprovincias_add" autofocus>
                                <p class="errorCodigo text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Nombre Provincia:</label>
                            <div class="col-sm-10">
                                  <input type="text" class="form-control" id="nombreprovincias_add" autofocus>
                                <p class="errorNombre text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-check'></span> Agregar
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal form to show a post -->
    <div id="showModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Codigo Provincia:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="codigoprovincia_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Nombre Provincia :</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="nombreprovincia_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Nombre Pais :</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="nombrepais_show" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal form to edit a form -->
    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                    <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_edit" disabled>
                            </div>
                        </div>
                    <div class="form-group">
                            <label class="control-label col-sm-2" for="pais">Pais que pertenece:</label>
                                                        <div class="col-sm-10">
                            <select id="nombrepais_edit" class="form-control">
                                  @foreach($paises as $pai)
                                    <option value="{{$pai->id}}">{{$pai->NombrePais}}</option>
                                  @endforeach
                            </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Codigo provincia:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="codigoprovincias_edit" autofocus>
                                <p class="errorCodigo text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Nombre Provincias:</label>
                            <div class="col-sm-10">
                                 <input type="text" class="form-control" id="nombreprovincias_edit">

                                <p class="errorNombre text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                            <span class='glyphicon glyphicon-check'></span> Editar
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal form to delete a form -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Seguro deseas eliminar?</h3>
                    <br />
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_delete" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Provincia:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="nombreprovincias_delete" disabled>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Eliminar
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <!-- Bootstrap JavaScript -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

    <!-- toastr notifications -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <!-- icheck checkboxes -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

    <!-- Delay table load until everything else is loaded -->
    <script>
        $(window).load(function(){
            $('#postTable').removeAttr('style');
        })
    </script>

      <!-- AJAX CRUD operations -->
    <script type="text/javascript">
        // add a new post
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Añadir una nueva provincia');
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: 'provincias',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'idpais': $('#nombrepais_add').val(),
                    'nombreprovincias': $('#nombreprovincias_add').val(),
                    'codigoprovincias': $('#codigoprovincias_add').val()
                },
                success: function(data) {
                    $('.errorCodigo').addClass('hidden');
                    $('.errorNombre').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('No guardado!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.codigopais) {
                            $('.errorCodigo').removeClass('hidden');
                            $('.errorCodigo').text(data.errors.codigopais);
                        }
                        if (data.errors.nombrepais) {
                            $('.errorNombre').removeClass('hidden');
                            $('.errorNombre').text(data.errors.nombrepais);
                        }
                    } else {
        toastr.success('Añadido Con exito!', 'Success Alert', {timeOut: 5000});
        location.reload();
                    }
                },
            });
        });

        // Show a post
        $(document).on('click', '.show-modal', function() {
            $('.modal-title').text('Mostrar Provincias');
            $('#id_show').val($(this).data('id'));
            $('#codigoprovincia_show').val($(this).data('codigoprovincias'));
            $('#nombreprovincia_show').val($(this).data('nombreprovincias'));
            $('#nombrepais_show').val($(this).data('nombrepais'));
            $('#showModal').modal('show');
        });


        // Edit a post
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Editar Provincias');
            $('#id_edit').val($(this).data('id'));
            $('#codigoprovincias_edit').val($(this).data('codigoprovincias'));
            $('#nombreprovincias_edit').val($(this).data('nombreprovincias'));
            $('#nombrepais_edit').val($(this).data('idpais'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'provincias/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'idpais': $('#nombrepais_edit').val(),
                    'codigoprovincias': $('#codigoprovincias_edit').val(),
                    'nombreprovincias': $('#nombreprovincias_edit').val()
                },
                success: function(data) {
                    $('.errorCodigo').addClass('hidden');
                    $('.errorNombre').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Error al editar!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.codigopais) {
                            $('.errorCodigo').removeClass('hidden');
                            $('.errorCodigo').text(data.errors.codigopais);
                        }
                        if (data.errors.nombrepais) {
                            $('.errorNombre').removeClass('hidden');
                            $('.errorNombre').text(data.errors.nombrepais);
                        }
                    } else {
                        toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                       location.reload();
                    }
                }
            });
        });

        // delete a post
        $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Eliminar Provincias');
            $('#id_delete').val($(this).data('id'));
            $('#nombreprovincias_delete').val($(this).data('nombreprovincias'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: 'provincias/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Eliminado con exito!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                }
            });
        });
    </script>

</body>
</html>

@endsection