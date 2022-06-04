<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ConfigCat </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <style>
        html, body {
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
        }

        .wrapper {
            text-align: left;
            padding: 40px;
        }
    </style>
</head>
<body>
    <div class="wrapper">

      @if($isMyAwesomeFeatureEnabled == 1)

        <h1>SWITCH IS ON</h1>
        <img height="400px" width="600px" src="{{ asset('/img/dashboard.png') }}"/>

        @endif

        @if($isMyAwesomeFeatureEnabled == 0)

        <h1>SWITCH IS OFF</h1>
       

        @endif
       
       


        
        
        
    </div>
</body>



<script type="text/javascript">
    $("#checkAwesome").click(function(){
        fetchAwesomeEnabled();
    });

    $("#checkProofOfConcept").click(function(){
        fetchPOCEnabled();
    });

    function fetchAwesomeEnabled() {
        $.ajax({
            type:'GET',
            url:'api/config/awesome',
            success:function(data){
                $("#isAwesomeEnabled").text(data);
            }
        });
    }

    function fetchPOCEnabled() {
        const email = $("#userName").val();

        $.ajax({
            type:'GET',
            url:'api/config/poc',
            data:{ email:email },
            success:function(data){
                $("#isPOCEnabled").text(data);
            }
        });
    }

</script>

</html>