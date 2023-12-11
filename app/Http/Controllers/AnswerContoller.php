<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Requests\AnswerRequest;
use App\Http\Resources\AnswerRessource;
use App\Http\Requests\StoreAnswerForParticipant;

class AnswerContoller extends Controller
{
    /**
     * Display a listing of surveys.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AnswerRessource::collection(Answer::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswerRequest $request)
    {
        try {
            $request->validated();
            $answer = Answer::create([
                "value" => $request->value,
                "email" => $request->email,
                "survey_id" => $request->survey_id,
                "question_id" => $request->question_id,
            ]);


            return  $answer ;

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }
    }


    /**
     * Enregistrements des réponses envoyé par l'utilisateur
     */
    public function storeForParticipant(StoreAnswerForParticipant $request)
    {
        try {


            $request->validated();

            $survey_id =   $request->survey_id;
            $email = $request->email;
            $answers = $request->answers;

            //creation de l'entité participant
            $participant = Participant::create(
                [
                "email" => $email,
                "token" => base64_encode($email),
                "survey_id" => $survey_id
                ]
            );


            //Sauvegardes des reponses
            foreach($answers as $answer) {
                $answer = Answer::create([
                    "value" => $answer["value"],
                    "email" => $email,
                    "survey_id" => $survey_id,
                    "question_id" => $answer["question_id"],
                ]);
            };

            return response()->json([
                'message' => "Sondage enrgistré",

            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ], 500);
        }


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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
