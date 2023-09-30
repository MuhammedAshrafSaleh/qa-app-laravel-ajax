@extends('layouts.master')
@section('title', 'أسئلة و أجوبة د.رامى فريد')
@php

    $message = "انا كنت عايزه استشير ف حاجه كده
انا كنت اعرف حد من السوشيال ميديا وكده وسبنا بعض حوالي ٥ مرات ورجعنا واخر مره اتخطبنا وسبنا بعض تاني بحجة أنه مش قادر ع موضوع الجواز وكده هو ممكن يكون بيبعد عني عشان علاقتنا ببعض كانت حرام من الاول واني غضبت ربنا اني كلمته من النت !!
هو ف كل مره كان بيسبني ويرجع يتأسفلي ويقولي اخر مره هسيبك
مع العلم اني معملتش معاه غير كل خير ولله ودائما كان يقولي أنه محبش حد قدى ولا ارتاح مع حد زيي انا مش عارفه هو ليه بعد عني طلما بيحبني انا عملت معاه كل الخير
هو ممكن يرجع تاني بما أنه سابنا بعض كذا مره ورجع عشان مديش لنفسي امل بس !!
انا اسفه لو طولت بس مش عايزه اي خيط امل بس يخليني مبطلش دعا أنه يرجع";

@endphp

@section('css')
    <style>
        .card-body {
            overflow-x: scroll !important;
        }
    </style>
@endsection
@section('content')
    @include('includes.add_model')
    @include('includes.update_model')
    @include('includes.view_model')
    <div class="container">
        <h3 class="text-light">سؤال وجواب شرعى دكتور رامى</h3>
        <div class="center-btn">
            <a class="btn btn-success" href="{{ route('index_mobile') }}">Mobile Veriosn</a>
            <a class="btn btn-primary" href="{{ route('index') }}">Desktop Version</a>
        </div>
        <div class="row my-5">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                        <button class="btn btn-warning" id="important_questions">الاسئلة المهمة</button>
                        <button class="btn btn-light" id="unsent_questions"> الاسئلة التى لم تُرسل </button>
                        {{-- <button class="btn btn-primary" id="completed_questions">الاسئلة المكتملة</button> --}}
                        <button class="btn btn-light" id="uncompleted_questions">الاسئلة الغير مكتملة</button>
                        <button class="btn btn-success" id="unanswerd_questions">الاسئلة الغير مجاب عنها</button>
                        <button class="btn btn-light" id="all_questions">كل الاسئلة</button>
                        <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addQuestionModal"><i
                                class="bi-plus-circle mx-2"></i>اضافة سؤال</button>
                        {{--
                            <a class="btn btn-light" href="{{ url("https://api.whatsapp.com/send?phone=+201149077411&text=$message") }}" target="_blank">
                                    Send Message on WhatsApp
                        </a> --}}
                    </div>
                    <div class="card-body" id="show_all_questions" style="overflow-x: scroll !important;">
                        <h1 class="text-center text-secondary my-5">...تحميل</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        let storeRoute = '{{ route('store') }}';
        let editRoute = '{{ route('edit') }}';
        let deleteRoute = '{{ route('delete') }}';
        let updateRoute = '{{ route('update') }}';
        let viewRoute = '{{ route('view') }}';
        let csrf = '{{ csrf_token() }}';

        function copyQustion() {
            var range = document.createRange();
            range.selectNode(document.getElementById("question_copy"));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
            Swal.fire({
                position: "center",
                icon: "success",
                title: "تمت النسخ بفضل الله",
                showConfirmButton: false,
                timer: 1500,
            });
        }
    </script>

@endsection
