<?php

namespace App\Libs;

class Templ
{

    protected $tmpl;
    protected $data;

    protected $ld = '{{';
    protected $rd = '}}';

    protected $ldIf = '{{#if';
    protected $rdIf = '}}';

    protected $dEnd = '{{#end}}';

    public function __construct($tmpl, $data)
    {
        $this->tmpl = $tmpl;
        $this->data = $data;
    }


    public function render()
    {
        $this->renderConditions();
        $this->renderVariables();

        $this->tmpl = nl2br($this->tmpl);
        return $this->tmpl;
    }

    public function renderConditions()
    {
        $res = preg_match_all('/'.$this->ldIf.'\s*([a-zA-Z0-9_]*)'.$this->rdIf.'(\s*\w*)'.$this->dEnd.'/', $this->tmpl, $matches);
        if($res) {
            foreach ($matches[1] as $ind => $key) {
                if(key_exists($key, $this->data)) {
                    if(false === $this->data[$key]) {
                        $this->tmpl = str_replace($matches[0][$ind], $matches[2][$ind], $this->tmpl);
                    } else {
                        $this->tmpl = str_replace($matches[0][$ind], "", $this->tmpl);
                    }
                }
            }
        }
    }

    public function renderVariables()
    {
        $res = preg_match_all('/'.$this->ld.'([a-zA-Z0-9_]*)'.$this->rd.'/', $this->tmpl, $matches);
        if($res) {
            foreach ($matches[1] as $ind => $key) {
                if(key_exists($key, $this->data)) {
                    $this->tmpl = str_replace($matches[0][$ind], $this->data[$key], $this->tmpl);
                }
            }
        }
    }
}
