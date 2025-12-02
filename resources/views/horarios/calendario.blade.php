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
    <div class="modal fade" id="eventoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="eventoTitulo"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,listWeek'
                },
                events: "{{ route('horarios.calendario.data') }}",

                eventClick: function(info) {
                    const e = info.event;

                    const modalEl = document.getElementById('eventoModal');
                    const modal = new bootstrap.Modal(modalEl);

                    document.getElementById('eventoTitulo').textContent = e.title;
                    document.getElementById('eventoAmbiente').textContent = e.extendedProps.ambiente ?? 'N/A';
                    document.getElementById('eventoInstructor').textContent = e.extendedProps.instructor ?? 'N/A';
                    document.getElementById('eventoCompetencia').textContent = e.extendedProps.competencia ?? 'N/A';
                    document.getElementById('eventoInicio').textContent = e.start ? new Intl.DateTimeFormat('es-ES', { dateStyle: 'short', timeStyle: 'short' }).format(e.start) : 'N/A';
                    document.getElementById('eventoFin').textContent = e.end ? new Intl.DateTimeFormat('es-ES', { dateStyle: 'short', timeStyle: 'short' }).format(e.end) : 'N/A';

                    modal.show();
                }
            });

            calendar.render();
        });
    </script>
@stop
