@extends('app')

@section('content')
    <div class="container" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Add Map</div>

                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ URL('/map/update') }}"  class="form-horizontal" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Title</label>
                                <div class="col-lg-10">
                                    <input type="text" name="title" class="form-control" required="required" value=" {{$map->title}}">


                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Context</label>
                                <div class="col-lg-10">
                                    <textarea name="context" rows="10" class="form-control" required="required" >
                                        {{$map->context}}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Tag</label>
                                <div class="tagsinput-primary col-lg-10">
                                    @foreach($tag as $map->belongsToManyTags )
                                        $list_tag = $tag->tag;

                                    @endforeach

                                    <input name="tags" class="tagsinput tagsinput-typeahead " value="">
                                    </input>
                                </div>
                            </div>


                            <br>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Public</label>
                                <div class="col-lg-3">
                                    <input name="isPublic"type="checkbox" checked data-toggle="switch" data-on-color="success" data-off-color="warning" id="custom-switch-06" />
                                </div>
                                <button class="btn btn-primary btn-info">add Map</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>

        var states = new Bloodhound({
            datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.word); },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            limit: 4,
            local: [
                { word: "Alabama" },
                { word: "Alaska" },
                { word: "Arizona" },
                { word: "Arkansas" },
                { word: "California" },
                { word: "Asasa" },
                { word: "Colorado" }
            ]
        });

        states.initialize();

        $('input.tagsinput').tagsinput();

        $('input.tagsinput-typeahead').tagsinput('input').typeahead(null, {
            name: 'states',
            displayKey: 'word',
            source: states.ttAdapter()
        });

        $('input.typeahead-only').typeahead(null, {
            name: 'states',
            displayKey: 'word',
            source: states.ttAdapter()
        });

    </script>


@endsection