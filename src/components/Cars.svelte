<script>
  import { onMount } from "svelte";
  import Car from "./Car.svelte";
  if (!sessionStorage.getItem("logged")) {
    window.location.href = "/#/login";
  }
  let cars = [];
  onMount(() => {
    fetch("http://www.carsrentserver.fl/cars.php", {
      method: "GET",
    })
      .then((res) => res.json())
      .then((res) => {
        cars = res;
      });
  });
</script>

<main>
  <div class="main">
    <div class="top-section">
      <div class="red" />
      <div class="shape" />
    </div>
    <div class="content">
      {#each cars as car}
        <Car
          brand={car.brand}
          model={car.model}
          description={car.description}
          year={car.year}
          mileage={car.mileage}
          image={car.image}
          engine={car.capacity +
            "ccm " +
            car.code +
            " " +
            car.type +
            " " +
            car.power +
            "km"}
        />
      {/each}
    </div>
  </div>
</main>

<style>
  body {
    background-color: #343434;
  }

  .content {
    position: absolute;
    width: 100%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    overflow-x: hidden;
    background-color: #343434;
  }

  main {
    background-color: #343434;
    overflow-x: hidden;
  }

  .main {
    background-color: #343434;
    width: 100vw;
    overflow-x: hidden;
  }
</style>
