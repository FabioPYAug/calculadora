<style>
  h1 {
    color: black;
    text-align: center;
  }

  p.uppercase {
    color: darkblue;
    text-transform: uppercase;
  }

  body {
    background: linear-gradient(-45deg, #ADD8E6, #B19CD9);
    background-size: 400% 400%;
    animation: gradient 15s ease infinite;
    height: 100vh;
  }

  @keyframes gradient {
    0% {
      background-position: 0% 50%;
    }

    50% {
      background-position: 100% 50%;
    }

    100% {
      background-position: 0% 50%;
    }
  }

  .calculator {
    width: 40%;
    padding: 25px;
    -webkit-box-shadow: 1px 2px 8px 1px rgba(0, 0, 0, 0.2);
    box-shadow: 4px 8px 16px 4px rgba(0, 0, 0, 0.2);
    border-radius: 30px;
  }

  .titulocal {
    font-size: 72px;
    font-style: bold;
    font-family: arial, sans-serif;
  }

  .historico {
    width: 50%;
    padding: 35px;
    -webkit-box-shadow: 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
    box-shadow: 1px 2px 8px 1px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    margin-right: 200;
  }

  .input {
    border: 1px solid #6075ad;
    height: 60px;
    padding-right: 15px;
    padding-top: 10px;
    text-align: right;
    font-size: 2.5rem;
    overflow-x: auto;
    transition: all .2s ease-in-out;
    color: black;
  }

  .input:hover {
    border: 1px solid #bbb;
    -webkit-box-shadow: inset 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
    box-shadow: inset 0px 1px 4px 0px rgba(0, 0, 0, 0.2);
  }

  .quadrado {
    width: 150px;
    height: 200px;
    background-color: gray;
    color: white;
    position: fixed;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    display: none;
    justify-content: center;
    align-items: center;
    text-align: center;
  }
</style>