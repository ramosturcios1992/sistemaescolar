<li class="{{ Request::is('home*') ? 'active' : '' }}">
    <a href="{{ route('inicio') }}" style="{{ Request::is('home*') ? 'border-left:solid 2px #00C4FD!important;' : '' }}">
        <i class="fas fa-home"></i>&nbsp;&nbsp;&nbsp;<span>INICIO</span>
    </a>
</li>

{{-- ADMINISTRADOR --}}
@if (Auth::user()->tipo == 1)
    <li
        class="treeview {{ Request::is('usuarios*', 'estudiantes*', 'docentes*', 'directors*', 'tipo-usuarios*') ? 'menu-open' : '' }}">
        <a href="#"
            style="{{ Request::is('usuarios*', 'estudiantes*', 'docentes*', 'directors*', 'tipo-usuarios*') ? 'border-left:solid 2px #00C4FD!important' : '' }}">
            <i class="fas fa-user-tie"></i>&nbsp;&nbsp;
            <span>USUARIOS</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu"
            style="{{ Request::is('usuarios*', 'estudiantes*', 'docentes*', 'directors*', 'tipo-usuarios*') ? 'display:block' : '' }}">
            <li class="{{ Request::is('usuarios*') ? 'active' : '' }}">
                <a href="{{ route('usuarios.index') }}"><i class="fas fa-users"></i>&nbsp;&nbsp;&nbsp;<span>Todos los
                        Usuarios</span></a>
            </li>
            <li class="{{ Request::is('estudiantes*') ? 'active' : '' }}">
                <a href="{{ route('estudiantes.index') }}"><i
                        class="fas fa-user-graduate"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Estudiante</span></a>
            </li>
            <li class="{{ Request::is('docentes*') ? 'active' : '' }}">
                <a href="{{ route('docentes.index') }}"><i
                        class="fas fa-chalkboard-teacher"></i>&nbsp;&nbsp;&nbsp;<span>Docente</span></a>
            </li>
            <li class="{{ Request::is('directors*') ? 'active' : '' }}">
                <a href="{{ route('directors.index') }}"><i
                        class="fas fa-user-shield"></i>&nbsp;&nbsp;&nbsp;<span>Administrador</span></a>
            </li>
            <li class="{{ Request::is('tipo-usuarios*') ? 'active' : '' }}">
                <a href="{{ route('tipo_usuarios.index') }}"><i
                        class="fas fa-user-tie"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span>Tipos Usuario</span></a>
            </li>
        </ul>
    </li>

    <li
        class="treeview {{ Request::is('grados*', 'semestres*', 'seccions*', 'horarios*', 'notas*') ? 'menu-open' : '' }}">
        <a href="#"
            style="{{ Request::is('grados*', 'semestres*', 'seccions*', 'notas*') ? 'border-left:solid 2px #00C4FD!important' : '' }}">
            <i class="fas fa-university"></i>&nbsp;&nbsp;
            <span>INSTITUCIONAL</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu"
            style="{{ Request::is('grados*', 'semestres*', 'seccions*', 'horarios*', 'notas*') ? 'display:block' : '' }}">

            <li class="{{ Request::is('seccions*') ? 'active' : '' }}">
                <a href="{{ route('seccions.index') }}"><i
                        class="fas fa-ad"></i>&nbsp;&nbsp;&nbsp;<span>Sección</span></a>
            </li>
            <li class="{{ Request::is('grados*') ? 'active' : '' }}">
                <a href="{{ route('grados.index') }}"><i class="fas fa-layer-group"></i>&nbsp;&nbsp;&nbsp;<span>Grado y
                        Sección</span></a>
            </li>
            <li class="{{ Request::is('semestres*') ? 'active' : '' }}">
                <a href="{{ route('semestres.index') }}"><i
                        class="fas fa-list-ol"></i>&nbsp;&nbsp;&nbsp;<span>Semestre</span></a>
            </li>


            <li class="{{ Request::is('notas*') ? 'active' : '' }}">
                <a href="{{ route('notas.index') }}"><i
                        class="fas fa-sticky-note"></i>&nbsp;&nbsp;&nbsp;<span>Notas</span></a>
            </li>

            <li class="{{ Request::is('horarios*') ? 'active' : '' }}">
                <a href="{{ route('horarios.table') }}"><i
                        class="far fa-calendar-times"></i>&nbsp;&nbsp;&nbsp;<span>Horarios</span></a>
            </li>
        </ul>
    </li>

    <li class="treeview {{ Request::is('cursos*', 'materias*', 'competencias*') ? 'menu-open' : '' }}">
        <a href="#"
            style="{{ Request::is('cursos*', 'materias*', 'competencias*') ? 'border-left:solid 2px #00C4FD!important;' : '' }}">
            <i class="fas fa-book-reader"></i>&nbsp;&nbsp;
            <span>CURSOS</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu"
            style="{{ Request::is('cursos*', 'materias*', 'competencias*') ? 'display:block' : '' }}">
            <li class="{{ Request::is('materias*') ? 'active' : '' }}">
                <a href="{{ route('materias.index') }}"><i
                        class="fas fa-book-open"></i>&nbsp;&nbsp;&nbsp;<span>Cursos</span></a>
            </li>
            <li class="{{ Request::is('cursos*') ? 'active' : '' }}">
                <a href="{{ route('cursos.index') }}"><i
                        class="fas fa-chalkboard-teacher"></i>&nbsp;&nbsp;&nbsp;<span>Cursos y Docentes</span></a>
            </li>
            {{-- <li class="{{ Request::is('competencias*') ? 'active' : '' }}">
        <a href="{{ route('competencias.index') }}"><i
                class="fas fa-align-center"></i>&nbsp;&nbsp;&nbsp;<span>Competencias</span></a>
</li> --}}
        </ul>
    </li>

    {{-- <li class="{{ Request::is('acercade*') ? 'active' : '' }}">
<a href="{{ route('competencias.index') }}">
    <i class="fas fa-info-circle"></i>&nbsp;&nbsp;&nbsp;<span>ACERCA
        DE...</span></a>
</li> --}}
@endif



{{-- PROFESORES O DOCENTES --}}
@if (Auth::user()->tipo == 2)
    <li class="{{ Request::is('mis-cursos*') ? 'active' : '' }}">
        <a href="{{ route('horariosDocente.table') }}"><i class="fas fa-book-open"></i>&nbsp;&nbsp;&nbsp;<span>MIS
                CURSOS</span></a>
    </li>

    <li class="{{ Request::is('notas-docente*') ? 'active' : '' }}">
        <a href="{{ route('notasDocente.index') }}"
            style="{{ Request::is('notas-docente*') ? 'border-left:solid 2px #00C4FD!important;' : '' }}">
            <i class="fas fa-sticky-note"></i>&nbsp;&nbsp;&nbsp;<span>INGRESAR
                NOTAS</span></a>
    </li>

    <li class="{{ Request::is('horarios-docente*') ? 'active' : '' }}">
        <a target="_blank" href="{{ route('horariosDocente.index') }}"><i
                class="far fa-calendar-times"></i>&nbsp;&nbsp;&nbsp;<span>HORARIOS</span></a>
    </li>
@endif

{{-- ESTUDIANTES O ALUMNOS --}}
@if (Auth::user()->tipo == 3)
    <li class="{{ Request::is('mis-cursos*') ? 'active' : '' }}">
        <a href="{{ route('horariosEstudiante.table') }}"><i class="fas fa-book-open"></i>&nbsp;&nbsp;&nbsp;<span>MIS
                CURSOS</span></a>
    </li>

    <li class="{{ Request::is('notas-estudiante*') ? 'active' : '' }}">
        <a href="{{ route('notasEstudiante.ingresarAnio') }}"
            style="{{ Request::is('notas-estudiante*') ? 'border-left:solid 2px #00C4FD!important;' : '' }}">
            <i class="fas fa-sticky-note"></i>&nbsp;&nbsp;&nbsp;<span>MIS NOTAS</span></a>
    </li>

    <li class="{{ Request::is('horarios-estudiante*') ? 'active' : '' }}">
        <a target="_blank" href="{{ route('horariosEstudiante.index') }}"><i
                class="far fa-calendar-times"></i>&nbsp;&nbsp;&nbsp;<span>HORARIOS</span></a>
    </li>
@endif


@if (Auth::user()->tipo == 1)
    {{-- INFO --}}
    <li class="{{ Request::is('info*') ? 'active' : '' }}">
        <a href="{{ route('info.index') }}"
            style="{{ Request::is('info*') ? 'border-left:solid 2px #00C4FD!important;' : '' }}">
            <i class="fas fa-info-circle"></i>&nbsp;&nbsp;&nbsp;<span>ACERCA DE...</span>
        </a>
    </li>
@endif

{{-- CERRAR SESION --}}
{{-- <li class="{{ Request::is('salir*') ? 'active' : '' }}">
<a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    <i class="fas fa-power-off"></i>&nbsp;&nbsp;&nbsp;<span>SALIR</span>
</a>
</li> --}}
