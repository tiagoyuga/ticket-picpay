<div class="row">

    @if($skillList)

        @foreach($skillList as $skill)

            <div class="col-sm-4 col-md-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $skill->name }}
                    </div>
                    <div class="panel-body">

                        @foreach($skill->options as $option)

                            <div class="skills form-group col-md-12 ">
                                <label for="password">{{ $option->name }}</label>
                                <input type="number" name="skill[{{ $option->id }}]" id=""
                                       class="form-control" min="0" max="10" maxlength="2"
                                       value="{{ old("skill[$option->id]", $userQualifications[$option->id] ?? 0 ) }}">
                            </div>

                        @endforeach

                    </div>

                </div>
            </div>

        @endforeach

    @endif


</div>

@section('scripts')
    @parent
    <script>
        $(".skills").on('keyup keypress blur change', function (e) {

            if ($(this).val() > 10) {
                $(this).val(0);
                return false;
            }

        });
    </script>
@endsection
