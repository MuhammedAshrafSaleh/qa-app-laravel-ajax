@extends('layouts.master')
@section('css')
    <style>
        .btn {
            font-size: 14px;
        }
    </style>
@endsection

@section('title', 'أسئلة و أجوبة د.رامى فريد')

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
                    <div class="card-header bg-danger d-flex">
                        <div class="owl-carousel">
                            <div class="item">
                                <button class="btn btn-warning" id="important_questions">الاسئلة المهمة</button>
                            </div>
                            <div class="item">
                                <button class="btn btn-light" id="unsent_questions"> الاسئلة التى لم تُرسل </button>
                            </div>
                            {{-- <div class="item">
                                <button class="btn btn-primary" id="completed_questions">الاسئلة المكتملة</button>
                            </div> --}}
                            <div class="item">
                                <button class="btn btn-primary" id="uncompleted_questions">الاسئلة الغير مكتملة</button>
                            </div>
                            <div class="item">
                                <button class="btn btn-success" id="unanswerd_questions">الاسئلة الغير مجاب عنها</button>
                            </div>
                            <div class="item">
                                <button class="btn btn-light" id="all_questions">كل الاسئلة</button>
                            </div>
                            <div class="item">
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addQuestionModal"><i
                                        class="bi-plus-circle mx-2"></i>اضافة سؤال</button>
                            </div>
                        </div>
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
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                items: 1,
                // autoplay: true,
                // autoplayTimeout: 4000,
                // loop: true,
            });
        });

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
