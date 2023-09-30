<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;

class QuestionController extends Controller
{
    public function index()
    {
        $tags = DB::table('tags')->get();
        return view('index', compact('tags'));
    }

    public function index_mobile()
    {
        $tags = DB::table('tags')->get();
        return view('index_mobile', compact('tags'));
    }

    // handle insert a new employee ajax request
    public function store(StoreRequest $request)
    {
        $data = $request->except('_token');
        $data['answer_status'] = ($request->answer == "") ? 0 : 1;
        DB::table('questions')->insert($data);
        return response()->json([
            'status' => 200,
        ]);
    }


    // handle fetch all eamployees ajax request
    public function fetchAll($keyword)
    {
        if ($keyword == 'important') {
            // get important questions
            $questions = DB::table('questions')->where('important_status', 1)->get();
        } else if ($keyword == 'unanswerd') {
            // get unanswerd quesitons
            $questions = DB::table('questions')->where('answer_status', 0)->get();
        } else if ($keyword == 'unsent') {
            // get questions where the there's an answer and it is not sent
            $questions = DB::table('questions')->where('answer_status', 1)->where('completed_status', 1)->where('sent_status', 0)->get();
        } else if ($keyword == 'uncompleted') {
            // get questions where the there's an answer and you need to come back again
            $questions = DB::table('questions')->where('answer_status', 1)->where('completed_status', 0)->get();
        } else if ($keyword == 'completed') {
            $questions = DB::table('questions')->where('answer_status', 1)->where('completed_status', 1)->get();
        } else {
            // get all questions
            $questions = DB::table('questions')->get();
        }
        // dd($questions);
        $tags = DB::table('tags')->get();
        $output = '';
        if ($questions->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>رقم السؤال</th>
                <th>السؤال</th>
                <th>القسم</th>
                <th>الأهمية</th>
                <th>مجاب أم لا</th>
                <th> أرسل أم لاء </th>
                <th>أعمال أخرى</th>
              </tr>
            </thead>
            <tbody>';

            foreach ($questions as $question) {
                $important_status = ($question->important_status == 1) ? "مهم" : "غير مهم";
                $answer_status = (!is_null($question->answer)) ? '<p class="alert alert-success text-center">مجاب عنه</p>' : ' <p class="alert alert-danger text-center">غير مجاب</p>';
                $completed_status = ($question->completed_status == 1) ? 1 : 0;
                $sent_status = ($question->sent_status == 1) ? 1 : 0;
                $tag_section = "";
                foreach ($tags as $tag) {
                    if ($question->tag_id == $tag->id) {
                        $tag_section = $tag->name;
                        break;
                    }
                }
                $output .= '<tr>
                <td>' . $question->id . '</td>
                <td style="overflow:hidden"><p class="text-with-dots"> ' . $question->question . ' </p></td>
                <td>' . $tag_section . '</td>
                <td>' . $important_status . '</td>
                <td>' . $answer_status . '</td>
                <td>
                    <input type="checkbox" id="sent_status" question_id="' . $question->id . '" name="sent_status" ' . ($sent_status ? 'checked' : "") . '>
                </td>
                <td>

                  <a href="#" id="' . $question->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editQuestionModal"><i class="bi-pencil-square h4"></i></a>
                  <a href="#" id="' . $question->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                  <a href="#" id="' . $question->id . '" class="text-success mx-1 viewIcon" data-bs-toggle="modal" data-bs-target="#viewQuestionModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                    </svg>
                  </a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">لا يوجد أسئلة فى الداتا بيز حاليا</h1>';
        }
    }


    // handle edit an employee ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $question = DB::table('questions')->where('id', $id)->first();
        return response()->json($question);
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $question = DB::table('questions')->where('id', $id)->get()->first();
        return response()->json($question);
    }

    // handle update an employee ajax request
    public function update(Request $request)
    {
        $id = $request->id;
        $data = $request->except('_token');
        $data['answer_status'] = ($request->answer == "") ? 0 : 1;
        DB::table('questions')->where('id', $id)->update($data);
        return response()->json([
            'status' => 200,
        ]);
    }


    // handle delete an employee ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        DB::table('questions')->where('id', $id)->delete();
    }

    public function update_completed(Request $request)
    {
        $id = $request->id;
        $data = $request->except('_token');
        DB::table('questions')->where('id', $id)->update($data);
        return response()->json([
            'status' => 200,
        ]);
    }
}


//   <button id="' . $question->id . '" class="text-warning mx-1 copyIcon btn" onclick="copyQustion()">
//     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clipboard-plus" viewBox="0 0 16 16">
//         <path fill-rule="evenodd" d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z"/>
//         <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
//         <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
//     </svg>
//   </button>
