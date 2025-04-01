function openForm(button) {
  const card = button.closest('.pricing-card');
  document.getElementById('modal').style.display = 'flex';
  document.getElementById('selected-plan').value = card.getAttribute('data-plan');
  document.getElementById('selected-price').value = card.getAttribute('data-price');
  document.getElementById('selected-full').value = card.getAttribute('data-full');
  document.getElementById('modal-title').innerText = `Souscrire à l'offre ${card.getAttribute('data-plan')}`;
}

function closeForm() {
  document.getElementById('modal').style.display = 'none';
}