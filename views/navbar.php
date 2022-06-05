
<nav class="Lana" id='Lana'>
    <div>
        <a class="akam" onclick="url()" href="/kam/">
            <img src="img/kamlogo1.png" class="logokam">
        </a>
    </div>
    <ul class="nav-list" id="navi-list">
        <li class="list-item"><a href="/kam/Texte-Public">Textes Publics</a></li>
        <?php
        if (isset($_SESSION['pseudo'])) {
            echo '<li class="list-item"><a href="/kam/Mes-videos">Mes vidéos</a></li>';
            echo '<li class="list-item"><a href="/kam/Mes-textes">Mes textes</a></li>';
            echo '<li class="list-item"><a style="color: rgb(189, 166, 93);" href="/kam/Mon-Compte">'.$_SESSION['pseudo'].'</a></li>';
            echo '<li class="list-item"><a href="/kam/Deconnexion">Deconnexion</a></li>';
        }else{
            echo '<li class="list-item">
            <a href="/kam/Inscris-toi">Crée ton compte</a>
        </li>
        <li class="list-item">
            <a href="/kam/Connexion">Connecte-toi</a>
        </li>';
        }
        ?>



    </ul>
    <div class="menu" id="buttonbigo">
        <div class="menu-line">

        </div>
        <div class="menu-line">

        </div>
        <div class="menu-line">

        </div>
    </div>
</nav>

<script>
    const toggleButton = document.getElementById('buttonbigo');
    const naviList = document.getElementById('navi-list');



    toggleButton.addEventListener('click', () => {
        naviList.classList.toggle('active');
    })
</script>
