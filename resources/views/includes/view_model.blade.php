    {{-- edit employee modal start --}}
    <div class="modal fade" id="viewQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل السؤال</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="question_copy">
                    <h3>
                        سؤال رقم : <span id="question_number"></span>
                    </h3>
                    <hr>
                    <p id="question_content"></p>
                    -----------------------------------------
                    <p id="question_answer"></p>
                    -----------------------------------------
                    <p>
                        #التوحيد_اولا
                        <br>
                        #د_رامى_فريد
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    <button type="submit" id="copy_question_btn" class="btn btn-success">نسخ السؤال</button>
                </div>
            </div>

        </div>
    </div>
