document.addEventListener('DOMContentLoaded', () => {
  const stickyButton = document.querySelector('[data-kc-scroll-to-add]');
  const addToCartForm = document.querySelector('form.cart');

  if (!stickyButton || !addToCartForm) {
    return;
  }

  stickyButton.addEventListener('click', () => {
    addToCartForm.scrollIntoView({ behavior: 'smooth', block: 'center' });
    const firstActionable = addToCartForm.querySelector('button, input, select');
    if (firstActionable) {
      firstActionable.focus({ preventScroll: true });
    }
  });
});
