<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between align-items-center">
                <a href="#" class="d-flex align-items-center gap-2">
                    <div class="logo-icon d-flex align-items-center justify-content-center"
                        style="width: 40px; height: 40px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px;">
                        <i class="bi bi-book text-white fs-5"></i>
                    </div>
                    <span class="text-dark fw-bold fs-5">Learnify</span>
                </a>

                <div class="toggler d-block d-lg-none">
                    <a href="#" class="sidebar-hide" onclick="toggleSidebar()">
                        <i class="bi bi-x fs-4"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="sidebar-menu">
            @if (Auth::user()->role === 'admin')

                <ul class="menu">
                    <li class="sidebar-title">Menu</li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-title">Main Menu</li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.competitions.index') }}" class="sidebar-link">
                            <i class="bi bi-trophy"></i>
                            <span>Competitions</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.categories.index') }}" class="sidebar-link">
                            <i class="bi bi-tags"></i>
                            <span>Category</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.questions.index') }}" class="sidebar-link">
                            <i class="bi bi-card-checklist"></i>
                            <span>Question</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.badges.index') }}" class="sidebar-link">
                            <i class="bi bi-award"></i>
                            <span>Badges</span>
                        </a>
                    </li>

                    <li class="sidebar-title">List Anggota</li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.peserta.index') }}" class="sidebar-link">
                            <i class="bi bi-people-fill"></i>
                            <span>Peserta</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.qualifier.index') }}" class="sidebar-link">
                            <i class="bi bi-people-fill"></i>
                            <span>Qualifier</span>
                        </a>
                    </li>

                    <li class="sidebar-title">Pages</li>
                    <li class="sidebar-item">
                        <a href="{{ route('global.leaderboard') }}" class="sidebar-link">
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Leaderboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('admin.analytics') }}" class="sidebar-link">
                            <i class="bi bi-graph-up"></i>
                            <span>Analytics</span>
                        </a>
                    </li>
                </ul>

            @elseif (Auth::user()->role === 'peserta')

                <ul class="menu">
                    <li class="sidebar-item">
                        <a href="{{ route('peserta.dashboard') }}" class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('peserta.competitions.list') }}" class="sidebar-link">
                            <i class="bi bi-trophy-fill"></i>
                            <span>Competitions</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('peserta.my-badges') }}" class="sidebar-link">
                            <i class="bi bi-award-fill"></i>
                            <span>My Badges</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('global.leaderboard') }}" class="sidebar-link">
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Leaderboard</span>
                        </a>
                    </li>
                </ul>

            @else

                <ul class="menu">
                    <li class="sidebar-item">
                        <a href="{{ route('qualifier.dashboard') }}" class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('qualifier.answer-validation') }}" class="sidebar-link">
                            <i class="bi bi-check2-square"></i>
                            <span>Answer Validation</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('global.leaderboard') }}" class="sidebar-link">
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Leaderboard</span>
                        </a>
                    </li>
                </ul>

            @endif
        </div>
    </div>
</div>
