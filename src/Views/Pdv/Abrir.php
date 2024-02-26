<?php require_once 'Views/Shared/Header.php'; ?>

<section class="modal radius">
    <div class="container flex justify-center">
        <div class="box-12 pd-10 animated bounceInDown mg-t-8 radius">
            
            <form action="" method="POST" class="modal-form box-12 pd-10 bg-branco shadow-down radius ">
            <h1 class="titulo fonte-poppin fonte20 espaco-letra fnc-preto  mg-b-4"> Abrir Caixa!</h1>

                <label class=""> Digite o Valor Inicial do Caixa!</label>
                <input type="hidden" name="usuario" value="<?php echo $_SESSION['id']; ?>" class="fnc-preto pd-l-1"  />
                <input type="hidden" name="dataabertura" value="<?php echo date("Y-m-d H:i:s"); ?>" class="fnc-preto pd-l-1"  />
                <input type="text"  name="valorinicial" class="fnc-preto pd-l-1" required="" />
                <input type="submit" value="Iniciar"  class="btn-100 bg-gradiente-azul-roxo fnc-branco" />
            </form>
        </div>
    </div>
    <div class="limpar"></div>
</section>
