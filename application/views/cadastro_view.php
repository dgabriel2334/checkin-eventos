
<!DOCTYPE html>
<html lang="pt-br" >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, max-scale=1.0">
        <!-- Importações -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="./js/cadastro.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/modal-sucess.css">
        <!-- Título da página -->
        <title>Check-in</title>
        

    </head>
    <body>


    <div id="sucesso" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div id='status' class="modal-header-sucess justify-content-center">
                    <div class="icon-box">
                        <i class="material-icons">&#xE7F2;</i>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <h4>Checkin efetuado</h4>
                    <img class="imagem" id='qrcode'src="" alt="">	
                    <p>Tire um print desta tela e se identifique com seu QR-Code.</p>
                    <p>Aproveite o evento.</p>
                    <button id='sair' class="btn btn-success" data-dismiss="modal"><span>Sair</span> <i class="material-icons">&#xE5C8;</i></button>
                </div>
            </div>
        </div>
    </div> 

    <div id="erro" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div id='status' class="modal-header-error justify-content-center">
                    <div class="icon-box">
                        <i class="material-icons">&#xE811;</i>
                    </div>
                </div>
                <div class="modal-body text-center">
                    <h4>Houve um erro!</h4>	
                    <p>Parece que algum campo obrigatório não foi preenchido.</p>
                    <button class="btn btn-error" data-dismiss="modal"><span>Voltar</span> </button>
                </div>
            </div>
        </div>
    </div> 




    <div class="container">
        <div class="card">
            <div class="card-image">	
                <h2 class="card-heading">
                    Check-in
                    <small>Vamos fazer seu check-in?</small>
                </h2>
            </div>
            <form class="card-form">
                <div class="input">
                    <input type="text" id="nome_sobrenome" class="input-field" required/>
                    <label class="input-label">Nome e sobrenome*</label>
                </div>
                <div class="input">
                    <input type="text" id="email" class="input-field" placeholder="" required/>
                    <label class="input-label">Email*</label>
                </div>
                <div class="input">
                    <input type="text" id="telefone" onkeydown="return mascaraTelefone(event)"  class="input-field" required/>
                    <label class="input-label">Telefone*</label>
                </div>
                <div class="input">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdown_profissoes" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                        Profissão*
                    </button>
                    <div id="menu" class="dropdown-menu" aria-labelledby="dropdown_profissoes">
                        <form class="px-4 py-2">
                            <input type="search" id="pesquisa_profissao" class="form-control" placeholder="Pesquise sua profissão" autofocus="autofocus">
                        </form>
                        <div id="menuItems"></div>
                        <div id="vazio" class="dropdown-header">Sem resultados</div>
                    </div>
                </div>
                <div class="action">
                    <button id="cadastrar" type='submit' class="action-button" class="trigger-btn" data-toggle="modal">Check-in</button>
                </div>
            </form>
            <div class="card-info">
                <p>Ao fazer o check-in você concorda com nossos termos e confições<a href="#">Termos e condições.</a></p>
            </div>
        </div>
    </div>
    <!-- partial -->

    </body>
</html>
