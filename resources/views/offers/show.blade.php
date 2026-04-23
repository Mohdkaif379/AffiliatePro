<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusive Offer - Limited Time</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-grid {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            opacity: 0.22;
            background-image:
                linear-gradient(to right, rgba(148, 163, 184, 0.12) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(148, 163, 184, 0.12) 1px, transparent 1px);
            background-size: 44px 44px;
            mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), transparent 90%);
        }

        .bg-orb {
            position: fixed;
            border-radius: 9999px;
            filter: blur(28px);
            opacity: 0.3;
            pointer-events: none;
            z-index: 0;
            animation: drift 18s ease-in-out infinite alternate;
        }

        .bg-orb.one {
            width: 24rem;
            height: 24rem;
            left: -8rem;
            top: 8rem;
            background: radial-gradient(circle, rgba(15, 23, 42, 0.24), rgba(15, 23, 42, 0));
        }

        .bg-orb.two {
            width: 18rem;
            height: 18rem;
            right: -5rem;
            top: 16rem;
            background: radial-gradient(circle, rgba(14, 165, 233, 0.18), rgba(14, 165, 233, 0));
            animation-delay: -6s;
        }

        .bg-orb.three {
            width: 16rem;
            height: 16rem;
            left: 35%;
            bottom: 6rem;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.18), rgba(99, 102, 241, 0));
            animation-delay: -12s;
        }

        .float {
            animation: floatSlow 10s ease-in-out infinite;
        }

        .float-slower {
            animation: floatSlow 14s ease-in-out infinite;
        }

        .soft-shadow {
            box-shadow: 0 24px 60px rgba(15, 23, 42, 0.12);
        }

        @keyframes floatSlow {
            0% { transform: translate3d(0, 0, 0); }
            50% { transform: translate3d(0, -14px, 0); }
            100% { transform: translate3d(0, 0, 0); }
        }

        @keyframes drift {
            from { transform: translate3d(0, 0, 0); }
            to { transform: translate3d(28px, -20px, 0); }
        }
    </style>
</head>
<body class="relative min-h-screen overflow-x-hidden bg-slate-50 text-slate-900">
    <div class="bg-grid"></div>
    <div class="bg-orb one"></div>
    <div class="bg-orb two"></div>
    <div class="bg-orb three"></div>

    <header class="relative z-10 border-b border-slate-200 bg-white/70 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-900 text-white font-bold">AP</div>
                <div>
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Affiliate Programme</p>
                    <p class="text-base font-semibold text-slate-900">Exclusive Offer</p>
                </div>
            </div>
            <button id="topButton" class="rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-slate-800">
                Jump to Offer
            </button>
        </div>
    </header>

    <main class="relative z-10">
        <section class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8 lg:py-16">
            <div class="grid items-center gap-10 lg:grid-cols-[1.15fr_0.85fr]">
                <div class="space-y-8">
                    <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-slate-600 soft-shadow">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Limited Time Invitation
                    </div>

                    <div class="space-y-5">
                        <h1 class="max-w-3xl text-4xl font-black tracking-tight text-slate-950 sm:text-6xl">
                            Premium Access Unlocked For You
                        </h1>
                        <p class="max-w-2xl text-base leading-8 text-slate-600 sm:text-lg">
                            You have been selected for premium lifetime access to features designed to save time,
                            improve results, and keep everything in one place.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wider text-slate-700 soft-shadow">Personal Invitation</span>
                        <span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wider text-slate-700 soft-shadow">Limited Window</span>
                        <span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wider text-slate-700 soft-shadow">Instant Access</span>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 soft-shadow">
                            <p class="text-sm text-slate-500">Activation</p>
                            <p class="mt-2 text-xl font-bold text-slate-950">Instant</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 soft-shadow">
                            <p class="text-sm text-slate-500">Support</p>
                            <p class="mt-2 text-xl font-bold text-slate-950">24/7</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-5 soft-shadow">
                            <p class="text-sm text-slate-500">Access</p>
                            <p class="mt-2 text-xl font-bold text-slate-950">Lifetime</p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="float rounded-3xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.12)]">
                        <div class="rounded-2xl bg-gradient-to-br from-slate-950 to-slate-700 p-6 text-white">
                            <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-300">Today&apos;s Offer</p>
                            <h2 class="mt-2 text-2xl font-bold">Exclusive Offer</h2>
                            <p class="mt-3 text-sm leading-7 text-slate-200">
                                Hello Sir/Madam
                            </p>
                            <div class="mt-4 rounded-2xl bg-white/10 p-4 text-sm leading-7 text-white/90">
                                {!! $offer->description ?? 'Exclusive offer details will be shown here.' !!}
                            </div>
                        </div>

                        <div class="mt-6 grid gap-4 sm:grid-cols-2">
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Offer Expires In</p>
                                <div id="timer" class="mt-2 text-4xl font-black tracking-tight text-slate-950">
                                    <span class="minutes">15</span><span class="px-1">:</span><span class="seconds">00</span>
                                </div>
                            </div>
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <p class="text-sm text-slate-500">Fast Track</p>
                                <p class="mt-2 text-lg font-bold text-slate-950">Claim in one click</p>
                            </div>
                        </div>

                        <a href="{{ route('offers.click', $offer->random_url) }}?user_id={{ request('user_id') }}"
                           id="claimButton"
                           class="mt-6 inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-6 py-4 text-base font-bold text-white transition hover:bg-slate-800 hover:shadow-xl">
                            CLAIM YOUR OFFER NOW
                        </a>
                    </div>

                    <div class="absolute -left-4 -top-4 hidden rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 shadow-lg lg:block">
                        Selected for premium access
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 soft-shadow">
                    <h3 class="text-xl font-bold text-slate-950">What you get</h3>
                    <div class="mt-5 grid gap-4">
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="font-semibold text-slate-900">Instant Activation</p>
                            <p class="mt-1 text-sm text-slate-500">Immediate access to all premium features with one-click activation.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="font-semibold text-slate-900">Advanced Security</p>
                            <p class="mt-1 text-sm text-slate-500">Privacy protection and secure access for your data.</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="font-semibold text-slate-900">Exclusive Benefits</p>
                            <p class="mt-1 text-sm text-slate-500">Access special features reserved for premium members only.</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 soft-shadow">
                    <h3 class="text-xl font-bold text-slate-950">Why users click</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        The page is designed like a complete website, not a small card. It uses clear sections,
                        motion, and hierarchy so the offer feels premium and easy to understand.
                    </p>
                    <div class="mt-6 space-y-3">
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="font-semibold text-slate-900">Clean layout</p>
                            <p class="text-sm text-slate-500">Big hero area, section spacing, and a focused CTA.</p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="font-semibold text-slate-900">Motion accents</p>
                            <p class="text-sm text-slate-500">Background orbs and floating panels add life without clutter.</p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-4">
                            <p class="font-semibold text-slate-900">Responsive design</p>
                            <p class="text-sm text-slate-500">Reads well on desktop and mobile.</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 soft-shadow">
                    <h3 class="text-xl font-bold text-slate-950">Quick FAQ</h3>
                    <div class="mt-5 space-y-4">
                        <div class="faq-item rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <button type="button" class="faq-question flex w-full items-center justify-between text-left font-semibold text-slate-900">
                                <span>Is there any cost for this offer?</span>
                                <span class="faq-icon text-2xl text-slate-400">+</span>
                            </button>
                            <div class="faq-answer mt-3 max-h-0 overflow-hidden text-sm leading-7 text-slate-600 transition-all duration-300">
                                This exclusive access is completely free with absolutely no hidden charges or fees.
                            </div>
                        </div>

                        <div class="faq-item rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <button type="button" class="faq-question flex w-full items-center justify-between text-left font-semibold text-slate-900">
                                <span>How long will I have access?</span>
                                <span class="faq-icon text-2xl text-slate-400">+</span>
                            </button>
                            <div class="faq-answer mt-3 max-h-0 overflow-hidden text-sm leading-7 text-slate-600 transition-all duration-300">
                                Once claimed, you'll enjoy lifetime access to all premium features and future updates.
                            </div>
                        </div>

                        <div class="faq-item rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <button type="button" class="faq-question flex w-full items-center justify-between text-left font-semibold text-slate-900">
                                <span>What happens after the timer ends?</span>
                                <span class="faq-icon text-2xl text-slate-400">+</span>
                            </button>
                            <div class="faq-answer mt-3 max-h-0 overflow-hidden text-sm leading-7 text-slate-600 transition-all duration-300">
                                Once the timer reaches zero, this exclusive offer will disappear forever.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
            <div class="rounded-3xl bg-gradient-to-r from-slate-950 to-slate-700 px-6 py-8 text-white sm:px-10">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-300">Ready when you are</p>
                        <h2 class="mt-2 text-2xl font-bold sm:text-3xl">Claim your access before the timer ends</h2>
                    </div>
                    <a href="{{ route('offers.click', $offer->random_url) }}?user_id={{ request('user_id') }}"
                       id="claimButtonSecondary"
                       class="inline-flex items-center justify-center rounded-2xl bg-white px-6 py-4 text-base font-bold text-slate-950 transition hover:bg-slate-100">
                        CLAIM YOUR OFFER NOW
                    </a>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.getElementById('topButton').addEventListener('click', function() {
            document.getElementById('claimButton').scrollIntoView({ behavior: 'smooth', block: 'center' });
        });

        const primaryClaimButton = document.getElementById('claimButton');
        const secondaryClaimButton = document.getElementById('claimButtonSecondary');
        let timeLeft = 15 * 60;
        const minutesElement = document.querySelector('.minutes');
        const secondsElement = document.querySelector('.seconds');
        const timerElement = document.getElementById('timer');

        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;

            minutesElement.textContent = String(minutes).padStart(2, '0');
            secondsElement.textContent = String(seconds).padStart(2, '0');

            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                timerElement.textContent = 'EXPIRED';

                primaryClaimButton.textContent = 'OFFER EXPIRED';
                primaryClaimButton.classList.add('pointer-events-none', 'cursor-not-allowed', 'bg-slate-400');
                primaryClaimButton.classList.remove('bg-slate-900', 'hover:bg-slate-800');

                secondaryClaimButton.textContent = 'OFFER EXPIRED';
                secondaryClaimButton.classList.add('pointer-events-none', 'cursor-not-allowed', 'bg-slate-200', 'text-slate-500');
                secondaryClaimButton.classList.remove('bg-white', 'hover:bg-slate-100');

                const topButton = document.getElementById('topButton');
                topButton.textContent = 'EXPIRED';
                topButton.classList.add('pointer-events-none', 'cursor-not-allowed', 'opacity-50');
            }

            timeLeft--;
        }

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                const answer = item.querySelector('.faq-answer');
                const icon = item.querySelector('.faq-icon');
                const isOpen = item.classList.toggle('active');

                if (isOpen) {
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                    icon.textContent = '-';
                } else {
                    answer.style.maxHeight = '0px';
                    icon.textContent = '+';
                }
            });
        });
    </script>
</body>
</html>
