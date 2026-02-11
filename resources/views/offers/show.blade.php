<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusive Offer - Limited Time</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-color: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.3);
            --secondary-color: #8b5cf6;
            --accent-color: #10b981;
            --dark-bg: #0f172a;
            --card-bg: #1e293b;
            --card-border: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--dark-bg);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .floating-button {
            position: fixed;
            top: 30px;
            right: 30px;
            z-index: 1000;
        }

        .floating-button button {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 8px 32px rgba(99, 102, 241, 0.4);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .floating-button button:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 12px 48px rgba(99, 102, 241, 0.6);
        }

        .floating-button button:active {
            transform: translateY(0) scale(0.98);
        }

        .floating-button button::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .floating-button button:hover::after {
            left: 100%;
        }

        .floating-button button span {
            position: relative;
            z-index: 1;
        }

        .floating-button button svg {
            width: 20px;
            height: 20px;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }

        .page {
            max-width: 1000px;
            margin: 0 auto;
            padding: 120px 20px 60px;
            position: relative;
        }

        /* Header Styles */
        .header {
            text-align: center;
            padding-bottom: 60px;
            position: relative;
            margin-bottom: 40px;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
        }

        .logo-container {
            margin-bottom: 30px;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .logo {
            font-size: 48px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(99, 102, 241, 0.3);
            letter-spacing: 1px;
        }

        .tagline {
            color: var(--text-secondary);
            font-size: 18px;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-weight: 500;
            position: relative;
            display: inline-block;
            padding: 0 20px;
        }

        .tagline::before,
        .tagline::after {
            content: '✦';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
            opacity: 0.6;
        }

        .tagline::before { left: 0; }
        .tagline::after { right: 0; }

        /* Badge Styles */
        .badge-container {
            text-align: center;
            margin-bottom: 60px;
            animation: slideInDown 0.8s ease-out;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .badge {
            background: linear-gradient(135deg, var(--card-bg), #2d3748);
            color: var(--text-primary);
            padding: 14px 40px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            display: inline-block;
            border: 1px solid var(--card-border);
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .badge::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }

        /* Title Styles */
        .title-container {
            text-align: center;
            margin-bottom: 40px;
            animation: fadeInUp 0.8s ease-out 0.2s both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title {
            font-size: 56px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 24px;
            background: linear-gradient(135deg, #ffffff 30%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 40px rgba(99, 102, 241, 0.2);
        }

        .description {
            font-size: 20px;
            color: var(--text-secondary);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Features Section */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 80px;
        }

        .feature {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid var(--card-border);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.6s ease;
        }

        .feature:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
        }

        .feature:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .feature-icon svg {
            width: 28px;
            height: 28px;
            color: white;
        }

        .feature-title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-primary);
        }

        .feature-text {
            color: var(--text-secondary);
            font-size: 16px;
            line-height: 1.7;
        }

        /* Stats Section */
        .stats {
            background: var(--card-bg);
            padding: 60px;
            border-radius: 20px;
            margin-bottom: 60px;
            border: 1px solid var(--card-border);
            position: relative;
            overflow: hidden;
        }

        .stats::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .stats-content {
            position: relative;
            z-index: 1;
        }

        .stats-title {
            font-size: 28px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
            color: var(--text-primary);
        }

        .stats-grid {
            display: flex;
            justify-content: center;
            flex-direction: column;
            align-items: center;
        }

        .stat-item {
            text-align: center;
            padding: 0 40px;
        }

        .stat-number {
            font-size: 64px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 16px;
            font-family: 'Monaco', 'Courier New', monospace;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 18px;
            font-weight: 500;
        }

        /* Countdown Timer */
        .countdown {
            background: var(--card-bg);
            padding: 60px;
            border-radius: 20px;
            margin-bottom: 60px;
            border: 1px solid var(--card-border);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .countdown::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent, rgba(99, 102, 241, 0.1), transparent);
            animation: shimmer 3s infinite;
        }

        .countdown-content {
            position: relative;
            z-index: 1;
        }

        .countdown-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 40px;
            color: var(--text-primary);
        }

        .countdown-timer {
            font-size: 72px;
            font-weight: 800;
            font-family: 'Monaco', 'Courier New', monospace;
            color: var(--text-primary);
            text-shadow: 0 0 20px var(--primary-glow);
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from { text-shadow: 0 0 20px var(--primary-glow); }
            to { text-shadow: 0 0 30px var(--primary-glow), 0 0 40px var(--primary-glow); }
        }

        .timer-separator {
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        /* CTA Section */
        .cta-section {
            text-align: center;
            margin-bottom: 80px;
        }

        .cta-title {
            font-size: 42px;
            font-weight: 800;
            margin-bottom: 24px;
            color: var(--text-primary);
        }

        .cta-description {
            color: var(--text-secondary);
            font-size: 20px;
            margin-bottom: 48px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
        }

        .cta-button {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            text-decoration: none;
            padding: 24px 64px;
            font-size: 20px;
            font-weight: 700;
            display: inline-block;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(99, 102, 241, 0.4);
        }

        .cta-button:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 30px 80px rgba(99, 102, 241, 0.6);
        }

        .cta-button:active {
            transform: translateY(-2px) scale(1.02);
        }

        .cta-button::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
            transform: scale(0);
            transition: transform 0.5s ease;
        }

        .cta-button:active::after {
            transform: scale(1);
        }

        /* Testimonials */
        .testimonials {
            margin-bottom: 80px;
        }

        .section-title {
            font-size: 36px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 60px;
            color: var(--text-primary);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .testimonial {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 20px;
            border: 1px solid var(--card-border);
            position: relative;
            transition: transform 0.4s ease;
        }

        .testimonial:hover {
            transform: translateY(-5px);
        }

        .testimonial::before {
            content: '"';
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 80px;
            color: var(--primary-color);
            opacity: 0.2;
            font-family: serif;
            line-height: 1;
        }

        .testimonial-text {
            font-size: 18px;
            color: var(--text-secondary);
            margin-bottom: 30px;
            font-style: italic;
            line-height: 1.8;
            position: relative;
            z-index: 1;
        }

        .testimonial-author {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 18px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .testimonial-author::before {
            content: '';
            width: 8px;
            height: 8px;
            background: var(--accent-color);
            border-radius: 50%;
        }

        /* FAQ Section */
        .faq {
            margin-bottom: 80px;
        }

        .faq-grid {
            display: grid;
            gap: 20px;
        }

        .faq-item {
            background: var(--card-bg);
            padding: 32px;
            border-radius: 16px;
            border: 1px solid var(--card-border);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .faq-item:hover {
            border-color: var(--primary-color);
            transform: translateX(5px);
        }

        .faq-question {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 16px;
            color: var(--text-primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-question::after {
            content: '+';
            font-size: 24px;
            color: var(--primary-color);
            transition: transform 0.3s ease;
        }

        .faq-item.active .faq-question::after {
            transform: rotate(45deg);
        }

        .faq-answer {
            color: var(--text-secondary);
            font-size: 16px;
            line-height: 1.7;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .faq-item.active .faq-answer {
            max-height: 200px;
        }

        /* Footer */
        .footer {
            padding-top: 80px;
            text-align: center;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 200px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
        }

        .footer-links {
            margin-bottom: 40px;
            display: flex;
            justify-content: center;
            gap: 40px;
            flex-wrap: wrap;
        }

        .footer-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
            position: relative;
            padding: 8px 0;
        }

        .footer-link:hover {
            color: var(--text-primary);
        }

        .footer-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .footer-link:hover::after {
            width: 100%;
        }

        .copyright {
            color: var(--text-muted);
            font-size: 14px;
        }

        /* ========== RESPONSIVE DESIGN IMPROVEMENTS ========== */
        
        /* Large Desktop */
        @media (max-width: 1200px) {
            .page {
                max-width: 900px;
                padding: 100px 30px 60px;
            }
            
            .title {
                font-size: 52px;
            }
            
            .features {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Desktop */
        @media (max-width: 1024px) {
            .page {
                padding: 90px 25px 50px;
            }
            
            .title {
                font-size: 48px;
            }
            
            .countdown-timer {
                font-size: 60px;
            }
            
            .stat-number {
                font-size: 56px;
            }
            
            .cta-title {
                font-size: 38px;
            }
            
            .section-title {
                font-size: 32px;
            }
        }

        /* Tablet Landscape */
        @media (max-width: 900px) {
            .floating-button {
                top: 25px;
                right: 25px;
            }

            .floating-button button {
                padding: 14px 28px;
                font-size: 15px;
            }
            
            .page {
                padding: 80px 20px 40px;
            }
            
            .logo {
                font-size: 42px;
            }
            
            .title {
                font-size: 42px;
                margin-bottom: 20px;
            }
            
            .description {
                font-size: 18px;
                line-height: 1.6;
            }
            
            .features {
                grid-template-columns: 1fr;
                gap: 20px;
                margin-bottom: 60px;
            }
            
            .feature {
                padding: 30px;
            }
            
            .feature-title {
                font-size: 20px;
            }
            
            .stats {
                padding: 40px 30px;
                margin-bottom: 40px;
            }
            
            .stats-title {
                font-size: 24px;
                margin-bottom: 30px;
            }
            
            .countdown {
                padding: 40px 30px;
                margin-bottom: 40px;
            }
            
            .countdown-title {
                font-size: 24px;
                margin-bottom: 30px;
            }
            
            .countdown-timer {
                font-size: 52px;
            }
            
            .cta-section {
                margin-bottom: 60px;
            }
            
            .cta-title {
                font-size: 32px;
                margin-bottom: 20px;
            }
            
            .cta-description {
                font-size: 18px;
                margin-bottom: 40px;
                line-height: 1.6;
            }
            
            .cta-button {
                padding: 22px 50px;
                font-size: 18px;
            }
            
            .testimonials {
                margin-bottom: 60px;
            }
            
            .section-title {
                font-size: 28px;
                margin-bottom: 40px;
            }
            
            .testimonials-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .testimonial {
                padding: 30px;
            }
            
            .faq {
                margin-bottom: 60px;
            }
            
            .faq-item {
                padding: 24px;
            }
            
            .faq-question {
                font-size: 18px;
            }
            
            .footer {
                padding-top: 60px;
            }
        }

        /* Tablet Portrait */
        @media (max-width: 768px) {
            .floating-button {
                top: 20px;
                right: 20px;
            }

            .floating-button button {
                padding: 12px 24px;
                font-size: 14px;
            }
            
            .page {
                padding: 70px 15px 40px;
            }
            
            .header {
                padding-bottom: 40px;
                margin-bottom: 30px;
            }
            
            .logo {
                font-size: 36px;
            }
            
            .tagline {
                font-size: 16px;
                letter-spacing: 2px;
            }
            
            .badge-container {
                margin-bottom: 40px;
            }
            
            .badge {
                padding: 12px 30px;
                font-size: 15px;
            }
            
            .title {
                font-size: 36px;
            }
            
            .description {
                font-size: 17px;
            }
            
            .feature-icon {
                width: 50px;
                height: 50px;
                margin-bottom: 20px;
            }
            
            .feature-icon svg {
                width: 24px;
                height: 24px;
            }
            
            .stat-number {
                font-size: 48px;
            }
            
            .stat-label {
                font-size: 16px;
            }
            
            .countdown-timer {
                font-size: 44px;
            }
            
            .cta-button {
                padding: 20px 40px;
                font-size: 17px;
                width: 100%;
                max-width: 400px;
            }
            
            .footer-links {
                gap: 30px;
            }
        }

        /* Mobile Landscape */
        @media (max-width: 600px) {
            .floating-button {
                top: 15px;
                right: 15px;
            }

            .floating-button button {
                padding: 10px 20px;
                font-size: 13px;
                gap: 8px;
            }
            
            .floating-button button svg {
                width: 16px;
                height: 16px;
            }
            
            .page {
                padding: 60px 15px 30px;
            }
            
            .logo {
                font-size: 32px;
            }
            
            .title {
                font-size: 32px;
            }
            
            .description {
                font-size: 16px;
                line-height: 1.5;
            }
            
            .feature {
                padding: 25px;
            }
            
            .feature-title {
                font-size: 18px;
            }
            
            .feature-text {
                font-size: 15px;
            }
            
            .stats,
            .countdown {
                padding: 30px 20px;
            }
            
            .countdown-timer {
                font-size: 40px;
            }
            
            .cta-title {
                font-size: 28px;
            }
            
            .cta-description {
                font-size: 16px;
            }
            
            .section-title {
                font-size: 24px;
                margin-bottom: 30px;
            }
            
            .testimonial {
                padding: 25px;
            }
            
            .testimonial-text {
                font-size: 16px;
            }
            
            .footer-links {
                gap: 20px;
                flex-direction: column;
            }
            
            .footer-link {
                margin: 5px 0;
            }
        }

        /* Mobile Portrait */
        @media (max-width: 480px) {
            .floating-button {
                position: fixed;
                bottom: 20px;
                top: auto;
                right: 20px;
                left: 20px;
                width: calc(100% - 40px);
            }

            .floating-button button {
                width: 100%;
                justify-content: center;
                padding: 16px 24px;
                font-size: 15px;
            }
            
            .page {
                padding-top: 80px;
                padding-bottom: 100px;
            }
            
            .logo {
                font-size: 28px;
            }
            
            .tagline {
                font-size: 14px;
                letter-spacing: 1px;
            }
            
            .title {
                font-size: 28px;
                line-height: 1.2;
            }
            
            .badge {
                padding: 10px 20px;
                font-size: 14px;
            }
            
            .features {
                gap: 15px;
                margin-bottom: 40px;
            }
            
            .feature {
                padding: 20px;
                border-radius: 16px;
            }
            
            .feature-icon {
                width: 45px;
                height: 45px;
                border-radius: 12px;
                margin-bottom: 15px;
            }
            
            .feature-icon svg {
                width: 20px;
                height: 20px;
            }
            
            .stats-title,
            .countdown-title,
            .section-title {
                font-size: 22px;
            }
            
            .countdown-timer {
                font-size: 36px;
            }
            
            .stat-number {
                font-size: 42px;
            }
            
            .cta-title {
                font-size: 24px;
                margin-bottom: 15px;
            }
            
            .cta-button {
                padding: 18px 30px;
                font-size: 16px;
                border-radius: 12px;
            }
            
            .testimonial {
                padding: 20px;
            }
            
            .testimonial::before {
                font-size: 60px;
            }
            
            .testimonial-text {
                font-size: 15px;
                margin-bottom: 20px;
            }
            
            .testimonial-author {
                font-size: 16px;
            }
            
            .faq-item {
                padding: 20px;
            }
            
            .faq-question {
                font-size: 16px;
                margin-bottom: 12px;
            }
            
            .faq-answer {
                font-size: 14px;
            }
            
            .copyright {
                font-size: 12px;
                padding: 0 10px;
            }
        }

        /* Small Mobile */
        @media (max-width: 360px) {
            .floating-button {
                bottom: 15px;
                right: 15px;
                left: 15px;
                width: calc(100% - 30px);
            }
            
            .page {
                padding: 70px 10px 90px;
            }
            
            .logo {
                font-size: 24px;
            }
            
            .title {
                font-size: 24px;
            }
            
            .description {
                font-size: 15px;
            }
            
            .feature-title {
                font-size: 17px;
            }
            
            .feature-text {
                font-size: 14px;
            }
            
            .countdown-timer {
                font-size: 32px;
            }
            
            .cta-button {
                font-size: 15px;
                padding: 16px 24px;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 15px;
            }
        }

        /* Very Small Mobile */
        @media (max-width: 320px) {
            .logo {
                font-size: 22px;
            }
            
            .title {
                font-size: 22px;
            }
            
            .countdown-timer {
                font-size: 28px;
            }
            
            .stat-number {
                font-size: 36px;
            }
            
            .cta-button {
                font-size: 14px;
            }
        }

        /* Touch Device Optimizations */
        @media (hover: none) and (pointer: coarse) {
            .feature:hover,
            .testimonial:hover,
            .faq-item:hover {
                transform: none;
            }
            
            .floating-button button:hover,
            .cta-button:hover {
                transform: none;
            }
            
            .feature:hover::before {
                transform: scaleX(0);
            }
            
            /* Make touch targets larger */
            .footer-link,
            .faq-item {
                min-height: 44px;
            }
            
            .cta-button {
                min-height: 60px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        /* High Resolution Screens */
        @media (min-width: 1440px) {
            .page {
                max-width: 1200px;
                padding: 140px 40px 80px;
            }
            
            .title {
                font-size: 64px;
            }
            
            .description {
                font-size: 22px;
            }
            
            .features {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        /* Dark mode adjustments for different devices */
        @media (prefers-color-scheme: dark) {
            :root {
                --dark-bg: #0a0a0a;
                --card-bg: #1a1a1a;
                --card-border: #2a2a2a;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Button -->
    <div class="floating-button">
        <button id="topButton">
            <span>🔥 EXCLUSIVE OFFER</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
            </svg>
        </button>
    </div>

    <div class="page">
        <header class="header">
            <div class="logo-container">
                <div class="logo">EXCLUSIVE ACCESS</div>
            </div>
            <div class="tagline">LIMITED TIME INVITATION</div>
        </header>

        <main class="main">
            <div class="badge-container">
                <div class="badge">PERSONAL INVITATION ONLY</div>
            </div>
            
            <div class="title-container">
                <h1 class="title">Premium Access<br>Unlocked For You</h1>
                <p class="description">
                    You've been selected for exclusive lifetime access to premium features. 
                    This special invitation expires soon and won't be available again.
                </p>
            </div>
            
            <section class="features">
                <div class="feature">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="feature-title">Instant Activation</h3>
                    <p class="feature-text">Immediate access to all premium features with one-click activation.</p>
                </div>
                
                <div class="feature">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                    <h3 class="feature-title">Advanced Security</h3>
                    <p class="feature-text">Military-grade encryption and privacy protection for your data.</p>
                </div>
                
                <div class="feature">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>
                    </div>
                    <h3 class="feature-title">Exclusive Benefits</h3>
                    <p class="feature-text">Access special features reserved for premium members only.</p>
                </div>
                
                <div class="feature">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.25 0 2.25 2.25 0 014.25 0zm-13.5 0a2.25 2.25 0 11-4.25 0 2.25 2.25 0 014.25 0z" />
                        </svg>
                    </div>
                    <h3 class="feature-title">24/7 Priority Support</h3>
                    <p class="feature-text">Dedicated customer support available round the clock.</p>
                </div>
            </section>
            
            <section class="stats">
                <div class="stats-content">
                    <h3 class="stats-title">Already Claimed By Elite Members</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number" id="claimedCount">0</div>
                            <div class="stat-label">Verified Premium Users</div>
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="countdown">
                <div class="countdown-content">
                    <h3 class="countdown-title">Offer Expires In</h3>
                    <div class="countdown-timer" id="timer">
                        <span class="minutes">15</span>
                        <span class="timer-separator">:</span>
                        <span class="seconds">00</span>
                    </div>
                </div>
            </section>
            
            <section class="cta-section">
                <h2 class="cta-title">Claim Your Exclusive Access</h2>
                <p class="cta-description">
                    This is your only chance to secure premium lifetime access. 
                    Click below before this exclusive offer disappears forever.
                </p>
                <a href="{{ route('offers.click', $offer->random_url) }}?user_id={{ request('user_id') }}" 
                   class="cta-button" id="claimButton">
                    🔥 CLAIM YOUR OFFER NOW 
                </a>
            </section>
            
            <section class="testimonials">
                <h2 class="section-title">Verified Member Success Stories</h2>
                
                <div class="testimonials-grid">
                    <div class="testimonial">
                        <p class="testimonial-text">
                            "This exclusive access completely transformed my workflow. 
                            The premium features saved me hours every week and the quality 
                            is absolutely exceptional."
                        </p>
                        <div class="testimonial-author">Sarah Johnson, Digital Marketer</div>
                    </div>
                    
                    <div class="testimonial">
                        <p class="testimonial-text">
                            "I was skeptical at first, but this has been a game-changer. 
                            The support team is incredibly responsive and the exclusive 
                            tools are worth every penny."
                        </p>
                        <div class="testimonial-author">Michael Chen, Tech Entrepreneur</div>
                    </div>
                </div>
            </section>
            
            <section class="faq">
                <h2 class="section-title">Frequently Asked Questions</h2>
                
                <div class="faq-grid">
                    <div class="faq-item">
                        <div class="faq-question">Is there any cost for this offer?</div>
                        <p class="faq-answer">This exclusive access is completely free with absolutely no hidden charges or fees.</p>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">How long will I have access?</div>
                        <p class="faq-answer">Once claimed, you'll enjoy lifetime access to all premium features and future updates.</p>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">Can I share this with others?</div>
                        <p class="faq-answer">This is a personal invitation tied to your account and cannot be transferred or shared.</p>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">What happens after the timer ends?</div>
                        <p class="faq-answer">Once the timer reaches zero, this exclusive offer will disappear forever.</p>
                    </div>
                </div>
            </section>
        </main>
        
        <footer class="footer">
            <div class="footer-links">
                <a href="#" class="footer-link">Privacy Policy</a>
                <a href="#" class="footer-link">Terms of Service</a>
                <a href="#" class="footer-link">Support Center</a>
                <a href="#" class="footer-link">Contact Us</a>
            </div>
            <div class="copyright">
                © 2024 Exclusive Access Inc. All rights reserved. This invitation is non-transferable.
            </div>
        </footer>
    </div>

    <script>
        // Floating button click handler
        document.getElementById('topButton').addEventListener('click', function() {
            document.getElementById('claimButton').scrollIntoView({ 
                behavior: 'smooth',
                block: 'center'
            });
            
            // Add animation effect
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });

        // Countdown Timer
        let timeLeft = 15 * 60;
        const minutesElement = document.querySelector('.minutes');
        const secondsElement = document.querySelector('.seconds');
        
        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            
            minutesElement.textContent = minutes.toString().padStart(2, '0');
            secondsElement.textContent = seconds.toString().padStart(2, '0');
            
            // Add pulse animation when under 5 minutes
            if (timeLeft <= 300) {
                document.querySelector('.countdown-timer').style.animation = 'glow 0.5s ease-in-out infinite alternate';
            }
            
            // Add urgent animation when under 1 minute
            if (timeLeft <= 60) {
                document.querySelector('.countdown-timer').style.color = '#ef4444';
                document.querySelector('.countdown-timer').style.animation = 'glow 0.25s ease-in-out infinite alternate';
            }
            
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                document.querySelector('.countdown-timer').textContent = "EXPIRED";
                document.querySelector('.countdown-timer').style.color = '#ef4444';
                document.querySelector('.countdown-timer').style.animation = 'none';
                
                const claimButton = document.getElementById('claimButton');
                claimButton.textContent = "OFFER EXPIRED";
                claimButton.style.background = 'linear-gradient(135deg, #4b5563, #6b7280)';
                claimButton.style.boxShadow = 'none';
                claimButton.style.cursor = 'not-allowed';
                claimButton.style.pointerEvents = 'none';
                
                // Disable floating button
                document.getElementById('topButton').style.opacity = '0.5';
                document.getElementById('topButton').style.cursor = 'not-allowed';
                document.getElementById('topButton').style.pointerEvents = 'none';
            }
            
            timeLeft--;
        }
        
        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        // Animate claimed counter
        const claimedElement = document.getElementById('claimedCount');
        let currentCount = 0;
        const targetCount = 1247;
        const duration = 3000;
        const increment = targetCount / (duration / 16);
        let startTime = null;
        
        function animateCounter(timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = timestamp - startTime;
            const percentage = Math.min(progress / duration, 1);
            
            // Easing function for smooth animation
            const easeOutQuart = 1 - Math.pow(1 - percentage, 4);
            
            currentCount = Math.floor(targetCount * easeOutQuart);
            claimedElement.textContent = currentCount.toLocaleString();
            
            if (percentage < 1) {
                requestAnimationFrame(animateCounter);
            } else {
                claimedElement.textContent = targetCount.toLocaleString();
                
                // Add subtle pulse animation after completion
                claimedElement.style.animation = 'pulse 2s infinite';
            }
        }

        // Button click handler
        const claimButton = document.getElementById('claimButton');
        claimButton.addEventListener('click', function(e) {
            const originalText = this.innerHTML;
            const originalHref = this.href;
            
            // Add click animation
            this.style.transform = 'scale(0.95)';
            
            setTimeout(() => {
                this.innerHTML = '🎯 PROCESSING...';
                this.style.background = 'linear-gradient(135deg, #059669, #10b981)';
                
                setTimeout(() => {
                    this.innerHTML = '🚀 REDIRECTING...';
                    
                    setTimeout(() => {
                        window.location.href = originalHref;
                    }, 600);
                }, 800);
            }, 200);
            
            e.preventDefault();
        });

        // FAQ toggle functionality
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });

        // Initialize animations
        document.addEventListener('DOMContentLoaded', function() {
            // Start counter animation
            requestAnimationFrame(animateCounter);
            
            // Add scroll reveal animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            // Observe all sections for scroll animations
            document.querySelectorAll('.feature, .testimonial, .faq-item').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });
            
            // Add floating particles effect
            createParticles();
        });

        // Floating particles background effect
        function createParticles() {
            const colors = ['#6366f1', '#8b5cf6', '#10b981'];
            
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'fixed';
                particle.style.width = Math.random() * 4 + 1 + 'px';
                particle.style.height = particle.style.width;
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.opacity = Math.random() * 0.4 + 0.1;
                particle.style.top = Math.random() * 100 + 'vh';
                particle.style.left = Math.random() * 100 + 'vw';
                particle.style.zIndex = '-1';
                particle.style.pointerEvents = 'none';
                
                document.body.appendChild(particle);
                
                // Animate particle
                animateParticle(particle);
            }
        }

        function animateParticle(particle) {
            let x = parseFloat(particle.style.left);
            let y = parseFloat(particle.style.top);
            const speedX = (Math.random() - 0.5) * 0.5;
            const speedY = (Math.random() - 0.5) * 0.5;
            
            function move() {
                x += speedX;
                y += speedY;
                
                // Wrap around edges
                if (x > 100) x = 0;
                if (x < 0) x = 100;
                if (y > 100) y = 0;
                if (y < 0) y = 100;
                
                particle.style.left = x + 'vw';
                particle.style.top = y + 'vh';
                
                requestAnimationFrame(move);
            }
            
            move();
        }
    </script>
</body>
</html>