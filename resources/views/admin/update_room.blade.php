<!DOCTYPE html>
<html>
  <head> 
    <base href="/public">

    @include('admin.css')

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }

        label {
            display: inline-block;
            width: 250px;
            font-weight: 600;
            text-align: right;
            margin-right: 20px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 300px;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        }

        textarea {
            height: 80px;
            resize: vertical;
        }

        .div_deg {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .div_center {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 30px;
        }

        .btn-primary {
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: bold;
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        img {
            display: block;
            margin-left: 220px;
            margin-top: 10px;
        }
    </style>
  </head>
  <body>
    <!-- Header -->
    @include('admin.header')
    <!-- Header end-->

    <!-- Sidebar Navigation-->
    @include('admin.sidebar')
    <!-- Sidebar Navigation end-->
     
    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <div class="div_center">
                <h1>Update Room</h1>

                <form action="{{url('edit_room',$data->id)}}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <div class="div_deg">
                        <label>Room Title</label>
                        <input type="text" name="title" value="{{$data->room_title}}">
                    </div>
                    <div class="div_deg">
                        <label>Description</label>
                        <textarea name="description">{{$data->description}}</textarea>
                    </div>
                    <div class="div_deg">
                        <label>Price</label>
                        <input type="number" name="price" value="{{$data->price}}">
                    </div>
                    <div class="div_deg">
                        <label>Room Type</label>
                        <select name="type">
                            <option selected value="{{$data->room_type}}">{{$data->room_type}}</option>
                            <option value="regular">Regular</option>
                            <option value="premium">Premium</option>
                            <option value="deluxe">Deluxe</option>
                        </select>
                    </div>
                    <div class="div_deg">
                        <label>Free Wifi</label>
                        <select name="wifi">
                            <option selected value="{{$data->wifi}}">{{$data->wifi}}</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="div_deg">
                        <label>Current Image</label>
                        <img width="100" src="/room/{{$data->image}}">
                    </div>
                    <div class="div_deg">
                        <label>Upload Image</label>
                        <input type="file" name="image">
                    </div>
                    <div class="div_deg">
                        <input class="btn btn-primary" type="submit" value="Update Room">
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
    <!-- Footer -->
    @include('admin.footer')
    <!-- Footer end -->
  </body>
</html>
