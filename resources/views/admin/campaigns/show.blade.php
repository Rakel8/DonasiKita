<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Kampanye - DonasiKita Admin</title>
    
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
        
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 10px 15px;
            border-radius: 6px;
            border: none;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn-danger {
            background: #e74c3c;
            color: white;
        }
        
        .btn-danger:hover {
            background: #c0392b;
        }
        
        .btn-secondary {
            background: white;
            color: #667eea;
            border: 2px solid #667eea;
        }
        
        .btn-secondary:hover {
            background: #667eea;
            color: white;
        }
        
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
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
        }
        
        .card-title {
            font-size: 16px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        .campaign-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            background: #f0f0f0;
        }
        
        .info-group {
            margin-bottom: 20px;
        }
        
        .info-label {
            color: #999;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 16px;
            font-weight: 500;
            color: #333;
        }
        
        .stat-item {
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .stat-label {
            color: #999;
            font-size: 12px;
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: #667eea;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .status-active {
            background: #d4edda;
            color: #155724;
        }
        
        .status-inactive {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-completed {
            background: #e2e3e5;
            color: #383d41;
        }
        
        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 10px;
            overflow: hidden;
            margin-top: 10px;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table thead {
            background: #f8f9fa;
            border-bottom: 2px solid #e0e0e0;
        }
        
        .table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            color: #666;
        }
        
        .table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .table tbody tr:hover {
            background: #f8f9fa;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 20px;
        }
        
        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            text-decoration: none;
            color: #667eea;
            font-size: 12px;
        }
        
        .pagination a:hover {
            background: #f8f9fa;
        }
        
        .pagination .active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }
        
        .pagination .disabled {
            color: #ccc;
            cursor: not-allowed;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }
        
        .empty-state i {
            font-size: 40px;
            color: #ddd;
            margin-bottom: 15px;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .grid-2 {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
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
                <h1>{{ $campaign->title }}</h1>
                <p>Detail Kampanye</p>
            </div>
            <div class="action-buttons">
                <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <form method="POST" action="{{ route('admin.campaigns.destroy', $campaign->id) }}" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kampanye ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
                <a href="{{ route('admin.campaigns.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <div class="grid-2">
            <!-- Campaign Info Card -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-info-circle"></i> Informasi Kampanye
                    </div>
                </div>
                <div class="card-body">
                    @if ($campaign->image)
                        <img src="{{ str_starts_with($campaign->image, 'http') ? $campaign->image : asset('storage/' . $campaign->image) }}" alt="{{ $campaign->title }}" class="campaign-image">
                    @else
                        <div class="campaign-image" style="display: flex; align-items: center; justify-content: center; background: #f0f0f0;">
                            <i class="fas fa-image" style="font-size: 40px; color: #ddd;"></i>
                        </div>
                    @endif

                    <div style="margin-top: 20px;">
                        <div class="info-group">
                            <div class="info-label">Judul</div>
                            <div class="info-value">{{ $campaign->title }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Deskripsi</div>
                            <div class="info-value" style="font-size: 14px; line-height: 1.6;">{{ $campaign->description }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Status</div>
                            <div>
                                @if ($campaign->status === 'active')
                                    <span class="status-badge status-active">Aktif</span>
                                @elseif ($campaign->status === 'inactive')
                                    <span class="status-badge status-inactive">Nonaktif</span>
                                @else
                                    <span class="status-badge status-completed">Selesai</span>
                                @endif
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Tanggal Dibuat</div>
                            <div class="info-value">{{ $campaign->created_at->format('d M Y H:i') }}</div>
                        </div>

                        <div class="info-group">
                            <div class="info-label">Tanggal Akhir</div>
                            <div class="info-value">{{ $campaign->end_date->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-chart-pie"></i> Statistik Kampanye
                    </div>
                </div>
                <div class="card-body">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                        <div class="stat-item">
                            <div class="stat-label">Target Dana</div>
                            <div class="stat-value">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-label">Dana Terkumpul</div>
                            <div class="stat-value" style="color: #27ae60;">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-label">Jumlah Donasi</div>
                            <div class="stat-value">{{ $campaign->donors_count }}</div>
                        </div>

                        <div class="stat-item">
                            <div class="stat-label">Persentase</div>
                            <div class="stat-value">{{ $campaign->progress }}%</div>
                        </div>
                    </div>

                    <div style="margin-top: 20px;">
                        <div class="info-label">Progress</div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: {{ $campaign->progress }}%"></div>
                        </div>
                    </div>

                    <div style="margin-top: 15px; padding: 15px; background: #f8f9fa; border-radius: 8px; font-size: 13px;">
                        <div style="margin-bottom: 10px;">
                            <strong>Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</strong> dari <strong>Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</strong>
                        </div>
                        <div style="color: #999;">
                            Masih memerlukan <strong>Rp {{ number_format($campaign->target_amount - $campaign->current_amount, 0, ',', '.') }}</strong> untuk mencapai target
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Donations Table -->
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-list"></i> Daftar Donasi ({{ $donations->total() }} total)
                </div>
            </div>
            <div class="card-body">
                @if ($donations->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Donatur</th>
                                <th>Jumlah Donasi</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donations as $donation)
                                <tr>
                                    <td>
                                        {{ $donation->donor_name ?? 'Anonim' }}
                                    </td>
                                    <td>
                                        <strong>Rp {{ number_format($donation->amount, 0, ',', '.') }}</strong>
                                    </td>
                                    <td>
                                        @if ($donation->status === 'paid')
                                            <span class="status-badge status-active">Berhasil</span>
                                        @elseif ($donation->status === 'pending')
                                            <span class="status-badge status-inactive">Menunggu</span>
                                        @else
                                            <span class="status-badge" style="background: #f8d7da; color: #721c24;">Gagal</span>
                                        @endif
                                    </td>
                                    <td>{{ $donation->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination">
                        {{ $donations->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada donasi untuk kampanye ini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
