<?php

namespace App\Http\Controllers;

use App\Libs\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Yaml\Yaml;

class PagesController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function home(Request $request): \Illuminate\Contracts\View\View
    {
        return view('home');
    }


    /**
     * @param Request $request
     * @return string
     */
    public function renderTemplate(Request $request): string
    {
        // Default value to return
        $output = "An error occurred";

        try {
            // Some simple validation rules for input data
            $validated = $request->validate([
                'templateBody'  => 'required|min:3|string',
                'templateYaml'  => 'required|min:10|string'
            ]);

            // Parsing YAML string with Symfony/Yaml package
            $data = Yaml::parse($validated['templateYaml']);

            $tmp = $validated['templateBody'];

            $template = new Template($tmp, $data);

            return $template->render();

        } catch (\Exception $e) {
            Log::notice($e->getMessage());
        }

        return $output;
    }
}
