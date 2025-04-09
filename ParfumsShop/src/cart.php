<?php
	session_start();

	$servername = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "perfumycompl";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$product_id = intval($_POST['product_id']);
		$quantity = intval($_POST['quantity']);

		$sql = "SELECT * FROM perfumy WHERE ID = ?";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $product_id);
		$stmt->execute();
		$result = $stmt->get_result();

		if ($result->num_rows > 0) {
			$product = $result->fetch_assoc();
			
			if (isset($_SESSION['cart'][$product_id])) {
				$_SESSION['cart'][$product_id]['quantity'] += $quantity;
			} else {
				$_SESSION['cart'][$product_id] = [
					'name' => $product['Marka'] . ' ' . $product['Rodzaj'] . ' ' . $product['Typ'] . ' ' . $product['Pojemnosc'] . 'ml',
					'price' => $product['Cena'],
					'image' => $product['Zdjecie'],
					'page' => $product['Strona'],
					'quantity' => $quantity
				];
			}
		}

		$stmt->close();
	}

	$conn->close();
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <title>Perfumy.com.pl</title>
    <meta charset="UTF-8" />
    <meta name = "viewport" content = "width=device-width, initial-scale=1" />
    <link rel = "stylesheet" href = "style.css"/>
    <link rel = "preconnect" href = "https://fonts.googleapis.com">
    <link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin>
    <link href = "https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel = "stylesheet">
	<link rel = "icon" type = "image/x-icon" href = "../img/favicon.ico">
</head>
<body>
    <header id = "indexHeader">
        <div id = "logo">
            <a href = "index.html">Perfumy.com.pl</a>
        </div>
        <nav>
            <a href = "about.html" class = "navigator">O nas</a>
            <a href = "help.html" class = "navigator">Pomoc</a>
            <a href = "cart.php" class = "navigator">Koszyk</a>
        </nav>
    </header>
    <section>
        <h1 id = "catH1">Koszyk</h1>
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                <div class = "cartProduct">
					<a href = <?= htmlspecialchars($item['page']) ?>>
						<div class = "cartProcuctIMGName">
							<img src = "<?= htmlspecialchars($item['image']) ?>"/>
							<p class = "cartProductt"><?= htmlspecialchars($item['name']) ?></p>
						</div>
					</a>
                    <div class = "cartProductPrice">
                        <p class = "cartDesc">Ilość: <?= htmlspecialchars($item['quantity']) ?></p>
                        <p class = "cartDesc">Cena: <?= htmlspecialchars(str_replace('.', ',', $item['price'])) ?> zł</p>
                        <p class = "cartDescDelete"><a href = "remove.php?id=<?= $id ?>">Usuń produkt z koszyka</a></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div id = "endSection">
                <div id = "summaryPrice">
                    <?php
                    $total = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $total += $item['price'] * $item['quantity'];
                    }
                    echo "Całkowity koszt: " . number_format($total, 2) . " zł";
                    ?>
                </div>
                <div id = "finish">
                    <a href = "error.html" >Przejdź do realizacji ></a>
                </div>
            </div>
        <?php else: ?>
            <p class = "info">Brak produktów</p>
        <?php endif; ?>
    </section>
    <footer>
        <div class = "halfFoot">
            <div>
                <h2 class = "footH2">Kontakt:</h2>
                <p class = "footText">Perfumeria online Perfumy.com.pl</p>
                <p class = "footText">KIELCE, UL.WARSZAWSKA 26</p>
                <p class = "footText">NIP 739-111-41-41</p>
                <p class = "footText">25-313 KIELCE</p>
                <p class = "footText">Polska</p>
            </div>
        </div>
        <div class = "halfFoot">
            <div>
                <h2 class = "footH2">Mapa:</h2>
                <p class = "footText">
                    <iframe frameborder = "0" style = "border:0;" allowfullscreen = "" aria-hidden = "false" tabindex = "0" src = "https://www.google.com/maps/embed/v1/place?q=Warszawska+26,+25-312+Kielce&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                </p>
            </div>
        </div>
        <div id = "foot">
            <div>
                <h2 class = "footH2">Informacje prawne:</h2>
                <p id = "footText">Właścicielem sklepu internetowego Perfumy.com.pl jest Daniel Cieślak, 25-313 KIELCE, ul. Warszawska 26 o numerze NIP: 7391114141, REGON: 571288151</p>
            </div>
        </div>
    </footer>
</body>
</html>
