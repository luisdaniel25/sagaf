@extends('adminlte::page')

@section('title', 'Editar Aprendiz')

@section('content_header')
    <h1>Editar Aprendiz</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('aprendices.update', $aprendiz->Codigo) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apr_PrimerNombre">Primer Nombre *</label>
                            <input type="text" name="apr_PrimerNombre" class="form-control" value="{{ old('apr_PrimerNombre', $aprendiz->apr_PrimerNombre) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apr_SegundoNombre">Segundo Nombre</label>
                            <input type="text" name="apr_SegundoNombre" class="form-control" value="{{ old('apr_SegundoNombre', $aprendiz->apr_SegundoNombre) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="apr_Apellidos">Apellidos *</label>
                    <input type="text" name="apr_Apellidos" class="form-control" value="{{ old('apr_Apellidos', $aprendiz->apr_Apellidos) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apr_TipoDocumento">Tipo de Documento *</label>
                            <select name="apr_TipoDocumento" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <option value="CC" {{ old('apr_TipoDocumento', $aprendiz->apr_TipoDocumento) == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                                <option value="CE" {{ old('apr_TipoDocumento', $aprendiz->apr_TipoDocumento) == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                                <option value="TI" {{ old('apr_TipoDocumento', $aprendiz->apr_TipoDocumento) == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                                <option value="RC" {{ old('apr_TipoDocumento', $aprendiz->apr_TipoDocumento) == 'RC' ? 'selected' : '' }}>Registro Civil</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apr_NumeroDocumento">Número de Documento *</label>
                            <input type="text" name="apr_NumeroDocumento" class="form-control" value="{{ old('apr_NumeroDocumento', $aprendiz->apr_NumeroDocumento) }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="apr_FechaNacimiento">Fecha de Nacimiento *</label>
                    <input type="date" name="apr_FechaNacimiento" class="form-control" value="{{ old('apr_FechaNacimiento', $aprendiz->apr_FechaNacimiento->format('Y-m-d')) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Codigo_programa">Programa *</label>
                            <select name="Codigo_programa" class="form-control" required>
                                <option value="">Seleccione un programa...</option>
                                @foreach($programas as $programa)
                                    <option value="{{ $programa->prog_codigoPrograma }}" {{ old('Codigo_programa', $aprendiz->Codigo_programa) == $programa->prog_codigoPrograma ? 'selected' : '' }}>
                                        {{ $programa->prog_Denominacion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Codigo_ficha">Ficha *</label>
                            <select name="Codigo_ficha" class="form-control" required>
                                <option value="">Seleccione una ficha...</option>
                                @foreach($fichas as $ficha)
                                    <option value="{{ $ficha->Codigo }}" {{ old('Codigo_ficha', $aprendiz->Codigo_ficha) == $ficha->Codigo ? 'selected' : '' }}>
                                        {{ $ficha->Codigo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Codigo_centro">Centro de Formación *</label>
                            <select name="Codigo_centro" class="form-control" required>
                                <option value="">Seleccione un centro...</option>
                                @foreach($centros as $centro)
                                    <option value="{{ $centro->Codigo }}" {{ old('Codigo_centro', $aprendiz->Codigo_centro) == $centro->Codigo ? 'selected' : '' }}>
                                        {{ $centro->cent_Denominacion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Codigo_regional">Regional</label>
                            <select name="Codigo_regional" class="form-control">
                                <option value="">Seleccione una regional...</option>
                                @foreach($regionales as $regional)
                                    <option value="{{ $regional->Codigo }}" {{ old('Codigo_regional', $aprendiz->Codigo_regional) == $regional->Codigo ? 'selected' : '' }}>
                                        {{ $regional->reg_Nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apr_Jornada">Jornada *</label>
                            <select name="apr_Jornada" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <option value="Diurna" {{ old('apr_Jornada', $aprendiz->apr_Jornada) == 'Diurna' ? 'selected' : '' }}>Diurna</option>
                                <option value="Nocturna" {{ old('apr_Jornada', $aprendiz->apr_Jornada) == 'Nocturna' ? 'selected' : '' }}>Nocturna</option>
                                <option value="Mixta" {{ old('apr_Jornada', $aprendiz->apr_Jornada) == 'Mixta' ? 'selected' : '' }}>Mixta</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apr_ModalidadFormacion">Modalidad *</label>
                            <select name="apr_ModalidadFormacion" class="form-control" required>
                                <option value="">Seleccione...</option>
                                <option value="Presencial" {{ old('apr_ModalidadFormacion', $aprendiz->apr_ModalidadFormacion) == 'Presencial' ? 'selected' : '' }}>Presencial</option>
                                <option value="Virtual" {{ old('apr_ModalidadFormacion', $aprendiz->apr_ModalidadFormacion) == 'Virtual' ? 'selected' : '' }}>Virtual</option>
                                <option value="Híbrida" {{ old('apr_ModalidadFormacion', $aprendiz->apr_ModalidadFormacion) == 'Híbrida' ? 'selected' : '' }}>Híbrida</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apr_FechaInicioFormacion">Fecha Inicio Formación *</label>
                            <input type="date" name="apr_FechaInicioFormacion" class="form-control" value="{{ old('apr_FechaInicioFormacion', $aprendiz->apr_FechaInicioFormacion->format('Y-m-d')) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="apr_FechaFinalizacionFormacion">Fecha Finalización Formación</label>
                            <input type="date" name="apr_FechaFinalizacionFormacion" class="form-control" value="{{ old('apr_FechaFinalizacionFormacion', $aprendiz->apr_FechaFinalizacionFormacion ? $aprendiz->apr_FechaFinalizacionFormacion->format('Y-m-d') : '') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="apr_SedeFormacion">Sede de Formación *</label>
                    <input type="text" name="apr_SedeFormacion" class="form-control" value="{{ old('apr_SedeFormacion', $aprendiz->apr_SedeFormacion) }}" required>
                </div>

                <div class="form-group">
                    <label for="apr_CorreoPersonal">Correo Personal</label>
                    <input type="email" name="apr_CorreoPersonal" class="form-control" value="{{ old('apr_CorreoPersonal', $aprendiz->apr_CorreoPersonal) }}">
                </div>

                <div class="form-group">
                    <label for="apr_CorreoSena">Correo SENA</label>
                    <input type="email" name="apr_CorreoSena" class="form-control" value="{{ old('apr_CorreoSena', $aprendiz->apr_CorreoSena) }}">
                </div>

                <div class="form-group">
                    <label for="apr_Telefono">Teléfono</label>
                    <input type="text" name="apr_Telefono" class="form-control" value="{{ old('apr_Telefono', $aprendiz->apr_Telefono) }}">
                </div>

                <div class="form-group">
                    <label for="apr_TelefonoWhatsapp">WhatsApp</label>
                    <input type="text" name="apr_TelefonoWhatsapp" class="form-control" value="{{ old('apr_TelefonoWhatsapp', $aprendiz->apr_TelefonoWhatsapp) }}">
                </div>

                <div class="form-group">
                    <label for="apr_Direccion">Dirección</label>
                    <textarea name="apr_Direccion" class="form-control" rows="3">{{ old('apr_Direccion', $aprendiz->apr_Direccion) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('aprendices.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
