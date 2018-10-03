@extends('layout')

@section('content')
    <h3 class="text-center">Edit Game Details</h3>
    <div id="jsoneditor" style="margin: 0; height: 100%;overflow: hidden;"></div>
    <br>
    <a href="/game" class="btn btn-primary">Back to Dashboard</a>
    <input type="hidden" value="{{$record['id'] }}" name="id" id="gameId">
    <input type="submit" value="Update" style="float: right;;" onclick="updateJSON();" class="btn btn-warning">
@endsection

@section('js')
    <script>
        // Create The Editor
        var container = document.getElementById("jsoneditor");
        var options = {};
        var editor = new JSONEditor(container, options);

        var jsonData = '<?php echo $record->game_details; ?>';
        jsonData = JSON.parse(jsonData);
        // Set Json Data To Editor
        var json = jsonData;
        editor.set(json);

        // Get Json Data From Editor And Add It To Database
        function updateJSON() {
            var jsonData = editor.get();
            var gameId = $('#gameId').val();
            var validationError = 0;
            if (jsonData.Credits == '' || jsonData.GameName == '' || jsonData.WinRate == '') {
                validationError = 1;
            }

            // Ajax call If No Error Found
            if (validationError == 0) {
                var data = {"id": gameId, "json": jsonData};
                $.ajax({
                    type: 'PUT',
                    url: "/game/" + gameId,
                    data: data,
                    dataType: "text",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (resultData) {
                        swal({
                            title: "Success!",
                            text: "Game Detail Updated Successfully",
                            type: "success",
                            showConfirmButton: true
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location.href = "/game";
                            }
                        });
                    }
                });
            } else {
                swal({
                    title: "Error in Data!",
                    text: "All Fields Are Mandatory",
                    type: "error",
                    showConfirmButton: true
                });
            }
        }
    </script>
@endsection
