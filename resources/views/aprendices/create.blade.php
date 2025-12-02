@extends('adminlte::page')

@section('title', 'Crear Aprendiz')

@section('content_header')
    <h1>Crear Nuevo Aprendiz</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="card-title">Información Personal del Aprendiz</h3>
                </div>

                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Por favor corrige los siguientes errores:</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('aprendices.store') }}" method="POST" id="aprendizForm">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="apr_PrimerNombre" class="font-weight-bold">Primer Nombre *</label>
                                    <input type="text"
                                           name="apr_PrimerNombre"
                                           id="apr_PrimerNombre"
                                           class="form-control @error('apr_PrimerNombre') is-invalid @enderror"
                                           value="{{ old('apr_PrimerNombre') }}"
                                           required>
                                    @error('apr_PrimerNombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="apr_SegundoNombre" class="font-weight-bold">Segundo Nombre</label>
                                    <input type="text"
                                           name="apr_SegundoNombre"
                                           id="apr_SegundoNombre"
                                           class="form-control @error('apr_SegundoNombre') is-invalid @enderror"
                                           value="{{ old('apr_SegundoNombre') }}">
                                    @error('apr_SegundoNombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="apr_Apellidos" class="font-weight-bold">Apellidos *</label>
                                    <input type="text"
                                           name="apr_Apellidos"
                                           id="apr_Apellidos"
                                           class="form-control @error('apr_Apellidos') is-invalid @enderror"
                                           value="{{ old('apr_Apellidos') }}"
                                           required>
                                    @error('apr_Apellidos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apr_TipoDocumento" class="font-weight-bold">Tipo Documento *</label>
                                    <select name="apr_TipoDocumento"
                                            id="apr_TipoDocumento"
                                            class="form-control @error('apr_TipoDocumento') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione...</option>
                                        <option value="Cédula" {{ old('apr_TipoDocumento') == 'Cédula' ? 'selected' : '' }}>Cédula</option>
                                        <option value="Tarjeta Identidad" {{ old('apr_TipoDocumento') == 'Tarjeta Identidad' ? 'selected' : '' }}>Tarjeta Identidad</option>
                                        <option value="Cédula Extranjería" {{ old('apr_TipoDocumento') == 'Cédula Extranjería' ? 'selected' : '' }}>Cédula Extranjería</option>
                                        <option value="Pasaporte" {{ old('apr_TipoDocumento') == 'Pasaporte' ? 'selected' : '' }}>Pasaporte</option>
                                    </select>
                                    @error('apr_TipoDocumento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apr_NumeroDocumento" class="font-weight-bold">Número Documento *</label>
                                    <input type="text"
                                           name="apr_NumeroDocumento"
                                           id="apr_NumeroDocumento"
                                           class="form-control @error('apr_NumeroDocumento') is-invalid @enderror"
                                           value="{{ old('apr_NumeroDocumento') }}"
                                           required>
                                    @error('apr_NumeroDocumento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apr_FechaNacimiento" class="font-weight-bold">Fecha Nacimiento *</label>
                                    <input type="date"
                                           name="apr_FechaNacimiento"
                                           id="apr_FechaNacimiento"
                                           class="form-control @error('apr_FechaNacimiento') is-invalid @enderror"
                                           value="{{ old('apr_FechaNacimiento') }}"
                                           required>
                                    @error('apr_FechaNacimiento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apr_Jornada" class="font-weight-bold">Jornada *</label>
                                    <select name="apr_Jornada"
                                            id="apr_Jornada"
                                            class="form-control @error('apr_Jornada') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione...</option>
                                        <option value="Mañana" {{ old('apr_Jornada') == 'Mañana' ? 'selected' : '' }}>Mañana</option>
                                        <option value="Tarde" {{ old('apr_Jornada') == 'Tarde' ? 'selected' : '' }}>Tarde</option>
                                        <option value="Noche" {{ old('apr_Jornada') == 'Noche' ? 'selected' : '' }}>Noche</option>
                                        <option value="Mixta" {{ old('apr_Jornada') == 'Mixta' ? 'selected' : '' }}>Mixta</option>
                                    </select>
                                    @error('apr_Jornada')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apr_Direccion" class="font-weight-bold">Dirección</label>
                                    <input type="text"
                                           name="apr_Direccion"
                                           id="apr_Direccion"
                                           class="form-control @error('apr_Direccion') is-invalid @enderror"
                                           value="{{ old('apr_Direccion') }}">
                                    @error('apr_Direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apr_Telefono" class="font-weight-bold">Teléfono</label>
                                    <input type="text"
                                           name="apr_Telefono"
                                           id="apr_Telefono"
                                           class="form-control @error('apr_Telefono') is-invalid @enderror"
                                           value="{{ old('apr_Telefono') }}">
                                    @error('apr_Telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="apr_TelefonoWhatsapp" class="font-weight-bold">WhatsApp</label>
                                    <input type="text"
                                           name="apr_TelefonoWhatsapp"
                                           id="apr_TelefonoWhatsapp"
                                           class="form-control @error('apr_TelefonoWhatsapp') is-invalid @enderror"
                                           value="{{ old('apr_TelefonoWhatsapp') }}">
                                    @error('apr_TelefonoWhatsapp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apr_CorreoPersonal" class="font-weight-bold">Correo Personal</label>
                                    <input type="email"
                                           name="apr_CorreoPersonal"
                                           id="apr_CorreoPersonal"
                                           class="form-control @error('apr_CorreoPersonal') is-invalid @enderror"
                                           value="{{ old('apr_CorreoPersonal') }}">
                                    @error('apr_CorreoPersonal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apr_CorreoSena" class="font-weight-bold">Correo SENA</label>
                                    <input type="email"
                                           name="apr_CorreoSena"
                                           id="apr_CorreoSena"
                                           class="form-control @error('apr_CorreoSena') is-invalid @enderror"
                                           value="{{ old('apr_CorreoSena') }}">
                                    @error('apr_CorreoSena')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h5 class="text-primary mb-3">Información de Formación</h5>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Codigo_ficha" class="font-weight-bold">Ficha *</label>
                                    <select name="Codigo_ficha"
                                            id="Codigo_ficha"
                                            class="form-control @error('Codigo_ficha') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione una ficha...</option>
                                        @foreach($fichas as $ficha)
                                            <option value="{{ $ficha->Codigo }}" {{ old('Codigo_ficha') == $ficha->Codigo ? 'selected' : '' }}>
                                                {{ $ficha->Codigo }} - {{ $ficha->programa->prog_Denominacion ?? 'Sin programa' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Codigo_ficha')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Codigo_programa" class="font-weight-bold">Programa *</label>
                                    <select name="Codigo_programa"
                                            id="Codigo_programa"
                                            class="form-control @error('Codigo_programa') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione un programa...</option>
                                        @foreach($programas as $programa)
                                            <option value="{{ $programa->prog_codigoPrograma }}" {{ old('Codigo_programa') == $programa->prog_codigoPrograma ? 'selected' : '' }}>
                                                {{ $programa->prog_Denominacion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Codigo_programa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Codigo_centro" class="font-weight-bold">Centro *</label>
                                    <select name="Codigo_centro"
                                            id="Codigo_centro"
                                            class="form-control @error('Codigo_centro') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione un centro...</option>
                                        @foreach($centros as $centro)
                                            <option value="{{ $centro->Codigo }}" {{ old('Codigo_centro') == $centro->Codigo ? 'selected' : '' }}>
                                                {{ $centro->cent_Denominacion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Codigo_centro')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="Codigo_regional" class="font-weight-bold">Regional</label>
                                    <select name="Codigo_regional"
                                            id="Codigo_regional"
                                            class="form-control @error('Codigo_regional') is-invalid @enderror">
                                        <option value="">Seleccione una regional...</option>
                                        @foreach($regionales as $regional)
                                            <option value="{{ $regional->Codigo }}" {{ old('Codigo_regional') == $regional->Codigo ? 'selected' : '' }}>
                                                {{ $regional->reg_Nombre ?? 'Regional' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('Codigo_regional')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="apr_SedeFormacion" class="font-weight-bold">Sede Formación *</label>
                                    <input type="text"
                                           name="apr_SedeFormacion"
                                           id="apr_SedeFormacion"
                                           class="form-control @error('apr_SedeFormacion') is-invalid @enderror"
                                           value="{{ old('apr_SedeFormacion') }}"
                                           required>
                                    @error('apr_SedeFormacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="apr_ModalidadFormacion" class="font-weight-bold">Modalidad Formación *</label>
                                    <select name="apr_ModalidadFormacion"
                                            id="apr_ModalidadFormacion"
                                            class="form-control @error('apr_ModalidadFormacion') is-invalid @enderror"
                                            required>
                                        <option value="">Seleccione...</option>
                                        <option value="Presencial" {{ old('apr_ModalidadFormacion') == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                        <option value="Virtual" {{ old('apr_ModalidadFormacion') == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                                        <option value="Mixta" {{ old('apr_ModalidadFormacion') == 'Mixta' ? 'selected' : '' }}>Mixta</option>
                                    </select>
                                    @error('apr_ModalidadFormacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apr_FechaInicioFormacion" class="font-weight-bold">Fecha Inicio Formación *</label>
                                    <input type="date"
                                           name="apr_FechaInicioFormacion"
                                           id="apr_FechaInicioFormacion"
                                           class="form-control @error('apr_FechaInicioFormacion') is-invalid @enderror"
                                           value="{{ old('apr_FechaInicioFormacion') }}"
                                           required>
                                    @error('apr_FechaInicioFormacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apr_FechaFinalizacionFormacion" class="font-weight-bold">Fecha Finalización Formación</label>
                                    <input type="date"
                                           name="apr_FechaFinalizacionFormacion"
                                           id="apr_FechaFinalizacionFormacion"
                                           class="form-control @error('apr_FechaFinalizacionFormacion') is-invalid @enderror"
                                           value="{{ old('apr_FechaFinalizacionFormacion') }}">
                                    @error('apr_FechaFinalizacionFormacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="confirmData" required>
                                <label class="custom-control-label text-danger" for="confirmData">
                                    Confirmo que la información ingresada es correcta
                                </label>
                            </div>
                        </div>

                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('aprendices.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Volver al Listado
                            </a>

                            <button type="submit" class="btn btn-success" id="btnSubmit">
                                <i class="fas fa-save"></i> Guardar Aprendiz
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Auto-dismiss alerts
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
@stop
