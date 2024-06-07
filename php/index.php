<?php
$con = new mysqli("localhost", "root", "", "komentarze");


if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $comment = $_POST['comment'];

    if (!empty($username) && !empty($comment)) {
        $stmt = $con->prepare('INSERT INTO komentarz (nazwa_użytkownika, tekst) VALUES (?, ?)');
        $stmt->bind_param('ss', $username, $comment);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$res = $con->query("SELECT * FROM `komentarze`");

require_once 'blocked_words_list.php';

?>
<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Portugalia</title>
		<link rel="stylesheet" href="../css/style.css" />
	</head>
	<body>
		<header>
			<div class="foto">
				<img src="../assets/porto.jpg" alt="" class="foto1" />
				<div class="tytul">
					<h1>Porto - Portugalia</h1>
					<br />
					<h2>
						Lorem ipsum dolor sit amet consectetur adipisicing elit.
						Accusantium aliquam aut veritatis sunt nostrum adipisci
					</h2>
				</div>
			</div>
		</header>
		<main>
			<div class="tlo">
				<section class="sekcja1">
					<div class="tytul_section1">
						<h1>Informacje o mieście</h1>
					</div>
					<div class="info_parent">
						<div class="info1">
							<div class="tytul2">
								<h1>Lorem ipsum dolor sit amet</h1>
							</div>
							<div class="information">
								<div>
									<h2>1</h2>
									<p>Sequi nesciunt cumque</p>
								</div>
								<div>
									<h2>2</h2>
									<p>
										consectetur adipisicing elit. Id beatae
									</p>
								</div>
								<div>
									<h2>3</h2>
									<p>dolor molestias? Eius dolorem</p>
								</div>
								<div style="display: flex;justify-content: flex-start;margin-left: 200px;">
									<h2>4</h2>
									<p>facere sequi repellat sunt!</p>
								</div>
							</div>
						</div>
						<div class="info2">
							<div class="text">
								<h1>
									Lorem ipsum dolor sit amet consectetur
									adipisicing elit. Sequi nesciunt cumque eum
									ducimus quam dolor nostrum
								</h1>
							</div>
							<div class="information2">
								<div class="tak">
									<h2>✔</h2>
									<p>
										Lorem ipsum dolor sit amet consectetur
										adipisicing elit. Magni velit voluptates
										fuga nam. Quibusdam, fugiat. Molestiae,
										consequuntur? Laudantium corporis,
										laborum dolore inventore neque nisi
										mollitia sit, consequatur ex,
										perferendis animi.
									</p>
								</div>
								<div class="tak">
									<h2>✔</h2>
									<p>
										Lorem ipsum dolor sit amet consectetur
										adipisicing elit. Magni velit voluptates
										fuga nam. Quibusdam, fugiat. Molestiae,
										consequuntur? Laudantium corporis,
										laborum dolore inventore neque nisi
										mollitia sit, consequatur ex,
										perferendis animi.
									</p>
								</div>
								<div class="tak">
									<h2>✔</h2>
									<p>
										Lorem ipsum dolor sit amet consectetur
										adipisicing elit. Magni velit voluptates
										fuga nam. Quibusdam, fugiat. Molestiae,
										consequuntur? Laudantium corporis,
										laborum dolore inventore neque nisi
										mollitia sit, consequatur ex,
										perferendis animi.
									</p>
								</div>
								<div class="tak">
									<h2>✔</h2>
									<p>
										Lorem ipsum dolor sit amet consectetur
										adipisicing elit. Magni velit voluptates
										fuga nam. Quibusdam, fugiat. Molestiae,
										consequuntur? Laudantium corporis,
										laborum dolore inventore neque nisi
										mollitia sit, consequatur ex,
										perferendis animi.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="info2"></div>
			</div>
		</main>
		<footer>
			<div class="komentarze">
				<div class="comment-title">
					<h1>Napisz komentarz <br> wasze zdanie się dla nas liczy!</h1>
				</div>
				<div class="comment-box">
					<form action="create.php" method="post">
						<input type="text" name="tresc" id="" placeholder="Treść komentarza" class="tresc">
						<input type="text" name="nazwa" id="" placeholder="Twoja nazwa" class="nazwa">
						<input type="submit" class="wyslij">
					</form>
				</div>
			</div>
			<div class="komentarz">
				<?php 
			 while ($row = mysqli_fetch_assoc($res)) {

				if (isset($row['nazwa_uzytkownika']) && isset($row['tekst'])) {
					$username = htmlspecialchars($row['nazwa_uzytkownika']);
					$comment = nl2br(htmlspecialchars($row['tekst']));
				} else {
					$username = 'Nieznany użytkownik';
					$comment = 'Brak treści komentarza';
				}

				foreach ($blocked_words as $word) {
					$pattern = '/\b' . preg_quote($word, '/') . '\b/i';
					$replacement = str_repeat('*', mb_strlen($word));
					$comment = preg_replace($pattern, $replacement, $comment);
					$username = preg_replace($pattern, $replacement, $username);
				}
		
				echo '<div class="comment">
						  <div class="userdata">
							  <p class="nickname">' . $username . '</p>
						  </div>
						  <div class="tresc_komentarza">
							  <p>' . $comment . '</p>
						  </div>
					  </div>
					  <hr style="border-width: 2px">';
			}
			$con->close();
		?></div>
		
		</footer>
	</body>
</html>
