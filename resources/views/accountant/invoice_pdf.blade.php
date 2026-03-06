<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>NHI 17 Services - Invoice</title>
</head>

<body style="font-family: DejaVu Sans, sans-serif; background:#f1f5f9; border-radius:20px;">

    <div style="max-width:1100px; margin:auto; border-radius:20px;overflow:hidden;">


        <!-- HEADER -->
        <div style="background:#0a1a2f;color:#fff;padding:10px;">
            <h1 style="text-align:center; margin:0;">
                INVOICE
            </h1>
            <table width="100%">
                <tr>

                    <!-- LOGO LEFT -->
                    <td width="220" valign="top">
                        <div style="text-align:left;">

                            <img src="{{ public_path('images/logo.png') }}"
                                style="max-width:140px; max-height:80px; display:block; margin-bottom:8px; margin-left:30px;">

                            <div style="font-size:11px; color:white; line-height:1.5;">

                                <div style="font-weight:bold; margin-bottom:2px;">
                                    Address:
                                    <span style="font-weight:normal;">
                                        123, Main Street, New Delhi, India
                                    </span>
                                </div>

                                <div style="font-weight:bold;">
                                    Phone:
                                    <span style="font-weight:normal;">
                                        +91 98765 43210
                                    </span>
                                </div>

                            </div>
                        </div>
                    </td>

                    <!-- DETAILS RIGHT -->
                    <td valign="top">
                        <table width="100%">
                            <tr>
                                <td style="text-align:right;">
                                    <div style="font-size:11px;color:#8ca3c2;">Invoice No</div>
                                    <div style="font-size:14px;font-weight:bold;">
                                        {{ $invoiceNumber ?? 'INV-001' }}
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:right;">
                                    <div style="font-size:11px;color:#8ca3c2;">Invoice Date</div>
                                    <div style="font-size:14px;font-weight:bold;">
                                        {{ date('d M Y') }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    <div style="font-size:11px;color:#8ca3c2;">Payment Method</div>
                                    <div style="font-size:14px;font-weight:bold;">
                                        {{ $payment['payment_method'] ?? 'None' }}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align:right;">
                                    <div style="
                                            display:inline-block;
                                            padding:4px 10px;
                                            font-size:13px;
                                            font-weight:bold;
                                            background:#22c55e;
                                            color:#ffffff;
                                            border-radius:24px;
                                        ">
                                        {{ $payment['payment_status'] ?? 'Paid' }}
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'DejaVu Sans', sans-serif; max-width: 800px; margin: 0 auto; padding: 20px 0;">
            <tr>
                <td colspan="3" style="padding: 0 20px 20px 20px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <!-- Bill To with Left Margin -->
                            <td width="48%" valign="top" style="padding-left: 20px;">
                                <div style="font-size: 12px; color: #6b7280; margin-bottom: 8px;">BILL TO</div>
                                <div style="font-size: 16px; color: #111827; font-weight: 600;">
                                    {{ $invoiceUser->full_name ?? 'Client Name' }}
                                </div>
                                <div style="font-size: 16px; color: #4b5563;">
                                    {{ $invoiceUser->email ?? 'client@mail.com' }}<br>
                                    @if(isset($invoiceUser->address))
                                    {{ $invoiceUser->address }}
                                    @endif
                                </div>
                            </td>

                            <td width="4%"></td>

                            <!-- Billing Period -->
                            <td width="48%" valign="top" align="right">
                                <div style="font-size: 12px; color: #6b7280; margin-bottom: 8px;">BILLING PERIOD</div>
                                <div style="font-size: 12px; color: #111827; margin-bottom: 4px;">
                                    <span style="color: #4b5563;">From:</span> {{ $fromDate ?? '01 Mar 2026' }}
                                </div>
                                <div style="font-size: 12px; color: #111827;">
                                    <span style="color: #4b5563;">To:</span> {{ $toDate ?? '28 Mar 2026' }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- OFFER DETAILS TABLE - FULL TABLE -->
        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; background: white; border: 1px solid black; font-family: 'DejaVu Sans', sans-serif; margin: 0 20px; width: calc(100% - 40px);">

            @forelse($lineItems ?? [] as $index => $item)
            <!-- Offer Header -->
            <tr>
                <td colspan="5" style="background: black; padding: 16px 20px;">
                    <div style="font-size: 18px; font-weight: 600; color: white;">{{ $item->offer_title }}</div>
                </td>
            </tr>

            <!-- Column Headers -->
            <tr style="background: #f8fafc;">
                <th style="padding: 14px 15px; text-align: left; font-size: 13px; font-weight: 700; color: #334155; border-right: 1px solid black; border-bottom: 1px solid black;">Offer</th>
                <th style="padding: 14px 15px; text-align: center; font-size: 13px; font-weight: 700; color: #334155; border-right: 1px solid black; border-bottom: 1px solid black;">Clicks</th>
                <th style="padding: 14px 15px; text-align: center; font-size: 13px; font-weight: 700; color: #334155; border-right: 1px solid black; border-bottom: 1px solid black;">Views</th>
                <th style="padding: 14px 15px; text-align: center; font-size: 13px; font-weight: 700; color: #334155; border-right: 1px solid black; border-bottom: 1px solid black;">Conversions</th>
                <th style="padding: 14px 15px; text-align: right; font-size: 13px; font-weight: 700; color: #334155; border-bottom: 1px solid black;">Amount (₹)</th>
            </tr>

            <!-- Data Row -->
            <tr style="background: {{ $index % 2 == 0 ? '#ffffff' : '#fafbfc' }};">
                <td style="padding: 40px 25px; font-size: 14px; font-weight: 200; color: #0f172a; border-right: 1px solid black;">{{ $item->offer_title }}</td>
                <td style="padding: 40px 25px; text-align: center; font-size: 20px; font-weight: 200; color: #1e293b; border-right: 1px solid black;">{{ number_format($item->total_clicks ?? 0) }}</td>
                <td style="padding: 40px 25px; text-align: center; font-size: 20px; font-weight: 200; color: #1e293b; border-right: 1px solid black;">{{ number_format($item->total_views ?? 0) }}</td>
                <td style="padding: 40px 25px; text-align: center; font-size: 20px; font-weight: 200; color: #1e293b; border-right: 1px solid black;">{{ number_format($item->total_conversions ?? 0) }}</td>
                <td style="padding: 40px 25px; text-align: right; font-size: 26px; font-weight: 500; color: #059669;">{{ number_format($item->advertiser_amount, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 30px; text-align: center; color: #64748b; font-size: 14px; background: #f8fafc;">No data available for this period</td>
            </tr>
            @endforelse

            <!-- Footer -->
            <tr style="background: #f1f5f9; border-top: 1px solid black;">
                <td colspan="4" style="padding: 12px 15px; text-align: right; font-size: 15px; font-weight: 600; color: #0f172a;">TOTAL:</td>
                <td style="padding: 12px 15px; text-align: right; font-size: 18px; font-weight: 700; color: #059669;">₹{{ number_format($invoiceSummary['advertiser_total'] ?? 0, 2) }}</td>
            </tr>
        </table>




        <!-- SIGNATURE SECTION -->
        <div style="padding: 40px 20px 10px 20px; font-family: 'DejaVu Sans', sans-serif; text-align: right;">
            <div style="border-top: 1px solid #94a3b8; width: 250px; margin-bottom: 8px; margin-left: auto;"></div>
            <div style="font-size: 13px; color: #334155; font-weight: 600;">Authorized Signatory</div>
            <div style="font-size: 12px; color: #64748b; margin-top: 4px;">NHI 17 Services Private Limited, Amritsar, Punjab, India (143006)</div>
            <div style="font-size: 11px; color: #64748b;">Date: {{ date('d M Y') }}</div>
        </div>

        <!-- Terms and Conditions -->
        <div style="padding: 20px 20px 30px 20px; font-family: 'DejaVu Sans', sans-serif;">
            <div style="font-size: 11px; color: #64748b; line-height: 1.5;">
                <div style="font-weight: 600; margin-bottom: 8px;">Terms & Conditions:</div>
                <div>• This is a computer generated invoice, no signature required.</div>
                <div>• Payment is due within 15 days from the invoice date.</div>
                <div>• All amounts are in Indian Rupees (₹).</div>
                <div>• For any queries, please contact finance@dms.co</div>
            </div>
        </div>


        <!-- FOOTER -->
        <table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'DejaVu Sans', sans-serif; margin-top: 20px;">
            <tr>
                <td style="padding: 20px 40px 10px 40px; border-top: 2px solid #f1f5f9;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="color: #94a3b8; font-size: 11px; text-align: center; padding-bottom: 8px;">
                                NHI 17 Services Private Limited, Amritsar, Punjab, India (143006) | Phone: +91 9878681717 |
                            </td>
                        </tr>
                        <tr>
                            <td style="color: #94a3b8; font-size: 10px; text-align: center; border-top: 1px dashed #e2e8f0; padding-top: 8px;">
                                Generated on {{ date('d M Y, h:i A') }} · Invoice - {{ $invoiceNumber ?? 'INV-001' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>