const colorOptions = document.querySelectorAll('.color-option');
colorOptions.forEach(option => option.addEventListener('click', function() {
  colorOptions.forEach(otherOption => otherOption.classList.remove('active'));
  this.classList.add('active');
  // Update product image or other elements based on selected color
}));

const amountButtons = document.querySelectorAll('.amount_button');
const amountInput = document.querySelector('.amount-selector input');

amountButtons.forEach(button => button.addEventListener('click', function() {
  if (button.classList.contains('minus')) {
    amountInput.value = Math.max(1, amountInput.value - 1);
  } else {
    amountInput.value++;
  }
}));