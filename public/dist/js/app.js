$(function () {
    let keyword = "all";

    function getAllQuestions() {
        keyword = "all";
        fetchAllEmployees();
    }

    function getUnCompletedQuestions() {
        keyword = "uncompleted";
        fetchAllEmployees();
    }
    function getUnanswerdQuestions() {
        keyword = "unanswerd";
        fetchAllEmployees();
    }

    function getImportantQuestions() {
        keyword = "important";
        fetchAllEmployees();
    }
    function getUnsentQuestions() {
        keyword = "unsent";
        fetchAllEmployees();
    }
    document.getElementById("all_questions").onclick = getAllQuestions;
        document.getElementById("uncompleted_questions").onclick =
        getUnCompletedQuestions;
    document.getElementById("unanswerd_questions").onclick =
        getUnanswerdQuestions;
    document.getElementById("important_questions").onclick =
        getImportantQuestions;
    document.getElementById("unsent_questions").onclick = getUnsentQuestions;

    $(document).ready(function () {
        $(document).on("click", "#sent_status", function (e) {
            e.preventDefault();
            // Check if the checkbox is checked
            // let csrf = '{{ csrf_token() }}';
            let id = $(this).attr("question_id");
            let status = $(this).is(":checked") ? 1 : 0;
            if ($(this).is(":checked")) {
                $.ajax({
                    url: "/update_completed",
                    type: "POST",
                    data: {
                        sent_status: status,
                        _token: csrf,
                        id: id,
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "تمت التعديل بفضل الله",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            fetchAllEmployees();
                        }
                    },
                });
            } else {
                $.ajax({
                    url: "/update_completed",
                    type: "POST",
                    data: {
                        sent_status: status,
                        _token: csrf,
                        id: id,
                    },
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "تمت التعديل بفضل الله",
                                showConfirmButton: false,
                                timer: 1500,
                            });
                            fetchAllEmployees();
                        }
                    },
                });
            }
        });
    });

    // add new employee ajax request
    $("#add_question_form").submit(function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        $("#add_question_btn").text("...تتم الاضافة الان");
        $.ajax({
            url: storeRoute,
            method: "post",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "تمت الاضافة بفضل الله",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    fetchAllEmployees();
                }
                $("#add_question_btn").text("اضافة سؤال");
                $("#add_question_form")[0].reset();
                $("#addQuestionModal").modal("hide");
            },
        });
    });
    // Copy Question
    $(document).on("click", "#copy_question_btn", function (e) {
        e.preventDefault();
        $("#copy_question_btn").text("...يتم النسخ الان");
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
        $("#copy_question_btn").text("نسخ السؤال");
    });

    // view question and answer
    $(document).on("click", ".viewIcon", function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        $.ajax({
            url: viewRoute,
            method: "get",
            data: {
                id: id,
            },
            success: function (response) {
                $("#question_number").text(response.id);
                $("#question_content").text(response.question);
                $("#question_answer").text(response.answer);
            },
        });
    });

    // edit question ajax request
    $(document).on("click", ".editIcon", function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        $.ajax({
            url: editRoute,
            method: "get",
            data: {
                id: id,
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                $("#question_update").val(response.question);
                $("#answer_update").val(response.answer);
                $("#tag_id_update").val(response.tag_id);
                $("#important_status_update").val(response.important_status);
                $("#completed_status_update").val(response.completed_status);
                $("#question_id").val(response.id);
            },
        });
    });

    // update question ajax request
    $("#edit_question_form").submit(function (e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_question_btn").text("...يتم التعديل الان");
        $.ajax({
            url: updateRoute,
            method: "post",
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "تمت التعديل بفضل الله",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    fetchAllEmployees();
                }
                $("#editQuestionModal").modal("hide");
                $("#edit_question_btn").text("تعديل السؤال");
                $("#edit_question_form")[0].reset();
            },
        });
    });

    // delete employee ajax request
    $(document).on("click", ".deleteIcon", function (e) {
        e.preventDefault();
        let id = $(this).attr("id");
        // let csrf = '{{ csrf_token() }}';
        Swal.fire({
            title: "هل متأكد من أنك تريد المسح",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "نعم إمسحه",
            cancelButtonText: "إغلاق",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: deleteRoute,
                    method: "delete",
                    data: {
                        id: id,
                        _token: csrf,
                    },
                    success: function (response) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "تم المسح بفضل الله",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        fetchAllEmployees();
                    },
                });
            }
        });
    });

    // fetch all employees ajax request
    fetchAllEmployees();

    function fetchAllEmployees() {
        $.ajax({
            url: "/fetchAll/" + keyword,
            method: "get",
            success: function (response) {
                $("#show_all_questions").html(response);
                document.getElementById("show_all_questions").style.overflowX =
                    "scroll";

                $("table").DataTable({
                    order: [0, "asc"],
                    responsive: true,
                });
            },
        });
    }
});
