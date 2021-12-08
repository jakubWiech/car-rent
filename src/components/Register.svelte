<script>
  import { onMount } from "svelte";
  import PdfViewer from "svelte-pdf";
  if (sessionStorage.getItem("logged")) {
    window.location.href = "/#/account";
  }
  let errors = false;
  let empty = false;
  let loginLength = false;
  let regDeclined = false;
  let userExists = false;
  onMount(() => {
    document
      .getElementById("register-form")
      .addEventListener("submit", function (e) {
        e.preventDefault();
        let data = new FormData(this);
        errors = false;
        empty = false;
        loginLength = false;
        regDeclined = false;
        userExists = false;
        for (let value of data.entries()) {
          if (value[1] == "") {
            empty = true;
            errors = true;
          }
        }
        if (!empty) {
          if (data.get("login").length > 20 || data.get("login").length < 6) {
            loginLength = true;
            errors = true;
          }
          if (!data.get("reg")) {
            regDeclined = true;
            errors = true;
          }
        }
        if (!errors) {
          fetch("http://www.carsrentserver.fl/register.php", {
            method: "POST",
            body: data,
          })
            .then((res) => res.json())
            .then((res) => {
              switch (res) {
                case "success":
                  window.location.href = "/#/login";
                  break;
                case "user exists":
                  userExists = true;
              }
            });
        }
      });
  });
</script>

<main>
  <div class="main">
    <div class="shape" />
    <div class="form">
      <form id="register-form">
        <div class="column">
          <label for="login">Login:</label>
          <label for="pass">Password:</label>
          <label for="reg"
            >I accept <a href="/#/terms" target="_blank">the terms of use</a>:
          </label>
        </div>
        <div class="column">
          <input type="text" name="login" />
          {#if userExists}
            <p class="error">This user already exists.</p>
          {/if}
          {#if loginLength}
            <p class="error">Login should have between 6 and 50 characters.</p>
          {/if}
          <input type="password" name="pass" />
          <input type="checkbox" name="reg" />
          {#if regDeclined}
            <p class="error">You must accept the terms of use.</p>
          {/if}
          <input
            type="submit"
            value="REGISTER"
            style="background-color: #a62d37; border: none; color: white; cursor: pointer"
          />
          {#if empty}
            <p class="error">All fields should be filled</p>
          {/if}
        </div>
      </form>
    </div>
  </div>
</main>

<style>
  .error {
    font-size: 20px;
    color: #a62d37;
  }

  .main {
    position: relative;
    width: 100vw;
    height: 100vh;
    background-color: #a62d37;
  }

  .shape {
    width: 100%;
    height: 100%;
    position: absolute;
    background-color: #343434;
    clip-path: polygon(80% 0, 100% 0%, 100% 100%, 0% 100%);
  }

  .form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #ffffff99;
    color: black;
    padding: 40px;
    border-radius: 20px;
  }

  #register-form {
    display: flex;
    flex-direction: row;
    font-size: 30px;
  }

  .column > label {
    line-height: 44px;
    margin-top: 5px;
    margin-bottom: 5px;
    width: 350px;
  }

  .column > input {
    height: 40px;
    font-size: 30px;
    margin: 5px;
    width: 100%;
  }

  .column:nth-child(2) {
    align-items: center;
  }

  .column {
    display: flex;
    flex-direction: column;
    margin: 0 20px;
  }
</style>
