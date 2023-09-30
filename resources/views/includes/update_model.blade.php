    {{-- edit employee modal start --}}
    <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تعديل السؤال</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" id="edit_question_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="question_id">
                    <div class="modal-body p-4 bg-light">
                        <div class="row my-2">
                            <div class="col-lg">
                                <label for="question">السؤال</label>
                                <textarea class="form-control mt-2" name="question" id="question_update" cols="30" rows="5"
                                    placeholder="اكتب السؤال">{{ old('question') }}</textarea>
                                @error('question')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg">
                                <label for="answer">الإجابة</label>
                                <textarea class="form-control mt-2" name="answer" id="answer_update" cols="30" rows="10">{{ old('answer') }}</textarea>
                                @error('answer')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg">
                                <label for="tag_id">الأقسام</label>
                                <select name="tag_id" id="tag_id_update" class="form-select mt-2">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                                    @endforeach
                                    {{-- TODO: Make Add Tag Here  --}}
                                </select>
                                @error('tag_id')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg">
                                <label for="important_status">الأقسام</label>
                                <select name="important_status" id="important_status_update" class="form-select mt-2">
                                    <option value="1" >مهم</option>
                                    <option value="0" >غير مهم</option>
                                </select>
                                @error('important_status')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-lg">
                                <label for="completed_status">هل اكتمل ؟</label>
                                <select name="completed_status" id="completed_status_update" class="form-select mt-2">
                                    <option value="0">غير مكتمل</option>
                                    <option value="1">مكتمل</option>
                                </select>
                                @error('completed_status')
                                    <div class="alert alert-danger mt-3">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" id="edit_question_btn" class="btn btn-success">تعديل السؤال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
