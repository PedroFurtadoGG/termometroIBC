<a id="myLink" href="#" class="btn btn-2 btn-2h" onclick="document.getElementById('id01').style.display='block'">Começar o seu teste</a>
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
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" 
class="close" title="Close Modal">&times;</span>
  <form class="modal-content animate" action="<?php echo $url;?>/acess.php" method="POST">    
    <div class="container">
      <label><b>Nome</b></label>
      <input type="text" placeholder="Insira seu nome completo" name="nome" required>
      <label><b>Email</b></label>
      <input type="text" placeholder="Insira seu email" name="email" required>
      <label><b>Local(cidade)</b></label>
      <input type="text" placeholder="Insira sua cidade" name="email" required>
      <label><b>Idade</b></label>
      <input type="text" placeholder="Insira sua idade" name="email" required>
      <label><b>Escolaridade</b></label>
      <select id="escolaridade">
        <option>--SELECIONE--</option>
        <option value="ensino-fundamental">Ensino fundamental</option>
        <option value="ensino-fundamental-incompleto">Ensino fundamental incompleto</option>
        <option value="ensino-medio">Ensino médio</option>
        <option value="ensino-medio-incompleto">Ensino médio incompleto</option>
        <option value="ensino-superior">Ensino superior</option>
        <option value="ensino-superior-incompleto">Ensino superior incompleto</option>
      </select>
      <label><b>Sexo</b></label>
      <select id="sexo" style="">
        <option>--SELECIONE--</option>
        <option value="M">Masculino</option>
        <option value="F">Feminino</option>
        <option value="O">Outros</option>
      </select>
      <button type="submit">Acessar</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancelar</button>
    </div>
  </form>
</div>

Nome  Email Idade Sexo  Local(cidade)     Escolaridade