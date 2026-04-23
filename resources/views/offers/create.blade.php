@extends('layout.app')

@section('content')
<div class="min-h-screen bg-slate-50 px-4 py-10">
    <div class="mx-auto w-full max-w-6xl rounded-2xl border border-slate-200 bg-white p-6 shadow-[0_24px_60px_rgba(15,23,42,0.12)] sm:p-8">
        <div class="mb-6 border-b border-slate-200 pb-5">
            <h1 class="text-3xl font-bold text-slate-900">Create Offer</h1>
            <p class="mt-1 text-sm text-slate-500">Fill in the offer details across the tabs below.</p>
        </div>

        <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6 flex flex-wrap gap-2 border-b border-slate-200">
                <button type="button" onclick="openTab(event,'tab1')" class="tab-btn border-b-2 border-slate-900 px-4 py-3 text-sm font-semibold text-slate-900">Basic</button>
                <button type="button" onclick="openTab(event,'tab2')" class="tab-btn px-4 py-3 text-sm font-semibold text-slate-500">Pricing & Date</button>
                <button type="button" onclick="openTab(event,'tab3')" class="tab-btn px-4 py-3 text-sm font-semibold text-slate-500">Device & Location</button>
                <button type="button" onclick="openTab(event,'tab4')" class="tab-btn px-4 py-3 text-sm font-semibold text-slate-500">Other</button>
            </div>

            <div id="tab1" class="tab-content grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Offer Title *</label>
                    <input type="text" name="offer_title" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Offer Category</label>
                    <input type="text" name="offer_category" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Offer URL</label>
                    <input type="url" name="offer_url" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Advertiser</label>
                    <select name="advertiser_id" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                        <option value="">Select Advertiser</option>
                        @foreach($advertisers as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Description</label>
                    <textarea id="description" name="description" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200"></textarea>
                </div>
            </div>

            <div id="tab2" class="tab-content hidden grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Advertiser Price</label>
                    <input type="number" step="0.01" name="advertiser_price" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Affiliate Price</label>
                    <input type="number" step="0.01" name="affiliate_price" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Schedule</label>
                    <input type="date" name="schedule" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                </div>
            </div>

            <div id="tab3" class="tab-content hidden grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Device Brand</label>
                    <input type="text" name="device_brand" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Device</label>
                    <select name="device" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                        <option value="">Select</option>
                        <option value="Mobile">Mobile</option>
                        <option value="Desktop">Desktop</option>
                        <option value="Tablet">Tablet</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Operating System</label>
                    <select name="operating_system" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                        <option value="">Select</option>
                        <option value="Android">Android</option>
                        <option value="iOS">iOS</option>
                        <option value="Windows">Windows</option>
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">OS Version</label>
                    <input type="text" name="os_version" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Country</label>
                    <select name="country_id" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">State</label>
                    <select name="state_id" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">City</label>
                    <select name="city_id" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                        <option value="">Select City</option>
                        @foreach($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Language</label>
                    <select name="language_id" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                        <option value="">Select Language</option>
                        @foreach($languages as $language)
                        <option value="{{ $language->id }}">{{ $language->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="tab4" class="tab-content hidden grid gap-4 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Browser</label>
                    <input type="text" name="browser" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Upload File</label>
                    <input type="file" name="upload_file" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition file:mr-4 file:rounded-lg file:border-0 file:bg-slate-100 file:px-4 file:py-2 file:font-semibold file:text-slate-700">
                </div>

                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Terms & Conditions</label>
                    <textarea id="terms" name="terms_conditions" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200"></textarea>
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold text-slate-700">Status *</label>
                    <select name="status" required class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 text-slate-900 outline-none transition focus:border-slate-900 focus:ring-2 focus:ring-slate-200">
                        <option value="">Select</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex justify-start pt-2">
                    <button type="submit" class="rounded-lg bg-slate-900 px-10 py-3 font-semibold text-white transition hover:bg-slate-800 hover:shadow-lg">
                        Create Offer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#description'));
    ClassicEditor.create(document.querySelector('#terms'));

    function openTab(event, tabId) {
        document.querySelectorAll('.tab-content').forEach(t => t.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(b => {
            b.classList.remove('border-b-2', 'border-slate-900', 'text-slate-900');
            b.classList.add('text-slate-500');
        });

        document.getElementById(tabId).classList.remove('hidden');
        event.target.classList.add('border-b-2', 'border-slate-900', 'text-slate-900');
        event.target.classList.remove('text-slate-500');
    }
</script>
@endsection
