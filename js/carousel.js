$(document).ready(function() {
    $('.carousel').slick({
      slidesToShow: 3, // Quantidade de cards visíveis de uma vez
      slidesToScroll: 1, // Quantidade de cards a rolar
      prevArrow: $('.prev'), // Botão de navegação para anterior
      nextArrow: $('.next'), // Botão de navegação para próximo
      responsive: [{
        breakpoint: 768, // Breakpoint para telas menores
        settings: {
          slidesToShow: 1 // Reduzir a quantidade de cards visíveis em telas menores
        }
      }]
    });
  });