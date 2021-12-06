<script>
  import { onMount } from "svelte";
  export let brand;
  export let model;
  export let description;
  export let year;
  export let mileage;
  export let image;
  export let engine;
</script>

<main>
  <div class="main">
    <img class="carimg" src={"/images" + image + ".jpg"} alt="" />
    <h1 class="brandmodel">{brand + " " + model}</h1>
    <p clasa="engine">Silnik: {engine}</p>
    <p class="desc">{description}</p>
    <p class="year">Rocznik: {year}</p>
    <p class="mileage">Przebieg: {mileage} km</p>
    <button class="rentBt">Rent car!</button>
  </div>
</main>

<style>
  .main {
    margin: 150px 150px 150px 150px;
    width: calc(50vw - 408px);
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
  }
</style>
