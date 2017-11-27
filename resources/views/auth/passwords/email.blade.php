
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" charset="utf-8"> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sistema de permisos</title>
<script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
<link href="{{asset('bootstrap/bootstrap.min.css')}}" rel="stylesheet"/>    
<link href="{{asset('bootstrap/bootstrap-theme.css')}}" rel="stylesheet"/>
<link href="fonts/OleoScript-Regular.ttf" rel="stylesheet" />
    
</head>
<style>
@font-face{
font-family:Fuentechida;
src:url(fonts/OleoScript-Regular.ttf);
}
    body{
        background-image: url("{{asset('imagenes/railway-station-1363771_1920.jpg')}}");
        background-size:cover;
        background-repeat: no-repeat;
        background-attachment:fixed;
    }
    .formulario{
        transition: 2s;
        margin-top: 50px;
        width: 30%;
        box-shadow: 0px 0px 40px rgba(1,201,241 ,1),0px 0px 80px rgba(1,201,241 ,1);
    }

    .formulario:hover{
        transition: .8s;
        background-color: rgba(0,0,0,.5);
    }


.logo{
        height: 100px;
        margin-top: 5px;
    }
    
 .espaciado{
        margin-top: 5px;
    }

    fieldset{
        transition: 2s;
        margin-bottom: 50px;
        border-color: #01C9F1;
        border-style: groove;
        border-width: 5px;
        border-radius: 20px;
    }
    
    a{
        color: white;
    }
 label{
        color: white;
    }
   h1,h2,h3,h4{
        
        color:white;
        text-align: center;
        font-family: fuentechida;
    }
  
    .Input{
        transition: .8s;
        background-color: rgba(0,0,0,.5);
        color: white;
        border-color:#006;
    border-bottom-color:white;
        border-bottom-style:groove;
    border-left:none;
    border-right:none;
    border-top:none;
        border-width: 4px;
        
    }

    .Input:hover{
        transition: .8s;
    background-color:rgba(55,71,79 ,.5);
    box-shadow:inset;
        border-bottom-color:#01C9F1;
    }
    
    .Input:focus{
        transition: .8s;
    border-bottom-color:#01C9F1;
    }



    @media screen and (max-width:750px) {
        
        .logo{
            height: 50px;
        }
        .formulario{
            transition: 2s;
            width: 95%;
            margin-top: 10px;
        }
    }
</style>


<body>
    <div class="container formulario">
         <div class="row">
               <div class="col-xs-4 col-xs-offset-4  ">
                                                <h1 class="center-block">PUCESE</h1>
                <img src="{{asset('imagenes/ejecutivo_logo.png')}}" class="logo center-block">
                </div>
            
        </div>
         <div class=" espaciado">
                
                </div>
        <div class="row">
           @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
            @endif

            <fieldset class="col-xs-10 col-xs-offset-1">
            

                <legend class="hidden-xs">
                    <h3>Restablecer Contraseña</h3>
                </legend>
                @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                @endif

                <form role="form" class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                      {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-xs-12" for="usuario"><h4>Direcion Email:</h4></label>
                 <div class="col-xs-10 col-xs-offset-1">
                        
                    <input id="email" type="email" name="email" class="form-control Input" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@+(['p']['u']['c']['e']['s']['e'])+([.]['e']['d']['u'][.]['e']['c'])" required title="ejemplo@pucese.edu.ec" placeholder="ejemplo@pucese.edu.ec">
                           
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                        </div>
                    
                    </div>

                    <div class="form-group">
                    <button type="submit" class="btn btn-danger center-block">Restablecer contraseña</button>
               
                     </div>
                 
                </form>
            </fieldset>
        
        </div>
    </div>
    

</body>
</html>
