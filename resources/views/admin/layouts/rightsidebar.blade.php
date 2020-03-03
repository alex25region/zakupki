<aside class="main-sidebar sidebar-dark-secondary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        {{--            <img src="" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"--}}
        {{--                 style="opacity: .8">--}}
        <span class="brand-text font-weight-bold">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
            <div class="info text-cyan">
                Username
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-1">
            <ul id="rightmenu" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" >
                <li class="nav-header">Выберите таблицу:</li>
                        <li class="nav-item">
                            <a href="{{ route('obas.index') }}" class="nav-link">
                                <i class="fa fa-angle-right"></i>
                                <p><b>ОБАС</b></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('mpi.index')}}" class="nav-link">
                                <i class="fa fa-angle-right"></i>
                                <p><b>МПИ</b></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('tru.index')}}" class="nav-link">
                                <i class="fa fa-angle-right"></i>
                                <p><b>ТРУ</b></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('kosgu.index')}}" class="nav-link">
                                <i class="fa fa-angle-right "></i>
                                <p><b>КОСГУ</b></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('okpd.index')}}" class="nav-link">
                                <i class="fa fa-angle-right "></i>
                                <p><b>ОКПД</b></p>
                            </a>
                        </li>
{{--                        <li class="nav-item ml-4">
                            <a href="#" class="nav-link">
                                <i class="fa fa-angle-right"></i>
                                <p><b>Бюджет</b></p>
                            </a>
                        </li>--}}
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>