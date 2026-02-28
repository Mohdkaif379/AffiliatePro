<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoiceNumber }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1e293b;
            line-height: 1.5;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: #f8fafc;
        }
        
        .invoice-container {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        
        /* Header Section */
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
        }
        
        .brand-section h1 {
            font-size: 42px;
            font-weight: 800;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 0 0 8px 0;
            letter-spacing: -1px;
        }
        
        .invoice-meta {
            display: flex;
            gap: 16px;
            align-items: center;
        }
        
        .invoice-number {
            background: #eef2ff;
            color: #2563eb;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        
        .status-badge {
            background: #f59e0b;
            color: white;
            padding: 8px 24px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(245, 158, 11, 0.2);
        }
        
        /* Client Info Card */
        .client-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 40px;
            border: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .client-info h3 {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b;
            margin: 0 0 12px 0;
        }
        
        .client-name {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin: 0 0 4px 0;
        }
        
        .client-email {
            font-size: 14px;
            color: #475569;
        }
        
        .period-badge {
            background: white;
            padding: 16px 24px;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            text-align: right;
        }
        
        .period-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .period-dates {
            font-size: 18px;
            font-weight: 700;
            color: #2563eb;
            margin-top: 4px;
        }
        
        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: #f8fafc;
            border-radius: 18px;
            padding: 20px;
            border: 1px solid #e9eef2;
            transition: all 0.2s;
        }
        
        .stat-label {
            font-size: 12px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
        }
        
        .stat-sub {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 6px;
        }
        
        /* Offers Section */
        .offers-section {
            margin-bottom: 40px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .section-title span {
            background: #2563eb;
            color: white;
            padding: 4px 12px;
            border-radius: 30px;
            font-size: 12px;
        }
        
        /* Offer Cards */
        .offer-card {
            background: white;
            border: 1px solid #e9eef2;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 16px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
            transition: all 0.2s;
        }
        
        .offer-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
            border-color: #cbd5e1;
        }
        
        .offer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 2px dashed #e2e8f0;
        }
        
        .offer-title {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
        }
        
        .offer-clicks {
            background: #eef2ff;
            color: #2563eb;
            padding: 6px 16px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 14px;
        }
        
        .offer-details {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        
        .detail-item {
            padding: 12px;
            background: #f8fafc;
            border-radius: 14px;
        }
        
        .detail-label {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        
        .detail-amount {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
        }
        
        .detail-amount.positive {
            color: #059669;
        }
        
        .detail-amount small {
            font-size: 11px;
            font-weight: normal;
            color: #64748b;
            margin-left: 4px;
        }
        
        /* Summary Section */
        .summary-section {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            border-radius: 24px;
            padding: 30px;
            margin-top: 40px;
            color: white;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }
        
        .summary-item {
            text-align: center;
            padding: 0 20px;
        }
        
        .summary-item:not(:last-child) {
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .summary-item .label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 8px;
        }
        
        .summary-item .value {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 4px;
        }
        
        .summary-item .sub {
            font-size: 11px;
            color: #94a3b8;
        }
        
        .total-clicks {
            font-size: 48px;
            font-weight: 800;
            color: #fbbf24;
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .total-clicks .label {
            font-size: 14px;
            color: #94a3b8;
            display: block;
            margin-bottom: 8px;
        }
        
        /* Footer */
        .invoice-footer {
            margin-top: 40px;
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px;
            background: #f8fafc;
            border-radius: 20px;
            color: #64748b;
            font-style: italic;
        }
        
        /* Currency */
        .currency {
            font-size: 12px;
            color: #64748b;
            margin-right: 2px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .offer-details {
                grid-template-columns: 1fr;
            }
            
            .summary-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .summary-item:not(:last-child) {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding-bottom: 20px;
            }
        }
    </style>
</head> 
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="invoice-header">
            <div class="brand-section">
                <h1>INVOICE</h1>
                <div class="invoice-meta">
                    <span class="invoice-number">#{{ $invoiceNumber }}</span>
                </div>
            </div>
            <div class="status-badge">● PENDING PAYMENT</div>
        </div>
        
        <!-- Client Information Card -->
        <div class="client-card">
            <div class="client-info">
                <h3>Bill To</h3>
                <div class="client-name">{{ $invoiceUser->full_name }}</div>
                <div class="client-email">{{ $invoiceUser->email }}</div>
            </div>
            
            @if($fromDate || $toDate)
            <div class="period-badge">
                <div class="period-label">Billing Period</div>
                <div class="period-dates">
                    {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d M Y') : 'Start' }} 
                    — 
                    {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d M Y') : 'Today' }}
                </div>
            </div>
            @endif
        </div>
        
        <!-- Quick Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Invoice Date</div>
                <div class="stat-value">{{ $invoiceDate->format('d M') }}</div>
                <div class="stat-sub">{{ $invoiceDate->format('Y') }}</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-label">Total Clicks</div>
                <div class="stat-value">{{ number_format($invoiceSummary['total_clicks']) }}</div>
                <div class="stat-sub">Billable actions</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-label">Total Revenue</div>
                <div class="stat-value">Rs {{ number_format($invoiceSummary['advertiser_total'], 0) }}</div>
                <div class="stat-sub">Advertiser amount</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-label">Platform Margin</div>
                <div class="stat-value" style="color: #059669;">Rs {{ number_format($invoiceSummary['platform_margin_total'], 0) }}</div>
                <div class="stat-sub">Net earnings</div>
            </div>
        </div>
        
        <!-- Offers Section -->
        <div class="offers-section">
            <div class="section-title">
                Offer Details
                <span>{{ count($lineItems) }} Items</span>
            </div>
            
            @forelse($lineItems as $item)
            <div class="offer-card">
                <div class="offer-header">
                    <div class="offer-title">{{ $item->offer_title }}</div>
                    <div class="offer-clicks">{{ number_format($item->total_clicks) }} clicks</div>
                </div>
                
                <div class="offer-details">
                    <div class="detail-item">
                        <div class="detail-label">Advertiser Rate</div>
                        <div class="detail-amount">Rs {{ number_format($item->advertiser_rate, 2) }}</div>
                        <small>Per click</small>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Affiliate Rate</div>
                        <div class="detail-amount">Rs {{ number_format($item->affiliate_rate, 2) }}</div>
                        <small>Per click</small>
                    </div>
                    
                    <div class="detail-item" style="background: #ecfdf5;">
                        <div class="detail-label">Platform Margin</div>
                        <div class="detail-amount positive">Rs {{ number_format($item->platform_margin, 2) }}</div>
                        <small>Net profit</small>
                    </div>
                </div>
                
                <div style="display: flex; justify-content: space-between; margin-top: 16px; padding-top: 16px; border-top: 1px solid #e9eef2;">
                    <div style="font-size: 13px; color: #475569;">
                        <strong>Advertiser Amount:</strong> Rs {{ number_format($item->advertiser_amount, 2) }}
                    </div>
                    <div style="font-size: 13px; color: #475569;">
                        <strong>Affiliate Amount:</strong> Rs {{ number_format($item->affiliate_amount, 2) }}
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                No billable click data found for this period
            </div>
            @endforelse
        </div>
        
        <!-- Summary Section (Dark Card) -->
        <div class="summary-section">
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="label">Advertiser Total</div>
                    <div class="value">Rs {{ number_format($invoiceSummary['advertiser_total'], 0) }}</div>
                    <div class="sub">Gross revenue</div>
                </div>
                
                <div class="summary-item">
                    <div class="label">Affiliate Payout</div>
                    <div class="value">Rs {{ number_format($invoiceSummary['affiliate_total'], 0) }}</div>
                    <div class="sub">Partner earnings</div>
                </div>
                
                <div class="summary-item">
                    <div class="label">Platform Margin</div>
                    <div class="value" style="color: #fbbf24;">Rs {{ number_format($invoiceSummary['platform_margin_total'], 0) }}</div>
                    <div class="sub">Net profit</div>
                </div>
            </div>
            
            <div class="total-clicks">
                <span class="label">Total Billable Clicks</span>
                {{ number_format($invoiceSummary['total_clicks']) }}
            </div>
        </div>
        
        <!-- Footer -->
        <div class="invoice-footer">
            <p>This is a system-generated invoice • For queries contact finance@company.com</p>
            <p>Invoice #{{ $invoiceNumber }} • Generated on {{ now()->format('d M Y, h:i A') }}</p>
        </div>
    </div>
</body>
</html>