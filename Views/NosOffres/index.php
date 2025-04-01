<?php
$css = 'nosoffres'
?>
<section class="pricing-section mt-4">
    <div class="container">
        <h2 class="section-title">Choisissez votre plan</h2>
        <p class="section-subtitle">Des formules pensées pour accompagner votre croissance digitale.</p>

        <div class="pricing-cards mt-4">
            <!-- Starter -->
            <div class="pricing-card" data-plan="Starter" data-price="99€/mois" data-full="900€">
                <h3 class="plan-title">Starter</h3>
                <p class="starting-text fw-bold">À partir de</p>
                <p class="price">99€/mois</p>
                <p class="see-conditions"><a href="/ConditionTarifaire" target="_blank">*Voir conditions</a></p>
                <p class="alt-price">ou 899€ en une fois</p>
                <ul class="features">
                    <li>Site vitrine personnalisé ou e-commerce (Shopify, Wix)</li>
                    <li>Nom de domaine & hébergement inclus</li>
                    <li>Maintenance & support</li>
                </ul>
                <div class="btn-wrapper">
                    <button class="btn-subscribe" onclick="openForm(this)">Souscrire</button>
                </div>
            </div>

            <!-- Business -->
            <div class="pricing-card highlighted" data-plan="Business" data-price="199€/mois" data-full="4699€">
                <div class="badge">Le plus populaire</div>
                <h3 class="plan-title">Business</h3>
                <p class="starting-text fw-bold">À partir de</p>
                <p class="price">199€/mois</p>
                <p class="see-conditions"><a href="/ConditionTarifaire" target="_blank">*Voir conditions</a></p>
                <p class="alt-price">ou 4699€ en une fois</p>
                <ul class="features">
                    <li>Site pro ou e-commerce complet</li>
                    <li>Optimisation SEO avancée</li>
                    <li>Nom de domaine, hébergement, support & mises à jour</li>
                </ul>
                <div class="btn-wrapper">
                    <button class="btn-subscribe" onclick="openForm(this)">Souscrire</button>
                </div>
            </div>

            <!-- Premium -->
            <div class="pricing-card" data-plan="Premium" data-price="250€/mois" data-full="5499€">
                <h3 class="plan-title">Premium</h3>
                <p class="starting-text fw-bold">À partir de</p>
                <p class="price">250€/mois</p>
                <p class="see-conditions"><a href="/ConditionTarifaire" target="_blank">*Voir conditions</a></p>
                <p class="alt-price">ou 6499€ en une fois</p>
                <ul class="features">
                    <li>Site haut de gamme sur mesure</li>
                    <li>Consulting & stratégie digitale</li>
                    <li>Assistance prioritaire & SEO expert</li>
                    <li>Nom de domaine, hébergement, support & mises à jour</li>
                </ul>
                <div class="btn-wrapper">
                    <button class="btn-subscribe" onclick="openForm(this)">Souscrire</button>
                </div>
            </div>

            <!-- Sur mesure -->
            <div class="pricing-card" data-plan="Sur mesure" data-price="Sur devis" data-full="Sur devis">
                <h3 class="plan-title">Site sur mesure</h3>
                <p class="starting-text fw-bold">Projet 100% personnalisé</p>
                <p class="price">Sur devis</p>
                <p class="see-conditions"><a href="/ConditionTarifaire" target="_blank">*Voir conditions</a></p>
                <p class="alt-price">Contactez-nous pour une estimation</p>
                <ul class="features">
                    <li>Design unique selon vos besoins</li>
                    <li>Développement sur-mesure</li>
                    <li>Accompagnement personnalisé & suivi</li>
                    <li>Fonctionnalités spécifiques & intégrations avancées</li>
                </ul>
                <div class="btn-wrapper">
                    <button class="btn-subscribe" onclick="openForm(this)">Demander un devis</button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Formulaire modal -->
<div class="modal-overlay" id="modal" style="display:none;">
    <div class="modal-form">
        <h3 id="modal-title">Souscrire à une offre</h3>
        <form action="mailto:dronex.contact@gmail.com" method="POST" enctype="text/plain">
            <input type="text" name="nom" placeholder="Votre nom" required>
            <input type="email" name="email" placeholder="Votre email" required>
            <input type="hidden" id="selected-plan" name="offre">
            <input type="hidden" id="selected-price" name="abonnement">
            <input type="hidden" id="selected-full" name="paiement_unique">

            <div class="radio-group">
                <label class="radio-option">
                    <input type="radio" name="type_paiement" value="Abonnement mensuel" required>
                    Abonnement mensuel
                </label>
                <label class="radio-option">
                    <input type="radio" name="type_paiement" value="Paiement en une fois">
                    Paiement en une fois
                </label>
            </div>

            <textarea name="message" placeholder="Détails supplémentaires (facultatif)" rows="4"></textarea>
            <div class="modal-actions">
                <button type="submit">Envoyer ma demande</button>
                <button type="button" class="cancel" onclick="closeForm()">Annuler</button>
            </div>
        </form>
        <div id="error-message" class="alert alert-danger" role="alert"></div>
        <div id="success-message" class="alert alert-success" role="alert"></div>
    </div>
</div>
<?php
$script = 'offre'
?>