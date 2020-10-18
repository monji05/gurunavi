<?php

namespace App\Http\Controllers\Qa;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Qa as Qa;
use Collective\Html\FormFacade;
use Illuminate\Http\Request;

class QaController extends BaseController
{
    public function __construct(Qa $qa)
    {
        $this->qa = $qa;
    }

    public function index ()
    {
        $list = $this->qa->fetch();
        return view('qa.index', ['list' => $list]);
    }

    public function create()
    {
        return view('qa.edit');
    }

    public function edit(?int $qaId = null)
    {
        $fetchDefaults = $this->qa->fetchDefaults();
        return view('qa.edit', ['defaults' => $fetchDefaults]);
    }

    public function confirm(Request $request, ?int $qaId = null)
    {
        $input = $request->all();
        $request->session()->put('input', $input);
        $fetchDefaults = $this->qa->fetchDefaults($qaId);
        return view('qa.confirm',
            [
                'input' => $input,
                'defaults' => $fetchDefaults ?? null
            ]
        );

    }

    public function complete(Request $request, ?int $qaId = null)
    {
        $input = $request->session()->get('input');
        $this->qa->register($input, $qaId);
        $request->session()->remove('input');
        return redirect()->route('qa.index')->with('登録完了しました');
    }
}
