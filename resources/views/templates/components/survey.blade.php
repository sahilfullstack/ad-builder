@if(empty($value['_value']))
    {{ $default }}
@else
    <script>
        var httpRequest;

        function recordSurveyResponse(unitId, componentId, response) {
            httpRequest = new XMLHttpRequest();

            if (! httpRequest) {
                alert('Giving up :( Cannot create an XMLHTTP instance');
                return false;
            }
            httpRequest.onreadystatechange = recordedSurveyResponse;
            httpRequest.open('POST', '/units/' + unitId + '/components/' + componentId + '/responses?' + (new Date()).getTime());
            httpRequest.setRequestHeader('Content-Type', 'application/json');
            httpRequest.send(JSON.stringify({response: response}));
        }

        function recordedSurveyResponse() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    // success
                } else {
                    // error
                }
            }
        }
    </script>
    <p>@include('templates.components.text', ['value' => $value['_value'], 'default' => 'Survey'])</p>
    <div class="survey-buttons">
        <button onclick="recordSurveyResponse({{ $unit->id }}, {{ array_get($value, '_id') }}, 'yes')">Yes</button>
        <button onclick="recordSurveyResponse({{ $unit->id }}, {{ array_get($value, '_id') }}, 'no')">No</button>
    </div>
@endif