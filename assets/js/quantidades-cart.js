document.addEventListener('DOMContentLoaded', function() {
    const plusButtons = document.querySelectorAll('.cart__count--plus');
    const minusButtons = document.querySelectorAll('.cart__count--minum');
    const totalProductPrices = document.querySelectorAll('.total-product-price');
    const totalPriceElement = document.querySelector('.product__card--totalPrice');

    function updateTotalPriceSoma(button) {
        const quantityElement = button.parentElement.querySelector('.cart__count--price');
        const currentQuantity = parseInt(quantityElement.textContent);
        const priceElement = button.parentElement.nextElementSibling;
        const precoUnitario = parseFloat(priceElement.textContent);
        const totalElement = button.parentElement.parentElement.querySelector('.total-product-price');

        const totalValue = (precoUnitario * currentQuantity).toFixed(2);
        totalElement.textContent = totalValue;
        updateTotalPrice();
    }

    function updateTotalPriceSub(button) {
        const quantityElement = button.parentElement.querySelector('.cart__count--price');
        const currentQuantity = parseInt(quantityElement.textContent);
        const priceElement = button.parentElement.nextElementSibling;
        const precoUnitario = parseFloat(priceElement.textContent);
        const totalElement = button.parentElement.parentElement.querySelector('.total-product-price');

        const totalValue = (precoUnitario * currentQuantity).toFixed(2);
        totalElement.textContent = totalValue;
        updateTotalPrice();
    }

    function updateQuantity(nomeProduto, operacao) {
        // Chame o arquivo PHP responsável por atualizar a quantidade no banco de dados usando AJAX
        const xhr = new XMLHttpRequest();
        const url = 'atualizar_quantidade.php';
        const params = `nomeProduto=${nomeProduto}&operacao=${operacao}`;

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status !== 200) {
                    console.error('Erro ao atualizar a quantidade no banco de dados.');
                }
            }
        };

        xhr.send(params);
    }

    function updateTotalPrice() {
        let totalPrice = 0;

        totalProductPrices.forEach(priceElement => {
            const precoUnitario = parseFloat(priceElement.textContent);
            totalPrice += precoUnitario;
        });

        totalPriceElement.textContent = totalPrice.toFixed(2);
    }

    plusButtons.forEach(button => {
        button.addEventListener('click', function() {
            const quantityElement = button.parentElement.querySelector('.cart__count--price');
            const currentQuantity = parseInt(quantityElement.textContent);
            quantityElement.textContent = currentQuantity + 1;

            updateTotalPriceSoma(button);

            const nomeProduto = button.parentElement.parentElement.querySelector('p:first-child').textContent;
            updateQuantity(nomeProduto, 'incrementar');
        });
    });

    minusButtons.forEach(button => {
        button.addEventListener('click', function() {
            const quantityElement = button.parentElement.querySelector('.cart__count--price');
            const currentQuantity = parseInt(quantityElement.textContent);

            if (currentQuantity > 0) {
                quantityElement.textContent = currentQuantity - 1;

                updateTotalPriceSub(button);

                const nomeProduto = button.parentElement.parentElement.querySelector('p:first-child').textContent;
                updateQuantity(nomeProduto, 'decrementar');
            }
        });
    });

    updateTotalPrice();
});