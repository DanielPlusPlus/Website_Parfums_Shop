<!DOCTYPE html>
<html lang = "pl-PL">
    <head>
        <title>Perfumy.com.pl</title>
        <meta charset = "UTF-8" />
        <meta name = "viewport" content = "width=device-width, initial-scale=1" />
        <link rel = "stylesheet" href = "style.css"/>
        <link rel = "preconnect" href = "https://fonts.googleapis.com">
        <link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin>
        <link href = "https://fonts.googleapis.com/css2?family=Jockey+One&display=swap" rel = "stylesheet">
		<link rel = "icon" type = "image/x-icon" href = "../img/favicon.ico">
    </head>
    <body>
        <header id = "womanHeader">
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
			<h1 id = "titl">Perfumy damskie</h1>
			<p id = "filtr"><span style = "cursor: pointer" onclick = "filter()">Filtruj produkty:</span></p>
			<script>
				function filter() {
					document.getElementById("filters").classList.toggle('show');
				}
			</script>
			<div id = "filters" class = "hidden">
				<form method = "POST" action = "">
					<p>Cena od:<input type = "number" name = "cena_od" placeholder = "0" min = "0" max = "9999"/> do <input type = "number" name = "cena_do" placeholder = "9999" min = "0" max = "9999"/></p>
					<p>Pojemność:<input type = "number" name = "pojemnosc_od" placeholder = "0" min = "0" max = "500"/> do <input type = "number" name = "pojemnosc_do" placeholder = "500" min = "0" max = "500"/></p>
					<p>Marka:
						<select name = "marka">
							<option value = "">Wszystkie</option>
								<?php
									$servername = "127.0.0.1";
									$username = "root";
									$password = "";
									$dbname = "perfumycompl";
									
									$conn = new mysqli($servername, $username, $password, $dbname);
									if ($conn->connect_error) {
										die("Connection failed: " . $conn->connect_error);
									}
									
									$sql = "SELECT DISTINCT Marka FROM perfumy ORDER BY Marka";
									$result = $conn->query($sql);
									
									if ($result->num_rows > 0) {
										while($row = $result->fetch_assoc()) {
											$marka = htmlspecialchars($row["Marka"]);
											echo '<option value = "' . $marka . '">' . $marka . '</option>';
										}
									}
									$conn->close();
								?>
						</select>
						Typ:
						<select name = "typ">
							<option value = "">Wszystkie</option>
							<option value = "EDP">EDP</option>
							<option value = "EDT">EDT</option>
						</select>
					</p>
					<p>Sortowanie po cenie:
                    <select name = "sortowanie">
						<option value = "relevance">Przypadkowe</option>
                        <option value = "ASC">Rosnąco</option>
                        <option value = "DESC">Malejąco</option>
                    </select>
					</p>
					<p><input type = "submit" value = "Filtruj"/></p>
				</form>
			</div>
			<hr id = "split"/>
			<div id = "products">
				<?php
					$servername = "127.0.0.1";
					$username = "root";
					$password = "";
					$dbname = "perfumycompl";

					$conn = new mysqli($servername, $username, $password, $dbname);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					
					$sql = "SELECT * FROM perfumy WHERE Plec = 'K'";
					$types = "";
					$values = [];

					$filters = [];
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						
						$cena_od = !empty($_POST['cena_od']) ? floatval($_POST['cena_od']) : 0;
						$cena_do = !empty($_POST['cena_do']) ? floatval($_POST['cena_do']) : 9999;
						$filters[] = "Cena BETWEEN ? AND ?";
						$types .= "dd";
						$values[] = $cena_od;
						$values[] = $cena_do;
						
						$pojemnosc_od = !empty($_POST['pojemnosc_od']) ? intval($_POST['pojemnosc_od']) : 0;
						$pojemnosc_do = !empty($_POST['pojemnosc_do']) ? intval($_POST['pojemnosc_do']) : 500;
						$filters[] = "Pojemnosc BETWEEN ? AND ?";
						$types .= "ii";
						$values[] = $pojemnosc_od;
						$values[] = $pojemnosc_do;
						
						if (!empty($_POST['marka'])) {
							$filters[] = "Marka = ?";
							$types .= "s";
							$values[] = $_POST['marka'];
						}
						
						if (!empty($_POST['typ'])) {
							$filters[] = "Typ = ?";
							$types .= "s";
							$values[] = $_POST['typ'];
						}
						
						if (!empty($filters)) {
							$sql .= " AND " . implode(" AND ", $filters);
						}
						
						if (!empty($_POST['sortowanie']) && $_POST['sortowanie'] != 'relevance') {
							$sortowanie = $_POST['sortowanie'];
							$sql .= " ORDER BY Cena $sortowanie";
						}
					}
					
					$stmt = $conn->prepare($sql);
					if (!empty($values)) {
						$stmt->bind_param($types, ...$values);
					}
					$stmt->execute();
					$result = $stmt->get_result();
					
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$cena = htmlspecialchars(str_replace('.', ',', $row["Cena"]));
							$strona = htmlspecialchars($row["Strona"]);
							$zdjecie = htmlspecialchars($row["Zdjecie"]);
							$marka = htmlspecialchars($row["Marka"]);
							$rodzaj = htmlspecialchars($row["Rodzaj"]);
							$typ = htmlspecialchars($row["Typ"]);
							$pojemnosc = htmlspecialchars($row["Pojemnosc"]);
							
							echo '<a href = "' . $strona . '">';
							echo '<div class = "product">';
							echo '<img src = "' . $zdjecie . '"/>';
							echo '<h2>' . $marka . ' ' . $rodzaj . ' ' . $typ . ' ' . $pojemnosc . 'ml</h2>';
							echo '<h2>' . $cena . ' zł</h2>';
							echo '</div>';
							echo '</a>';
						}
					} else {
						echo "<p class = 'info'>Brak wyników</p>";
					}
					
					$stmt->close();
					$conn->close();
				?>
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