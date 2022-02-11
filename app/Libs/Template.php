<?php

namespace App\Libs;

class Template
{

    /**
     * Holds the template string
     *
     * @var string
     */
    protected $tpl;

    /**
     * Holds parsed YAML data
     *
     * @var array
     */
    protected $data;

    /**
     * @param $tpl
     * @param $data
     */
    public function __construct($tpl, $data)
    {
        $this->tpl = $tpl;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $this->renderConditions();
        $this->renderVariables();

        return $this->tpl;
    }

    /**
     * Renders "if" conditions.
     * Format: {{#if variableName}} text||variable {{#end}}
     */
    public function renderConditions()
    {
        // Finds all matches for Format. Case-insensitive. Non-greedy
        $res = preg_match_all('/{{#if\s*([a-zA-Z0-9_]*)}}(.*?){{#end}}/i', $this->tpl, $matches);

        // if matches found
        if($res) {
            // $matches[1] holds all variableNames from Format
            foreach ($matches[1] as $ind => $key) {
                // if variableName key exists in YAML data
                if(key_exists($key, $this->data)) {
                    // replace whole matched string which is held in $matches[0] with condition's content - text||variable
                    $result = ($this->data[$key]) ? $matches[2][$ind] : "";
                    $this->tpl = str_replace($matches[0][$ind], $result, $this->tpl);
                }
            }
        }

        // TODO: With small changes we can also have support for {{#else}}

    }

    /**
     * Renders variables
     * Format: {{variableName}}
     */
    public function renderVariables()
    {
        // Finds all matches for Format. Case-sensitive. Greedy
        $res = preg_match_all('/{{([a-zA-Z0-9_]*)}}/', $this->tpl, $matches);

        // if matches found
        if($res) {
            // $matches[1] holds all variableNames from Format
            foreach ($matches[1] as $ind => $key) {
                // if variableName key exists in YAML data
                if(key_exists($key, $this->data)) {
                    // replace whole matched string which is held in $matches[0] with YAML data value
                    $this->tpl = str_replace($matches[0][$ind], $this->data[$key], $this->tpl);
                }
            }
        }
    }
}
