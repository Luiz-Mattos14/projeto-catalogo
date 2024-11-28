import { formatMoneyTable } from "../common/utilities.js";

const Home = {
  setPDF: function () {},

  init: function () {
    console.log("Entrou no JAVASCRIPT HOME");

    this.setPDF();
    formatMoneyTable();
  },
};

export default Home;
