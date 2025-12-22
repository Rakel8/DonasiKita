@extends('layouts.admin')

@section('title', 'Daftar Donasi')

@section('extra-styles')
<style>
    .header {
        background: white;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 25px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .header h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }
    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 8px;
    }
    .stat-card.pending {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    .stat-card h3 {
        font-size: 14px;
        margin-bottom: 8px;
        opacity: 0.9;
    }
    .stat-card .value {
            
        font-size: 24px;
        font-weight: 700;
    }

    .filters {
        background: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .filters input, .filters select {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }
    .filters input {
        flex: 1;
        min-width: 200px;
    }
    .btn {
        padding: 10px 20px;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn:hover {
        background: #5568d3;
    }
    .btn.secondary {
        background: #6c757d;
    }
    .btn.secondary:hover {
        background: #5a6268;
    }

    .table-container {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th {
        background: #f8f9fa;
        padding: 15px;
        text-align: left;
        font-weight: 600;
        font-size: 13px;
        color: #666;
        border-bottom: 1px solid #e0e0e0;
    }
    td {
        padding: 15px;
        border-bottom: 1px solid #e0e0e0;
    }
    tr:hover {
        background: #f9f9f9;
    }
    .badge {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge.paid {
        background: #d4edda;
        color: #155724;
    }
    .badge.pending {
        background: #fff3cd;
        color: #856404;
    }
    .badge.failed {
        background: #f8d7da;
        color: #721c24;
    }
    .amount {
        font-weight: 600;
        color: #667eea;
    }
    
    /* Auto-refresh indicator */
    .badge.pending::after {
        content: '';
        display: inline-block;
        width: 8px;
        height: 8px;
        background: #ff9800;
        border-radius: 50%;
        margin-left: 6px;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }
    
    /* Real-time indicator di header */
    .auto-refresh-indicator {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #667eea;
        margin-top: 10px;
    }
    
    .auto-refresh-indicator .dot {
        width: 8px;
        height: 8px;
        background: #4caf50;
        border-radius: 50%;
        animation: blink 1s infinite;
    }
    
    @keyframes blink {
        0%, 49%, 100% {
            opacity: 1;
        }
        50%, 99% {
            opacity: 0;
        }
    }
    
    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 20px;
    }
    .pagination a, .pagination span {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-decoration: none;
        color: #667eea;
    }
    .pagination a:hover {
        background: #f5f5f5;
    }
    .pagination .active {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    .action-buttons a {
        padding: 6px 12px;
        background: #e7f3ff;
        color: #0066cc;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        font-size: 12px;
        cursor: pointer;
    }
    .action-buttons a:hover {
        background: #cce5ff;
    }
    .action-buttons button {
        padding: 6px 12px;
        background: #fff3cd;
        color: #856404;
        border: none;
        border-radius: 4px;
        font-size: 12px;
        cursor: pointer;
    }
    .empty {
        text-align: center;
        padding: 40px 20px;
        color: #999;
    }
</style>
@endsection

@section('content')
        <div class="header">
            <h1><i class="fas fa-credit-card"></i> Manajemen Donasi</h1>
            <p>Track dan kelola semua donasi yang masuk</p>
            <div class="auto-refresh-indicator">
                <span class="dot"></span>
                <span>Auto-check pembayaran pending</span>
            </div>

            <div class="stats">
                <div class="stat-card">
                    <h3>Total Donasi</h3>
                    <div class="value">{{ number_format($totalDonations / 1000000, 1) }}M</div>
                </div>
                <div class="stat-card">
                    <h3>Donasi Sukses</h3>
                    <div class="value">{{ number_format($totalPaidDonations / 1000000, 1) }}M</div>
                </div>
                <div class="stat-card">
                    <h3>Jumlah Donasi</h3>
                    <div class="value">{{ $donationCount }}</div>
                </div>
                <div class="stat-card pending">
                    <h3>Menunggu Pembayaran</h3>
                    <div class="value">{{ $pendingDonations }}</div>
                </div>
            </div>
        </div>

        <div class="filters">
            <form method="GET" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: center; width: 100%;">
                <input type="text" name="search" placeholder="Cari nama, email, atau telpon..." value="{{ request('search') }}">
                <select name="status">
                    <option value="">Semua Status</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Sukses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Gagal</option>
                </select>
                <button type="submit" class="btn">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="{{ route('admin.donations.export') }}" class="btn secondary">
                    <i class="fas fa-download"></i> Export CSV
                </a>
            </form>
        </div>

        <div class="table-container">
            @if($donations->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Donatur</th>
                            <th>Email</th>
                            <th>Nominal</th>
                            <th>Kampanye</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donations as $donation)
                            <tr data-order-id="{{ $donation->order_id }}" data-donation-id="{{ $donation->id }}">
                                <td>{{ $donation->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $donation->donor_name }}</td>
                                <td>{{ $donation->donor_email }}</td>
                                <td class="amount">Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                <td>{{ $donation->campaign->title }}</td>
                                <td>
                                    <span class="badge {{ $donation->payment_status }}" data-status="{{ $donation->payment_status }}">
                                        {{ ucfirst($donation->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.donations.show', $donation->id) }}">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $donations->links() }}
                </div>
            @else
                <div class="empty">
                    <i class="fas fa-inbox" style="font-size: 48px; color: #ddd;"></i>
                    <p style="margin-top: 15px;">Tidak ada donasi</p>
                </div>
            @endif
        </div>

@endsection

@section('extra-scripts')
<script>
    // Auto-refresh donation status setiap 10 detik untuk check payment updates
    const AUTO_REFRESH_INTERVAL = 10000; // 10 detik
    let refreshTimeout;

    function checkPendingDonations() {
        const pendingRows = document.querySelectorAll('tr[data-order-id]');
        
        if (pendingRows.length === 0) {
            return;
        }

        // Check each row dengan pending status
        pendingRows.forEach(row => {
            const orderId = row.dataset.orderId;
            const statusBadge = row.querySelector('[data-status]');
            
            if (!orderId || !statusBadge || statusBadge.dataset.status !== 'pending') {
                return;
            }

            fetch(`/api/donation/${orderId}/status`)
                .then(res => res.json())
                .then(data => {
                    if (data.payment_status === 'paid' && statusBadge.dataset.status === 'pending') {
                        // Status changed to paid, refresh the page
                        console.log(`Payment received for ${orderId}, refreshing...`);
                        location.reload();
                    }
                })
                .catch(err => console.error('Error checking payment status:', err));
        });
    }

    function startAutoRefresh() {
        refreshTimeout = setInterval(checkPendingDonations, AUTO_REFRESH_INTERVAL);
    }

    function stopAutoRefresh() {
        if (refreshTimeout) {
            clearInterval(refreshTimeout);
        }
    }

    // Start auto-refresh when page loads
    document.addEventListener('DOMContentLoaded', () => {
        startAutoRefresh();
        
        // Check immediately on load
        checkPendingDonations();
    });

    // Stop auto-refresh when leaving page
    window.addEventListener('beforeunload', stopAutoRefresh);
</script>
@endsection
