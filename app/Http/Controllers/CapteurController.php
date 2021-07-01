<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capteur;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class CapteurController extends Controller
{
    /**
     * permet l'affichage d'une liste de capteurs
     */
    public function index(){

        CapteurController::fetch();

        $db_result = DB::select('select * from capteurs');

        return view('main', ['capteurs' => $db_result]);

    }

    /**
     * permet la mise a jour d'un capteur
     */
    public function update(Request $request){

        $capteur = Capteur::find(request('id'));
        $capteur->id = request('id');
        if(request('numero') != null){
            $capteur->numero = request('numero');
        }
        if(request('gateway') != null){
            $capteur->gateway = request('gateway');
        }
        if(request('date') != null){
            $capteur->installation_date = request('date');
        }
        if(request('longitude') != null){
            $capteur->longitude = request('longitude');
        }
        if(request('latitude') != null){
            $capteur->latitude = request('latitude');
        }
        $capteur->status = request('status');
        $capteur->batterie = request('batterie');
        $capteur->rssi = request('rssi');

        $capteur->save();

        $updated_capteur = DB::select('select * from capteurs where id = ?', [request('id')]);


        return $updated_capteur;


    }

    /**
     * permet l'ajout d'un capteur
     */
    public function add(){

        $id_list = DB::select("select id from capteurs ORDER BY capteurs.id DESC");

        for($i=0; $i < count($id_list); $i++){
            for($j=0; $j < count($id_list); $j++){
                $new_id = $id_list[0];
            }
        }

        foreach($new_id as $data){
            $id = $data;
        }

        $id += 1;

        $capteur = new Capteur;
        $capteur->id = $id;
        $capteur->numero = request('numero');
        $capteur->gateway = request('gateway');
        $capteur->installation_date = request('date');
        $capteur->status = request('status');
        $capteur->batterie = request('batterie');
        $capteur->longitude = request('longitude');
        $capteur->latitude = request('latitude');
        $capteur->rssi = request('rssi');

        $capteur->save();

        $result = DB::select('select * from capteurs where id = ?', [$id]);

        return $result;

    }

    /**7
     * permet la suppression d'un objet capteur
     */
    public function delete($id){

        DB::table("capteurs")->delete($id);

    }


    /**
     * @Return Bool
     * @Param mixed $data_api
     *
     * permet de vérifier l'existance d'un élément Json dans la bdd
     */
    private function isInDatabase($data_api): bool
    {

        $data_database = DB::select('select * from capteurs');

        if(count($data_database) === 0){
            $exist = false;
        }else{

            foreach($data_database as $d_db){

                if($data_api == $d_db->id){
                    $exist = true;
                    break;
                }else{
                    $exist = false;
                }

            }

        }

        return $exist;

    }

    /**
     * permet de récupérer les données de l'API et de les enregistrer dans la ddb
     */
    private function fetch()
    {

        $response = Http::get('https://dev2.charlie-solutions.com/api/data_test_technique');

        foreach($response['data'] as $i){

            if(CapteurController::isInDatabase($i['id']) == false){

                $capteur = new Capteur();
                $capteur->id = $i['id'];
                $capteur->numero = $i['numero_capteur'];
                $capteur->gateway = $i['numero_gateway'];
                $capteur->installation_date = $i['installation_date'];
                $capteur->status = $i['status'];
                $capteur->batterie = $i['batterie'];
                $capteur->latitude = $i['latitude'];
                $capteur->longitude = $i['longitude'];
                $capteur->rssi = $i['rssi'];
                $capteur->save();

            }
        }

    }
}
