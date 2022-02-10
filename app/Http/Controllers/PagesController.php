<?php

namespace App\Http\Controllers;

use App\Libs\Templ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Yaml\Yaml;

class PagesController extends Controller
{
    public function home(Request $request)
    {
        return view('home');
    }


    public function renderTemplate(Request $request)
    {
        $output = "An error occurred";

        try {
            $validated = $request->validate([
                'templateBody'  => 'required|min:3',
                'templateYaml'  => 'required|min:10'
            ]);

            $data = Yaml::parse($validated['templateYaml']);
            $tmpl = $validated['templateBody'];

            $tmpEng = new Templ($tmpl, $data);

            return $tmpEng->render();

        } catch (\Exception $e) {
            Log::notice($e->getMessage());
        }

        return $output;
    }
}
