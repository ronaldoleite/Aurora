<?php require_once 'Views/Shared/Header.php'; ?>
<div class="body wd-100 hg-full bg-p3-paper  ">

    <section class="main-main mg-auto">
        <div class="container flex justify-center">
            <div class="box-12 loger mg-t-8 radius shadow-down borda-light pd-5">

                <div class="box-6"><h2 class="esconde-elemento">-</h2></div>

                <div class="box-6 bg-branco radius mg-t-4">
                    <h2 class=" pd-10 radius mg-b-3"><img src="lib/img/logo-roxo.png" alt="" class="logo-60 mg-auto" /></h2>
                    <!-- <h3 class="fonte14 fonte-fredoca pd-5 txt-c fnc-grape">Acesse com seu usuário e senha</h3> -->
                    <form action="" method="POST" class="pd-10">
                        <div class="box-12 mg-b-3 borda-1 hg-40 radius">
                            <div class="box-11">
                                <input class="hg-40 sem-borda" type="text" name="usuario" required="" placeholder="Digite seu usuário...">
                            </div>
                            <div class="box-1 flex justify-end pd-r-1">
                                <i class="fa-solid fa-user fonte18 mg-t-1 fnc-cinza-light"></i>
                            </div>

                        </div>

                        <div class="box-12 mg-b-2 borda-1 hg-40 radius">
                            <div class="box-11">
                                <input class="hg-40 sem-borda" type="password" name="senha" required="" placeholder="Digite sua senha...">
                            </div>
                            <div class="box-1 flex justify-end pd-r-1">
                                <i class="fa-solid fa-lock fonte18 mg-t-1 fnc-cinza-light"></i>
                            </div>

                        </div>

                        <div class="box-12 txt-d mg-b-2">
                            <a href="" class="fnc-cinza-claro fnc-cinza-hover fonte-fredoca fonte12">Esqueceu a senha?</a>
                        </div>

                        <div class="box-12 pd-b-1">
                            <input type="submit" value="Entrar" class="bg-gradiente-azul-roxo bg-gradiente-azul-roxo-hover fnc-branco hg-40 pointer">
                        </div>
                        <div class="box-12 pd-20">
                            <p class="fonte10 fnc-cinza-claro fonte-fredoca txt-c">&#169; 2023 </p>
                            <p class="fonte10 fnc-cinza-claro fonte-fredoca txt-c">Versão 1.0</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require_once 'Views/Shared/Footer.php'; ?>