// Espera a que el DOM esté completamente cargado antes de enganchar eventos
document.addEventListener('DOMContentLoaded', () => {
  const deleteModal = document.getElementById('deleteModal');
  const formDelete = document.getElementById('form-delete');
  const spanModalNewsTitle = document.getElementById('modal-news-title');

  // Si falta alguno de los elementos, salimos
  if (!deleteModal || !formDelete || !spanModalNewsTitle) return;

  // Cuando se abre el modal, rellenamos el título y la acción
  deleteModal.addEventListener('show.bs.modal', event => {
    const btn = event.relatedTarget;
    formDelete.action = btn?.dataset?.href || '';
    spanModalNewsTitle.textContent = btn?.dataset?.title || '';
  });
});
