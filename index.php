<?php
	$success = "";
	$error = "";
	$captchaFail = "";
	$site = "6Lfdp-saAAAAAPanojRF3ADVuR6SxnPH3AK6YwY6";
	if(isset($_POST["submit"])) {
		$secret = "6Lfdp-saAAAAAPZ-0VHc0MuIRyMPFLpBEc4Iy8Gm";
		$response = $_POST["g-recaptcha-response"];
		$remoteIP = $_SERVER["REMOTE_ADDR"];
		$url = "https://www.google.com/recaptcha/api/siteverify?secret=";
		$url .= $secret . "&response=" . $response . "&remoteip=" . $remoteIP;
		$verify = json_decode(file_get_contents($url), true);
		if (isset($verify["success"]) && $verify["success"]) {
			if ($_POST) {
				if (!$_POST["name"]) {
					$error .= "Nome obrigatório!<br>";
				}
				if (!$_POST["email"]) {
					$error .= "E-mail obrigatório!<br>";
				}
				if ($_POST["email"] && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
					$error .= "E-mail inválido!<br>";
				}
				if (!$_POST["message"]) {
					$error .= "Mensagem obrigatória!<br>";
				}
				if (!isset($_POST["checkbox"])) {
					$error .= "Aceite dos termos obrigatório!<br>";
				}
				if ($error != "") {
					$error = "<p class='error'><strong>Ops, algo deu errado...</strong><br>" . $error .	"</p>";
				}
				else {
						$success = "<p class='success'><strong>Mensagem enviada com sucesso!</strong><br>Em breve entraremos em contato.</p>";
					}
				}
			}
		if ($response == null) {
			$captchaFail = "<p class='error'><strong>CAPTCHA falhou!</strong><br>Tente novamente...</p>";
		}
	}
?>

<!DOCTYPE html>

<html lang="pt-br">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
		      content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="stylesheet" href="css/main.css">
		<script src="https://www.google.com/recaptcha/api.js" async
		        defer></script>
		<script src="js/main.js" defer></script>
		<title>reCAPTCHA</title>
	</head>

	<body>
		<header>
			<h1>
				reCAPTCHA
			</h1>
		</header>
		<main>
			<h2>
				Envie seu recado
			</h2>
			<div class="result">
				<?php
					echo $success;
					echo $error;
					echo $captchaFail;
				?>
			</div>
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				<label for="name">Nome</label>
				<div class="input-field name before">
					<input type="text" name="name" id="name" placeholder="Nome"
					       autocomplete="off">
				</div>
				<label for="email">E-mail</label>
				<div class="input-field email before">
					<input type="text" name="email" id="email"
					       placeholder="E-mail" autocomplete="off">
				</div>
				<label for="message">Mensagem</label>
				<div class="input-field message before">
					<textarea name="message" id="message" rows="4"
					          placeholder="Mensagem" autocomplete="off"></textarea>
				</div>
				<div class="terms">
					<input type="checkbox" name="checkbox" id="terms">
					<p>
						<label for="terms">Aceito os termos de uso deste
							formulário.</label>
						<a href="#">Saiba mais</a>
					</p>
					<p class="terms-details">
						Solicitamos nome e e-mail para entrarmos em contato com
						você. Mas fique tranquilo, não armazenamos e não
						disponibilizamos seus dados para terceiros.
						<small>
							<a href="#">Fechar</a>
						</small>
					</p>
				</div>
				<div class="g-recaptcha"
				     data-sitekey="<?php echo $site; ?>"></div>
				<input type="submit" name="submit" id="submit" value="Enviar">
			</form>
		</main>
	</body>

</html>
