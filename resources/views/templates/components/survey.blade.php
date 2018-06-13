@if(empty($value['_value']))
    {{ $default }}
@else
    <script>
        var httpRequest;

        function recordSurveyResponse(event, unitId, componentId, response) {
            event.target.disabled = true;
            setTimeout(() => {
                event.target.disabled = false;
            }, 60000);
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
    <p class="survey-title">@include('templates.components.text', ['value' => $value['_value']['title'], 'default' => 'Survey Title'])</p>
        @php
            $boxStyle = '';
        
            if(isset($value['_value']['box_color'])) $boxStyle .= 'border-color: ' . $value['_value']['box_color'] . ';';
        @endphp

    <div style="{{ $boxStyle }};"  class="survey-question">
        <p>@include('templates.components.text', ['value' => $value['_value']['question'], 'default' => 'Survey Question'])</p>    
        <div class="survey-buttons">
            @php
                $yesButtonStyle = '';
                $noButtonStyle = '';

                if(isset($value['_value']['yes_button_color'])) $yesButtonStyle .= 'background-color: ' . $value['_value']['yes_button_color'] . ';';
                if(isset($value['_value']['no_button_color'])) $noButtonStyle .= 'background-color: ' . $value['_value']['no_button_color'] . ';';
            @endphp
            <button style="{{ $yesButtonStyle }};" onclick="recordSurveyResponse(event, {{ $unit->id }}, {{ array_get($value, '_id') }}, 'yes')">Yes</button>
            <button style="{{ $noButtonStyle }};" onclick="recordSurveyResponse(event, {{ $unit->id }}, {{ array_get($value, '_id') }}, 'no')">No</button>
        </div>
    </div>
@endif