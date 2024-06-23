<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>G-User</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css'><link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="content.css">

</head>
<body>

  

<nav>
  <section class="table__header">
    <div class="input-group">
    <input id="searchbar"  type="text"
name="search" placeholder="Search offre.." >

        <img src="img/search.png">
    </div>
  
  <div class="action">
    <div class="profile" onclick="menuToggle(event);">
      <img src="img/c.png">
    </div>
    <div class="menu">
      <h3>RH<br /><span>candidat</span></h3>
      <img src="icons/user.png" width="30px" height="30px"><a class="a" href="profile.php"> Acceuill</a><br><br>
      <img src="icons/log-out.png" width="30px" height="30px"><a class="a" href="../php/logout.php">Déconnection</a>
    </div>
</div>

<script>
  function menuToggle() {
    const toggleMenu = document.querySelector(".menu");
    toggleMenu.classList.toggle("active");
  }
</script>

  
  </nav>
  
  
  <div class="action">
    <div class="profile" onclick="menuToggle(event);">
      <img src="img/c.png">
    </div>
    <div class="menu">
      <h3>RH<br /><span>candidat</span></h3>
      <img src="icons/user.png" width="30px" height="30px"><a class="a" href="profile.php"> Acceuill</a><br><br>
      <img src="icons/log-out.png" width="30px" height="30px"><a class="a" href="../php/logout.php">Déconnection</a>
    </div>
</div>

<script>
  function menuToggle() {
    const toggleMenu = document.querySelector(".menu");
    toggleMenu.classList.toggle("active");
  }
</script>

  
  </nav>
  

  

<div id="nav-bar">
  <input id="nav-toggle" type="checkbox"/>
  <div id="nav-header"><a id="nav-title" href="index.html" >G<i class="fab fa-codepen"></i>USER</a>
    <label for="nav-toggle"><span id="nav-toggle-burger"></span></label>
    <hr/>
  </div>
  <div id="nav-content">
    <div class="nav-button"><i class="fas fa-plus"></i><span>Ajoute User</span></div>
    
  
    <div id="nav-content-highlight"></div>
  </div>
  

</div>
<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "gestion_user";

$conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if ($conn->connect_error) {
    ?>
    <script>
        alert("La connexion à la base de données a échoué : <?php echo $conn->connect_error; ?>");
    </script>
    <?php
} else {
    // Sélectionner tous les clients de la table Client_Fourniseur
    $query_clients = "SELECT Nom ,Telephone ,Prenom
    FROM employer" ;
    $result_clients = $conn->query($query_clients);
}

    ?>




 
  <div class="user">LIST DES UTILISATEUR</div>
  <div class="grid">  
  <?php
      if ($result_clients->num_rows > 0) {
        while ($row = $result_clients->fetch_assoc()) {
            ?>
    <div class="item">
      <div class="item-content">
     <span class="no">Nom</span>
     <span class="no1"><?php echo $row['Nom']; ?></span>
     <span class="quantite">Prenom</span>
     <span class="quantite1"><?php echo $row['Prenom']; ?></span>
     <span class="categorie">tel</span>
     <span class="categorie1 prix1"><?php echo $row['Telephone']; ?></span>
      <span><a href="" class="modifier">Modifier</a></span>
      <span><a href="" class="p">Historique</a></span>
      <span><a href="" class="d">suprimer</a></span>
      
    </div>
    </div>

    <?php
        }
    } else {
        ?>
        <script>
            alert("Aucun employe trouvé dans la base de données.");
        </script>
        <?php
    }
    ?>
    
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/muuri@0.9.5/dist/muuri.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/web-animations-js@2.3.2/web-animations.min.js"></script>

<script>
  var grid = new Muuri('.grid', {
   dragEnabled: true,
   dragHandle: '.item-content', 
   layout: {
     fillGaps: true,
     horizontal: false,
   },
   layoutDuration: 500
 });
 function resizeGrid() {
   grid.layout();
 }
 const navdd = document.querySelector('.barre-plant');
 const lien=document.querySelector('.lien-ret')

window.addEventListener('scroll', () => {
const scrollY = window.scrollY;

if (scrollY > 30) {
 navdd.style.backgroundColor = '#24075baa';
 navdd.style.color = '#dcdde1';
 
 lien.style.backgroundColor='#dcdde1'
 
} else {

 lien.style.backgroundColor='transparent'
 navdd.style.backgroundColor = 'transparent';
 navdd.style.color = 'black';
}

// Ajoutez une transition aux propriétés CSS modifiées
navdd.style.transition = '0.01s';
});



 var filterButton1 = document.querySelector('#searchbar');

filterButton1.addEventListener('keyup', function () {

const titre = document.querySelector('#searchbar');

if (grid && titre) {
 var items = grid.getItems();
 var searchTerm = this.value.toLowerCase().replace(/\s/g, ''); 

 for (var i = 0; i < items.length; i++) {
   var titleElement = items[i].getElement().querySelector('.no1');
   var categorie = items[i].getElement().querySelector('.categorie1');
   var prix = items[i].getElement().querySelector('.prix1');
   var quantite = items[i].getElement().querySelector('.quantite1');
   if (titleElement) {
     var title = titleElement.textContent.toLowerCase();
     var categorie1 = categorie.textContent.toLowerCase();
     var prix1 = prix.textContent.toLowerCase();
     var  quantite1 = quantite.textContent.toLowerCase();

     if (title.includes(searchTerm) || categorie1.includes(searchTerm) || prix1.includes(searchTerm) || quantite1.includes(searchTerm)) {
       items[i].getElement().setAttribute('data-category', 'Refusé');
     } else {
       items[i].getElement().setAttribute('data-category', '');
     }
   }
   

  
 }
 
 


 grid.filter('[data-category="Refusé"]');


 

 grid.layout();
}
});



</script>
  
</body>
</html>
