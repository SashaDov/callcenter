<h2>Информация о новом клиенте</h2>
<form class="form-horizontal" action="http://www.call/call/new-clients" method="post">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
        <label for="fio">Имя Отчество Фамилия:</label>
        <input type="text" class="form-control" name="fio" placeholder="Имя Отчество Фамилия" required>
    </div>
    <div class="form-group">
        <label for="number">Номер телефона:</label>
        <input type="tel" class="form-control" name="number" placeholder="79168976536" required>
    </div>
    <button type="submit" class="btn btn-success">Регистрация нового клиента</button>
</form>