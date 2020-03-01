<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{!! mix('css/inspina_theme_register_dev.css') !!}"/>
</head>
<body>
<div id="gray-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="ibox">
                    <div class="ibox-title text-center">
                        <h5 class="text-center">Webholding - Programmer Registration</h5>
                    </div>
                    <div class="ibox-content">


                        <form method="post" id="form" action="{{ route('dev.store')  }}" class="wizard-big"
                        enctype="multipart/form-data">
                            {{ method_field('POST') }}
                            {{ csrf_field() }}

                            <h1>Account</h1>
                            <fieldset>
                                <h2>Account Information</h2>
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>Name *</label>
                                                <input id="name" name="name" type="text"
                                                       class="form-control required" value="{{old('name')}}">

                                                {!! $errors->first('name','<span class="help-block m-b-none">:message</span>') !!}

                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Email *</label>
                                                <input id="email" name="email" type="email" value="{{ old('email')}} "
                                                       class="form-control required">

                                                {!! $errors->first('email','<span class="help-block m-b-none">:message</span>') !!}

                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-12">
                                                <label>Resume *</label>
                                                <input id="resume" name="resume" type="file"
                                                       class="form-control required"
                                                       accept="image/gif, image/jpeg, image/png, application/pdf"
                                                >
                                            </div>


                                        </div>

                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>Password *</label>
                                                <input id="password" name="password" type="password"
                                                       class="form-control required">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Confirm Password *</label>
                                                <input id="password_confirmation" name="password_confirmation" type="password"
                                                       class="form-control required">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </fieldset>

                            <h1>Address</h1>
                            <fieldset>
                                <h2>Address Information</h2>
                                <div class="row">

                                    <div class="col-lg-12">

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Country *</label>
                                                <input id="country" name="country" type="text" value="{{ old('country') }}"
                                                       class="form-control required">

                                                {!! $errors->first('country','<span class="help-block m-b-none">:message</span>') !!}

                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>State *</label>
                                                <input id="state" name="state" type="text" value="{{ old('state') }}"
                                                       class="form-control required">
                                                {!! $errors->first('country','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label>Zip code *</label>
                                                <input id="zipcode" name="zipcode" type="text" value="{{ old('state') }}"
                                                       class="form-control required">
                                                {!! $errors->first('country','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                        </div>
                                        <div class="form-row">

                                            <div class="form-group col-md-6">
                                                <label>City *</label>
                                                <input id="city" name="city" type="text"  value="{{ old('state') }}"
                                                       class="form-control required">
                                                {!! $errors->first('state','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label>Street *</label>
                                                <input id="street" name="street" type="text"  value="{{ old('street') }}"
                                                       class="form-control required">
                                                {!! $errors->first('street','<span class="help-block m-b-none">:message</span>') !!}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <h1>Skills</h1>
                            <fieldset>

                                <h2>Rate your skills from 0 to 10</h2>
                                <div class="row">

                                    @inject('devSkillCategoryService', '\App\Services\DevSkillCategoryService')
                                    @include('panel._layouts._partials.skills', ['skillList' => $devSkillCategoryService->listsWithOptions(), 'userQualifications' => []])

                                </div>

                            </fieldset>

                            <h1>Bank Information</h1>

                            <fieldset>

                                <div class="row">

                                    <div class="col-lg-12">

                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger dev-mod">
                                                <ul>

                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="form-row">

                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Country</th>
                                                    <th>Bank Name</th>
                                                    <th>Agency</th>
                                                    <th>Account Number</th>
                                                    <th>Document Number</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @for($i=1; $i<=2;$i++)

                                                    <tr>
                                                        <td>{{ $i }}</td>
                                                        <td><input type="text" name="bank[{{ $i }}][country]"
                                                                   class="form-control"
                                                                   value="{{ old("bank[".$i."][country]") }}"></td>
                                                        <td><input type="text" name="bank[{{ $i }}][name]"
                                                                   class="form-control"
                                                                   value="{{ old("bank[".$i."][name]") }}"></td>
                                                        <td><input type="text" name="bank[{{ $i }}][agency]"
                                                                   class="form-control"
                                                                   value="{{ old("bank[".$i."][agency]") }}"></td>
                                                        <td><input type="text" name="bank[{{ $i }}][number]" id=""
                                                                   class="form-control"
                                                                   value="{{ old("bank[".$i."][number]") }}"></td>
                                                        <td><input type="text" name="bank[{{ $i }}][cpf]" id=""
                                                                   class="form-control "
                                                                   value="{{ old("bank[".$i."][cpf]") }}"></td>
                                                        <td>
                                                            <input type="hidden" name="bank[{{ $i }}][id]" id=""
                                                                   class="form-control "
                                                                   value="{{ old("bank[".$i."][id]") }}">
                                                        </td>

                                                    </tr>

                                                @endfor

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="{{ mix('js/inspina_register_dev.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {

        $("#form").steps({
            bodyTag: "fieldset",
            onStepChanging: function (event, currentIndex, newIndex) {
                // Always allow going backward even if the current step contains invalid fields!
                if (currentIndex > newIndex) {
                    return true;
                }

                // Forbid suppressing "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age").val()) < 18) {
                    return false;
                }

                var form = $(this);

                // Clean up if user went backward before
                if (currentIndex < newIndex) {
                    // To remove error styles
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }

                // Disable validation on fields that are disabled or hidden.
                form.validate().settings.ignore = ":disabled,:hidden";

                // Start validation; Prevent going forward if false
                return form.valid();
            },
            onStepChanged: function (event, currentIndex, priorIndex) {
                // Suppress (skip) "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                    $(this).steps("next");
                }

                // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3) {
                    $(this).steps("previous");
                }
            },
            onFinishing: function (event, currentIndex) {
                var form = $(this);

                // Disable validation on fields that are disabled.
                // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                form.validate().settings.ignore = ":disabled";

                // Start validation; Prevent form submission if false
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                var form = $(this);

                // Submit form input
                form.submit();
            }
        }).validate({
            errorPlacement: function (error, element) {
                element.before(error);
            },
            rules: {
                confirm: {
                    equalTo: "#password"
                }
            }
        });
    });
</script>

</body>
</html>
