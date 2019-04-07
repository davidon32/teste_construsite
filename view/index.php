<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br" >

<head>
  <meta charset="UTF-8">
  <title>Cadastre-se</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
 body{
  background-color: black;
}

.form-heading { color:#fff; font-size:23px;}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 2px;
  margin: 10px auto 30px;
  max-width: 38%;
  padding: 50px 70px 70px 71px;
}

.login-form .form-group {
  margin-bottom:10px;
}
.login-form{ text-align:center;}
.forgot a {
  color: #777777;
  font-size: 14px;
  text-decoration: underline;
}
.login-form  .btn.btn-primary {
  background: #f0ad4e none repeat scroll 0 0;
  border-color: #f0ad4e;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}
.forgot {
  text-align: left; margin-bottom:30px;
}
.botto-text {
  color: #ffffff;
  font-size: 14px;
  margin: auto;
}
.login-form .btn.btn-primary.reset {
  background: #ff9900 none repeat scroll 0 0;
}
.back { text-align: left; margin-top:10px;}
.back a {color: #444444; font-size: 13px;text-decoration: none;}

</style>
<body>
  <div class="container">
    <div class="login-form">
      <div class="main-div">
        <div class="panel">
         <h3>Cadastrar Cliente</h3>
         <br>
       </div>
       <!--envia o valor dos inputs via post para o controller que ficara responsavel pelo cadastro-->
       <form id="form" action="../controller/ControllerCadastro.php" method="post">

        <div class="form-group">
          <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="email" name="email" placeholder="e-mail">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="senha" name="senha" placeholder="senha">
        </div>

        <div class="form-group">
          <input type="text" class="form-control" id="data" name="data" placeholder="Data de nascimento" maxlength="10" onkeypress="mascaraData( this, event )">
        </div>
        <!--funçao validar chamada pelo onclick-->
        <button type="submit" id="submit" class="btn btn-primary" onclick="return validar()">Enviar</button>

        <?php
        //verifica se a variavel existe,caso ela exista ele mostra a mensagem e automaticamente remove o valor dela para quando dar o refresh na pagina a mensagem sumir
        if(isset($_SESSION["mensagem"])):
          echo $_SESSION["mensagem"];
          unset($_SESSION["mensagem"]);
        endif; 
        ?>

      </form>
    </div>
  </div></div></div>

  <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="../js/jquery.mask.min.js"></script> 
  <!--funçao para definir a mascara de telefone ao input-->
  <script type="text/javascript">
    $(document).ready(function(){
    
      $("#telefone").mask("(00)0000-0000")
     
    })
    </script>
  <!--funçao para definir a mascara de data ao input-->
  <script type="text/javascript">
    function mascaraData( campo, e ){
      var kC = (document.all) ? event.keyCode : e.keyCode;
      var data = campo.value;
      
      if( kC!=8 && kC!=46 )
      {
        if( data.length==2 )
        {
          campo.value = data += '/';
        }
        else if( data.length==5 )
        {
          campo.value = data += '/';
        }
        else
          campo.value = data;
      }
    }
  </script>
  <!--funçao para validar os campos tanto por estarem vazios ou pelo tamanho-->
  <script type="text/javascript">
      function validar(){
        var nome = form.nome.value;
        var email = form.email.value;
        var senha = form.senha.value;
        var telefone = form.telefone.value;
        var data = form.data.value;
        
        if(nome == ""){
          alert('Preencha o campo nome corretamente');
          form.nome.focus();
          return false;
        }

        if(email == "" || email.indexOf('@') == -1 || email.indexOf('.') == -1){
          alert('Email Invalido');
          form.email.focus();
          return false;
        }

        if(telefone == "" || telefone.length < 13){
          alert('Preencha o campo telefone corretamente');
          form.telefone.focus();
          return false;
        }

        if(senha == "" || senha.length <= 5){
          alert('Preencha o campo senha com minimo 6 caracteres');
          form.senha.focus();
          return false;
        }

        if(data == "" || data.length < 10){
          alert('Preencha o campo data corretamente');
          form.data.focus();
          return false;
        }
        document.form.submit();
      }
    </script>
</body>

</html>
