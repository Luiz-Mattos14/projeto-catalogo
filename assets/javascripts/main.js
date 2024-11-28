import Home from "./page/home.js";
import Product from "./page/product.js";

const page = document.querySelector("body").getAttribute("data-page");
console.log(page);

console.log(
  "%cPainel Catálogo",
  'color: #f88d5b; font-size: 15px; font-family: "Verdana", sans-serif; font-weight: bold;'
);

window.addEventListener("DOMContentLoaded", () => {
  if (page == "page-home") {
    Home.init();
  }

  if (page == "page-product") {
    Product.init();
  }
});
