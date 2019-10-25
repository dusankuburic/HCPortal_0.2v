
<div class="row justify-content-center"> 
    <div class="col-lg-4 col-4">
    <h2>Profesor Login</h2>
        <form method="post">
            <div class="form-group">
                <label>Korisnicko ime</label>
                <input type="text" class="form-control" id="username">
            </div>
            <div class="form-group">
                <label>Sifra</label>
                <input type="text" class="form-control" id="password">
            </div>
            <input type="submit" class="btn btn-primary" id="login" onclick="login_user()" value="Login">
        </form>
    </div>
</div>

<script src="../../js/core/prijava_profesor.js"></script>