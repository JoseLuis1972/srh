<?php include(resource_path('views/config.php')); ?>
<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background:#777777">
 <ul class="nav">

        <!-- Item de inicio -->
        <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Inicio</span>
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('Tablemetasdinamicas.list') }}">
                <i class="fa fa-external-link menu-icon"></i>
                <span class="menu-title">Metas Individuales</span>
            </a>
        </li>

         <li class="nav-item">
            <a class="nav-link" href="{{ route('communication.list') }}">
                <i class="fa fa-line-chart menu-icon"></i>
                <span class="menu-title">Metas Institucionales</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('request.list') }}">
                <i class="fa fa-edit menu-icon"></i>
                <span class="menu-title">Eval. Correctiva/Mejora</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fa fa-mortar-board menu-icon"></i>
                <span class="menu-title">Evaluaciones</span>
            </a>
        </li>


        <!-- Item Administracion      ***************   NO  APLICA  **************-->
        @if($adminMatch)
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic-admin" aria-expanded="false"
                    aria-controls="ui-basic-admin">
                    <i class="fa fa-cog menu-icon"></i>
                    <span class="menu-title">Administración</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic-admin">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('user.list') }}">Usuarios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Roles</a></li>
                    </ul>
                </div>
            </li>
        @endif

        <!-- Item Correspondencia -->
        @if($letterMatch)
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic_corres" aria-expanded="false"
                    aria-controls="ui-basic_corres">
                    <i class="fa fa-archive menu-icon"></i>
                    <span class="menu-title">Reportes</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic-corres">
                    <ul class="nav flex-column sub-menu">
                        <!-- <li class="nav-item"><a class="nav-link" href="#">Administración</a></li>     -->
                        <li class="nav-item"><a class="nav-link" href="{{ route('letter.list') }}">Resumen de Calif.</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('office.list') }}">Doc. PDF de Calif.</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('office.list') }}">Capacitación Acred. </a></li>
                        <!-- @if($letterAdminMatch)
                            <li class="nav-item"><a class="nav-link" href="{{ route('inside.list') }}">Interno</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('round.list') }}">Circulares</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route(name: 'file.list') }}">Lineamientos</a></li>
                        @endif -->
                    </ul>
                </div>
            </li>
        @endif


<!--/+  JHR  05/03/2025  -->

        @if($letterMatch)
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic-courses" aria-expanded="false"
                    aria-controls="ui-basic-courses">
                    <i class="fa fa-desktop menu-icon"></i>
                    <!-- Icono cambiado a computadora -->
                    <span class="menu-title">CATALOGOS</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic-courses"><ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadeinstrumento.list') }}">Gestion del rendimiento</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadeverbo.list') }}">Verbo en infinitivo</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadetipo.list') }}">Tipo de accion</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadeum.list') }}">Unidad de medicion</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadecriterio.list') }}"> Criterio y principios</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievademn.list') }}">Marco Normativo</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadevalor.list') }}">Valor de Indicador</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadeindicador.list') }}">Indicador</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievademeta.list') }}">Meta individual</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadeunidad.list') }}">Tipo de Unidad</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadeparametro.list') }}">parametro alcanzado</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadeaccion.list') }}">Accion correctiva </a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadeasociado.list') }}">Comportamiento asociado</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('Sievadealineacion.list') }}">Aliniacion al PND</a></li>
                    </ul>
                    </ul>
                </div>
            </li>
        @endif


<!--/+  JHR  05/03/2025  -->


        @if($letterCRH)
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic_corres-x" aria-expanded="false"
                            aria-controls="ui-basic_corres-x">
                            <i class="fa fa-folder-open menu-icon"></i>
                            <span class="menu-title">C.R.H.</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic_corres-x">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('communication.list') }}">Oficios</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('request.list') }}">Requerimiento</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('informative.list') }}">Informativo</a>
                                </li>
                                <!--<li class="nav-item"><a class="nav-link" href="{{ route('certification.list') }}">Certificaciones</a> </li>   -->
                            </ul>
                        </div>
                    </li>
        @endif

        <!-- Item Cursos -->
        @if(isset($coursesMatch) && $coursesMatch)
            <li class="nav-item {{ request()->routeIs('coursesauditoria.list') || request()->routeIs('courses.list') || request()->routeIs('coursescategoria.list') || request()->routeIs('coursescoordinacion.list') || request()->routeIs('coursesestatuto.list') || request()->routeIs('coursesmodalidad.list') || request()->routeIs('coursesnombreacc.list') || request()->routeIs('coursesorganizacion.list') || request()->routeIs('coursesprograma.list') || request()->routeIs('coursestipoac.list') || request()->routeIs('coursestipocur.list') || request()->routeIs('tableinstructor.list') || request()->routeIs('tablecourses.list') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#ui-cursos" aria-expanded="false" aria-controls="ui-cursos">
                    <i class="fa fa-desktop menu-icon"></i>
                    <span class="menu-title">Cursos</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-cursos">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('coursesauditoria.list') }}">Auditoria</a>                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('courses.list') }}">Beneficio</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('coursescategoria.list') }}">Categoría</a>                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('coursescoordinacion.list') }}">Coordinación</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('coursesestatuto.list') }}">Estatuto Orgánico</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('coursesmodalidad.list') }}">Modalidad</a> </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('coursesnombreacc.list') }}">Nombre Acción</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('coursesorganizacion.list') }}">Organización</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('coursesprograma.list') }}">P.Institucional</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('coursestipoac.list') }}">Tipo Acción</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('coursestipocur.list') }}">Tipo Cursos</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('tableinstructor.list') }}">Instructores</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('tablecourses.list') }}">Cursos Tabla</a></li>
                    </ul>
                </div>
            </li>
        @endif

        <!-- Item Acerca de -->
        <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('about') }}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Acerca de</span>
            </a>
        </li>


    </ul>
</nav>
