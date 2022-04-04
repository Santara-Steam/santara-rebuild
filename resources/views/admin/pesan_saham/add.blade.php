<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="{{url('pesan_saham/store')}}" method="POST"
    enctype="multipart/form-data">
    {{ csrf_field() }}
    {{-- <input type="number" name="trader_id"> --}}
    {{-- <input type="number" name="trader_id"> --}}
    <select name="trader_id" id="">
        @foreach ($user as $item)
            <option value="{{$item->trader->id}}">{{$item->trader->name}}</option>
        @endforeach
    </select>
    {{-- <input type="number" name="emiten_id"> --}}
    <select name="emiten_id" id="">
        @foreach ($emiten as $item)
            <option value="{{$item->id}}">{{$item->company_name}}</option>
        @endforeach
    </select>
    <input type="number" name="lembar_saham">
    <input type="file" name="bukti_transfer">
    <button type="submit">Ok</button>
    </form>
</body>
</html>