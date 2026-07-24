@extends('adminlte::page')

@section('title', 'Calendario de Horarios')

@section('content_header')
    <h1>Calendario de Horarios</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <div id="calendar"></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="eventoModal" tabindex="-1" role="dialog" aria-labelledby="eventoTitulo" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="eventoTitulo"></h5>

                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <p><strong>Ambiente:</strong> <span id="eventoAmbiente"></span></p>

                    <p><strong>Instructor:</strong> <span id="eventoInstructor"></span></p>

                    <p><strong>Competencia:</strong> <span id="eventoCompetencia"></span></p>

                    <p><strong>Inicio:</strong> <span id="eventoInicio"></span></p>

                    <p><strong>Fin:</strong> <span id="eventoFin"></span></p>

                </div>

            </div>
        </div>
    </div>

@stop

@section('css')

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.css" rel="stylesheet">

    <style>
        #calendar{
            max-width:100%;
            margin:0 auto;
        }

        .fc-event{
            cursor:pointer;
        }
    </style>

@stop

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/locales/es.global.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {

                locale: 'es',

                initialView: 'dayGridMonth',

                height: 'auto',

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },

                events: "{{ route('horarios.calendario.data') }}",

                eventClick: function(info){

                    let e = info.event;

                    $('#eventoTitulo').text(e.title);

                    $('#eventoAmbiente').text(e.extendedProps.ambiente ?? 'N/A');

                    $('#eventoInstructor').text(e.extendedProps.instructor ?? 'N/A');

                    $('#eventoCompetencia').text(e.extendedProps.competencia ?? 'N/A');

                    $('#eventoInicio').text(
                        e.start
                            ? e.start.toLocaleString('es-CO')
                            : 'N/A'
                    );

                    $('#eventoFin').text(
                        e.end
                            ? e.end.toLocaleString('es-CO')
                            : 'N/A'
                    );

                    $('#eventoModal').modal('show');

                }

            });

            calendar.render();

        });

    </script>

@stop
