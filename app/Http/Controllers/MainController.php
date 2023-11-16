<?php

namespace App\Http\Controllers;

use App\Models\Sections;
use App\Models\Team;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view("land.index", ["sections" => Sections::where('page', 'index')->where('status',1)->get()]);
    }

    public function upload(Request $request){
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('public/uploads');
            $url = asset(str_replace('public', 'storage', $path));

            $team = Team::find($request->team);

            $team->logo = $url;

            if($team->save()){
                return response()->json(["type" => "success", "message" => "Kapak başarıyla yüklendi", "url" => $url, "status" => true], 200);
            }

            
        }
        return response()->json(["type" => "warning", "message" => "Dosya yüklenirken bir hata oluştu."], 500);
    }
}
