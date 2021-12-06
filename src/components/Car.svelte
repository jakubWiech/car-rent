<script>
  import { onMount } from "svelte";
  export let id;
  export let brand;
  export let model;
  export let description;
  export let year;
  export let mileage;
  export let image;
  export let engine;
  export let price = null;
  export let status = null;
  import Rent from "./stores/rentstore";
  onMount(() => {
    document.getElementById("rentBt").addEventListener("click", function () {
      let reservData = new FormData();
      reservData.append("start", $Rent.dateStart);
      reservData.append("end", $Rent.dateEnd);
      reservData.append("car", id);
      reservData.append("user", sessionStorage.getItem("id"));
      reservData.append("price", price);
      fetch("http://www.carsrentserver.fl/rent.php", {
        method: "POST",
        body: reservData,
      })
        .then((res) => res.json())
        .then((res) => console.log(res));
    });
  });
</script>

<main>
  <div class="main">
    <img class="carimg" src={"/images" + image + ".jpg"} alt="" />
    <h1 class="brandmodel">{brand + " " + model}</h1>
    <p clasa="engine">Engine: {engine}</p>
    <p class="desc">{description}</p>
    <p class="year">Year: {year}</p>
    <p class="mileage">Mileage: {mileage} km</p>
    {#if price != null}
      <p class="price">Price: {price} PLN</p>
    {/if}
    {#if status != null}
      {#if status == "available"}
        <p class="status">Status: <span style="color: green">{status}</span></p>
      {/if}
      {#if status == "not available"}
        <p class="status">Status: <span style="color: red">{status}</span></p>
      {/if}
      {#if status == "waiting"}
        <p class="status">
          Status: <span style="color: yellow">{status}</span>
        </p>
      {/if}
    {/if}
    {#if status == "available" || status == "waiting"}
      <button class="rentBt" id="rentBt">Rent car!</button>
    {/if}
  </div>
</main>

<style>
  .main {
    margin: 0 150px 150px 150px;
    width: calc(50vw - 410px);
    background-color: #ffffff99;
    padding: 50px;
    border-radius: 30px;
    position: relative;
    overflow-x: hidden;
  }

  .main > h1 {
    font-size: 40px;
  }

  .main > p {
    font-size: 20px;
  }

  .carimg {
    height: 300px;
    border-radius: 10px;
    width: 100%;
    object-fit: cover;
    object-position: center;
  }

  .rentBt {
    background-color: #a62d37;
    color: white;
    padding: 20px;
    border: unset;
    font-size: 30px;
    float: right;
    border-radius: 5px;
    cursor: pointer;
  }

  .rentBt:hover {
    background-color: #db3b48;
  }
  @media only screen and (max-width: 1550px) {
    .main {
      margin: 0 50px 150px 50px;
      width: calc(50vw - 210px);
    }
  }

  @media only screen and (max-width: 1100px) {
    .main {
      margin: 0 50px 150px 50px;
      width: calc(100vw - 210px);
    }
  }
</style>
