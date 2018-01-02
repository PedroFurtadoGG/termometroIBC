<!-- Button to open the modal login form -->

<a id="myLink" href="#" class="btn btn-2 btn-2h" onclick="document.getElementById('id01').style.display='block'">Começar o seu teste</a>

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" 
class="close" title="Close Modal">&times;</span>
  <form class="modal-content animate" action="<?php echo $url;?>/acess.php" method="POST">    
    <div class="container">
      <label><b>Nome</b></label>
      <input type="text" placeholder="Insara seu nome completo" name="nome" required>
      <label><b>Email</b></label>
      <input type="text" placeholder="Insira seu email" name="email" required>
      <button type="submit">Acessar</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar</button>
    </div>
  </form>
</div>