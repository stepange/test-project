<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .table-container{
                width: 70%;
                display: flex;
                flex-wrap: wrap;
            }

            .table{
                width: 100%;
                text-align: center;
            }

            .search-bar{
                width: 100%;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            .search-button{
                margin-top: 10px;
            }

            .underline{
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="table-container">
                <div class="search-bar">
                    <form action="/" method="GET" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="search">Search</label>
                            <input value="{{ $searchText }}" type="text" class="form-control" id="search" name="search" placeholder="search">
                        </div>
                        <button type="submit" class="btn btn-primary search-button">Submit</button>
                    </form>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Dictionary</th>
                        <th scope="col">Term</th>
                        <th scope="col">Translation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dictionaries as $dictionary)
                        <tr>
                            <th scope="row">{{ $dictionary['id'] }}</th>
                            <td @if($highlightColumn == 'dictionary') class="underline" @endif>{{ $dictionary['name'] }}</td>
                            <td></td>
                            <td></td>
                        </tr>

                        @foreach($dictionary['terms'] as $term)
                            <tr>
                                <th scope="row"></th>
                                <td></td>
                                <td @if($highlightColumn == 'term') class="underline" @endif>{{ $term['name'] }}</td>
                                <td></td>
                            </tr>

                            @foreach($term['translations'] as $translation)
                                <tr>
                                    <th scope="row"></th>
                                    <td></td>
                                    <td></td>
                                    <td @if($highlightColumn == 'translation') class="underline" @endif>{{ $translation['name'] }}</td>
                                </tr>


                            @endforeach
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
