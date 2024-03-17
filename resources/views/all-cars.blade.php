<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>crud System ajax in lareval</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">crud System ajax in lareval <button class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addModal">add new</button></div>
            <div class="card-body">
                <table class="table table-sm table-borderd table-striped">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Car Name</th>
                            <th>manufacture Year</th>
                            <th>Engine Capacity</th>
                            <th>Fuel Type</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- pass data from database here -->
                        @if(count($all_cars) > 0)
                        @foreach($all_cars as $car)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $car->name }}</td>
                            <td>{{ $car->manufacture_year }}</td>
                            <td>{{ $car->engine_capacity }}</td>
                            <td>{{ $car->fuel_type }}</td>
                            <td><button class="btn btn-primary btn-sm editBtn" data-id="{{$car->id}}" data-name="{{$car->name}}" data-year="{{$car->manufacture_year}}" data-engine="{{$car->engine_capacity}}" data-fuel="{{$car->fuel_type}}" data-bs-toggle="modal" data-bs-target="#updateModal">Edit</button></td>
                            <td><button id="deleteBtn" class="btn btn-danger btn-sm deleteBtn" data-id="{{$car->id}}" data-bs-toggle="modal" data-bs-target="#deleteModal">delete</button></td>

                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5">No Data Found</td>
                        </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- edit car model -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Cars</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCarForm">
                        @csrf
                        <input type="hidden" id="car_id" name="car_id">
                        <div class="form-group">
                            <label for="">Car name</label>
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="">manufacture year</label>
                            <input type="number" name="manufacture_year" class="form-control" id="manufacture_year">
                        </div>
                        <div class="form-group">
                            <label for="">Engine capacity</label>
                            <input type="text" name="engine_capacity" class="form-control" id="engine_capacity">
                        </div>

                        <div class="form-group">
                            <label for="">fuel type</label>
                            <input type="text" name="fuel_type" class="form-control" id="fuel_type">
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary editButton">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- MODAL -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ADD Cars</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCarForm">
                        <div class="form-group">
                            <label for="">Car name</label>
                            <input type="text" name="name" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">manufacture year</label>
                            <input type="number" name="manufacture_year" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">Engine capacity</label>
                            <input type="text" name="engine_capacity" class="form-control" id="">
                        </div>

                        <div class="form-group">
                            <label for="">fuel type</label>
                            <input type="text" name="fuel_type" class="form-control" id="">
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary addBtn">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- delete model -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ADD Cars</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete
                    <h6 class="car_name"></h6>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger deleteButton">Delete</button>
                </div>
            </div>
        </div>




        <script>
            $(document).ready(function() {
                var car_id;
                $('#addCarForm').submit(function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        url: '{{route("addCar")}}',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('.addBtn').prop('disabled', true);
                        },
                        complete: function() {
                            $('.addBtn').prop('disabled', false);
                        },
                        success: function(data) {

                            if (data.success == true) {
                                $('addCarForm').modal('hide');
                                location.reload();
                                alert(data.msg);
                                var reloadInterval = 5000;

                                function reloadPage() {
                                    location.reload(true);
                                }
                                var intervalId = setInterval(reloadPage, reloadInterval);

                            } else if (data.success == false) {

                                alert(data.msg);
                            } else {
                                alert(data.msg);
                            }
                        }
                    });
                    return false;
                });

                $('.deleteBtn').on('click', function() {
                    car_id = $(this).attr('data-id');
                    // console.log(car_id);
                });

                $('.deleteButton').on('click', function() {
                    console.log(car_id);
                    var url = "{{route('deleteCar',':car_id')}}";
                    url = url.replace(':car_id', car_id);
                    $.ajax({
                        url: url,
                        type: 'GET',
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('.deleteButton').prop('disabled', true);
                        },
                        complete: function() {
                            $('.deleteButton').prop('disabled', false);
                        },
                        success: function(data) {

                            if (data.success == true) {
                                $('#deleteModal').modal('hide');
                                location.reload();
                                alert(data.msg);
                                var reloadInterval = 5000;

                                function reloadPage() {
                                    location.reload(true);
                                }
                                var intervalId = setInterval(reloadPage, reloadInterval);

                            } else if (data.success == false) {

                                alert(data.msg);
                            } else {
                                alert(data.msg);
                            }
                        }
                    });

                });
            });


            $('.editBtn').on('click', function() {
                var car_id = $(this).attr('data-id');
                var car_name = $(this).attr('data-name');
                var year = $(this).attr('data-year');
                var capacity = $(this).attr('data-engine');
                var fuel = $(this).attr('data-fuel');

                // display values in inputs
                $('#name').val(car_name);
                $('#manufacture_year').val(year);
                $('#engine_capacity').val(capacity);
                $('#fuel_type').val(fuel);
                $('#car_id').val(car_id);


                $('#editCarForm').submit(function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        url: '{{route("editCar")}}',
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            $('.editButton').prop('disabled', true);
                        },
                        complete: function() {
                            $('.editButton').prop('disabled', false);
                        },
                        success: function(data) {

                            if (data.success == true) {
                                $('#updateModal').modal('hide');
                                location.reload();
                                alert(data.msg);
                                var reloadInterval = 5000;

                                function reloadPage() {
                                    location.reload(true);
                                }
                                var intervalId = setInterval(reloadPage, reloadInterval);

                            } else if (data.success == false) {

                                alert(data.msg);
                            } else {
                                alert(data.msg);
                            }
                        }
                    });

                });

            });
        </script>

</body>

</html>