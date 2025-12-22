@extends('layouts.admin')

@section('title', 'Detail Donatur')

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

    .donor-header {
        display: flex;
        align-items: center;
        gap: 25px;
        margin-bottom: 25px;
    }
    .donor-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        font-weight: 700;
    }
    .donor-details h1 {
        font-size: 24px;
        margin-bottom: 5px;
    }
    .donor-details p {
        color: #999;
        font-size: 14px;
        margin-bottom: 3px;
    }

    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin: 20px 0;
    }
    .stat {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 6px;
        border-left: 4px solid #667eea;
    }
    .stat label {
        font-size: 12px;
        color: #999;
        margin-bottom: 5px;
        display: block;
    }
    .stat value {
        font-size: 20px;
        font-weight: 700;
        color: #667eea;
        display: block;
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
        font-size: 14px;
        font-weight: 500;
        color: #333;
    }

    .table-container {
        overflow-x: auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    th {
        background: #f8f9fa;
        padding: 12px;
        text-align: left;
        font-weight: 600;
        font-size: 12px;
        color: #666;
        border-bottom: 1px solid #e0e0e0;
    }
    td {
        padding: 12px;
        border-bottom: 1px solid #e0e0e0;
    }
    tr:hover {
        background: #f9f9f9;
    }
    .amount {
        font-weight: 600;
        color: #667eea;
    }
    .badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        background: #d4edda;
        color: #155724;
    }

    /* Pagination summary only (no large buttons) */
    .pagination-summary {
        margin-top: 20px;
        text-align: center;
        font-size: 13px;
        color: #444;
        display: flex;
        flex-direction: column;
        gap: 6px;
        align-items: center;
    }
    .pagination-nav {
        display: inline-flex;
        gap: 12px;
        align-items: center;
    }
    .pagination-nav a,
    .pagination-nav span {
        color: #667eea;
        font-weight: 600;
        text-decoration: none;
        font-size: 13px;
    }
    .pagination-nav span.disabled { color: #bbb; }
    .pagination-info { font-size: 12px; color: #666; }

    @media (max-width: 768px) {
        .donor-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .info-grid {
            grid-template-columns: 1fr;
        }
        .stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')
        <a href="{{ route('admin.donors.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card">
            <div class="donor-header">
                <div class="donor-avatar">
                    {{ strtoupper(substr($donor->donor_name, 0, 1)) }}
                </div>
                <div class="donor-details">
                    <h1>{{ $donor->donor_name }}</h1>
                    <p><i class="fas fa-envelope"></i> {{ $donor->donor_email }}</p>
                    <p><i class="fas fa-phone"></i> {{ $donor->donor_phone }}</p>
                </div>
            </div>

            <div class="stats">
                <div class="stat">
                    <label>Total Donasi</label>
                    <value>Rp {{ number_format($totalDonations, 0, ',', '.') }}</value>
                </div>
                <div class="stat">
                    <label>Jumlah Transaksi</label>
                    <value>{{ $donationCount }}x</value>
                </div>
                <div class="stat">
                    <label>Donasi Terakhir</label>
                    <value>{{ $lastDonation?->created_at->format('d/m/Y') ?? '-' }}</value>
                </div>
                <div class="stat">
                    <label>Rata-rata/Donasi</label>
                    <value>Rp {{ number_format($donationCount > 0 ? $totalDonations / $donationCount : 0, 0, ',', '.') }}</value>
                </div>
            </div>
        </div>

        <div class="card">
            <h2>Riwayat Donasi</h2>
            
            <div class="table-container">
                @if($donations->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kampanye</th>
                                <th>Nominal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($donations as $donation)
                                <tr>
                                    <td>{{ $donation->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.campaigns.edit', $donation->campaign->id) }}" style="color: #667eea; text-decoration: none;">
                                            {{ $donation->campaign->title }}
                                        </a>
                                    </td>
                                    <td class="amount">Rp {{ number_format($donation->amount, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge">{{ ucfirst($donation->payment_status) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="pagination-summary">
                        <div class="pagination-nav">
                            @if ($donations->previousPageUrl())
                                <a href="{{ $donations->previousPageUrl() }}">&laquo; Previous</a>
                            @else
                                <span class="disabled">&laquo; Previous</span>
                            @endif

                            @if ($donations->nextPageUrl())
                                <a href="{{ $donations->nextPageUrl() }}">Next &raquo;</a>
                            @else
                                <span class="disabled">Next &raquo;</span>
                            @endif
                        </div>
                        <div class="pagination-info">
                            Showing {{ $donations->firstItem() }} to {{ $donations->lastItem() }} of {{ $donations->total() }} results
                        </div>
                    </div>
                @else
                    <p style="text-align: center; color: #999; padding: 20px;">Belum ada donasi</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
