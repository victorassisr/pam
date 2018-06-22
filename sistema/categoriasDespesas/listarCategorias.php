<?php

require_once("conexao.php");

$sql = "SELECT * FROM categoriasDespesa ORDER BY nome";

$con = conexaoMysql();

$busca = $con->prepare($sql);

$busca->execute();

$categorias = $busca->fetchAll(PDO::FETCH_OBJ);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Categorias de despesas</title>
</head>
<body>


			<table class="table table-hover table-dark table-responsive-xm">
			  <thead>
			    <tr>
		    	 	<th scope="col">Categorias</th>
		    	</tr>
		 	  </thead>
		  	  <tbody>
		  	  	<?php foreach($categorias as $categoria){
					if($categoria->nome == "Nenhuma"){ ?>
						<p>Categoria: <?php echo $categoria->nome; ?></p>
						<hr>
				<?php } else { ?>
		    	<tr>
		      		<td><?php echo $categoria->nome; ?></td>    		
		      		<th scope="row"><a href="editarCategoria.php?id=<?php echo $categoria->id; ?>">
		      			<i class="material-icons">edit</i></a>
		      		</th>
		      		<th scope="row"><a href="excluirCategoria.php?id=<?php echo $categoria->id; ?>"class="icon-excluir" title="Deletar">
		   				<i class="material-icons">delete</i>
		   			</th>
		    	</tr>
		    	<?php }} //Fim do foreach $categorias ?>
		  	  </tbody>
			</table>
</body>
</html>