<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('storage') . '/' . auth()->user()->image }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a href="/profile/{{ auth()->user()->id }}" aria-expanded="true">
                        <span>
                            {{ auth()->user()->name }}
                            <span class="user-level">{{ auth()->user()->role->name }}</span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                </div>
            </div>
            <ul class="nav nav-primary">
                @student
                <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
                    <a href="/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Try Out</h4>
                </li>
                <li class="nav-item {{ Request::is("tryout*") ? 'active' : '' }}">
                    <a href="/tryout">
                        <i class="fas fa-layer-group"></i>
                        <p>Try Out</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is("history/tryout*") ? 'active' : '' }}">
                    <a href="/history/tryout">
                        <i class="fas fa-history"></i>
                        <p>Riwayat Try Out</p>
                    </a>
                </li>
                @endstudent
                @admin
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Manajemen</h4>
                </li>
                <li class="nav-item {{ (Request::is("management/collection*") || Request::is("management/question*") || Request::is("management/tryout*")) ? 'active' : '' }}">
                    <a href="/management/collection">
                        <i class="fas fa-book"></i>
                        <p>Bank Soal</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is("management/variation") ? 'active' : '' }}">
                    <a href="/management/variation">
                        <i class="fas fa-archive"></i>
                        <p>Jenis Soal</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is("management/user*") ? 'active' : '' }}">
                    <a href="/management/user">
                        <i class="fas fa-user"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is("management/student*") ? 'active' : '' }}">
                    <a href="/management/student">
                        <i class="fas fa-user-graduate"></i>
                        <p>Siswa</p>
                    </a>
                </li>
                @endadmin
            </ul>
        </div>
    </div>
</div>

