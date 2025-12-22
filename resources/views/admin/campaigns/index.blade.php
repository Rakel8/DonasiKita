<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Kampanye - DonasiKita</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            color: #333;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #1a1a2e;
            color: white;
            overflow-y: auto;
            z-index: 100;
        }
        
        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .sidebar-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .sidebar-title {
            font-size: 16px;
            font-weight: 700;
        }
        
        .sidebar-nav {
            list-style: none;
            padding: 20px 0;
        }
        
        .sidebar-nav li {
            margin: 0;
        }
        
        .sidebar-nav a {
            color: #bbb;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .sidebar-nav a:hover {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
            border-left-color: #667eea;
        }
        
        .sidebar-nav a.active {
            background: rgba(102, 126, 234, 0.2);
            color: #667eea;
            border-left-color: #667eea;
            font-weight: 600;
        }
        
        .sidebar-nav i {
            width: 20px;
            margin-right: 10px;
        }
        
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
        }
        
        .user-name {
            font-size: 13px;
            color: #bbb;
        }
        
        .logout-btn {
            width: 100%;
            padding: 10px;
            background: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background: #c0392b;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 25px;
            min-height: 100vh;
        }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .page-title h1 {
            font-size: 28px;
            margin: 0;
        }
        
        .page-title p {
            color: #999;
            font-size: 14px;
            margin: 5px 0 0;
        }
        
        .top-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }
        
        .btn-danger {
            background: white;
            color: #e74c3c;
            border: 2px solid #e74c3c;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-danger:hover {
            background: #e74c3c;
            color: white;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .card-header {
            padding: 20px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .card-title {
            font-size: 16px;
            font-weight: 700;
        }
        
        .card-body {
            padding: 0;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th {
            background: #f8f9fa;
            padding: 15px 20px;
            text-align: left;
            font-weight: 600;
            color: #666;
            font-size: 13px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .table td {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 13px;
        }
        
        .table tr:hover {
            background: #f8f9fa;
        }
        
        .table tr:last-child td {
            border-bottom: none;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .badge-active {
            background: #d5f4e6;
            color: #27ae60;
        }
        
        .badge-inactive {
            background: #fef5e7;
            color: #f39c12;
        }
        
        .badge-completed {
            background: #dfe6e9;
            color: #2c3e50;
        }
        
        .progress-bar {
            background: #f0f0f0;
            height: 6px;
            border-radius: 3px;
            overflow: hidden;
            margin: 5px 0;
        }
        
        .progress-fill {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            height: 100%;
            border-radius: 3px;
        }
        
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-success {
            background: #d5f4e6;
            color: #27ae60;
            border: 1px solid #27ae60;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            padding: 20px;
        }
        
        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: #667eea;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        
        .pagination a:hover {
            background: #667eea;
            color: white;
        }
        
        .pagination .active span {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }
        
        .empty-state i {
            font-size: 48px;
            color: #ddd;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-heart"></i>
            </div>
            <div class="sidebar-title">DonasiKita</div>
        </div>

        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('admin.campaigns.index') }}" class="active">
                    <i class="fas fa-list"></i> Kampanye
                </a>
            </li>
            <li>
                <a href="{{ route('admin.donations.index') }}">
                    <i class="fas fa-credit-card"></i> Donasi
                </a>
            </li>
            <li>
                <a href="{{ route('admin.donors.index') }}">
                    <i class="fas fa-users"></i> Donatur
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="fas fa-chart-bar"></i> Laporan
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="user-name">
                    {{ auth()->user()->name }}
                </div>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="page-title">
                <h1>Manajemen Kampanye</h1>
                <p>Kelola semua kampanye donasi Anda</p>
            </div>
            <div class="top-actions">
                <a href="{{ route('admin.campaigns.create') }}" class="btn-primary">
                    <i class="fas fa-plus"></i> Kampanye Baru
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Campaigns Table -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-list-check"></i> Daftar Kampanye
                </div>
                <span style="color: #999; font-size: 13px;">Total: {{ $campaigns->total() }} kampanye</span>
            </div>
            <div class="card-body">
                @if ($campaigns->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Target</th>
                                <th>Terkumpul</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaigns as $campaign)
                                <tr>
                                    <td>
                                        <strong>{{ Str::limit($campaign->title, 30) }}</strong>
                                    </td>
                                    <td>Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</td>
                                    <td>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: {{ $campaign->progress }}%;"></div>
                                        </div>
                                        <small>{{ number_format($campaign->progress, 0) }}%</small>
                                    </td>
                                    <td>
                                        @if ($campaign->status === 'active')
                                            <span class="badge badge-active">Aktif</span>
                                        @elseif ($campaign->status === 'inactive')
                                            <span class="badge badge-inactive">Nonaktif</span>
                                        @else
                                            <span class="badge badge-completed">Selesai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.campaigns.show', $campaign->id) }}" class="btn-secondary">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                        <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn-secondary" style="margin-top: 5px;">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.campaigns.destroy', $campaign->id) }}" method="POST" style="display: inline; margin-top: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    <div class="pagination">
                        {{ $campaigns->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada kampanye. <a href="{{ route('admin.campaigns.create') }}" style="color: #667eea;">Buat yang pertama</a></p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
