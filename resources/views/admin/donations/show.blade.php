@extends('layouts.admin')

@section('title', 'Detail Donasi')

@section('extra-styles')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #667eea;
        text-decoration: none;
        margin-bottom: 20px;
        font-size: 14px;
    }
    .back-link:hover {
        text-decoration: underline;
    }

    .card {
        background: white;
        border-radius: 8px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .card h2 {
        font-size: 18px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        margin-bottom: 20px;
    }
    .info-item label {
        display: block;
        font-size: 12px;
        color: #999;
        margin-bottom: 5px;
        font-weight: 600;
        text-transform: uppercase;
    }
    .info-item value {
        display: block;
        font-size: 16px;
        font-weight: 500;
        color: #333;
    }
    .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
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
    .amount-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 8px;
        text-align: center;
        margin: 20px 0;
    }
    .amount-box .label {
        font-size: 13px;
        opacity: 0.9;
    }
    .amount-box .value {
        font-size: 32px;
        font-weight: 700;
        margin-top: 8px;
    }

    .status-form {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .status-form select {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 14px;
    }
    .btn {
        padding: 10px 20px;
        background: #667eea;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }
    .btn:hover {
        background: #5568d3;
    }

    .timeline {
        position: relative;
        padding-left: 40px;
    }
    .timeline-item {
        margin-bottom: 20px;
        position: relative;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -35px;
        top: 5px;
        width: 12px;
        height: 12px;
        background: #667eea;
        border-radius: 50%;
        border: 3px solid white;
    }
    .timeline-item .time {
        font-size: 12px;
        color: #999;
    }
    .timeline-item .text {
        font-size: 14px;
        margin-top: 3px;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <a href="{{ route('admin.donations.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card">
            <h2>Detail Donasi</h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <label>Nomor Pesanan</label>
                    <value>{{ $donation->order_id }}</value>
                </div>
                <div class="info-item">
                    <label>Tanggal</label>
                    <value>{{ $donation->created_at->format('d F Y H:i') }}</value>
                </div>
            </div>
        </div>

        <div class="card">
            <h2>Informasi Donatur</h2>
            
            <div class="info-grid">
                <div class="info-item">
                    <label>Nama Lengkap</label>
                    <value>{{ $donation->donor_name }}</value>
                </div>
                <div class="info-item">
                    <label>Email</label>
                    <value>{{ $donation->donor_email }}</value>
                </div>
                <div class="info-item">
                    <label>Nomor Telepon</label>
                    <value>{{ $donation->donor_phone }}</value>
                </div>
                <div class="info-item">
                    <label>Privasi Nama</label>
                    <value>
                        @if($donation->hide_name)
                            <span class="badge" style="background: #e7f3ff; color: #0066cc;">Tersembunyi</span>
                        @else
                            <span class="badge" style="background: #d4edda; color: #155724;">Ditampilkan</span>
                        @endif
                    </value>
                </div>
            </div>
        </div>

        <div class="card">
            <h2>Informasi Donasi</h2>
            
            <div class="amount-box">
                <div class="label">Total Donasi</div>
                <div class="value">Rp {{ number_format($donation->amount, 0, ',', '.') }}</div>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <label>Kampanye</label>
                    <value>
                        <a href="{{ route('admin.campaigns.edit', $donation->campaign->id) }}" style="color: #667eea; text-decoration: none;">
                            {{ $donation->campaign->title }}
                        </a>
                    </value>
                </div>
                <div class="info-item">
                    <label>Status Pembayaran</label>
                    <value>
                        <span class="badge {{ $donation->payment_status }}">
                            {{ match($donation->payment_status) {
                                'paid' => 'Sukses',
                                'pending' => 'Menunggu',
                                'failed' => 'Gagal',
                                default => ucfirst($donation->payment_status)
                            } }}
                        </span>
                    </value>
                </div>
            </div>

            @if($donation->payment_status == 'paid')
                <div class="info-grid" style="margin-top: 20px;">
                    <div class="info-item">
                        <label>Tipe Pembayaran</label>
                        <value>{{ ucfirst($donation->payment_type ?? '-') }}</value>
                    </div>
                    <div class="info-item">
                        <label>Tanggal Pembayaran</label>
                        <value>{{ $donation->paid_at?->format('d F Y H:i') ?? '-' }}</value>
                    </div>
                </div>
            @endif
        </div>

        <div class="card">
            <h2>Status Pembayaran</h2>
            
            <div style="display: flex; gap: 15px; margin-bottom: 20px; align-items: center;">
                <div>
                    <strong>Status Saat Ini:</strong>
                    <span class="badge {{ $donation->payment_status }}" style="margin-left: 10px;">
                        {{ ucfirst($donation->payment_status) }}
                    </span>
                </div>
                @if($donation->payment_status === 'pending')
                    <button type="button" class="btn" id="verifyBtn" style="background: #28a745;" onclick="verifyPayment()">
                        <i class="fas fa-check"></i> Verify ke Midtrans
                    </button>
                @endif
            </div>

            <div id="verifyMessage" style="margin-bottom: 15px; display: none; padding: 12px; border-radius: 6px; font-size: 14px;"></div>
        </div>

        <div class="card">
            <h2>Ubah Status Manual</h2>
            
            <form method="POST" action="{{ route('admin.donations.update-status', $donation->id) }}" class="status-form">
                @csrf
                <select name="status">
                    <option value="paid" {{ $donation->payment_status == 'paid' ? 'selected' : '' }}>Sukses</option>
                    <option value="pending" {{ $donation->payment_status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="failed" {{ $donation->payment_status == 'failed' ? 'selected' : '' }}>Gagal</option>
                </select>
                <button type="submit" class="btn">Perbarui Status</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
<script>
function verifyPayment() {
    const btn = document.getElementById('verifyBtn');
    const msg = document.getElementById('verifyMessage');
    const orderId = '{{ $donation->order_id }}';
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Verifying...';
    
    fetch(`/api/donation/${orderId}/verify`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            'Content-Type': 'application/json',
        },
    })
    .then(res => res.json())
    .then(data => {
        msg.style.display = 'block';
        
        if (data.updated) {
            // Payment verified and updated
            msg.style.backgroundColor = '#d4edda';
            msg.style.color = '#155724';
            msg.innerHTML = `
                <strong>✓ Pembayaran Berhasil Diverifikasi!</strong><br>
                Status telah diubah menjadi <strong>PAID</strong>.<br>
                <a href="javascript:location.reload()" style="color: inherit; text-decoration: underline;">Reload halaman</a>
            `;
            btn.style.display = 'none';
        } else if (data.status === 'pending') {
            msg.style.backgroundColor = '#fff3cd';
            msg.style.color = '#856404';
            msg.innerHTML = '<strong>⚠ Pembayaran Masih Pending</strong><br>Status belum berubah di Midtrans.';
        } else if (data.status === 'paid') {
            msg.style.backgroundColor = '#d4edda';
            msg.style.color = '#155724';
            msg.innerHTML = '<strong>✓ Pembayaran Sudah Verified</strong><br>Status sudah paid di sistem.';
            btn.style.display = 'none';
        } else if (data.error) {
            msg.style.backgroundColor = '#f8d7da';
            msg.style.color = '#721c24';
            msg.innerHTML = `<strong>✗ Error:</strong> ${data.error}`;
        }
        
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-check"></i> Verify ke Midtrans';
    })
    .catch(err => {
        msg.style.display = 'block';
        msg.style.backgroundColor = '#f8d7da';
        msg.style.color = '#721c24';
        msg.innerHTML = `<strong>✗ Error:</strong> ${err.message}`;
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-check"></i> Verify ke Midtrans';
    });
}
</script>
@endsection
