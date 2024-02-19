            <div class="form_container">
                <i class='bx bx-x-circle form_close'></i>
                <!-- El Login -->
                <div class="form login_form">
                    <form action="login.php" method="post">
                        <h2>Inicia Sesion</h2>

                        <div class="input_box">
                            <input type="text" name="usuario" value="" placeholder="Introduzca su usuario" required>
                            <i class='bx bxs-envelope email'></i>
                        </div>
                        <div class="input_box">
                            <input type="password"  name="password" value="" placeholder="Introduzca su password" required>
                            <i class='bx bxs-lock-alt password'></i>
                        </div>
                        <div class="option_field">
                            <span class="checkbox">
                                <input type="checkbox" id="check">
                                <label for="check">Recuerdame</label>
                            </span>
                            <a href="" class="forgot_pw">Olvidaste tu contraseña?</a>
                        </div>
                        
                        <button class="button">Inicia Sesion</button>
                        <div class="login_signup">Todavia sin cuenta? Unete a nosotros! <a href="#" id="signup">Registrate</a></div>
                    </form>
                </div>
                <!-- El registro hay que modificarlo y hacer php -->
                <div class="form signup_form">
                    <form action="">
                        <h2>Registrate</h2>

                        <div class="input_box">
                            <input type="email" placeholder="Introduzca su usuario" required>
                            <i class='bx bxs-envelope email'></i>
                        </div>
                        <div class="input_box">
                            <input type="password" placeholder="Cree su password" required>
                            <i class='bx bxs-lock-alt password'></i>
                            <i class='bx bxs-lock-open-alt pw_hide' ></i>
                        </div>
                        <div class="input_box">
                            <input type="password" placeholder="Confirme su password" required>
                            <i class='bx bxs-lock-alt password'></i>
                            <i class='bx bxs-lock-open-alt pw_hide' ></i>
                        </div>
                        
                        <button class="button">Registrate</button>


                        <div class="login_signup">Ya tiene suna cuenta? <a href="#" id="login">Incica Sesion</a></div>
                    </form>
                </div>
            </div>