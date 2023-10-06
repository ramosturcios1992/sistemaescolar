<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi horario</title>
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
            <a href="horarios-estudiante-lista-grados" class="btn btn-primary"><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;&nbsp;REGRESAR</a>
        </div>
        <div id="calendar" class="col-md-12">
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
                editable: false,
                eventLimit: false, // allow "more" link when too many events
                selectable: false,
                selectHelper: false,


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

           

        });
    </script>

</body>

</html>