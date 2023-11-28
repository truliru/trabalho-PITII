// Carrossel das promoções

let isDragging = false;
let startX, scrollLeft, startScroll;

const slider = document.querySelector('.home__cupcake--slider');

slider.addEventListener('mousedown', (e) => {
  if (slider.scrollWidth > slider.clientWidth) {
    isDragging = true;
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
    startScroll = slider.scrollLeft;
    slider.style.scrollBehavior = 'unset';
  }
});

slider.addEventListener('mouseleave', () => {
  isDragging = false;
});

slider.addEventListener('mouseup', () => {
  isDragging = false;
  slider.style.scrollBehavior = 'smooth';
});

slider.addEventListener('mousemove', (e) => {
  if (!isDragging) return;

  const x = e.pageX - slider.offsetLeft;
  const walk = (x - startX);
  const targetScroll = startScroll - walk;

  slider.scrollLeft = targetScroll;
});


// Search categoria
document.addEventListener('DOMContentLoaded', function() {
  const sabores = document.querySelectorAll('.sabor');
  const cupcakeSlider = document.querySelector('.home__cupcake--slider');
  const cupcakes = document.querySelectorAll('.home__cupcake--container');
  const inputSearch = document.querySelector('.home__search input');

  function filtrarSabores(event) {
      const saborSelecionado = event.target.dataset.sabor;

      cupcakes.forEach(function(cupcake) {
          const classeCupcake = cupcake.getAttribute('class');
          if (classeCupcake.includes(saborSelecionado)) {
              cupcake.classList.remove('d-none');
          } else {
              cupcake.classList.add('d-none');
          }
      });
  }

  function filtrarPorPesquisa() {
      const termoPesquisa = inputSearch.value.trim().toLowerCase();

      cupcakes.forEach(function(cupcake) {
          if (cupcake.textContent.toLowerCase().includes(termoPesquisa)) {
              cupcake.classList.remove('d-none');
          } else {
              cupcake.classList.add('d-none');
          }
      });
  }

  sabores.forEach(function(sabor) {
      sabor.addEventListener('click', filtrarSabores);
  });

  inputSearch.addEventListener('input', filtrarPorPesquisa);
});


// Evento de adição ao carrinho de compras"
const cupcakeItems = document.querySelectorAll('.home__cupcake--container');

// Função para lidar com o clique em um item
function handleClick(event) {
  const item = event.currentTarget;
  const preco = item.dataset.preco;
  const nome = item.dataset.nome;

  const confirmAdd = window.confirm('Deseja adicionar este item ao carrinho?');

  if (confirmAdd) {
    console.log('Enviando para o carrinho:', nome, preco); // Verificar se os dados estão corretos
    addToCart({ nome, preco });
  }
}

cupcakeItems.forEach(item => {
  item.addEventListener('click', handleClick);
});

function addToCart(item) {
  const xhr = new XMLHttpRequest();
  const url = './add-to-cart.php';
  const params = `nome=${item.nome}&preco=${item.preco}`;

  console.log('Parâmetros:', params); // Verificar a string de parâmetros

  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        console.log('Item adicionado ao carrinho:', item.nome, item.preco);
      } else {
        console.error('Ocorreu um erro ao adicionar o item ao carrinho.');
      }
    }
  };

  xhr.send(params);
}