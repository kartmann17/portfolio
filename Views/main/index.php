<?php
$css = 'main'
?>
<section class="hero">
    <div class="hero-content">
        <h1 class="fancy-title">
            <div class="word" id="word-kreyatik"></div>
            <div class="word" id="word-studio"></div>
        </h1>
        <p>Votre lumière merite d'être en ligne.</p>
        <p>Faites décoller votre présence en ligne dès 80 € / mois. Design, performance et accompagnement inclus.</p>
        <a href="#projects" class="cta-button">Explorer nos réalisations</a>
    </div>
</section>

<section id="projects" class="projects">
    <div class="container">
        <h2>Réalisations Récentes</h2>

        <div class="project">
            <h3>Nom du Projet 1</h3>
            <p>Un site e-commerce que j'ai réalisé avec HTML, CSS, et JavaScript. Ce site permet aux utilisateurs d'acheter des produits en ligne.</p>
            <a href="lien-vers-le-projet" target="_blank">Voir le projet</a>
            <img src="image-du-projet1.jpg" alt="Image du Projet 1">
        </div>

        <div class="project">
            <h3>Nom du Projet 2</h3>
            <p>Une application web développée avec React.js. Elle permet de gérer des tâches et de suivre les progrès.</p>
            <a href="lien-vers-le-projet" target="_blank">Voir le projet</a>
            <img src="image-du-projet2.jpg" alt="Image du Projet 2">
        </div>
    </div>
</section>

<section id="contact" class="contact-section">
    <div class="container contact-container">
        <h2 class="contact-title">Contactez-nous</h2>

        <div id="form-message" style="display: none; margin-top: 20px; color: #00A86B; font-weight: bold;">
            Merci ! Votre message a bien été envoyé.
        </div>

        <form action="/contact" method="post" class="contact-form">
            <input type="text" name="name" placeholder="Votre nom" required class="contact-input">
            <input type="email" name="email" placeholder="Votre email" required class="contact-input">
            <input type="text" name="subject" placeholder="Objet" required class="contact-input">
            <textarea name="message" placeholder="Votre message" rows="6" required class="contact-textarea"></textarea>
            <button type="submit" class="contact-button">Envoyer</button>
        </form>
    </div>
</section>

<?php
$script = 'acceuil'
?>
<?php
$script = 'Titreacceuil'
?>