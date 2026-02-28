<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $invoiceNumber }}</title>
    <!-- DOMPDF optimized version - NO Tailwind CDN, pure inline styles + embedded CSS -->
    <style>
        /* DOMPDF core styles - embedded for reliability */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DejaVu Sans', 'DejaVu', 'DejaVu Sans Mono', sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            line-height: 1.5;
            margin: 0;
            padding: 24px 16px;
            display: flex;
            justify-content: center;
        }
        
        /* Main invoice container */
        .invoice-container {
            max-width: 1100px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 30px -10px rgba(0,0,0,0.15);
            overflow: hidden;
            margin: 0 auto;
        }
        
        /* Header styles */
        .header {
            background: #0a1a2f;
            color: white;
            padding: 32px 40px 28px 40px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
            gap: 30px;
        }
        
        .header-left {
            flex: 2 1 260px;
        }
        
        .header-left h1 {
            font-size: 2.5rem;
            font-weight: 600;
            letter-spacing: -0.02em;
            margin: 0 0 4px 0;
        }
        
        .company-tag {
            color: #a0b8d4;
            font-size: 1rem;
            border-left: 4px solid #fbbf24;
            padding-left: 16px;
            margin-bottom: 20px;
        }
        
        .meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            margin-top: 8px;
        }
        
        .meta-item .label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #8ca3c2;
        }
        
        .meta-item .value {
            font-size: 1.25rem;
            font-weight: 600;
            color: white;
        }
        
        /* Logo area */
        .logo-area {
            flex: 0 0 auto;
            background: rgba(255,255,255,0.05);
            border: 1px dashed rgba(255,255,255,0.2);
            border-radius: 24px;
            padding: 18px 28px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .logo-img {
            max-width: 130px;
            max-height: 90px;
            object-fit: contain;
        }
        
        .logo-text {
            font-size: 0.75rem;
            color: #fde68a;
            margin-top: 8px;
            padding-top: 6px;
            border-top: 1px solid rgba(255,255,255,0.2);
        }
        
        /* Info cards grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            padding: 32px 40px 24px 40px;
            background: white;
        }
        
        .info-card {
            background: #f8fafc;
            border-radius: 16px;
            padding: 22px 26px;
            border: 1px solid #e2e8f0;
        }
        
        .card-title {
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #4338ca;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .card-title .dot {
            width: 8px;
            height: 8px;
            background: #f59e0b;
            border-radius: 50%;
            display: inline-block;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 12px;
            font-size: 0.95rem;
        }
        
        .info-label {
            width: 90px;
            color: #64748b;
        }
        
        .info-value {
            font-weight: 500;
            color: #1e293b;
        }
        
        .period-badge {
            background: white;
            border-radius: 12px;
            padding: 14px 16px;
            text-align: center;
            border: 1px solid #e2e8f0;
            margin-bottom: 16px;
        }
        
        .period-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.04em;
        }
        
        .period-dates {
            font-weight: 700;
            font-size: 1rem;
            color: #1e3a8a;
        }
        
        /* Items section */
        .items-section {
            padding: 0 40px 20px 40px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
        }
        
        .section-header h3 {
            font-size: 0.95rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #3730a3;
        }
        
        .currency-note {
            font-size: 0.75rem;
            color: #64748b;
        }
        
        .item-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 18px 22px;
            margin-bottom: 12px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            page-break-inside: avoid;
        }
        
        .item-offer {
            min-width: 180px;
            flex: 2 1 200px;
        }
        
        .offer-name {
            font-weight: 700;
            color: #1e293b;
        }
        
        .offer-desc {
            font-size: 0.7rem;
            color: #64748b;
        }
        
        .item-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 24px 32px;
            align-items: center;
            flex: 3 1 auto;
            justify-content: flex-end;
        }
        
        .stat {
            text-align: right;
        }
        
        .stat-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.03em;
        }
        
        .stat-value {
            font-weight: 600;
            color: #1e293b;
        }
        
        .stat-value.positive {
            color: #047857;
        }
        
        /* Totals bar */
        .totals-bar {
            background: #eef2ff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 20px 28px;
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        
        .total-item .total-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: #4338ca;
            font-weight: 600;
            letter-spacing: 0.04em;
        }
        
        .total-item .total-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }
        
        .total-item .total-number.positive {
            color: #047857;
        }
        
        .divider {
            width: 1px;
            height: 32px;
            background: #cbd5e1;
        }
        
        /* Summary cards */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px 40px 32px 40px;
        }
        
        .summary-card {
            background: white;
            border-radius: 24px;
            padding: 24px 12px;
            text-align: center;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 10px -4px rgba(0,0,0,0.05);
        }
        
        .summary-card.blue {
            border-top: 4px solid #2563eb;
        }
        
        .summary-card.green {
            border-top: 4px solid #059669;
        }
        
        .summary-card.orange {
            border-top: 4px solid #d97706;
        }
        
        .summary-label {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.06em;
            margin-bottom: 8px;
        }
        
        .summary-value {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
        }
        
        .summary-note {
            font-size: 0.75rem;
            color: #94a3b8;
            margin-top: 4px;
        }
        
        /* Payment section */
        .payment-section {
            padding: 0 40px 30px 40px;
        }
        
        .payment-card {
            background: #eef2ff;
            border-radius: 16px;
            padding: 24px 30px;
            border: 1px solid #c7d2fe;
        }
        
        .payment-title {
            font-size: 0.9rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #3730a3;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .payment-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 18px;
        }
        
        .payment-item .pay-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            color: #64748b;
        }
        
        .payment-item .pay-value {
            font-weight: 600;
            color: #1e293b;
            word-break: break-word;
        }
        
        /* Footer */
        .footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 20px 40px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 16px;
            font-size: 0.85rem;
            color: #64748b;
        }
        
        .footer .accent {
            color: #b45309;
            font-weight: 600;
        }
        
        /* Print styles for DOMPDF */
        @media print {
            body {
                background: white;
                padding: 0.2in;
            }
            .invoice-container {
                box-shadow: none;
                border: 1px solid #ddd;
            }
            .header {
                background: #0a1a2f !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .summary-card {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

<div class="invoice-container">

    <!-- ========== HEADER with logo ========== -->
    <div class="header">
        <div class="header-left">
            <h1>INVOICE</h1>
            <div class="company-tag">digital marketing solutions · performance based</div>

            <div class="meta-row">
                <div class="meta-item">
                    <div class="label">invoice no.</div>
                    <div class="value">{{ $invoiceNumber ?? 'INV-2425-013' }}</div>
                </div>
                <div class="meta-item">
                    <div class="label">invoice date</div>
                    <div class="value">{{ isset($invoiceDate) ? $invoiceDate->format('d M Y') : '28 Feb 2026' }}</div>
                </div>
                <div class="meta-item">
                    <div class="label">due (net15)</div>
                    <div class="value">{{ isset($invoiceDate) ? $invoiceDate->copy()->addDays(15)->format('d M Y') : '15 Mar 2026' }}</div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE: YOUR LOGO URL -->
        <div class="logo-area">
            <img 
                src="https://affiliateprogramme.newhopeindia17.com/public/images/logo.png" 
                alt="Company Logo"
                class="logo-img"
                onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22120%22%20height%3D%2280%22%20viewBox%3D%220%200%20120%2080%22%3E%3Crect%20width%3D%22120%22%20height%3D%2280%22%20fill%3D%22%233b5b8f%22%2F%3E%3Ctext%20x%3D%2210%22%20y%3D%2245%22%20font-family%3D%22DejaVu%20Sans%22%20font-size%3D%2214%22%20fill%3D%22%23ffffff%22%3ELOGO%3C%2Ftext%3E%3C%2Fsvg%3E';"
            />
            <span class="logo-text">New Hope India</span>
        </div>
    </div>

    <!-- ========== CLIENT & PERIOD CARDS ========== -->
    <div class="info-grid">
        <!-- client card -->
        <div class="info-card">
            <div class="card-title"><span class="dot"></span> Bill to</div>
            <div class="info-row">
                <span class="info-label">Client</span>
                <span class="info-value">{{ $invoiceUser->full_name ?? 'Aarav Mehta' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value">{{ $invoiceUser->email ?? 'client@performacemedia.com' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Client ID</span>
                <span class="info-value">#CLI-{{ isset($invoiceUser->email) ? substr($invoiceUser->email,0,4) : 'AARA' }}{{ rand(100,999) }}</span>
            </div>
        </div>

        <!-- period card -->
        <div class="info-card">
            <div class="card-title"><span class="dot"></span> Billing period</div>
            @if(!empty($fromDate) || !empty($toDate))
            <div class="period-badge">
                <div class="period-label">service period</div>
                <div class="period-dates">
                    {{ $fromDate ? \Carbon\Carbon::parse($fromDate)->format('d M Y') : '01 Mar 2026' }}
                    —
                    {{ $toDate ? \Carbon\Carbon::parse($toDate)->format('d M Y') : '28 Feb 2026' }}
                </div>
            </div>
            @else
            <div class="period-badge">
                <div class="period-label">service period</div>
                <div class="period-dates">01 Feb 2026 — 28 Feb 2026</div>
            </div>
            @endif
            <div class="info-row">
                <span class="info-label">Status</span>
                <span class="info-value" style="color: #b45309;">pending</span>
            </div>
        </div>
    </div>

    <!-- ========== ITEMS SECTION ========== -->
    <div class="items-section">
        <div class="section-header">
            <h3>offer / campaign details</h3>
            <span class="currency-note">all amounts in INR</span>
        </div>

        <div>
            @forelse($lineItems ?? [] as $item)
            <!-- dynamic item card -->
            <div class="item-card">
                <div class="item-offer">
                    <div class="offer-name">{{ $item->offer_title ?? 'Google discovery' }}</div>
                    <div class="offer-desc">campaign {{ $item->campaign_short ?? '#C' . rand(1000,9999) }}</div>
                </div>
                <div class="item-stats">
                    <div class="stat">
                        <span class="stat-label">clicks</span>
                        <div class="stat-value">{{ number_format($item->total_clicks ?? 13250) }}</div>
                    </div>
                    <div class="stat">
                        <span class="stat-label">adv rate</span>
                        <div class="stat-value">₹{{ number_format($item->advertiser_rate ?? 12.40,2) }}</div>
                    </div>
                    <div class="stat">
                        <span class="stat-label">aff rate</span>
                        <div class="stat-value">₹{{ number_format($item->affiliate_rate ?? 7.80,2) }}</div>
                    </div>
                    <div class="stat">
                        <span class="stat-label">advertiser</span>
                        <div class="stat-value positive">₹{{ number_format($item->advertiser_amount ?? 164300,2) }}</div>
                    </div>
                    <div class="stat">
                        <span class="stat-label">margin</span>
                        <div class="stat-value positive">₹{{ number_format($item->platform_margin ?? 60850,2) }}</div>
                    </div>
                </div>
            </div>
            @empty
            <!-- sample preview items -->
            <div class="item-card">
                <div class="item-offer"><div class="offer-name">Search brand – Max</div><div class="offer-desc">campaign #SA923</div></div>
                <div class="item-stats">
                    <div class="stat"><span class="stat-label">clicks</span><div class="stat-value">15,420</div></div>
                    <div class="stat"><span class="stat-label">adv rate</span><div class="stat-value">₹12.50</div></div>
                    <div class="stat"><span class="stat-label">aff rate</span><div class="stat-value">₹8.25</div></div>
                    <div class="stat"><span class="stat-label">advertiser</span><div class="stat-value positive">₹192,750</div></div>
                    <div class="stat"><span class="stat-label">margin</span><div class="stat-value positive">₹67,250</div></div>
                </div>
            </div>
            <div class="item-card">
                <div class="item-offer"><div class="offer-name">Meta retarget</div><div class="offer-desc">campaign #M211</div></div>
                <div class="item-stats">
                    <div class="stat"><span class="stat-label">clicks</span><div class="stat-value">8,750</div></div>
                    <div class="stat"><span class="stat-label">adv rate</span><div class="stat-value">₹9.80</div></div>
                    <div class="stat"><span class="stat-label">aff rate</span><div class="stat-value">₹5.40</div></div>
                    <div class="stat"><span class="stat-label">advertiser</span><div class="stat-value positive">₹85,750</div></div>
                    <div class="stat"><span class="stat-label">margin</span><div class="stat-value positive">₹38,500</div></div>
                </div>
            </div>
            <div class="item-card">
                <div class="item-offer"><div class="offer-name">LinkedIn awareness</div><div class="offer-desc">campaign #L442</div></div>
                <div class="item-stats">
                    <div class="stat"><span class="stat-label">clicks</span><div class="stat-value">3,210</div></div>
                    <div class="stat"><span class="stat-label">adv rate</span><div class="stat-value">₹22.00</div></div>
                    <div class="stat"><span class="stat-label">aff rate</span><div class="stat-value">₹15.80</div></div>
                    <div class="stat"><span class="stat-label">advertiser</span><div class="stat-value positive">₹70,620</div></div>
                    <div class="stat"><span class="stat-label">margin</span><div class="stat-value positive">₹19,908</div></div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- totals bar -->
        <div class="totals-bar">
            <div class="total-item">
                <span class="total-label">total clicks</span>
                <div class="total-number">{{ number_format($invoiceSummary['total_clicks'] ?? 27380) }}</div>
            </div>
            <div class="divider"></div>
            <div class="total-item">
                <span class="total-label">advertiser total</span>
                <div class="total-number positive">₹{{ number_format($invoiceSummary['advertiser_total'] ?? 349120, 0) }}</div>
            </div>
            <div class="divider"></div>
            <div class="total-item">
                <span class="total-label">platform margin</span>
                <div class="total-number positive">₹{{ number_format($invoiceSummary['platform_margin_total'] ?? 125658, 0) }}</div>
            </div>
        </div>
    </div>

    <!-- ========== THREE SUMMARY CARDS ========== -->
    <div class="summary-grid">
        <div class="summary-card blue">
            <div class="summary-label">total clicks</div>
            <div class="summary-value">{{ number_format($invoiceSummary['total_clicks'] ?? 27380) }}</div>
            <div class="summary-note">billable actions</div>
        </div>
        <div class="summary-card green">
            <div class="summary-label">advertiser total</div>
            <div class="summary-value">₹{{ number_format($invoiceSummary['advertiser_total'] ?? 349120, 0) }}</div>
            <div class="summary-note">gross revenue</div>
        </div>
        <div class="summary-card orange">
            <div class="summary-label">platform margin</div>
            <div class="summary-value">₹{{ number_format($invoiceSummary['platform_margin_total'] ?? 125658, 0) }}</div>
            <div class="summary-note">your profit</div>
        </div>
    </div>

    <!-- ========== PAYMENT DETAILS (if any) ========== -->
    @if(!empty($payment))
    <div class="payment-section">
        <div class="payment-card">
            <div class="payment-title"><span class="dot"></span> payment details</div>
            <div class="payment-grid">
                <div class="payment-item"><span class="pay-label">method</span><div class="pay-value">{{ ucfirst($payment['payment_method'] ?? '') }}</div></div>

                @if(($payment['payment_method'] ?? '') === 'upi')
                    <div class="payment-item"><span class="pay-label">UPI ID</span><div class="pay-value">{{ $payment['upi_id'] ?? '—' }}</div></div>
                @elseif(($payment['payment_method'] ?? '') === 'cash')
                    <div class="payment-item"><span class="pay-label">receipt / notes</span><div class="pay-value">{{ $payment['cash_receipt'] ?? '—' }}</div></div>
                @elseif(($payment['payment_method'] ?? '') === 'bank')
                    <div class="payment-item"><span class="pay-label">bank</span><div class="pay-value">{{ $payment['bank_name'] ?? '—' }}</div></div>
                    <div class="payment-item"><span class="pay-label">account</span><div class="pay-value">{{ $payment['bank_account'] ?? '—' }}</div></div>
                    <div class="payment-item"><span class="pay-label">IFSC</span><div class="pay-value">{{ $payment['bank_ifsc'] ?? '—' }}</div></div>
                @elseif(($payment['payment_method'] ?? '') === 'card')
                    <div class="payment-item"><span class="pay-label">cardholder</span><div class="pay-value">{{ $payment['card_name'] ?? '—' }}</div></div>
                    @php
                        $cardNumber = $payment['card_number'] ?? null;
                        $last4 = $cardNumber ? substr(preg_replace('/\s+/','',$cardNumber),-4) : null;
                    @endphp
                    <div class="payment-item"><span class="pay-label">card</span><div class="pay-value">{{ $last4 ? '•••• •••• •••• '.$last4 : '—' }}</div></div>
                    <div class="payment-item"><span class="pay-label">expiry</span><div class="pay-value">{{ ($payment['card_exp_month'] ?? '').'/'.($payment['card_exp_year'] ?? '') }}</div></div>
                    <div class="payment-item"><span class="pay-label">txn id</span><div class="pay-value">{{ $payment['card_txn'] ?? '—' }}</div></div>
                @endif
            </div>
        </div>
    </div>
    @endif

    <!-- ========== FOOTER ========== -->
    <div class="footer">
        <div><span class="accent">Digital Marketing Solutions</span> · contact@dms.co</div>
        <div>generated: {{ now()->format('d M Y') }}</div>
    </div>
</div>

</body>
</html>