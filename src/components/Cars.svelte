<script>
  import { onMount } from "svelte";
  import Car from "./Car.svelte";
  if (!sessionStorage.getItem("logged")) {
    window.location.href = "/#/login";
  }
  let allCars = [];
  let cars = [];
  let engines = [];
  let models = [];
  let fuels = [];
  onMount(() => {
    fetch("http://www.carsrentserver.fl/cars.php", {
      method: "GET",
    })
      .then((res) => res.json())
      .then((res) => {
        let tempCars = res;
        tempCars.sort((a, b) => {
          return a.power - b.power;
        });
        cars = tempCars;
        allCars = res;
        let enginesp = ["ALL"];
        let modelsp = ["ALL"];
        let fuelsp = ["ALL"];
        res.forEach((car) => {
          if (!enginesp.includes(car.code.toUpperCase())) {
            enginesp.push(car.code.toUpperCase());
          }
          if (!modelsp.includes(car.model)) {
            modelsp.push(car.model);
          }
          if (!fuelsp.includes(car.type)) {
            fuelsp.push(car.type);
          }
          engines = enginesp;
          models = modelsp;
          fuels = fuelsp;
        });
      });
    document.getElementById("filters").addEventListener("change", function () {
      let filters = new FormData(this);
      let selectedEngine = filters.get("engineCode");
      let selectedModel = filters.get("carModel");
      let selectedFuel = filters.get("fuelType");
      let selectedSort = filters.get("sorting");
      let sortDirection = filters.get("sort-direction");
      let newCars = [];
      allCars.forEach((car) => {
        if (selectedEngine != "all") {
          if (selectedModel != "ALL") {
            if (selectedFuel != "ALL") {
              if (
                car.code == selectedEngine &&
                car.model == selectedModel &&
                car.type == selectedFuel
              ) {
                newCars.push(car);
              }
            } else {
              if (car.code == selectedEngine && car.model == selectedModel) {
                newCars.push(car);
              }
            }
          } else {
            if (selectedFuel != "ALL") {
              if (car.code == selectedEngine && car.type == selectedFuel) {
                newCars.push(car);
              }
            } else {
              if (car.code == selectedEngine) {
                newCars.push(car);
              }
            }
          }
        } else {
          if (selectedModel != "ALL") {
            if (selectedFuel != "ALL") {
              if (car.model == selectedModel && car.type == selectedFuel) {
                newCars.push(car);
              }
            } else {
              if (car.model == selectedModel) {
                newCars.push(car);
              }
            }
          } else {
            if (selectedFuel != "ALL") {
              if (car.type == selectedFuel) {
                newCars.push(car);
              }
            } else {
              newCars.push(car);
            }
          }
        }
        newCars.sort((a, b) => {
          if (sortDirection == "asc") {
            return parseInt(a[selectedSort]) - parseInt(b[selectedSort]);
          } else if (sortDirection == "desc") {
            return parseInt(b[selectedSort]) - parseInt(a[selectedSort]);
          }
        });
        cars = newCars;
      });
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
      <form id="filters">
        <div class="form-column">
          <p>Filtering</p>
          <span
            >Engine: <select name="engineCode">
              {#each engines as engine}
                <option value={engine.toLowerCase()}>{engine}</option>
              {/each}
            </select></span
          >
          <span
            >Model: <select name="carModel">
              {#each models as model}
                <option value={model}>{model}</option>
              {/each}
            </select></span
          >
          <span
            >Fuel: <select name="fuelType">
              {#each fuels as fuel}
                <option value={fuel}>{fuel}</option>
              {/each}
            </select>
          </span>
        </div>
        <div class="form-column">
          <p>Sorting</p>
          <select name="sorting">
            <option value="power">Power</option>
            <option value="capacity">Engine capacity</option>
            <option value="year">Production year</option>
            <option value="mileage">Mileage</option>
          </select>
          <div class="column">
            <span>
              <input type="radio" value="asc" checked name="sort-direction" /> Ascending</span
            >
            <span>
              <input type="radio" value="desc" name="sort-direction" /> Descending</span
            >
          </div>
        </div>
      </form>
      <div class="content-cars">
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
  </div>
</main>

<style>
  .content {
    padding-top: 200px;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow-x: hidden;
    background-color: #343434;
  }

  #filters {
    align-self: flex-start;
    margin-left: 150px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    color: white;
    font-size: 20px;
  }

  .form-column {
    display: flex;
    flex-direction: column;
    margin: 20px;
  }

  .content-cars {
    width: 100%;
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: center;
    min-height: calc(100vh - 300px);
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

  @media only screen and (max-width: 1100px) {
    .content-cars {
      flex-direction: column;
    }
  }
</style>
