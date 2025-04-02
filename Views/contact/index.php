<section class="py-5 bg-light mt-5">
    <div class="container">
        <h1 class="text-center mb-4">Parlons de votre projet</h1>
        <p class="text-center mb-5">Remplissez le formulaire ci-dessous et nous vous répondrons rapidement.</p>

        <form class="bg-white p-4 shadow rounded" action="/SendEmail/emailClient" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Objet</label>
                <input type="text" class="form-control" id="subject" name="object_message" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
        <div>
            <div id="error-message" class="alert alert-danger" role="alert"></div>
            <div id="success-message" class="alert alert-success" role="alert"></div>
        </div>
    </div>
</section>