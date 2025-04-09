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
	
	$product_id = 10;
	
	$sql = "SELECT * FROM perfumy WHERE ID = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("i", $product_id);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if ($result->num_rows > 0) {
		$product = $result->fetch_assoc();
		$product_name = $product['Marka'] . ' ' . $product['Rodzaj'] . ' ' . $product['Typ'] . ' ' . $product['Pojemnosc'] . 'ml';
		$product_price = number_format($product['Cena'], 2, ',', '');
		$product_image = $product['Zdjecie'];
		$product_description = $product['Opis'] ?? 'Brak opisu';
		$product_breadcrumb = $product['Marka'] . ' ' . $product['Rodzaj'];
	} else {
		header("Location: ../error.html");
		exit();
	}
	
	$stmt->close();
	$conn->close();
?>
<!DOCTYPE html>
<html lang = "pl-PL">
    <head>
        <title>Perfumy.com.pl</title>
        <meta charset = "UTF-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1" />
        <link rel = "stylesheet" href = "../style.css"/>
        <link rel = "preconnect" href = "https://fonts.googleapis.com">
        <link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin>
        <link href = "https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel = "stylesheet">
		<link rel = "icon" type = "image/x-icon" href = "../../img/favicon.ico">
    </head>
    <body>
        <header id = "manHeader">
            <div id = "logo">
                <a href = "../index.html">Perfumy.com.pl</a>
            </div>
            <nav>
                <a href = "../about.html" class = "navigator">O nas</a>
                <a href = "../help.html" class = "navigator">Pomoc</a>
                <a href = "../cart.php" class = "navigator">Koszyk</a>
            </nav>
        </header>
        <section>
            <p id = "bread"><a href = "../index.html">Strona główna</a> > <a href = "../man.php">Perfumy damskie</a> > <?= htmlspecialchars($product_breadcrumb) ?></p>
            <h1 id = "titl"><?= htmlspecialchars($product_name) ?></h1>
            <hr id = "split"/>
            <div class = "descProduct" id = "slider">
                <img class = "productPhoto" src = "<?='../'.htmlspecialchars($product_image) ?>"/>
            </div>
            <div class = "descProduct">
                <p id = "price">Cena: <?= htmlspecialchars($product_price) ?> zł</p>
                <hr/>
				<form method = "POST" action = "../cart.php">
                <div id = "addToCart">
                    <div class = "halfAddToCart">
                        <p id = "amount">Ilość</p>
                        <input type = "number" name = "quantity" placeholder = "1" min = "1" max = "9" required/>
                    </div>
                    <div class = "halfAddToCart">
                        <p id = "disableAmount">Ilość</p>
                        <button type = "submit">Dodaj do koszyka</button>
                    </div>
					<input type = "hidden" name = "product_id" value = <?= htmlspecialchars($product_id) ?>/>
                </div>
				</form>
                <hr/>
                <p id = "desct">Opis</p>
                <p id = "desc"><?= htmlspecialchars($product_description) ?></p>
            </div>
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