@extends('layout.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-900">
    <div class="w-full max-w-6xl bg-gray-900 p-8 border-4 border-yellow-600 shadow-lg">

        <h1 class="text-2xl font-bold text-white mb-6 text-center">
            Create Offer
        </h1>

        <form action="{{ route('offers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tabs -->
            <div class="flex border-b border-yellow-700 mb-6">
                <button type="button" onclick="openTab(event,'tab1')" class="tab-btn text-white px-4 py-2 border-b-2 border-yellow-600">Basic</button>
                <button type="button" onclick="openTab(event,'tab2')" class="tab-btn text-white px-4 py-2">Pricing & Date</button>
                <button type="button" onclick="openTab(event,'tab3')" class="tab-btn text-white px-4 py-2">Device & Location</button>
                <button type="button" onclick="openTab(event,'tab4')" class="tab-btn text-white px-4 py-2">Other</button>
            </div>

            <!-- TAB 1 -->
            <div id="tab1" class="tab-content flex flex-wrap gap-4">

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Offer Title *</label>
                    <input type="text" name="offer_title" class="w-full border-2 border-yellow-600 px-3 py-2">
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Offer Category</label>
                    <input type="text" name="offer_category" class="w-full border-2 border-yellow-600 px-3 py-2">
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Offer URL</label>
                    <input type="url" name="offer_url" class="w-full border-2 border-yellow-600 px-3 py-2">
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Advertiser</label>
                    <select name="advertiser_id" class="w-full border-2 border-yellow-600 px-3 py-2 bg-white">
                        <option value="">Select Advertiser</option>
                        @foreach($advertisers as $user)
                        <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="w-[98%]">
                    <label class="block text-yellow-600 mb-1">Description</label>
                    <textarea id="description" name="description"
                        class="w-full border-2 border-yellow-600 px-3 py-2 rounded-lg"></textarea>
                </div>
            </div>

            <!-- TAB 2 -->
            <div id="tab2" class="tab-content hidden flex flex-wrap gap-4">

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Advertiser Price</label>
                    <input type="number" step="0.01" name="advertiser_price" class="w-full border-2 border-yellow-600 px-3 py-2">
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Affiliate Price</label>
                    <input type="number" step="0.01" name="affiliate_price" class="w-full border-2 border-yellow-600 px-3 py-2">
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Schedule</label>
                    <input type="date" name="schedule" class="w-full border-2 border-yellow-600 px-3 py-2">
                </div>

               


            </div>

            <!-- TAB 3 -->
            <div id="tab3" class="tab-content hidden flex flex-wrap gap-4">

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Device Brand</label>
                    <input type="text" name="device_brand" class="w-full border-2 border-yellow-600 px-3 py-2">
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Device</label>
                    <select name="device" class="w-full border-2 border-yellow-600 px-3 py-2">
                        <option value="">Select</option>
                        <option value="Mobile">Mobile</option>
                        <option value="Desktop">Desktop</option>
                        <option value="Tablet">Tablet</option>
                    </select>
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Operating System</label>
                    <select name="operating_system" class="w-full border-2 border-yellow-600 px-3 py-2">
                        <option value="">Select</option>
                        <option value="Android">Android</option>
                        <option value="iOS">iOS</option>
                        <option value="Windows">Windows</option>
                    </select>
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">OS Version</label>
                    <input type="text" name="os_version" class="w-full border-2 border-yellow-600 px-3 py-2">
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Country</label>

                    <select
                        name="country_id"
                        class="w-full border-2 border-yellow-600 px-3 py-2 bg-white">
                        <option value="">Select Country</option>

                        @foreach($countries as $country)
                        <option value="{{ $country->id }}">
                            {{ $country->country_name }}
                        </option>
                        @endforeach
                    </select>
                </div>


                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">State</label>
                    <select name="state_id" class="w-full border-2 border-yellow-600 px-3 py-2 bg-white">
                        <option value="">Select State</option>
                        @foreach($states as $state)
                        <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">City</label>

                    <select
                        name="city_id"
                        class="w-full border-2 border-yellow-600 px-3 py-2 bg-white">
                        <option value="">Select City</option>

                        @foreach($cities as $city)
                        <option value="{{ $city->id }}">
                            {{ $city->name }}
                        </option>
                        @endforeach
                    </select>
                </div>


                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Language</label>

                    <select
                        name="language_id"
                        class="w-full border-2 border-yellow-600 px-3 py-2 bg-white">
                        <option value="">Select Language</option>

                        @foreach($languages as $language)
                        <option value="{{ $language->id }}">
                            {{ $language->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- TAB 4 -->
            <div id="tab4" class="tab-content hidden flex flex-wrap gap-4">

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Browser</label>
                    <input type="text" name="browser" class="w-full border-2 border-yellow-600 px-3 py-2">
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Upload File</label>
                    <input type="file" name="upload_file" class="w-full border-2 border-yellow-600 px-3 py-2 bg-white">
                </div>

                <div class="w-full">
                    <label class="block text-yellow-600 mb-1">Terms & Conditions</label>
                    <textarea id="terms" name="terms_conditions"
                        class="w-full border-2 border-yellow-600 px-3 py-2 rounded-lg"></textarea>
                </div>

                <div class="w-full md:w-[48%]">
                    <label class="block text-yellow-600 mb-1">Status *</label>
                    <select name="status" required class="w-full border-2 border-yellow-600 px-3 py-2">
                        <option value="">Select</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="w-full text-left mt-6">
                    <button type="submit" class="bg-yellow-600 text-white px-10 py-2 font-bold hover:bg-yellow-600">
                        Create Offer
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#description'));
    ClassicEditor.create(document.querySelector('#terms'));
</script>

<!-- Tabs -->
<script>
    function openTab(event, tabId) {
        document.querySelectorAll('.tab-content').forEach(t => t.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('border-b-2', 'border-yellow-600', 'text-yellow-600'));

        document.getElementById(tabId).classList.remove('hidden');
        event.target.classList.add('border-b-2', 'border-yellow-600', 'text-yellow-600');
    }
</script>
@endsection