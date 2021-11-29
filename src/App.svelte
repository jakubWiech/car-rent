<script>
  import Header from "./components/Header.svelte";
  import Router from "svelte-spa-router";
  import Home from "./components/Home.svelte";
  import Login from "./components/Login.svelte";
  import Register from "./components/Register.svelte";
  import Account from "./components/Account.svelte";
  import Cars from "./components/Cars.svelte";
  import Offers from "./components/Offers.svelte";
  import NotFound from "./components/NotFound.svelte";
</script>

<main>
  <Header />
  <Router
    routes={{
      "/": Home,
      "/login": Login,
      "/register": Register,
      "/account": Account,
      "/cars": Cars,
      "/offers": Offers,
      "*": NotFound,
    }}
  />
</main>
