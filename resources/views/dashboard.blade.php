@extends('layout')

@section('content')
    <div class="col-md-12">
        <h2 class="text-center text-capitalize">Game Details Dashboard</h2>
    </div>
    <div class="col-md-12">
        <a href="/game/create" class="btn btn-success" style="float: right; margin: 10px;">Add New Game Detail</a>
    </div>
    <table class="table text-center table-striped table-bordered" id="table">
        <thead class="thead-light">
        <tr>
            <th class="text-center">Game Data</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $row)
            <tr>
                <td>{{$row->game_details}}</td>
                <td><a href="/game/{{$row->id}}/edit" class="btn btn-warning">Edit</a></td>
                <td><input type="submit" onclick="deleteGame({{$row->id}})" value="Delete" class="btn btn-danger" ></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
        function deleteGame(gameId){
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to revert this action !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, I am Sure !",
                    cancelButtonText: "No, I am Not Sure !",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: '/game/'+gameId,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(result) {
                                swal({
                                    title: "Deleted!",
                                    text: "Game Detail Deleted Successfully",
                                    type: "success",
                                    showConfirmButton: true
                                }, function (isConfirm) {
                                    if (isConfirm) {
                                        location.reload();
                                    }
                                });
                            }
                        });
                    }
                }
            );
        }
    </script>
@endsection
