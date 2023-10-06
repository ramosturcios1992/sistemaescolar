<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        span {
            font-size: 17px;
            text-transform: uppercase;
            line-height: 30px !important;
            text-align: center;
            font-weight: 600;
        }

        .fc-content {
            font-size: 15px;
        }

        .fc-unthemed th {
            background: #0086BC !important;
        }

        .header {
            display: flex;
            justify-content: space-around;
            background: #0086BC;
            color: white;
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 2000;
        }
    </style>
</head>

<body>
    <div>
        <?php
        foreach ($grado as $gra) : ?>
            <div class="header">
                <h4>HORARIO DE CLASES</h4>
                <h4><?= $gra->grado . "  " . $gra->nom_seccion ?></h4>
            </div>
        <?php endforeach
        ?>
        <hr>
        <div>
            <a href="horarios-lista-grados" class="btn btn-primary"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;REGRESAR</a>
        </div>
        <div id="calendar" class="col-md-12">
        </div>

        <!-- /.row -->
        <!-- Modal -->
        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="get" action="insertar-horarios-de-clase">
                        <?php
                        foreach ($grado as $gra) : ?>
                            <input type="text" hidden name="grado" value="<?= $gra->id_grado ?>">
                        <?php endforeach
                        ?>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar Evento</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="curso" class="col-sm-2 control-label">Curso</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="curso" id="curso">
                                        <option value="0">Seleccionar...</option>
                                        <?php
                                        foreach ($sql2 as $item) : ?>
                                            <option value="<?= $item->id_materia ?>"><?= $item->nombre ?></option>
                                        <?php endforeach
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div hidden class="form-group">
                                <label for="title" class="col-sm-2 control-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Seleccionar</option>
                                        <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                                        <option style="color:#008000;" value="#008000">&#9724; Verde</option>
                                        <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
                                        <option style="color:#000;" value="#000">&#9724; Negro</option>

                                    </select>
                                </div>
                            </div>
                            <div hidden class="form-group">
                                <label for="start" class="col-sm-2 control-label">Fecha Inicial</label>
                                <div class="col-sm-10">
                                    <input type="text" name="start" class="form-control" id="start" readonly>
                                </div>
                            </div>
                            <div hidden class="form-group">
                                <label for="end" class="col-sm-2 control-label">Fecha Final</label>
                                <div class="col-sm-10">
                                    <input type="text" name="end" class="form-control" id="end" readonly>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" method="GET" action="actualizarTitle-horarios-de-clase">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modificar Evento</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="curso" class="col-sm-2 control-label">Curso</label>
                                <div class="col-sm-10">
                                    <select name="curso" class="form-control" id="curso">
                                        <option value="0">Seleccionar...</option>
                                        <?php
                                        foreach ($sql2 as $it) : ?>
                                            <option value="<?= $it->id_materia ?>"><?= $it->nombre ?></option>
                                        <?php endforeach
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div hidden class="form-group">
                                <label for="title" class="col-sm-2 control-label">Titulo</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Titulo">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-10">
                                    <select name="color" class="form-control" id="color">
                                        <option value="">Seleccionar</option>
                                        <option style="color:#0071c5;" value="#0071c5">&#9724; Azul oscuro</option>
                                        <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquesa</option>
                                        <option style="color:#008000;" value="#008000">&#9724; Verde</option>
                                        <option style="color:#FFD700;" value="#FFD700">&#9724; Amarillo</option>
                                        <option style="color:#FF8C00;" value="#FF8C00">&#9724; Naranja</option>
                                        <option style="color:#FF0000;" value="#FF0000">&#9724; Rojo</option>
                                        <option style="color:#000;" value="#000">&#9724; Negro</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label class="text-danger"><input type="checkbox" name="delete"> Eliminar
                                            Evento</label>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" class="form-control" id="id">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->



    <script>
        $(document).ready(function() {

            var date = new Date();
            var yyyy = date.getFullYear().toString();
            var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date
                .getMonth() + 1).toString();
            var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate())
                .toString();

            $('#calendar').fullCalendar({
                /* solo fechas de rango */
                validRange: {
                    start: '2021-01-04',
                    end: '2021-01-09'
                },
                //defaultDate: '2018-11-11',
                header: { // Display nothing at the top
                    left: "",
                    center: "",
                    right: ""
                },
                //defaultDate: yyyy + "-" + mm + "-" + dd,
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                selectable: true,
                selectHelper: true,


                height: 680, // Fix height
                columnFormat: "dddd", // Display just full length of weekday, without dates
                defaultView: "agendaWeek", // display week view
                hiddenDays: [0, 6], // hide Saturday and Sunday
                weekNumbers: false, // don"t show week numbers
                minTime: "07:00:00", // display from 16 to
                maxTime: "24:00:00", // 23
                slotDuration: "00:15:00", // 15 minutes for each row
                allDaySlot: false, // don"t show "all day" at the top
                select: function(start, end) {

                    $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                    $('#ModalAdd').modal('show');
                },
                eventRender: function(event, element) {
                    element.bind('dblclick', function() {
                        $('#ModalEdit #id').val(event.id);
                        $('#ModalEdit #title').val(event.nombre);
                        $('#ModalEdit #color').val(event.color);
                        $('#ModalEdit #curso').val(event.curso);
                        $('#ModalEdit').modal('show');
                    });
                },
                eventDrop: function(event, delta, revertFunc) { // si changement de position

                    edit(event);

                },
                eventResize: function(event, dayDelta, minuteDelta,
                    revertFunc) { // si changement de longueur

                    edit(event);

                },
                events: [
                    <?php
                    foreach ($events as $event) :
                        $start = explode(' ', $event->start);
                        $end = explode(' ', $event->end);
                        if ($start[1] == '00:00:00') {
                            $start = $start['start'];
                        } else {
                            $start = $event->start;
                        }
                        if ($end[1] == '00:00:00') {
                            $end = $end[0];
                        } else {
                            $end = $event->end;
                        }
                    ?> {
                            id: '<?php echo $event->id; ?>',
                            title: '<?php echo $event->nombre; ?>',
                            start: '<?php echo $start; ?>',
                            end: '<?php echo $end; ?>',
                            color: '<?php echo $event->color; ?>',
                            curso: '<?php echo $event->curso; ?>',
                        },
                    <?php
                    endforeach; ?>
                ]
            });

            function edit(event) {
                start = event.start.format('YYYY-MM-DD HH:mm:ss');
                if (event.end) {
                    end = event.end.format('YYYY-MM-DD HH:mm:ss');
                } else {
                    end = start;
                }

                id = event.id;

                Event = [];
                Event[0] = id;
                Event[1] = start;
                Event[2] = end;

                $.ajax({
                    url: "actualizar-horarios-de-clase/" + Event[0] + "/" + Event[1] + "/" + Event[2] + "",
                    type: "get",
                    data: {
                        Event: Event
                    },
                    success: function(rep) {
                        if (rep.dato == 'OK') {
                            //alert('Evento se ha guardado correctamente');
                        } else {
                            //alert('No se pudo guardar. Inténtalo de nuevo.');
                        }
                    }
                });
            }

        });
    </script>

</body>

</html>