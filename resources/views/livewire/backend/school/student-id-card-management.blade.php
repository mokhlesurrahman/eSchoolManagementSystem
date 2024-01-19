<div>
    <main>
        <div class="container py-5">
            <header class="mb-4" wire:ignore>
                <div class="flex justify-center sm:justify-start items-center">
                    <span class="shadow-md px-2 py-2 bg-emerald-500 rounded mr-2">
                        <svg class="w-6 dark:fill-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <title>id-card</title>
                            <path
                                d="M4 4C2.89 4 2 4.89 2 6V18C2 19.11 2.89 20 4 20H20C21.11 20 22 19.11 22 18V6C22 4.89 21.11 4 20 4H4M4 6H20V10H4V6M4 12H8V14H4V12M10 12H20V14H10V12M4 16H14V18H4V16M16 16H20V18H16V16Z" />
                        </svg>
                    </span>
                </div>
            </header>

            <div class="flex flex-wrap items-start">
                <div class="w-full sm:w-4/12 bg-gray-300 dark:bg-slate-800 py-5 px-3 rounded-md">
                    <form wire:submit='generate' class="flex flex-col gap-3">
                        <h2 class="text-center border-b border-gray-400 dark:border-slate-900 pb-3 pt-2 text-lg">
                            Generate Student ID Card</h2>
                        <div>
                            <label for="" class="form-label">Class</label>
                            <select name="" wire:model.blur='class_id' class="form-select rounded" id=""
                                wire:change='getSection'>
                                <option value="">Select class</option>
                                @foreach ($classes as $item)
                                    <option value="{{ $item->id }}">{{ $item->class_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if ($this->groups != null)
                            <div class="">
                                <label for="group_id" class="form-label">Groups</label>
                                <select wire:model.blur='group_id' class="form-select rounded" wire:change='getStudents'
                                    wire:loading.class='opacity-50 blur-sm' wire:target='getSection' id="group_id">
                                    <option value="">Select group</option>
                                    @forelse ($this->groups as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $this->group_id ? 'selected' : '' }}>
                                            {{ $item->group_name }}</option>
                                    @empty
                                        <option value="" disabled>No group found</option>
                                    @endforelse
                                </select>
                                @error('group_id')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <div class="">
                                <label for="section_id" class="form-label">Section</label>
                                <select wire:model.blur='section_id' class="form-select rounded"
                                    wire:change='getStudents' wire:loading.class='opacity-50 blur-sm'
                                    wire:target='getSection' id="section_id">
                                    <option value="">Select section</option>
                                    @forelse ($sections as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $this->section_id ? 'selected' : '' }}>
                                            {{ $item->section_name }}</option>
                                    @empty
                                        <option value="" disabled>No section found
                                        </option>
                                    @endforelse
                                </select>
                                @error('section_id')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                        <div>
                            <label for="" class="form-label">Students</label>
                            <select name="" wire:model.blur='student_id' class="form-select rounded"
                                id="" wire:change='setIDcard'>
                                <option value="">Select student</option>
                                @forelse ($students as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $this->section_id ? 'selected' : '' }}>
                                        {{ $item->name_en . ' ID- ' . $item->student_id }}</option>
                                @empty
                                    <option value="" disabled>No student found
                                    </option>
                                @endforelse
                            </select>
                        </div>
                        {{-- <div>
                            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <!-- File Input -->
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 20 16">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                    class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                                                (MAX.
                                                800x400px)</p>
                                        </div>
                                        <input id="dropzone-file" wire:model.blur='photo' type="file"
                                            class="hidden" />
                                    </label>
                                </div>

                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                        :style="{ width: progress + '%' }">
                                        <span x-text="progress"></span>%
                                    </div>

                                </div>
                                @if ($photo)
                                    <img src="{{ $photo->temporaryUrl() }}" width="150px" class="rounded-md mt-3">
                                @endif
                            </div>
                        </div> --}}
                        {{-- <div class="text-end">
                            <button type="submit" class="px-3 py-2 rounded-md bg-emerald-500 mt-3">Generate</button>
                        </div> --}}
                    </form>
                </div>
                <div class="w-8/12">
                    <div class=" ml-5 bg-gray-300 dark:bg-slate-800 py-5 px-3 rounded-md">
                        <h2 class="mb-2 pb-2 pt-1 text-2xl text-center border-b border-gray-400 dark:border-slate-900">
                            Preview</h2>

                        <div class="preview_box_wrapper ">
                            <div class="preview_box print-view overflow-auto">
                                <div id="printContent">
                                    <style>
                                        .id_card_front {
                                            width: 250px;
                                            min-width: 250px;
                                            height: 387px;
                                            min-height: 387px;
                                            position: relative;
                                            border-radius: 8px;
                                            background: #FFF;
                                            box-shadow: 0px 4px 11px 0px rgba(0, 0, 0, 0.15);
                                            display: flex;
                                            justify-content: center;
                                            align-items: flex-end;
                                            width: 250px;
                                            min-width: 250px;
                                            min-height: 387px;
                                            height: 387px;
                                            overflow: hidden;
                                        }

                                        .shape_img_top {
                                            position: absolute;
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            height: 100%;
                                            border-radius: 8px;
                                            min-height: 387px !important;
                                        }

                                        .shape_img_top img {
                                            border-radius: 8px;
                                            height: 100%;
                                            width: 100%;
                                            object-fit: cover;
                                            object-position: top;
                                        }

                                        .id_card_front_inner h3 {
                                            color: #003249;
                                            font-family: Lexend;
                                            font-size: 21.323px;
                                            font-style: normal;
                                            font-weight: 600;
                                            line-height: normal;
                                            margin-bottom: 8px;
                                        }

                                        .id_card_front_inner .class_name {
                                            color: #003249;
                                            font-family: Lexend;
                                            font-size: 12.794px;
                                            font-style: normal;
                                            font-weight: 300;
                                            line-height: normal;
                                            text-align: center;
                                            display: block;
                                            margin-bottom: 12px;
                                        }

                                        .student_info p {
                                            color: #003249;
                                            font-family: Lexend;
                                            font-size: 9.946px;
                                            font-style: normal;
                                            font-weight: 300;
                                            line-height: normal;
                                            margin-bottom: 4px;
                                        }

                                        .id_card_profile_img {
                                            width: 98.315px;
                                            height: 98.315px;
                                            transform: rotate(45deg);
                                            flex-shrink: 0;
                                            box-shadow: 0px 0px 4.569228172302246px rgba(0, 0, 0, 0.25);
                                            background: #fff;
                                            margin: 0 auto;
                                            position: relative;
                                            top: -20px;
                                            margin-bottom: 7px;
                                        }

                                        .id_card_profile_img img {
                                            width: calc(100% + 10px);
                                            height: calc(100% + 10px);
                                            transform: rotate(-45deg);
                                            clip-path: polygon(50% -3%, 107% 50%, 50% 100%, -7% 50%);
                                            position: relative;
                                            top: -5px;
                                            /* right: 5px; */
                                        }

                                        .id_card_front_info {
                                            position: relative;
                                            z-index: 12;
                                            height: 100%;
                                            /* padding-top: 100px; */
                                            height: 387px;
                                            top: 95px;
                                            padding-top: 0;
                                            width: 250px !important;
                                            min-width: 250px !important;
                                        }

                                        .signature_image {
                                            max-width: 73px;
                                            margin: 0 auto;
                                            margin-top: 15px;
                                        }

                                        .signature_image img {
                                            max-width: 100%;
                                            height: 30px;
                                            object-fit: cover;
                                        }

                                        .id_card_back {
                                            width: 250px;
                                            min-width: 250px;
                                            height: 387px;
                                            position: relative;
                                            border-radius: 8px;
                                            background: #FFF;
                                            box-shadow: 0px 4px 11px 0px rgba(0, 0, 0, 0.15);
                                            display: flex;
                                            justify-content: center;
                                            align-items: flex-start;
                                            overflow: hidden;
                                        }

                                        .id_card_back .shape_img_top {
                                            position: absolute;
                                            top: 0;
                                            left: 0;
                                            width: 100%;
                                            height: 100%;
                                            border-radius: 8px;
                                        }

                                        .id_card_back .shape_img_top img {
                                            border-radius: 8px;
                                            height: 100%;
                                            width: 100%;
                                            object-fit: cover;
                                            object-position: bottom;
                                        }

                                        .id_card_back {
                                            padding: 38px 29px;
                                            text-align: center;
                                        }

                                        .id_card_back_info {
                                            position: relative;
                                            z-index: 12;
                                        }

                                        .id_card_back .id_card_back_info p {
                                            color: #003249;
                                            text-align: center;
                                            font-family: Lexend;
                                            font-size: 10.403px;
                                            font-style: normal;
                                            font-weight: 300;
                                            line-height: normal;
                                        }

                                        .id_card_back .id_card_back_info h5 {
                                            color: #003249;
                                            font-family: Lexend;
                                            font-size: 10.403px;
                                            font-style: normal;
                                            font-weight: 500;
                                            line-height: normal;
                                            margin: 18px 0 25px 0;
                                        }

                                        .id_card_back .id_card_back_info .qr_code {
                                            width: 57.786px;
                                            height: 57.709px;
                                            margin: 0 auto;
                                        }

                                        .id_card_back .id_card_back_info .qr_code img {
                                            max-width: 100%;
                                        }

                                        .id_card_back_logo_img {
                                            position: absolute;
                                            left: 20px;
                                            bottom: 45px;
                                            z-index: 15;
                                            text-align: left;
                                        }

                                        .id_card_back_logo_img img {
                                            max-width: 100px;
                                            width: 100%;
                                            object-fit: cover;
                                        }

                                        .gap_12 {
                                            grid-gap: 12px;
                                        }

                                        .gray_card {}

                                        .gray_card .card-header h3 {
                                            color: #1A1D1F;
                                            font-family: Lexend;
                                            font-size: 18px;
                                            font-style: normal;
                                            font-weight: 600;
                                            line-height: 30px;
                                        }

                                        .gray_card .card-body {
                                            background: #F2F2F2;
                                            border-radius: 0;
                                        }

                                        .generated_card_wrapper {
                                            display: grid;
                                            grid-template-columns: repeat(4, minmax(0, 1fr));
                                            grid-gap: 24px;
                                        }

                                        @media (max-width: 767.98px) {
                                            .preview_box_wrapper {
                                                margin-top: 20px;
                                            }
                                        }

                                        @media (min-width: 320px) and (max-width: 575.98px) {
                                            .generated_card_wrapper {
                                                grid-template-columns: repeat(1, minmax(0, 1fr));
                                            }
                                        }

                                        @media (min-width: 576px) and (max-width: 767.98px) {
                                            .generated_card_wrapper {
                                                grid-template-columns: repeat(2, minmax(0, 1fr));
                                            }
                                        }

                                        @media (min-width: 768px) and (max-width: 991.98px) {
                                            .generated_card_wrapper {
                                                grid-template-columns: repeat(2, minmax(0, 1fr));
                                            }
                                        }

                                        @media (min-width: 992px) and (max-width: 1199.98px) {
                                            .generated_card_wrapper {
                                                grid-template-columns: repeat(3, minmax(0, 1fr));
                                            }
                                        }

                                        .card_generated_img img {
                                            max-width: 100%;
                                            object-fit: cover;
                                        }

                                        .ot-btn-cancel {
                                            border-radius: 4px;
                                            background: rgba(4, 82, 204, 0.10);
                                            font-size: 13px;
                                            font-weight: 500;
                                        }

                                        .grid_cards_view {
                                            display: grid;
                                            width: 100%;
                                            grid-template-columns: repeat(auto-fill, minmax(396px, 1fr));
                                            grid-gap: 10px;
                                        }

                                        #printContent {
                                            width: 100%;
                                        }

                                        .preview_box_inner {
                                            display: flex;
                                            flex-wrap: wrap;
                                            grid-gap: 10px;
                                        }

                                        .id_card_front {
                                            width: 250px;
                                            height: 387px;
                                        }

                                        /* .student_info, .id_card_front_inner{
                                        position: relative;
                                        left: 60px;
                                        padding: 0 !important;
                                    } */
                                        .id_card_front_info {
                                            position: relative;
                                            z-index: 12;
                                            height: 100%;
                                            /* padding-top: 100px; */
                                            height: 387px;
                                            top: 95px;
                                            padding-top: 0;
                                            width: 160px !important;
                                            min-width: 160px !important;
                                        }

                                        .id_card_back .shape_img_top img {
                                            border-radius: 8px;
                                            height: 100%;
                                            width: 100%;
                                            object-fit: cover;
                                            object-position: bottom;
                                            width: 250px;
                                            height: 387px;
                                        }

                                        .id_card_back {
                                            height: 387px;
                                            width: 250px;
                                            max-width: 250px;
                                            padding: 0;
                                            min-width: 250px !important;
                                        }

                                        @media print {
                                            .grid_cards_view .preview_box_inner {
                                                display: flex;
                                                flex-direction: row;
                                                align-items: center;
                                                justify-content: center;
                                                height: 100%;
                                                padding: 10px;
                                            }
                                        }
                                    </style>
                                    <div class="grid_cards_view">
                                        <div class="preview_box_inner ">

                                            <div class="id_card_front">
                                                <div class="shape_img_top">
                                                    <img src="https://school.onesttech.com/backend/uploads/card-images/card-top-shape.png"
                                                        alt="">
                                                </div>
                                                <div class="id_card_front_info">
                                                    <div class="id_card_front_inner">
                                                        <div class="id_card_profile_img">

                                                            <img src="{{ isset($card['student']->student_image) ? config('app.url') . '/storage/' . $card['student']->student_image : 'https://placehold.co/100x100/png' }}"
                                                                alt="">
                                                        </div>
                                                        <h3 class="text-center">
                                                            {{ $card['student']->name_en ?? 'xxxxxxxxxxx' }}</h3>
                                                        <span
                                                            class="class_name">{{ $card['student']->school_class->class_name ?? 'xxxxxx' }}</span>
                                                    </div>
                                                    <div class="student_info">
                                                        <p>Admission No:
                                                            {{ $card['student']->admission_id ?? 'xxxxxxxxxxx' }}</p>
                                                        <p>Roll No: {{ $card['student']->roll ?? 'xxxxxxxxxxx' }}</p>
                                                        <p>Date of birth:
                                                            {{ isset($card['student']->dob) ? \carbon\carbon::parse($card['student']->dob)->toDateString() : 'xx-xx-xxxx' }}
                                                        </p>
                                                        <p>Blood Group: O- </p>
                                                        <div class="signature_image ">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="id_card_back">
                                                <div class="id_card_back_info">
                                                    <p>gdsdgsgdsgdsg</p>
                                                    <h5>EXPIRED: 01/26/2024</h5>
                                                    <div class="qr_code">
                                                    </div>
                                                </div>
                                                <div class="id_card_back_logo_img">
                                                    <img width="50%" src="https://i.ibb.co/9sk20NX/pngwing-com.png"
                                                        alt="#">
                                                </div>
                                                <div class="shape_img_top">
                                                    <img src="https://school.onesttech.com/backend/uploads/card-images/card-bottom-shape.png"
                                                        alt="#">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <table style="background-color: #dae9fc; padding: .8rem 1rem; border-radius: .5rem; width: 100%">
                        <tbody>
                            <tr style="display: flex; flex-direction: row;">
                                <td
                                    style="width:33%; display: flex; flex-direction: column; align-items:center; justify-content:space-around">
                                    <img class=" rounded-full mb-2 w-[70px]"
                                        src="{{ isset(school()->institute_logo) ? '/storage/' . school()->institute_logo : 'https://placehold.co/80x80/png' }}"
                                        alt="">
                                    <img class="relative block px-3 w-[100px]"
                                        src="{{ isset($card['student']->student_image) ? config('app.url') . '/storage/' . $card['student']->student_image : 'https://placehold.co/100x100/png' }}"
                                        alt="">
                                </td>
                                <td style="width:66%">
                                    <h2 class=" font-bold text-2xl uppercase text-center mb-0 text-blue-600">
                                        {{ school()->institute_name }}
                                    </h2>
                                    <p class="text-center text-black text-xs mb-2">
                                        {{ school()->institute_address }}
                                    </p>
                                    <div
                                        class="text-black flex flex-wrap gap-2 justify-center mb-1 border-b border-blue-600">
                                        <span class=" font-medium">Phone: {{ school()->mobile_no }}</span>
                                        <span class=" font-medium">Web: {{ school()->web_address }}</span>
                                    </div>
                                    <div class="py-2 flex-col text-slate-900 gap-2">
                                        <div class="flex gap-1">
                                            <span class=" font-medium">Name:</span>
                                            <span>{{ $card['student']->name_en ?? 'xxxxxxxxxxx' }}</span>
                                        </div>
                                        <div class="flex gap-1">
                                            <span class=" font-medium">Class:</span>
                                            <span>{{ $card['student']->school_class->class_name ?? 'xxxxxx' }}</span>
                                        </div>
                                        <div class="flex gap-1">
                                            <span class=" font-medium">DOB:</span>
                                            <span>{{ isset($card['student']->dob) ? \carbon\carbon::parse($card['student']->dob)->toDateString() : 'xx-xx-xxxx' }}</span>
                                        </div>
                                        <div class="flex gap-1">
                                            <span class=" font-medium">Address:</span>
                                            <span>
                                                {{ !empty($card['student'])
                                                    ? $card['student']->village . ', ' . $student_upazila_name . ', ' . $student_district_name
                                                    : 'xxx,xxxxxxx,xxxx,xxxxxxxxx' }}</span>
                                        </div>
                                        <div class="flex gap-1">
                                            <span class=" font-medium">Phone:</span>
                                            <span>{{ $card['student']->mobile_number ?? '0123456789' }}</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table> --}}
                    <div class="justify-end gap-3 flex flex-wrap">
                        <div class="download_print_btns">
                            <button class="my-4 px-6 py-4 rounded bg-sky-500 flex gap-2"
                                onclick="printDiv('printContent')">
                                Print Now
                                <span><i data-lucide="printer"></i></span>
                            </button>
                        </div>
                        {{-- <button wire:click='loadPdf'
                            class="bg-yellow-400 transition-all duration-300 mt-3 hover:bg-yellow-500/90 rounded-md py-2 px-4">
                            Download
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@push('page-script')
    <script>
        function onclick(event) {
            printDiv('printContent')
        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        //close modal on save data
        Livewire.on('closeModal', (value) => {
            console.log(value);
            var modalBackdrop = document.querySelector('[modal-backdrop]');
            document.querySelector('body').style.overflow = 'auto';
            modalBackdrop.style.display = 'none';
            if (value === false) {
                window.Alpine.data('openCEmodal', false);
            }
        });
        Livewire.on('reload', (value) => {
            location.reload();
        });
    </script>
@endpush
