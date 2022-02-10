<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Template Engine Test</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
        .highlight {
            background-color: #f8f9fa;
        }
        textarea {
            font-size: 12px;
        }
    </style>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src="js/app.js"></script>
</head>
<body>

<div class="container">
    <div class="row mt-5">
        <div class="col-6">
            <form id="theForm" class="" action="{{ route('render') }}" method="POST">
                @csrf
                <div class="card mb-3">
                    <div class="card-body highlight">
                        <label for="templateBody" class="form-label">Template Body</label>
                        @verbatim
                        <textarea required rows="10" class="form-control" id="templateBody" name="templateBody">
{{name1}} read "{{book1}}" and will {{#if willRecommend1}} not{{#end}} recommend it to read.

{{name2}} read "{{book2}}" and will {{#if willRecommend2}} not{{#end}} recommend it to read.</textarea>
                        @endverbatim
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body highlight">
                        <label for="templateYaml" class="form-label">Template Yaml</label>
                        @verbatim
                        <textarea required rows="10" class="form-control" id="templateYaml" name="templateYaml">
{
    name1: "Aram",
    name2: "John",
    book1: "Hyperion",
    book2: "Neuromancer",
    willRecommend1: true,
    willRecommend2: false,
}</textarea>
                        @endverbatim
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" type="submit">Run</button>
                </div>
            </form>
        </div>
        <div class="col-6">
            <div class="card" style="height: 100%;">
                <div class="card-body highlight">
                    <div id="output"></div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
