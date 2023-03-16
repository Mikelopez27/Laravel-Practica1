<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="background-color:#111827;">
    <div style="text-align: center; margin-top:100px;">
        
        <h2 style="color:white">INGRESA TU CODIGO DE LA APP DEL CEL</h2>
        @if(Session::has('alert-danger'))
        <div class="" style="">
            {{ Session::get('alert-danger') }}
        </div>
        @endif
        <form method="POST" action="{{route('codigoweb')}}">
            @csrf
            {{-- <x-input-label for="code" :value="__('code')"/> --}}
            <div>
                <x-text-input id="code" :value="__('')" name="code" type="text" class="" style="" required autofocus autocomplete="name" />
            </div><br>
            <div class="">
                <button type="submit" style="border-radius:20px;">Verificar Código</button>
            </div>
        </form>
    </div>
</body>

</html>