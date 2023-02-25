<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
// cria a pasta "uploads" se ela não existir
if (!file_exists('uploads')) {
    mkdir('uploads', 0777, true);
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Upload e Download de Arquivos</title>
</head>
<body>
	<h1>Upload e Download de Arquivos</h1>
	<?php
		if(isset($_GET['status'])) {
			if($_GET['status'] == 'success') {
				echo '<p style="color: green;">Arquivo enviado com sucesso!</p>';
			} else {
				echo '<p style="color: red;">Erro ao enviar arquivo.</p>';
			}
		}
	?>
	<h2>Upload de Arquivos</h2>
	<form action="upload.php" method="POST" enctype="multipart/form-data">
		<label for="file">Selecione o arquivo:</label>
		<input type="file" name="file" id="file"><br><br>
		<input type="submit" name="submit" value="Enviar">
	</form>
	<hr>
	<h2>Arquivos Enviados</h2>
	<ul>
		<?php
			$files = scandir("uploads");
			for ($a = 2; $a < count($files); $a++) {
				?>
				<li>
					<a href="download.php?file=<?php echo urlencode($files[$a]); ?>"><?php echo $files[$a]; ?></a>
				</li>
				<?php
			}
		?>
	</ul>
</body>
</html>

