<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

 <title>MAPromo</title>

 <!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"/>
<!-- Styles -->
<link href="{{ asset('css/general.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">


  <!--Script -->
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="../../js/script.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js">
</script>