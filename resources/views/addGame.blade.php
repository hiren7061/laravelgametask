@extends('layout')

@section('content')
    <h3 class="text-center">Add Game Details</h3>
    <div id="jsoneditor" style="margin: 0;height: 100%;overflow: hidden;"></div>
    <br>
    <a href="/game" class="btn btn-primary">Back to Dashboard</a>
    <input type="submit" value="Add Game" style="float: right;" onclick="addJSON();" class="btn btn-warning">
@endsection

@section('js')
    <script>
        // Create The Editor
        var container = document.getElementById("jsoneditor");
        var options = {};

        var editor = new JSONEditor(container, options);

        var errors = editor.validate({
            value: {
                to: "test"
            }
        });

        // Set Json Data To Editor
        var json = {
            "GameName": "", "WinRate": "", "Credits": ""
        };
        editor.set(json);

        // Get Json Data From Editor And Add It To Database
        function addJSON() {
            var jsonData = editor.get();
            var validationError = 0;
            if (jsonData.Credits == '' || jsonData.GameName == '' || jsonData.WinRate == '') {
                validationError = 1;
            }

            // Ajax Call If Not Any Error Found
            if (validationError == 0) {
                $.ajax({
                    type: 'POST',
                    url: "/game",
                    data: jsonData,
                    dataType: "text",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (resultData) {
                        swal({
                            title: "Success!",
                            text: "New Game Detail Added Successfully",
                            type: "success",
                            showConfirmButton: true
                        }, function (isConfirm) {
                            if (isConfirm) {
                                window.location.href = "/game";
                            }
                        });
                    }
                });
            }else{
                swal({
                    title: "Error!",
                    text: "All Fields Are Mandatory",
                    type: "error",
                    showConfirmButton: true
                });
            }
        }
    </script>
@endsection
