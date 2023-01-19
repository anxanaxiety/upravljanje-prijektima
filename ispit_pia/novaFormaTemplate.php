<template id="novaForma">
  <form action="dodaj.php" method="post" class="col-10 col-sm-8 col-lg-6 card d-flex align-self-stretch flex-column font-raleway p-0 h-100">
    <div class="card-header text-center fw-bold">
      <input type="hidden" name="bitnostProjekta" value="0" class="bitnost"></input>
      <i class="fa-regular fa-star" onclick="promeniBitnost(this);"></i>
      <input type="text" name="naslovProjekta" placeholder="Naslov projekta" class="w-75"></input>
      <br>
      <div class="fw-normal d-inline-block">
        <input type="date" name="rokProjekta"></input>
      </div>
      <input type="submit" class="fa-solid fa-check bg-transparent border-0 text-white d-inline-block" value=""></input>
    </div>

    <div class="card-body container p-5 overflow-auto h-100 custom-scrollbar" id="redovi">
      <div class="row my-2 border-md">
        <div class="col-8 col-lg-6">
          <input type="text" name="novitodo[]" class="w-100" placeholder="Stavka"></input>
        </div>
        <div class="col-2 col-lg-1">
          <input type="hidden" name="novabitnost[]" value="0" class="bitnost"></input>
          <i class="fa-regular fa-star" onclick="promeniBitnost(this);"></i>
        </div>
        <div class="col-lg">
          <input type="date" name="novitodoDatum[]" class="w-100"></input>
        </div>
        <div class="row d-flex justify-content-center" id="dodajRedDugme">
          <button type="button" class="text-center d-flex justify-content-center align-items-center bg-white border-0 s30x30 rounded-circle my-1" onclick="dodajRed(this);">+</button>
        </div>
      </div>

      <!-- <template id="redToDo">
        <div class="row my-2 border-md noviTodo">
          <div class="col-8 col-lg-6">
            <input type="text" name="todo[]" class="w-100" placeholder="Stavka"></input>
          </div>
          <div class="col-2 col-lg-1">
          <input type="hidden" name="bitnost[]" value="0" class="bitnost"></input>
          <i class="fa-regular fa-star" onclick="promeniBitnost(this);"></i>
          </div>
          <div class="col-lg">
            <input type="date" name="todoDatum[]" class="w-100"></input>
          </div>
          <div class="row d-flex justify-content-center" id="dodajRedDugme">
            <button type="button" class="text-center d-flex justify-content-center align-items-center bg-white border-0 s30x30 rounded-circle my-1" onclick="dodajRed(this);">+</button>
          </div>
        </div>
      </template> -->
    </div>
      <div class="card-footer d-flex justify-content-center">
        <div class="ikonica-tabela mx-2"><i class="fa-solid fa-message"></i></div>
        <div class="ikonica-tabela mx-2"><i class="fa-solid fa-user-group"></i></i></div>
        <div class="ikonica-tabela mx-2"><i class="fa-solid fa-arrow-down-wide-short"></i></div>
        <div class="ikonica-tabela mx-2"><i class="fa-solid fa-trash"></i></div>
      </div>
    </div>
</template>