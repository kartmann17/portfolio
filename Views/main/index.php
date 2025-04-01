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
        <p>Faites décoller votre présence en ligne dès <span class="fw-bold">99 € / mois.</span>  Design, performance et accompagnement inclus.</p>
        <a href="/NosOffres" class="cta-button">Explorer nos offres</a>
    </div>
</section>

<!-- ========== À PROPOS (STORYTELLING + PARALLAX) ========== -->
<section class="about-parallax">
  <div class="about-parallax-overlay">
    <div class="container">
      <h2 class="section-title text-white">Des Kréyations qui laissent une empreinte</h2>
      <p class="lead text-white text-center">
        Chaque pixel, chaque ligne de code, chaque interaction que nous créons a un but : faire briller votre identité en ligne.
      </p>
      <div class="row mt-5 align-items-center text-white">
        <div class="col-md-6">
          <p>
            Chez Kréyatik Studio, nous croyons que la vraie force du digital réside dans l’humain. Nous ne vendons pas juste des sites web.
            Nous concevons des expériences, des émotions et des leviers de croissance sur-mesure.
          </p>
          <p>
            🚀 Que vous lanciez votre activité ou que vous vouliez franchir un cap, nous sommes là pour vous accompagner à chaque étape.
          </p>
        </div>
        <div class="col-md-6">
          <div class="about-highlights text-white">
            <h4 class="mb-3">Notre ADN :</h4>
            <ul class="about-list">
              <li>🌟 Créativité poussée, pensée stratégique</li>
              <li>🛠️ Technologies modernes & stables</li>
              <li>👥 Écoute active et collaboration continue</li>
              <li>💡 Propositions qui ont du sens, pas du vent</li>
              <li>🔁 Amélioration continue, même après livraison</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ========== ENGAGEMENTS (FACTUEL & STRUCTURÉ) ========== -->
<section class="engagements py-5">
  <div class="container">
    <h2 class="section-title">Pourquoi choisir Kréyatik Studio ?</h2>
    <p class="lead text-center">Plus qu’un prestataire, un véritable partenaire digital à vos côtés.</p>

    <div class="row g-4 mt-4">
      <div class="col-md-6 col-lg-4">
        <div class="engagement-box">
          <h4>📐 Design sur-mesure</h4>
          <p>Un site qui vous ressemble. Du logo aux micro-interactions, chaque élément reflète votre ADN de marque.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="engagement-box">
          <h4>📱 Responsive & rapide</h4>
          <p>Des performances optimales sur tous les écrans. Mobile first, avec un temps de chargement ultra optimisé.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="engagement-box">
          <h4>🔐 Sécurité & fiabilité</h4>
          <p>Hébergement sécurisé en France, sauvegardes automatiques, et support réactif. Dormez tranquille.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="engagement-box">
          <h4>🔍 SEO ready</h4>
          <p>Code optimisé pour le référencement naturel. Votre site est pensé pour grimper sur Google.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="engagement-box">
          <h4>🤝 Suivi humain</h4>
          <p>Un interlocuteur dédié, à l’écoute de vos besoins, du premier brief à bien après la mise en ligne.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="engagement-box">
          <h4>🎯 Résultats concrets</h4>
          <p>Un site qui convertit, qui attire, et qui sert vos objectifs business. On ne parle pas design, on parle impact.</p>
        </div>
      </div>
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