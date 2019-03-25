<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/custom.css" type="text/css" >
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">

    <title>TotalVoice App</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-md-3">	            
                <form class="form-container">
                    <img src="assets/images/cell.png">
                    <h2 class="my-4">TotalVoice API Calls</h2>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Introduza o token de acesso" id="accessToken">
                    </div>                 
                    <div class="form-group">
                        <select class="form-control" id="apiCalls">
                            <option selected value="-1">Selecione um Endpoint</option>                   
                            <option value="status">Status (GET)</option>
                            <option value="bina">Bina (POST)</option>
                            <option value="saldo">Saldo (GET)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control sr-only" placeholder="Número de telefone celular" id="cellNumber" pattern="^[0-9]*$">
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-info btn-lg btn-block">Fazer petição</button>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="9" readonly resize="false" id='textResult'></textarea>
                    </div> 
                    <div class="form-group">
                        <button type="button" class="btn btn-danger btn-lg btn-block">Restabelecer</button>
                    </div>                
                </form>
            </div>
        </div>
    </div> 

    <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS and finally Custom.js -->
  
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>    
    <script src="assets/custom.js" ></script>
  </body>
</html>