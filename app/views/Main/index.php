
<h2>Call Center: вход для сотрудников</h2>
<form class="form-horizontal" action="http://www.call/main/autorization" method="post">
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Login:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" placeholder="Введите login" name="login" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Email:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="pwd" placeholder="Введите email" name="pwd" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Войти</button>
        </div>
    </div>
</form>

<?php
if (!empty($errors))
{ ?>
    <h3 color="red"><?=$errors[0]?></h3>
<?php } ?>