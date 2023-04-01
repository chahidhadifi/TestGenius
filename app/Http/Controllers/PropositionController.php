<?php

namespace App\Http\Controllers;

use App\Models\Proposition;
use App\Models\Question;
use Illuminate\Http\Request;

class PropositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $propositions = Proposition::with("question")->get();
        return response()->json($propositions);
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

        $propositions = $request->all();
  
            foreach($propositions as $ans) {
                $anss = Proposition::create([
                    'libelle' => $ans['libelle'],
                    'est_correcte' => $ans['est_correcte'],
                    'question_id' => $ans['question_id'],
                ]);
            }

        // $propositions = new Proposition([
        //    'libelle' => $request->input('libelle'),
        //    'est_correcte' => $request->input('est_correcte'),
        //    'question_id' => $request->input('question_id'),
        // ]);

        // $propositions->save();
        
        return response()->json('');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $propositions = Proposition::find($id);
        return response()->json($propositions);
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
        $propositions = Proposition::find($id);
        $propositions->update($request->all());
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
        $propositions = Proposition::find($id);
        $propositions->delete();
        return response()->json('');
    }
}
