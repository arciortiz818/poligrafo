@extends('layouts.app')

@section('content')
<div class="hold-transition sidebar-mini" id="app">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                @else
                    <li class="nav-item">
                        <span class="nav-link" href="#">
                        {{ Auth::user()->name }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>                    
                @endguest
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-navy">
            <a href="https://www.uniremington.edu.co/" class="brand-link text-center">
             
            <span class="brand-text font-weight-light">
                <div class="container "> 
                    <img  src="https://www.uniremington.edu.co/wp-content/uploads/2019/02/logo-universdad.png" height="100%" width="100%">
                </div>
            </span>
            </a>
            <div class="sidebar">
            <nav class="mt-2">
                <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
                >
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/programas">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>Programas</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/estudiantes">
                        <i class="nav-icon fas fas fa-child"></i>
                        <p>Estudiantes</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/materias">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Materias</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/matriculas">
                        <i class="nav-icon  fas fa-folder-open"></i>
                        <p>Matriculas</p>
                        </router-link>
                    </li>
                </ul>
            </nav>
            </div>
        </aside>
        <div class="content-wrapper">
        <!-- @yield('content') -->
            <router-view></router-view>
        </div>
        <!-- <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.1
            </div>
            <strong>
                Copyright &copy; 2014-2019
                <a href="http://adminlte.io">AdminLTE.io</a>.
            </strong>
            All rights reserved.
        </footer> -->
    </div>
    
</div>
@endsection
