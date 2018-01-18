<a id="myLink" href="#" class="btn btn-2 btn-2h" onclick="document.getElementById('id02').style.display='block'">Faça seu Login</a>
<style type="text/css" scoped>
  select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
  } 
  
  date {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box; 
  } 
</style>
<style type="text/css" scoped>
    
</style>
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" 
class="close" title="Close Modal">&times;</span>
  <form class="modal-content animate" action="<?php echo $url;?>/login.php" method="POST">    
    <div class="container">
      <label><b>Nome</b></label>
      <input type="text" placeholder="Insira seu nome completo" name="nome" required>
      <label><b>Email</b></label>
      <input type="text" placeholder="Insira seu email" name="email" required>
      <button type="submit">Acessar</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancelar</button>
    </div>
  </form>
</div>