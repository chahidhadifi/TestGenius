<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Proposition;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::with("examen")->get();
        return response()->json($questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // $questions = new Question([
        //   'examen_id' => $request->input('examen_id'),
        //   'libelle' => $request->input('libelle'),
        // ]);
        // $questions->save();


        // return response()->json('');

        // $propositions = $request->all();

        // $question = Question::create([
        //     'libelle' => $request->libelle,
        //     'examen_id' => $request->examen_id
        // ]);
        // if($question) {
        //     foreach($propositions as $ans) {
        //         $anss = Proposition::create([
        //             'libelle' => $ans['libelle'],
        //             'est_correcte' => $ans['est_correcte'],
        //             'question_id' => $question->id,
        //         ]);
        //     }
        // }

        // return response()->json('');
        
        $question = $request->all();
        $question = Question::create([
            'libelle' => $request->libelle,
            'examen_id' => $request->examen_id
        ]);
        foreach ($request->proposition as $ans) {
            $anss = Proposition::create([
                            'libelle' => $ans['libelle'],
                            'est_correcte' => $ans['est_correcte'],
                            'question_id' => $question->id,
                        ]);
        }
        return $question;

        // $data = $request->all();
        // $question = Question::create([
        // 'libelle' => $data['libelle'],
        // 'examen_id' => $data['examen_id'],
        // ]);
        // foreach ($data['propositions'] as $p) {
        //     $question->propositions()->create([
        //         'libelle' => $p['libelle'],
        //         'est_correcte' => $p['est_correcte'],
        //         'question_id' => $p['question_id']
        //     ]);
        // }
        // return $question;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Question::find($id);
        return response()->json($questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $questions = Question::find($id);
        $questions->update($request->all());
        return response()->json('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $questions = Question::find($id);
        $questions->delete();
        return response()->json('');
    }

    //
    // $data = json_decode(($request->test), true);
    //     $question = Question::create([
    //         'libelle' => $data["libelle"],
    //         'examen_id' => $data["examen_id"],
    //     ]);
    //     foreach ($data['propositions'] as $p) {
    //         $question->propositions()->create([
    //             'libelle' => $p->libelle,
    //         ]);
    //     }
    //     // $question->propositions()->create([
    //     //     'libelle' => $p->libelle',
    //     // ]);
    // //
}
